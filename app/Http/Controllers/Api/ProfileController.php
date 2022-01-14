<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Auth;
use Hash;
use App\User;

class ProfileController extends Controller
{
    public function get_profile(Request $request)
    {

        $user = Auth::user();

        return response()->json(['status' => 200, 'message' => 'User profile details', 'data' => $user]);
    }

    public function receive_notification(Request $request)
    {

        $user_detail = Auth::user();
        $user = User::where('id', $user_detail->id)->first();

        if ($user_detail->notification_status == 0) {

            $user->notification_status = 1;
            $user->save();
        } else {

            $user->notification_status = 0;
            $user->save();
        }

        return response()->json(['status' => 200, 'message' => 'Notification status updated', 'data' => $user]);
    }

    public function update_profile(Request $request)
    {
        $user_id = Auth::user()->id;
        $requestData = $request->all();

        if($request->has('email'))
        {
            $check_user_email = User::where('email', $request->email)->first();
            if($check_user_email)
            {
                if(($check_user_email->id != $user_id))
                { 
                    return response()->json(['status' => 100, 'message' => 'Email already exists.']);
                }
            }
        }

        if(($request->has('password')) && !empty($request->password))
        {
            $requestData['password'] = Hash::make($request->password);
        }

        if($request->has('image'))
        {
            $file = $request->file('image');
            $file_name = time(). '.' .$file->getClientOriginalName();
            $location = app()->basePath('public/user_profiles/');
            $file->move($location, $file_name);
            $requestData['image'] = 'public/user_profiles/'. $file_name; 
        }

        User::where('id', $user_id)->update($requestData);

        return response()->json(['status' => 200, 'message' => 'User profile updated Successfully!',"data"=>Auth::user()]);
    }
}
