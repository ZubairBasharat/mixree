<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Event;
use App\EventGift;
use App\EventDetail;
use App\EventLocation;
use App\Witneess;
use Illuminate\Support\Carbon;

class EventUpdateController extends Controller
{
    //update event details
    public function update_event_detail(Request $request)
    {
        DB::table('event_locations')->where('event_id',$request->event_id)->whereNotIn('id',$request->locations)->delete();
        $user = Auth::user();
        $explode = (explode("-", $_POST['start_dt_1']));
        // print_r($explode);die;
        $first_date = date('Y-m-d', strtotime($_POST['start_dt_1']));
        // echo $first_date;/die;
        $min_date = $first_date;
        $max_date = $first_date;
        $data = [
             'event_id' => $request->event_id,
             'user_id' => $user->id,
             'eve_name' => $request->eve_name,
             'groom_first_name' => $request->groom_first_name,
             'groom_last_name' => $request->groom_last_name,
             'bride_last_name' => $request->bride_last_name,
             'bride_first_name' => $request->bride_first_name,
             'guest_note' => $request->guest_note,
             'story' => $request->story,
             'no_of_days' => $request->no_of_days,
             'no_of_witness' => $request->no_of_witness,
        ];
        $witness= 1;
        $witness_type = 0;
        if ($request->hasFile('icon')) {
            
            $icon = time() . $request->icon->getClientOriginalName();
            $destinationPath = public_path('/images/event_images');
            $request->icon->move($destinationPath, $icon);
            $data['icon'] = $icon;

        }
        
        if ($request->hasFile('groom_img')) {
            
            $groom_img = time() . $request->groom_img->getClientOriginalName();
            $destinationPath = public_path('/images/event_images');
            $request->groom_img->move($destinationPath, $groom_img);
            $data['groom_img'] = $groom_img;

        }
        if ($request->hasFile('bride_img')) {
            
            $bride_img = time() . $request->bride_img->getClientOriginalName();
            $destinationPath = public_path('/images/event_images');
            $request->bride_img->move($destinationPath, $bride_img);
            $data['bride_img'] = $bride_img;

        }
    
        
        if ($request->hasFile('bg_img')) {
            
            $bg_img = time() . $request->bg_img->getClientOriginalName();
            $destinationPath = public_path('/images/event_images');
            $request->bg_img->move($destinationPath, $bg_img);
            $data['bg_img'] = $bg_img;

        }
        EventDetail::where('event_id',$request->event_id)->update($data);
        Witneess::where('event_id',$request->event_id)->delete();
        $images = 0;
            for($i=1; $i<=$request->no_of_witness; $i++){
           $witness_data = [
               'first_name'=>$_POST['witness_first_name_'.$witness],
               'last_name'=>$_POST['witness_last_name_'.$witness],
               'biography'=>$_POST['witness_biography_'.$witness],
               'witness_type' => $request->witness_type[$witness_type],
               'user_id' => $user->id,
               'event_id' => $request->event_id,
               'created_at' =>  Carbon::now(),
                'updated_at' => Carbon::now()
         ];
         if (!empty($request->witness_images[$images])) {
            $witness_img = time() . $request->witness_images[$images]->getClientOriginalName();
           $destinationPath = public_path('/images/event_images');
           $request->witness_images[$images]->move($destinationPath, $witness_img);
           $witness_data['witness_image'] = $witness_img;
         } else {
            $witness_data['witness_image'] = $request->old_img[$images];
         }
        //  return $witness_data;
         Witneess::create($witness_data);
         $witness++;
         $images++;
     }
    //}
        $locations = $request->only('name','location');
        $latlang = 1;
        $event_detail = EventDetail::where('event_id',$request->event_id)->first();
        // DB::table('event_locations')->where('event_id',$request->event_id)->delete();
        for($i=0;$i<sizeof($locations['name']);$i++){
            // $dt_time = (explode("-", $_POST['start_dt_'.$latlang]));
            $start_date = date('Y-m-d', strtotime($_POST['start_dt_'.$latlang]));
            $location_data = [
                'user_id' => $user->id,
                'event_id' => $request->event_id,
                'event_detail_id' => $event_detail->id,
                'name' => $locations['name'][$i],
                'address' => $locations['location'][$i],
                'lat'=>$_POST['lat_'.$latlang],
                'lang'=> $_POST['lang_'.$latlang],
                'start_date' => $start_date,
                'start_time'=> $_POST['start_time_'.$latlang],
                // 'end_time' => $_POST['end_time_'.$latlang],
                'created_at' =>  Carbon::now(),
                'updated_at' => Carbon::now(),
                ];  
                if($start_date>$max_date)
                {
                    $max_date = $start_date;
                }
                if($start_date<$min_date)
                {
                    $min_date = $start_date;
                }
                $latlang++;
                if(isset($request->locations[$i]))
                {
                    DB::table('event_locations')->where('id',$request->locations[$i])->update($location_data);
                } else {
                    DB::table('event_locations')->insert($location_data);
                }
        }
        // echo $max_date;
        // echo $min_date;die;
        Event::where('id',$request->event_id)->update(['end_date_event'=>$max_date,'start_date_event'=>$min_date]);
        return redirect('create_event_gift/'.$request->event_id);
    }

    //update event gifts
    public function update_event_gifts(Request $request){
        EventGift::where('event_id',$request->event_id)->delete();
        $payment_counter = 0;
        $user = Auth::user();
        if($request->gift == 1){
            $event = Event::find($request->event_id);
            $event->gift = 1;
            $event->save();
        }
        if($request->registry == 1){
            $event = Event::find($request->event_id);
            $event->registry = 1;
            $event->save();
        }
        if($request->gift==1){
        foreach($request->payment_type as $payment_type)
        {
            if($payment_type=='bank_account')
            {
                $name_of_bank = $request->name_of_bank[$payment_counter];
                $name_of_account = $request->name_of_account[$payment_counter];
                $acount_number = $request->account_number[$payment_counter];
                $payment_email = "";
                $paymant_image = "";
            }
            else{
                $name_of_bank = "";
                $name_of_account = "";
                $acount_number = "";
                $paymant_image = $payment_type.".png";
                $payment_email = $request->payment_email[$payment_counter];
            }

            $payment_data = [
                'user_id'=>$user->id,
                'event_id'=>$request->event_id,
                'payment_type'=> $payment_type,
                'payment_image'=> $paymant_image,
                'name_of_bank'=>$name_of_bank,
                'name_of_account'=> $name_of_account,
                'account_number'=> $acount_number,
                'payment_email'=> $payment_email,
                'gift'=>$request->gift,
                'registry'=>$request->registry,
                'created_at' =>  Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            EventGift::create($payment_data);
           $payment_counter++;
        }
       }
        $data = $request->all();
        $data['event_id'] = $request->event_id;
        $data['user_id'] = $user->id;
        $registry = $request->only('registryname','registrylink');
        DB::table('event_registries')->where('event_id',$request->event_id)->delete();
       if($request->registry==1){

         if(isset($registry['registryname']))
         {
            for($i=0;$i<sizeof($registry['registryname']);$i++){
                
                $registry_data[] = array(
                    'user_id' => $user->id,
                    'event_id' => $request->event_id,
                    'name' => ($data['registry'] == 1 ? $registry['registryname'][$i] : NULL),
                    'link' => ($data['registry'] == 1 ? $registry['registrylink'][$i] : NULL),
                    'created_at' =>  Carbon::now(),
                    'updated_at' => Carbon::now(),
                    );
            }
            DB::table('event_registries')->insert($registry_data);
        }
      }
        return redirect('create_event_fashion/'.$request->event_id);
    }

    //update event fashion

    public function update_event_fashion(Request $request){
        $data = $request->all();
        $user = Auth::user();
        if($data['fashion']!=0)
        {
            if($data['fashion'] == 1)
            {
                $event = Event::find($request->event_id);
                $event->fashion = 1;
                $event->save();
            } else {
                $event = Event::find($request->event_id);
                $event->fashion = 0;
                $event->save();
            }

            DB::table('event_fashions')->where('event_id',$request->event_id)->delete();
            //if dresscode type is general_dress_code
            if($request->dresscode_type=="general_dress_code")
            {
                if(isset($request->dreescode_description))
                {  
                    foreach($request->dreescode_description as $description)
                    {
                        $fashion_data[] = array(
                            'user_id' => $user->id,
                            'event_id' => $request->event_id,
                            'code_for_guest'=> $request->code_for_guest,
                            'dress_code_description'=>$description,
                            'type'=>$request->dresscode_type,
                            'name' => "",
                            'description' => "",
                            'image' => "",
                            'price' => "",
                            'link'=>"",
                            'coupon_code' => "",
                            'created_at' =>  Carbon::now(),
                            'updated_at' => Carbon::now(),
                            );
                    }
                    DB::table('event_fashions')->insert($fashion_data);
                }
            }
            if($request->dresscode_type=="link_to_purchase")
            {
                if(isset($data['item_name']))
                {
                    for($i=0;$i<sizeof($data['item_name']);$i++)
                    {
                    
                        if(isset($data['item_image'][$i]))
                        {
                            
                            $event_image = time() . $data['item_image'][$i]->getClientOriginalName();
                            $destinationPath = public_path('/images/event_images');
                            $data['item_image'][$i]->move($destinationPath, $event_image);
                        } else {
                            $event_image =  $data['hidden_link_image'][$i];
                        }
                            $fashion_data[] = array(
                                'user_id' => $user->id,
                                'event_id' => $request->event_id,
                                'code_for_guest'=> $request->code_for_guest,
                                'dress_code_description'=>"",
                                'type'=>$request->dresscode_type,
                                'name' => ($data['fashion'] == 1 ? $data['item_name'][$i] : NULL),
                                'description' => ($data['fashion'] == 1 ? $data['item_description'][$i] : NULL),
                                'image' => $event_image,
                                'price' => ($data['fashion'] == 1 ? $data['item_price'][$i] : NULL),
                                'link' => ($data['fashion'] == 1 ? $data['item_link'][$i] : NULL),
                                'coupon_code' => $data['coupon_code'][$i],
                                'created_at' =>  Carbon::now(),
                                'updated_at' => Carbon::now(),
                                );
                    }
                    DB::table('event_fashions')->insert($fashion_data);
                }
            }
            if($request->dresscode_type=="purchase_event_outfit")
            {
                if(isset($data['outfit_name']))
                {
                    for($i=0;$i<sizeof($data['outfit_name']);$i++)
                    {
                    
                        if(isset($data['outfit_image'][$i]))
                        {
                            
                            $event_image = time() . $data['outfit_image'][$i]->getClientOriginalName();
                            $destinationPath = public_path('/images/event_images');
                            $data['outfit_image'][$i]->move($destinationPath, $event_image);
                        } else {
                            $event_image =  $data['hidden_outfit_image'][$i];;
                        }
            
                        $fashion_data[] = array(
                            'user_id' => $user->id,
                            'event_id' => $request->event_id,
                            'code_for_guest'=> $request->code_for_guest,
                            'type'=>$request->dresscode_type,
                            'dress_code_description'=>"",
                            'name' => ($data['fashion'] == 1 ? $data['outfit_name'][$i] : NULL),
                            'description' => ($data['fashion'] == 1 ? $data['outfit_description'][$i] : NULL),
                            'image' => $event_image,
                            'price' => ($data['fashion'] == 1 ? $data['outfit_price'][$i] : NULL),
                            'link'=>"",
                            'coupon_code' => "",
                            'created_at' =>  Carbon::now(),
                            'updated_at' => Carbon::now(),
                            );
                    }
                DB::table('event_fashions')->insert($fashion_data);
                }
            }
        }
        return redirect('add_event_program_details/'.$request->event_id);
    }

    //update create event
    public function update_event(Request $request)
    {
        // return $request->all();
        $user = Auth::user();
        $event = $request->only('days', 'type', 'event_code', 'collect_info');
        $event['need_reservation'] =  $request->need_reservation == 'yes' ? 1 : 0;
        $event['user_id'] = $user->id;
        Event::where('id',$request->event_id)->update($event);
        return redirect('create_event_detail/' . $request->event_id);
    }

    public function check_event_code(Request $request)
    {
        $event =  Event::where('event_code',$request->code)->where('user_id','!=',Auth::user()->id)->first();
        if(!empty($event))
        {
          $status = false;
        } else {
            $status = true;
        }
        echo $status;
    }
}
