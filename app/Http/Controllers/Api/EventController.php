<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Event;
use App\EventDetail;
use App\EventReservation;
use App\EventParticipant;
use Carbon\Carbon;
use App\ShareContactInformation;
use App\MakeReservation;
use App\EventLocation;
use App\SelectedDish;
use App\Notification;
use DB;

class EventController extends Controller
{
    
    /*/////////////////////////////////////
    GET EVENTS
    /////////////////////////////////////*/

    public function get_events(Request $request)
    {
        $type = $request->type;
        $user_id = Auth::user()->id;
        $all_events = DB::table('events as t1')
                     ->leftjoin('event_details as t2','t1.id','=','t2.event_id')
                     ->leftjoin('event_participants as participent','t1.id','=','participent.event_id')
                    //   ->leftjoin('event_reservations as t3','t1.id','=','t3.event_id')
                      ->select('t1.id as event_id','t1.user_id as owner_id','t1.event_code','t2.eve_name','t2.bg_img','t1.start_date_event as start_date', 't1.end_date_event as end_date')->where('participent.user_id',$user_id);
        // $all_events = Event::with('event_details', 'get_event_reservations')->select('id', 'user_id as owner_id', 'type', 'collect_info', 'fashion', 'registry', 'gift');

        if($type == 'active')
        {
            $all_events = $all_events->where('t1.end_date_event', '>=', Carbon::today())->orderBy('t1.id', 'DESC')->paginate(5);
            // $all_events = $all_events->whereHas('get_event_reservations', function($query){
            //     $query->whereDate('start_date', '>=', Carbon::today());
            // });
        }
        else if($type == 'past')
        {
            $all_events = $all_events->where('t1.end_date_event', '<', Carbon::today())->orderBy('t1.id', 'DESC')->distinct()->paginate(5);
            // $all_events = $all_events->whereHas('get_event_reservations', function($query){
            //     $query->whereDate('start_date', '<', Carbon::today());
            // });
        }
        else if($type == 'all')
        {
            $all_events = $all_events->distinct()->orderBy('t1.id', 'DESC')->paginate(5);
            // $all_events = $all_events->whereHas('get_event_reservations', function($query){
            //     // $query->whereDate('start_date', '<', Carbon::today());
            // });
        }
        // $all_events = $all_events->withCount([
        //         'event_participants as allow' => function($query) use ($user_id){
        //             $query->where('user_id', $user_id);
        //         }])->orderBy('id', 'DESC')->paginate(5);

        return response()->json(['status' => 200, 'message' => 'success', 'data' => $all_events]);
    }



    /*/////////////////////////////////////
    VERIFY EVENT CODE
    /////////////////////////////////////*/

    public function verify_event_code(Request $request)
    {
        $event = [
            'collect_info'=>0,
            'food_type'=>0,
            'need_reservation'=>0
        ];
        $data['user_id'] = Auth::user()->id;
        // $check_event = Event::where(['event_code'=> $request->event_code])->select('id', 'user_id as owner_id','collect_info', 'need_reservation','food_type')->with('event_details')->first();
        $check_event = DB::table('events')
                       ->join('event_details','events.id','=','event_details.event_id')->
                       where('event_code',$request->event_code)->first();
        if(!empty($check_event))
        {
            $check_participation = EventParticipant::where('user_id',Auth::user()->id)->where('event_id', $check_event->event_id)->first();
            if(!empty($check_participation))
            {
                return response()->json(['status' => 200, 'message' => 'You are already participant of this event.','data'=>$event,'verification'=>null]);
            }else{
            if($check_event->collect_info==0 && $check_event->need_reservation==0 && $check_event->food_type==0){
                
                    $data['event_id'] = $check_event->event_id;
                    $data['owner_id'] = $check_event->user_id;
                    EventParticipant::create($data);
                    $detail = EventDetail::where('event_id',$check_event->event_id)->first();
                    $user = User::where('id',$check_event->user_id)->first();
                    if(!empty($user))
                    {
                        if($user->guest_notification==1)
                        {
                            $notification = [
                                    'event_id'=> $check_event->event_id,
                                    'notifiy_by' => Auth::user()->id,
                                    'notify_to' =>  $check_event->user_id,
                                    'message'  => Auth::user()->name.' has joined event for '.$detail->eve_name
                            ];
                            Notification::create($notification);
                        }
                   }
                return response()->json(['status' => 200, 'message' => 'You can enter into the event.','data'=>$check_event,'verification'=>1 , 'event_id'=>$check_event->id]);
            }
            else{
            return response()->json(['status'=>200, 'message'=>'Event Code is Valid', 'data'=>$check_event]);
            }
         }
        }
        else
        {
            return response()->json(['status' => 200, 'message' => 'Event Code is not correct.','data'=>$event,'verification'=>0]);
        }
      
    }


     /*/////////////////////////////////////
    Share contact information
    /////////////////////////////////////*/

    public function share_contact_information(Request $request)
    {
        $data = [
            'event_id'=> $request->event_id,
            'user_id'=> Auth::user()->id,
            'address_id'=>$request->address_id
        ];
        ShareContactInformation::create($data);
        $event = Event::where('id',$request->event_id)->select('id as event_id','user_id as owner_id', 'need_reservation', 'food_type' )->first();
        if($event->need_reservation==0 && $event->food_type==0){
                
            $data['event_id'] = $event->event_id;
            $data['owner_id'] = $event->owner_id;
        EventParticipant::create($data);
        $detail = EventDetail::where('event_id',$event->event_id)->first();
        $user = User::where('id',$event->owner_id)->first();
        if(!empty($user))
        {
            if($user->guest_notification==1)
            {
                $notification = [
                'event_id'=> $event->event_id,
                'notifiy_by' => Auth::user()->id,
                'notify_to' =>  $event->owner_id,
                'message'  => Auth::user()->name.' has joined event for '.$detail->eve_name
                ];
                Notification::create($notification);
            }
        }
        return response()->json(['status' => 200, 'message' => 'You can enter into the event.','verification'=>1 , 'event_id'=>$event->event_id]);
        }
        else{
        return response()->json(['status'=>200, 'message'=>'Information added successfully', 'data'=>$event]);
        }
    }

     /*/////////////////////////////////////
    Make a reservation
    /////////////////////////////////////*/
    public function make_reservation(Request $request)
    {
        $user = Auth::user()->id;
        if($request->has('person')){
        MakeReservation::create($request->all());
        }
        $event = Event::where('id',$request->event_id)->select('id as event_id','user_id as owner_id', 'food_type', 'user_id')->first();
        if($event->food_type==0){
                
            $data['event_id'] = $event->event_id;
            $data['owner_id'] = $event->owner_id;
            $data['user_id'] = $user;
            EventParticipant::create($data);
            $detail = EventDetail::where('event_id',$event->event_id)->first();
            $user = User::where('id',$event->owner_id)->first();
            if(!empty($user))
            {
                if($user->guest_notification==1)
                {
                    $notification = [
                        'event_id'=> $event->event_id,
                        'notifiy_by' => Auth::user()->id,
                        'notify_to' =>  $event->owner_id,
                        'message'  => Auth::user()->name.' has joined event for '.$detail->eve_name
                    ];
                    Notification::create($notification);
                }
            }
        return response()->json(['status' => 200, 'message' => 'You can enter into the event.','verification'=>1 , 'event_id'=>$event->event_id]);
        }
        else{
        return response()->json(['status'=>200, 'message'=>'Information added successfully', 'data'=>$event]);
        }
    }

    /*/////////////////////////////////////
    EVENT INFORMATION
    /////////////////////////////////////*/

    public function event_information(Request $request)
    {

        $event = Event::select('id', 'user_id as owner_id', 'type','fashion','gift');

        if($request->type == 'information')
        {
            $event = $event->with('event_details', 'get_event_reservations', 'event_locations','witnesses');
        }
        else if($request->type == 'gifts')
        {
            $event = $event->with('event_gifts', 'event_registries');
        }
        else
        {
            $event = $event->with('event_fashions');
        }

        $event = $event->where('id', $request->event_id)->get();
        return response()->json(['status' => 200, 'message' => 'Event Information', 'data' => $event]);
    }
   
     /*/////////////////////////////////////
     My Events
    /////////////////////////////////////*/
     public function my_events()
     {
        $user_id = Auth::user()->id;
        $events = DB::table('event_details as t1')
                ->join('events as t2','t1.event_id','=','t2.id')
                ->select('t1.*','t2.*')
                ->where('t1.user_id',$user_id)->get();
        if($events)
        {
         return response()->json(['status' => 200, 'message' => 'My Events', 'data' => $events]);
        }
        else
        {
         return response()->json(['status' => 200, 'message' => 'No Record Found.']);
        }
     }
      /*/////////////////////////////////////
     Search Events
     /////////////////////////////////////*/
     public function search_events(Request $request)
     {
         $events = DB::table('event_details as t1')
                    ->join('events as t2','t1.event_id','=','t2.id')
                    ->select('t1.*', 't2.*')
                    ->where('t1.eve_name','like',"%".$request['event_name']."%")->get();
        if($events)
        {
            return response()->json(['status' => 200, 'message' => 'Events', 'data' => $events]);
        }
        else
        {
            return response()->json(['status' => 200, 'message' => 'No Record Found.']);
        }  
     }

       /*/////////////////////////////////////
     Gifts Donations
     /////////////////////////////////////*/

     public function gift_donations(Request $request)
     {
         $qry = 0;
         $gif_donation['user_id'] = Auth::user()->id;
         $gif_donation['gift_id'] = $request['gift_id'];
         $gif_donation['email'] = $request['email'];
         $gif_donation['donation_amount'] = $request['donation'];
         $gif_donation['created_at'] = Carbon::now();
         $gif_donation['updated_at'] = Carbon::now();
        $gift = DB::table('event_gifts')->where('id',$request['gift_id'])->first();
        if(!empty($gift))
        {
            $data['total_donation'] =$gift->total_donation+$request->donation;
            $qry = DB::table('event_gifts')->where('id',$request['gift_id'])->update($data);
        }
        if($qry)
        {
            DB::table('gift_donations')->insert($gif_donation);
            return response()->json(['status' => 200, 'message' => 'Donation Added Successfully']);
        }
        else
        {
            return response()->json(['status' => 200, 'message' => 'Error:']);
        }
     }

      /*/////////////////////////////////////
     Event Days
     /////////////////////////////////////*/

     public function event_days(Request $request)
     {
        $event_days = Event::where('id',$request->event_id)->with('event_locations')->get();
        return response()->json(['status' => 200, 'message' => 'Event days', 'data'=>$event_days]);
     }

      /*/////////////////////////////////////
     All menu
     /////////////////////////////////////*/

     public function all_menu(Request $request)
     {
        $menu = EventLocation::where(['id'=>$request->event_day_id])->with('get_single_menus','get_platted_menu.platted_items')->get();
        return response()->json(['status' => 200, 'message' => 'Event days', 'data'=>$menu]);
     }

       /*/////////////////////////////////////
     Selected platted menu
     /////////////////////////////////////*/

     public function selected_platted_menu(Request $request)
     {
         $user = Auth::user()->id;
        if(isset($request->selected_dishes)){ 
        foreach($request->selected_dishes as $selected_dish)
        {
            // print_r($selected_dish[0]);
            // print_r($selected_dish[1]);

            $data = [
                  'user_id'=>$user,
                  'event_id'=>$request->event_id,
                  'event_location_id'=>$selected_dish[1],
                  'platted_dish_id'=>$selected_dish[0]
            ];
            SelectedDish::create($data);
          }
        }
        $event = Event::where('id',$request->event_id)->select('id as event_id','user_id as owner_id', 'food_type')->first();
            $data['event_id'] = $event->event_id;
            $data['owner_id'] = $event->owner_id;
            $data['user_id'] = $user;
        EventParticipant::create($data);
        $detail = EventDetail::where('event_id',$event->event_id)->first();
        $user = User::where('id',$event->owner_id)->first();
        if(!empty($user))
        {
            if($user->guest_notification==1)
            {
                $notification = [
                    'event_id'=> $event->event_id,
                    'notifiy_by' => Auth::user()->id,
                    'notify_to' =>  $event->owner_id,
                    'message'  => Auth::user()->name.' has joined event for '.$detail->eve_name
                ];
                Notification::create($notification);
            }
        }
        return response()->json(['status' => 200, 'message' => 'Dishes added successfully']);
     }

      /*/////////////////////////////////////
     All programs
     /////////////////////////////////////*/

     public function all_programs(Request $request)
     {
        $programs =  DB::table('event_program_details')
                ->leftjoin('event_program_descriptions','event_program_details.id','=','event_program_descriptions.event_program_details_id')
                ->where('event_id',$request->event_id)->where('event_location_id',$request->event_day_id)
                ->select('event_program_details.event_id','event_program_details.start_date','event_program_details.start_time','event_program_details.event_location_id as event_day_id','event_program_descriptions.description as program_name')
                ->get();
         $participants = EventParticipant::where('event_id',$request->event_id)->with('user')->get();   
         return response()->json(['status' => 200, 'message' => 'Programs found', 'data'=>$programs, 'participants'=>$participants]); 
     }


     /*/////////////////////////////////////
     All participants
     /////////////////////////////////////*/

     public function all_participants(Request $request)
     {
         $participants = EventParticipant::where('event_id',$request->event_id)->with('user')->get();   
         return response()->json(['status' => 200, 'message' => 'Programs found', 'participants'=>$participants]); 
     }
  
     public function all_selected_menu(Request $request)
     {
        $platted_food = DB::table('selected_dishes')
                        ->join('platted_dish_items','selected_dishes.platted_dish_id','=','platted_dish_items.platted_dish_name_id')
                        ->join('platted_dish_names','selected_dishes.platted_dish_id','=','platted_dish_names.id')
                        ->where('selected_dishes.event_id',$request->event_id)
                        ->where('selected_dishes.event_location_id',$request->day_id)
                        ->select('platted_dish_items.platted_dish_item as dish_item','platted_dish_names.dish_name as category')
                        ->orderBy('platted_dish_names.dish_name','ASC')->get();
        $viewonly_food = DB::table('event_single_menus')->where('event_id',$request->event_id)
                        ->where('event_location_id',$request->day_id)->select('name as dish_item','status as category')->get();
        return response()->json(['status' => 200, 'message' => 'Food found', 'platted'=>$platted_food, 'viewonly_food'=>$viewonly_food]);     
     }
}
