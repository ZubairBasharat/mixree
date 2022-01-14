<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Hash;
use App\UserAddress;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    // user login function
    public function user_login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {

            $error = $validator->messages();
            return response()->json(['status' => 100, 'message' => $error->first()]);
        } else {

            $data = array(
                'email' => $request->email,
                'password' => $request->password
            );

            if (Auth::attempt($data)) {

                User::where('id',$user = Auth::user()->id)->update(['online_status'=>1]);
                $user = Auth::user();
                // $token =  $user->createToken('token')->accessToken;
                $token = $user->createToken('Personal Access Token')->accessToken;
                return response()->json(['status' => 200, 'message' => 'User login successfully!', 'data' => $user, 'token' => $token ]);
            } else {

                return response()->json(['status' => 100, 'message' => 'Please Provide valid credentials']);
            }
        }
    }

    //  user registration function
    public function user_register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required',

        ]);

        if ($validator->fails()) {

            $error = $validator->messages();
            return response()->json(['status' => 100, 'message' => $error->first()]);
            // return $error->first();
        } else {

            $data = $request->all();
            $data['password'] = bcrypt($data['password']);
            $data['type'] = 'guest';
            // $data['image'] = NULL;
            $user = User::create($data);
            
            Auth::login($user);
            $user_details = Auth::user();
            $data = User::find($user_details->id);
            // create passport token
            $token =  $user->createToken('authToken')->accessToken;
            return response()->json(['status' => 200, 'message' => 'User registered successfully', 'data' => $data , 'token' => $token]);
        }
        
    }

    public function forget_password(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {

            $error = $validator->messages();
            return response()->json(['status' => 100, 'message' => $error->first()]);
            // return $error->first();
        } else {

            $user = User::where(['email' => $request->email])->first();

            if (!empty($user)) {
                
                $password = Str::random(8);
                // $password =  '4yz6ex@%*!' . rand(100000, 500000);

                $email = User::where(['email' => $request->email])->first();
                // $email->password = bcrypt($password);
                $email->password = Hash::make($password);
                $email->update();

                $to = $request->email;
                $subject = "Forget Password";
                $message = 'Your new password is ' . $password . '.';

                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: no-reply@mixrre.net\nX-Mailer: PHP/";

                mail($to, $subject, $message, $headers);

                return response()->json(['status' => 200, 'message' => 'New password has been sent to your email']);
            } else {

                return response()->json(['status' => 100, 'message' => 'Email not found']);
            }
        }
    }

    // social login
    public function social_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {

            $error = $validator->messages();
            return response()->json(['status' => 100, 'message' => $error->first()]);
        } else {

            $user = User::where('email', '=', $request->email)->first();

            if ($user) {
                
                $user->image = $request->image;
                $user->social_network = $request->social_network;
                $user->social_token = $request->social_token;
                $user->online_status = 1;
                $user->save();

                Auth::login($user);
                $token = $user->createToken('Personal Access Token')->accessToken;
                
                return response()->json(['status' => 200, 'message' => 'User Logged in successfully!', 'data' => $user, 'token' => $token]);

            } else {

                // create a new user
                $create_user = User::create([
                    'name' => $request->name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'social_network' => $request->social_network,
                    'social_token' => $request->social_token,
                    'image' => $request->image,
                    'password' => '',
                    'type' => 'guest',
                ]);

                Auth::login($create_user);
                $token = $create_user->createToken('Personal Access Token')->accessToken;
                 return response()->json(['status' => 200, 'message' => 'User Logged in successfully!', 'data' => $create_user, 'token' => $token]);
            }

        }
    }
    public function logout()
    {
        if (Auth::check()) {
            User::where('id',Auth::user()->id)->update(['online_status'=>0]);
            Auth::user()->token()->revoke();
         }
    }

    public function save_address(Request $request)
    {
        $request['user_id'] = Auth::user()->id;
        $address = UserAddress::create($request->all());
        return response()->json(['status'=>200, 'message'=>'Address added successfully','data'=> $address]);
    }
    
    public function edit_address(Request $request)
    {
       $address = UserAddress::where('id',$request->address_id)->get();
       return response()->json(['status'=>200, 'message'=>'Addresses Found', 'data'=>$address]);
    }
    
    public function update_address(Request $request)
    {
        UserAddress::where('id',$request->id)->update($request->except('address_id'));
        return response()->json(['status'=>200, 'message'=>'Address updated successfully', 'data'=>$request->all()]);
    }

    // public function delete_address(Request $request)
    // {
    //    if(UserAddress::where('id',$request->address_id)->delete())
    //    {
    //    return response()->json(['status'=>200, 'message'=>'Addresses Deleted Successfully']);
    //    }else{
    //     return response()->json(['status'=>200, 'message'=>'Addresses Not Deleted']);
    //    }
    // }
    public function get_addresses()
    {
        $addresses = UserAddress::where('user_id',Auth::user()->id)->get();
        foreach($addresses as $address)
        {
            $address['isSelect'] = false;
        }
        return response()->json(['status'=>200, 'message'=>'Addresses Found', 'data'=>$addresses]);
    }

}
