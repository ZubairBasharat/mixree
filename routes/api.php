<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'Api\AuthenticationController@user_login');
Route::post('/registration', 'Api\AuthenticationController@user_register');
Route::post('/forget_password', 'Api\AuthenticationController@forget_password');
Route::post('/social_login', 'Api\AuthenticationController@social_login');

Route::group(['prefix' => '/', 'middleware' => 'auth:api'], function(){

    // profile apis
Route::post('save_address','Api\AuthenticationController@save_address');
Route::post('edit_address','Api\AuthenticationController@edit_address');
Route::post('update_address','Api\AuthenticationController@update_address');
// Route::post('delete_address','Api\AuthenticationController@delete_address');
Route::get('get_addresses','Api\AuthenticationController@get_addresses');
Route::get('logout','Api\AuthenticationController@logout');
Route::get('get_profile', 'Api\ProfileController@get_profile');
Route::get('get_notification', 'Api\ProfileController@receive_notification');
Route::post('update_profile', 'Api\ProfileController@update_profile');
Route::post('get_events', 'Api\EventController@get_events');
Route::post('verify_event_code', 'Api\EventController@verify_event_code');
Route::get('my_events', 'Api\EventController@my_events');
Route::post('search_events', 'Api\EventController@search_events');
Route::post('gift_donations', 'Api\EventController@gift_donations');
Route::post('event_days','Api\EventController@event_days');
Route::post('all_menu','Api\EventController@all_menu');
Route::post('all_selected_menu','Api\EventController@all_selected_menu');
Route::post('selected_platted_menu','Api\EventController@selected_platted_menu');
Route::post('all_programs','Api\EventController@all_programs');
Route::post('all_participants','Api\EventController@all_participants');
Route::post('add_to_cart', 'Api\CartController@add_to_cart');
Route::post('decrease_quantity','Api\CartController@decrease_quantity');
Route::get('cart_items','Api\CartController@get_cart_items');
Route::post('delete_from_cart','Api\CartController@delete_product');
Route::post('order','Api\CartController@order');
Route::get('cart_items_counter','Api\CartController@cart_products_counter');
Route::post('add_memories','Api\MemoriesController@add_memories');
Route::post('edit_memory','Api\MemoriesController@edit_memory');
Route::post('update_memory','Api\MemoriesController@update_memory');
Route::post('memory_users','Api\MemoriesController@get_users');
Route::post('user_memories_notes','Api\MemoriesController@user_memories_notes');
Route::post('user_memories_media','Api\MemoriesController@user_memories_media');
Route::post('get_participants','Api\MemoriesController@get_participants');
Route::post('share_memory','Api\MemoriesController@share_memory');
Route::post('program_memories','Api\MemoriesController@program_memories');
Route::post('product_details','Api\CartController@product_details');
Route::post('share_contact_information','Api\EventController@share_contact_information');
Route::post('make_reservation','Api\EventController@make_reservation');
// Mingle Apis
Route::post('create_mingle','Api\MingleController@create_mingle_profile');
Route::post('get_mingle_profile','Api\MingleController@get_mingle_profile');
Route::post('change_profile_status','Api\MingleController@change_profile_status');
Route::post('get_active_users','Api\MingleController@get_active_users');
Route::post('send_request','Api\MingleController@send_request');
Route::post('get_requested_users','Api\MingleController@get_requested_users');
Route::post('request_response','Api\MingleController@request_response');
Route::post('mingle_friends', 'Api\MingleController@mingle_friends');

});
Route::post('event_information', 'Api\EventController@event_information');
