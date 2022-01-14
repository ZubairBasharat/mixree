<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::view('test','dashboard.owner.pages.create_event_fashion_detail');
// dashboard owner routes
Route::view('signup','dashboard.owner.pages.index');
Route::view('signin','dashboard.owner.pages.login')->name('login');
Route::get('logout','AuthenticationController@user_logout');

// dashboard admin routes
Route::view('admin_login','dashboard.admin.pages.index');

// social login
// Route::get('auth/google', 'AuthenticationController@redirectToGoogle');
Route::get('auth/google', 'AuthenticationController@google_credentials');
Route::get('auth/google/callback', 'AuthenticationController@googlelogin');
Route::get('auth/facebook', 'AuthenticationController@redirectToFacebook');
Route::get('auth/facebook/callback', 'AuthenticationController@handleFacebookCallback');

Route::post('user_registration', 'AuthenticationController@user_registration');
Route::post('user_login', 'AuthenticationController@user_login');
Route::view('forget_password', 'dashboard.owner.pages.forget_password');
Route::post('res_password', 'AuthenticationController@for_password');

Route::group(['middleware' => 'auth'], function () {

    // Route::view('dashboard','dashboard.pages.my_events');
    Route::get('dashboard','AuthenticationController@dashboard');
    Route::get('/profile-account','AuthenticationController@profile_account');
    Route::post('update-profile','AuthenticationController@update_profile');
    Route::view('create_event','dashboard.owner.pages.create_event');
    Route::post('add_event','EventController@add_event');
    Route::get('create_event_detail/{id}','EventController@create_event_detail');
    Route::post('add_event_detail','EventController@add_event_detail');
    Route::get('create_event_gift/{id}','EventController@create_event_gift');
    Route::post('add_event_gift','EventController@add_event_gifts');
    Route::get('create_event_fashion/{id}','EventController@create_event_fashion');
    Route::post('add_event_fashion','EventController@add_event_fashion');
    Route::get('add_event_program_details/{id}','EventController@add_event_program_details');
    Route::post('create_event_program_details','EventController@create_event_program_details');
    Route::get('add_single_meal/{id}','EventController@add_single_meal');
    Route::get('add_paired_meal/{id}','EventController@create_event_paired_meal');
    Route::post('create_event_menu','EventController@create_event_menu');
    Route::view('create_event_program/{id}','dashboard.owner.pages.create_event_program_detail');
    Route::post('create_paired_meal','EventController@create_paired_meal');
    Route::get('categorize_meal/{id}','EventController@categorize_meal');
    Route::post('create_categorize_meal','EventController@create_categorize_meal');
    Route::get('final_menu/{id}','EventController@final_menu');
    Route::get('edit_event/{id}','EventController@edit_event');
    Route::post('check_code', 'EventController@check_code');
    // show event detail
    Route::get('show_event/{id}','EventController@show_event');
    Route::post('delete_events','EventController@delete_events');
    Route::get('/event-program/{id}','EventController@event_program');
    Route::get('/event-menus/{id}','EventController@event_menus');
    Route::post('delete_event_description','EventController@delete_event_description');
    Route::get('delete_participant/{id}', 'EventController@delete_participant');
    Route::post('delete_participants','EventController@delete_participants');
    Route::get('all_participants','EventController@all_participants');
    Route::post('update_media','EventController@update_media');
    Route::post('update_note','EventController@update_note');
    Route::post('read_notification','EventController@read_notification');
    Route::get('mark_all_read', 'EventController@mark_all_read');

    Route::get('/event_participants/{id}', 'EventController@event_participants');
    Route::get('/guest-access','EventController@guest_access');
    Route::post('remove_view_only','EventController@remove_view_only');
    Route::post('remove_platted_only','EventController@remove_platted_only');
    Route::post('check_old_password','AuthenticationController@check_old_password');

    //update routes
    Route::post('update_event_detail','EventUpdateController@update_event_detail');
    Route::post('update_event_gift','EventUpdateController@update_event_gifts');
    Route::post('update_event_fashion', 'EventUpdateController@update_event_fashion');
    Route::post('update_event','EventUpdateController@update_event');
    Route::POST('check_event_code','EventUpdateController@check_event_code');
});
