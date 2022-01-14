<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Socialite;
use Illuminate\Support\Str;
use Hash;
use App\Event;
use App\EventDetail;
use App\EventFashion;
use App\EventGift;
use App\EventLocation;
use App\EventRegistry;
use App\EventReservation;
use Carbon\Carbon;
use DB;
use App\Notification;
// use Session;
use Google_Client;
use Google_Service_Oauth2;
use Google_Service_Drive;
// use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function __construct(){
        
        $google_client = new Google_Client();

        //Set the OAuth 2.0 Client ID
        $google_client->setClientId('190288791081-i29l09hpmp9o7hgevlr8kgroimckl665.apps.googleusercontent.com');

        //Set the OAuth 2.0 Client Secret key
        $google_client->setClientSecret('48YCLh9NUOYA4mjPaNq-J_Pp');

        //Set the OAuth 2.0 Redirect URI
        $google_client->setRedirectUri('https://mixer.appcrates.co/auth/google/callback');
        
        $google_client->setAccessType('online');
        // $google_client->setIncludeGrantedScopes(true);
        $google_client->approval_prompt=('auto');
        $google_client->setApplicationName(config('services.google.Mixrre'));
        $google_client->setScopes('openid');
        $google_client->setScopes('profile');
        $google_client->setScopes('email');
        // $google_client->setScopes(array(
        // "https://www.googleapis.com/auth/plus.login",
        // "https://www.googleapis.com/auth/userinfo.email",
        // "https://www.googleapis.com/auth/userinfo.profile",
        // "https://www.googleapis.com/auth/plus.me",
        // ));
        
        $this->google_client = $google_client;
        session_start();
    }
    
    // user login function
    public function user_login(Request $request)
    {
        $validatedData = $request->validate([
            
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('email', 'password');
        // Session::put($credentials);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            User::where('id',Auth::user()->id)->update(['online_status'=>1]);
            return redirect('dashboard')->with('user', $user);
        } else {

            return redirect('signin')->with('error_message', 'Please enter valid credentials')->withInput();
        }
    }

    public function user_registration(Request $request)
    {
        $validatedData = $request->validate([

            'user_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',

        ]);

        $data = $request->all();
        $data['name'] = $request->user_name;
        $data['type'] = 'owner';
        $data['password'] = Hash::make($data['password']);
        $new_user = User::create($data);

        Auth::login($new_user);
        $user_details = Auth::user();

        return redirect('dashboard')->with('user', $user_details);
    }

    public function user_logout()
    {
        // Session::flush();
        User::where('id',Auth::user()->id)->update(['online_status'=>0]);
        Auth::logout();
        return Redirect('signin');
    }
    
    public function google_credentials(){
        
       
        // $google_client = new Google_Client();

        // //Set the OAuth 2.0 Client ID
        // $google_client->setClientId('989794693001-e916dnlbgb6lq8k0d06jpsk96clmdcf7.apps.googleusercontent.com');

        // //Set the OAuth 2.0 Client Secret key
        // $google_client->setClientSecret('Bu-k-wRixQ-xbmycRimj45nf');

        // //Set the OAuth 2.0 Redirect URI
        // $google_client->setRedirectUri('https://www.mixrre.appcrates.net/auth/google/callback');

        // $google_client->addScope('email');

        // $google_client->addScope('profile');
        // $this->google_client = $google_client;

        $url = $this->google_client->createAuthUrl();
        //start session on web page
        // session_start();

        return redirect($url);

    }
    
    public function googlelogin(Request $request){
                    
            if (isset($_GET['code'])) {
                
                 $token = $this->google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
                
               if(!isset($token['error']))
                {
                    //Set the access token used for requests
                    $this->google_client->setAccessToken($token['access_token']);

                    //Store "access_token" value in $_SESSION variable for future use.
                    $_SESSION['access_token'] = $token['access_token'];
  
                // get profile info
                $google_oauth = new Google_Service_Oauth2($this->google_client);
                $google_account_info = $google_oauth->userinfo->get();

                // $id =  $google_account_info['id'];
                // $email =  $google_account_info['email'];
                
                $system_user = User::where(['email'=> $google_account_info['email'] , 'social_id' =>NULL])->first();
                
                if(empty($system_user)){
                    
                $finduser = User::where('social_id', $google_account_info['id'])
                ->first();
                
                    if($finduser){
                    
                        $finduser->email = $google_account_info['email'];
                        $finduser->image = $google_account_info['picture'];
                        $finduser->social_network = "google";
                        $finduser->social_token = $_SESSION['access_token'];
                        $finduser->save();
            
                        Auth::login($finduser);
                        return Redirect('dashboard');
                    } else {

                        // create a new user
                        $create_user = User::create([
                        'name' => '',
                        // 'last_name' => $data['family_name'],
                        'email' => $google_account_info['email'],
                        'image' => $google_account_info['picture'],
                        'social_id' => $google_account_info['id'],
                        'social_network' => "google",
                        'social_token' => $_SESSION['access_token'],
                        'type' => 'owner',
                        'password' => ''
                        ]);
            
                        Auth::login($create_user);
                        return Redirect('dashboard');
                    }
                } else {
                        return Redirect('signin')->with('error_message','Email is already in use. You cannot login with google');
                }
            } else {
                
                $url = $this->google_client->createAuthUrl();
                return redirect($url);
            }
    }
}

    public function redirectToGoogle()
    {
        // return Socialite::driver('google')->stateless()->redirect();
        // return Socialite::driver('google')->redirect();
        // Socialite::driver('google')->redirect();
        
        // return Socialite::driver('google')
        //     ->scopes(["https://www.googleapis.com/auth/userinfo.profile"])
        //     // ->with($parameters)
        //     ->redirect();
        // return Socialite::driver('google')
        // ->scopes(["https://www.googleapis.com/auth/userinfo.profile"])
        // ->scopes(['openid', 'email'])
        // ->redirect();
        
        $scopes = [
    'https://www.googleapis.com/auth/plus.me',
    'https://www.googleapis.com/auth/plus.profile.emails.read',
    'https://www.googleapis.com/auth/gmail.readonly'
];
$parameters = ['access_type' => 'offline'];
return Socialite::driver('google')->scopes($scopes)->with($parameters)->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        //  $response = $this->getAccessTokenResponse($this->getCode());
        //  dd($response);
        // dd($request->code);
//         $token = $request->get('auth');
//         return $token;
//         die;
        // dd(session()->get('auth_token'));
        // dd(session()->get('code'));
        // dd(session()->get('state'));
        // dd(session()->get('token'));
        // die;
// $provider='google';
// $driver= Socialite::driver($provider);
// $socialUserObject = $driver->userFromToken($token);
// print_r($socialUserObject);
// die;
//         return $token = $request->get('auth');
//         die;
//         // return Socialite::driver('google')->requestAccessToken('code');
//         return $access_token = Socialite::driver('google')->getAccessTokenResponse();
//         $code = $request->get('code');
//         return $code;
//         die;
        // return $request->code;
        // return session()->put('state', $request->input('state'));
        // session()->put('code', $request->input('code'));
        // try
        // {
        //       $adwords_api_response = Socialite::with('google')->getAccessTokenResponse($request->code);
        //       dd($adwords_api_response);
        //     // return $user = Socialite::driver('google')->stateless()->user();
        // } catch (\Exception $e) {

        //   dd($e);

        // }
        // session()->put('state', 'RCoxMHymDzhUef5Ey5Wc8zhyDLeO1Ywg1cGZH7sL');
        // // session()->put('code', '4/3QFLuy9lCk1C0PhPncCCJNxQKK1UD1A_N4_PGTL5KcIF_6vcccfcctd-VRmbWWwJYbIf3QPgVKCamgWy50EBaH4');
        // $state = $request->get('state');
        // dd($state);
        // $request->session()->put('state',$state);
        // session()->regenerate();
        // $user = Socialite::driver('google')->stateless()->user();
        // $code = $request->code;
        // dd($code);
        $gClient = new Google_Client();
        dd($gClient);
        //   'client_id' => '793522431472820',
        // 'client_secret' => 'a749eb7845d1e78e5e91874e96d9a3d5',
        // 'redirect' => 'https://www.mixrre.appcrates.net/auth/facebook/callback',
// $gClient->setApplicationName('Login to CodexWorld.com');
// $gClient->setClientId('793522431472820');
// $gClient->setClientSecret('a749eb7845d1e78e5e91874e96d9a3d5');
// $gClient->setRedirectUri('https://www.mixrre.appcrates.net/auth/facebook/callback');

// $google_oauthV2 = new Google_Oauth2Service($gClient);
// die;
        // $gClient = new Google_Client();
// $gClient->setApplicationName('Mixrre');
// $gClient->setClientId(GOOGLE_CLIENT_ID);
// $gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
// $gClient->setRedirectUri(GOOGLE_REDIRECT_URL);

// $google_oauthV2 = new Google_Oauth2Service($gClient);

//         if(isset($_GET["code"]))
// { dd("code is set");
// }
//         $code = $_GET["code"];
//         dd($code);
//         $user = Socialite::driver('google')->stateless()->user();
//         $token =Input::get('auth');
//         dd($user);
        // dd($user);
        // die;
        $user = Socialite::driver('google')->stateless()->user();
        dd($user);
        // echo $user->token;
        $final_user = Socialite::driver('google')->userFromToken($user->token);
        dd($final_user);
        // echo $user['token'];
        // die;
        dd($user);
$end_user = Socialite::driver('google')->userFromToken($user->token);
dd($end_user);
        $finduser = User::where('email', $user->email)->first();

        if ($finduser) {
            // update the avatar and provider that might have changed

            // $finduser->image = $user->avatar;
            $finduser->social_network = "google";
            $finduser->social_token = $user->token;
            $finduser->save();

            Auth::login($finduser);

            // if (Auth::check()) {
            //     return "user is logged in";
            // } else {
            //     return "not logged in";
            // }

        } else {
            // create a new user
            $create_user = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                // 'image' => $user->getAvatar(),
                'social_id' => $user->getId(),
                'social_network' => "google",
                'social_token' => $user->token,
                'type' => 'owner',
                'password' => ''
            ]);

            Auth::login($create_user);

            // if (Auth::check()) {
            //     return "user is logged in";
            // } else {
            //     return "not logged in";
            // }
        }

        // $login = Auth::user();
        // auth()->login($user);
        // Auth::login($user);


        return redirect('dashboard')->with('success_message', 'User Logged in successfully!');
    }

    public function redirectToFacebook()
    {

        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {

        // try{

        // $user = Socialite::driver('facebook')->stateless()->user();
        // // print_r($user);
        // // die;
        // // $user = Socialite::driver('facebook')->user();

        // } catch (Exception $e) {

        //     return redirect('signup');

        // }

        $user = Socialite::driver('facebook')->stateless()->user();
        
        $system_user = User::where(['email'=> $user->email , 'social_id' =>NULL])->first();
                
        if(empty($system_user)){
            
            $fileContents = file_get_contents($user->getAvatar());
            $content = file_get_contents($user->getAvatar());
            file_put_contents(public_path() . '/user_profiles/' . $user->getId() . ".jpg", $content);
            
            $finduser = User::where('email', $user->email)->orWhere('social_id', $user->getId())->first();

                if ($finduser) {
            // update the avatar and provider that might have changed

                    if ($user->getEmail()) {
                        $email = $user->getEmail();
                    } else {
                        $email = '';
                    }

            $finduser->email = $email;
            $finduser->image = 'user_profiles/' . $user->getId() . ".jpg";
            $finduser->social_network = "facebook";
            $finduser->social_token = $user->token;
            $finduser->save();
            
            Auth::login($finduser);
            
                } else {

                    if ($user->getEmail()) {
                        $email = $user->getEmail();
                    } else {
                        $email = '';
                    }
            // create a new user
            $create_user = User::create([
                'name' => $user->getName(),
                'email' => $email,
                'image' => 'user_profiles/' . $user->getId() . ".jpg",
                'social_id' => $user->getId(),
                'social_network' => "facebook",
                'social_token' => $user->token,
                'type' => 'owner',
                'password' => ''
            ]);
            
            Auth::login($create_user);
        } 
            } else {
                return Redirect('signin')->with('error_message','Email is already in use. You cannot login with facebook');
                }

        return Redirect('dashboard');
    }
    
    public function for_password(Request $request)
    {
            $validatedData = $request->validate([
            'email' => 'required',
            ]);
            
            $user = User::where(['email' => $request->email])
                          ->where('social_id', NULL)
                          ->first();
            // dd($user);

            if ($user) {
                
                $password = Str::random(8);

                $email = User::where(['email' => $request->email])->first();
                $email->password = Hash::make($password);
                $email->update();

                $to = $request->email;
                $subject = "Forget Password";
                $message = 'Your new password is ' . $password;

                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: no-reply@mixrre.net\nX-Mailer: PHP/";

                mail($to, $subject, $message, $headers);

                return Redirect('forget_password')->with('success_message','Email has been sent to your account')->withInput();
            
            } else {
                return Redirect('forget_password')->with('error_message','User does not exist')->withInput();
        }
    }
    
    public function dashboard(){
        
        $user = Auth::user();
        $notifications = Notification::where('notify_to', Auth::user()->id)->with('notify_by')->orderby('id','DESC')->get();
        $event = Event::with('event_details','get_event_reservations','event_participants')->where('user_id',$user->id)->orderBy('id', 'DESC')->get();
        $recent_events = Event::where('user_id',$user->id)->where('completion_bit',1)->whereDate('start_date_event', '<', Carbon::today())->orderBy('id', 'DESC')->with('event_details','get_event_reservations','event_participants')
        ->limit(3)->get();
        // ->whereHas('get_event_reservations', function($query){
        //     $query->whereDate('start_date', '<', Carbon::today())->orderBy('start_date','DESC')->limit(1);
        // })
        // return $recent_events;
        return view('dashboard.owner.pages.my_events',compact('user','event','recent_events','notifications'));
    }

    public function profile_account()
    {
        $user = Auth::user();
        $notifications = Notification::where('notify_to', Auth::user()->id)->with('notify_by')->get();
        $event = Event::with('event_details','get_event_reservations','event_participants')->where('user_id',$user->id)->orderBy('id', 'DESC')->get();
        return view('dashboard.owner.pages.profileAccount',compact('notifications','user','event'));
    }

    /*///////////////////////////////////////////////
        Update Profile
    ////////////////////////////////////////////////*/

    public function update_profile(Request $request)
    {
        if($request->guest_notification)
        {
            $profile['guest_notification'] = 1;  
        } else {
            $profile['guest_notification'] = 0;
        }

        // profile image
        if($request->hasFile('image'))
        {
          $file = $request->file('image');
          $filename = str_replace(' ', '', 'profile_'.time().'.'.$file->getClientOriginalName());
          $location = app()->basePath('/public/user_profiles/');
          $file->move($location, $filename);
          $profile['image'] = "/public/user_profiles"."/".$filename;
        }

      // cover image
       if($request->hasFile('cover_image'))
        {
          $file = $request->file('cover_image');
          $filename = str_replace(' ', '', 'cover_image_'.time().'.'.$file->getClientOriginalName());
          $location = app()->basePath('/public/user_profiles/');
          $file->move($location, $filename);
          $profile['cover_image'] = "/public/user_profiles"."/".$filename;
        }

        $profile['name'] = $request->full_name;

        // update password
        if($request->new_password!="")
        {
          $profile['password'] = Hash::make($request->new_password);
        }
      
        User::where('id',Auth::user()->id)->update($profile);
        return redirect('profile-account')->with('success_msg','Profile Updated Successfully');
    }

    //check old password match or not
    public function check_old_password(Request $request)
    {
        $user = User::where('id',Auth::user()->id)->first();
        if (Hash::check($request->password,$user->password)) {
            $response = true;
        }else{
            $response = false;
        }
        return response()->json($response);
    }
}
