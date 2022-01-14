<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use Carbon\Carbon;
use App\MingleProfile;
use App\User;
use App\Event;
use App\MingleRequest;
class MingleController extends Controller
{

  // create mingle profile

  public function create_mingle_profile(Request $request)
  {
    $check_profile = MingleProfile::where('user_id',Auth::user()->id)->where('event_id',$request->event_id)->first();
    if(empty($check_profile))
    {
        $image = "";
        if($request->has('image'))
        {
            $file = $request->file('image');
            $file_name = time(). '.mingle_.' .$file->getClientOriginalName();
            $location = app()->basePath('public/images/mingle_profile');
            $file->move($location, $file_name);
            $image = 'public/images/mingle_profile/'. $file_name;
        }

        $mingle_data = [
                'user_id'  => Auth::user()->id,
                'event_id' => $request->event_id,
                'name'     => $request->name,
                'image'    => $image,
                'status'   => 1
        ];
        $mingle = MingleProfile::create($mingle_data);
        if($mingle)
        {
          return response()->json(['status'=>200, 'message'=>'Profile created successfully', 'data'=> $mingle]);
        } else {
          return response()->json(['status'=>200, 'message'=>'Profile not created']);
        }
      }
      else {
        return response()->json(['status'=>200, 'message'=>'Profile already created']);
      }
    }
    
    //get mingle profile
    public function get_mingle_profile(Request $request)
    {
      $check_profile = MingleProfile::where('user_id',Auth::user()->id)->where('event_id',$request->event_id)->first();
      if(empty($check_profile))
      {
        return response()->json(['status'=>200, 'message'=>'Profile not available', 'available'=> 0]);
      } else {
        return response()->json(['status'=>200, 'message'=>'Profile available', 'data'=>$check_profile, 'available'=> 1, 'status_bit'=>$check_profile->status]);
      }
    }

    //change mingle status
    public function change_profile_status(Request $request)
    {
      $status = MingleProfile::where('user_id',Auth::user()->id)->where('event_id',$request->event_id)->update(['status'=> $request->status]);
      if($status)
      {
        return response()->json(['status'=>200, 'message'=>'status updated successfully', 'status_bit'=>$request->status]);
      } else {
        return response()->json(['status'=>200, 'message'=>'Status not updated ']);

      }
    }

    // get all active mingle users
    public function get_active_users(Request $request)
    {
      $active_users = MingleProfile::where('event_id',$request->event_id)->where('status',1)->where('user_id','!=',Auth::user()->id)->get();
      $status = MingleProfile::where('event_id',$request->event_id)->where('user_id',Auth::user()->id)->first();
      if(!empty($status))
      {
       return response()->json(['status'=>200, 'message'=>'Users found', 'data'=>$active_users, 'available_mingle'=>$status, 'available'=>1, 'status_bit'=>$status->status]);
      } else {
        return response()->json(['status'=>200, 'message'=>'Users found', 'data'=>$active_users, 'available_mingle'=>"", 'available'=>0]);
      }
    }

    // send request
    public function send_request(Request $request)
    {
      $status = MingleRequest::where('requested_by',$request->requested_by)->where('event_id',$request->event_id)->where('requested_to',$request->requested_to)->first();
      if(empty($status))
      {
        $check_request = MingleRequest::where('requested_to',$request->requested_by)->where('event_id',$request->event_id)->where('requested_by',$request->requested_to)->first();
        if(empty($check_request))
        {
          $request_data = [
                'event_id' => $request->event_id,
                'requested_to' => $request->requested_to,
                'requested_by'  => $request->requested_by
          ];
          if(MingleRequest::create($request_data))
          {
            return response()->json(['status'=>200, 'message'=>'Request sent successfully']);
          } else {
            return response()->json(['status'=>200, 'message'=>'Request not sent successfully due to some error']);
          }
        } else {
          return response()->json(['status'=>200, 'message'=>'This user already sent you request']);
        }
      } else {
        return response()->json(['status'=>200, 'message'=>'Request already sent']);
      }
    }

    //get all requested mingle users
    public function get_requested_users(Request $request)
    {
      $requests = MingleRequest::where('event_id', $request->event_id)->where('requested_to', $request->requested_to)->with('requested_by.user')->where('status',0)->get();
      $end_date = Event::where('id',$request->event_id)->first()->end_date_event;
      if(count($requests)>0)
      {
       return response()->json(['status'=>200, 'message'=>'Requests found', 'data'=>$requests, 'requested_to'=>Auth::user(), 'end_date'=>$end_date]);
      } else {
        return response()->json(['status'=>200, 'message'=>'Requests not availalbe']);
      }
    }

    //reques response
    public function request_response(Request $request)
    {
      $status= $request->response;
      MingleRequest::where('id',$request->request_id)->update(['status'=>$request->response]);
      if($request->response==1)
      {
        $request = MingleRequest::where('id',$request->request_id)->first()->requested_by;
        $user_id = MingleProfile::where('id',$request)->first()->user_id;
        $user = User::where('id',$user_id)->first();
        return response()->json(['status'=>200,'message'=> 'Mingle request accepted','accept_bit'=>$status, 'accepted_by'=>  Auth::user(), 'requested_by'=>$user ]);
      } else {
        MingleRequest::where('id',$request->request_id)->delete();
        return response()->json(['status'=>200,'message'=> 'Mingle request rejected']);
      }
    }

    //get mingle friends
    public function mingle_friends(Request $request)
    {
      $friends = MingleRequest::where('event_id', $request->event_id)->where('requested_to', $request->requested_to)->with('requested_by')->where('status',1)->get();
      if(count($friends)>0)
      {
        return response()->json(['status'=>200, 'message'=> 'Friends list', 'data'=>$friends]);
      } else {
        return response()->json(['status'=>200, 'message'=> 'Friends list empty']);
      }
    }
}
