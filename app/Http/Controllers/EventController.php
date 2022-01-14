<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Event;
use App\EventDetail;
use App\EventFashion;
use App\EventGift;
use App\EventLocation;
use App\EventProgramDescription;
use App\EventRegistry;
use App\EventReservation;
use App\PairedMealName;
use App\EventSingleMenu;
use App\PairedMealFoodId;
use App\Witneess;
use App\PlattedDishName;
use App\PlattedDishItem;
use DB;
use App\EventParticipant;
use App\OrdersTable;
use App\OrderDetailsTable;
use App\Notification;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;

class EventController extends Controller
{
    public function add_event(Request $request)
    {
        // return $request->all();
        $user = Auth::user();
        $event = $request->only('days', 'type', 'event_code', 'collect_info');
        $event['need_reservation'] =  $request->need_reservation == 'yes' ? 1 : 0;
        $event['user_id'] = $user->id;
        // $event['start_date_event'] = date('Y-m-d', strtotime($request->start_dt[0]));
        $events = Event::create($event);
        // $reservation = $request->except('days');
        // return $reservation;

        // for($i=0;$i<$request->days;$i++){

        //     // $dt_time = (explode("-",$reservation['start_dt'][$i]));
        //     $start_date = date('Y-m-d', strtotime($reservation['start_dt'][$i]));

        //     $reservation_data[] = array(
        //         'user_id' => $user->id,
        //         'event_id' => $events->id,
        //         'start_date' => $start_date,
        // 'start_time' => $reservation['start_time'][$i],
        // 'end_time' => $reservation['end_time'][$i],
        // 'need_reservation' => ($reservation['need_res'][$i] == 'yes' ? 1 : 0),
        // 'no_of_people' => ($reservation['need_res'][$i] == 'yes' ? $reservation['no_of_people'][$i] : NULL),
        // 'mandatory_reservation' => (($reservation['need_res'][$i] == 'yes' && $reservation['res_mandatory'][$i] == 'yes') ? 1 : 0),
        // 'created_at' =>  Carbon::now(),
        //             'updated_at' => Carbon::now(),
        //             );
        //     }
        //     DB::table('event_reservations')->insert($reservation_data);
        return redirect('create_event_detail/' . $events->id);
    }

    //check event code exist or not
    public function check_code(Request $request)
    {
        $event =  Event::where('event_code',$request->code)->first();
        if(!empty($event))
        {
          $status = false;
        } else {
            $status = true;
        }
        echo $status;
    }

    public function create_event_detail($id)
    {
        $event = Event::where('id', $id)->first();
        $event_details = EventDetail::where('event_id', $id)->first();
        $event_witness = Witneess::where('event_id', $id)->get();
        $event_location = EventLocation::where('event_id', $id)->get();
        return view('dashboard.owner.pages.create_event_preview', compact('event', 'event_details', 'event_witness', 'event_location'));
    }
    public function add_event_detail(Request $request)
    {
        // $explode = (explode("-", $_POST['start_dt_1']));
        $first_date = date('Y-m-d', strtotime($_POST['start_dt_1']));
        $min_date = $first_date;
        $max_date = $first_date;
        $data = $request->all();
        $user = Auth::user();
        $data['event_id'] = $request->event_id;
        $data['user_id'] = $user->id;
        $witness = 1;
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
        $event_detail = EventDetail::create($data);
        if ($request->hasFile('witness_images')) {
            foreach ($request->file('witness_images') as $image) {
                $witness_img = time() . $image->getClientOriginalName();
                $destinationPath = public_path('/images/event_images');
                $image->move($destinationPath, $witness_img);
                $image = $witness_img;
                $witness_data = [
                    'first_name' => $_POST['witness_first_name_' . $witness],
                    'last_name' => $_POST['witness_last_name_' . $witness],
                    'biography' => $_POST['witness_biography_' . $witness],
                    'witness_type' => $request->witness_type[$witness_type],
                    'witness_image' => $image,
                    'user_id' => $user->id,
                    'event_id' => $request->event_id,
                    'created_at' =>  Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                Witneess::create($witness_data);
                $witness++;
            }
        }
        $locations = $request->only('name', 'location');
        $latlang = 1;
        for ($i = 0; $i < sizeof($locations['name']); $i++) {
            // $dt_time = (explode("-", $_POST['start_dt_'.$latlang]));
            $start_date = date('Y-m-d', strtotime($_POST['start_dt_' . $latlang]));
            $location_data[] = array(
                'user_id' => $user->id,
                'event_id' => $request->event_id,
                'event_detail_id' => $event_detail->id,
                'name' => $locations['name'][$i],
                'address' => $locations['location'][$i],
                'lat' => $_POST['lat_' . $latlang],
                'lang' => $_POST['lang_' . $latlang],
                'start_date' => $start_date,
                'start_time' => $_POST['start_time_' . $latlang],
                // 'end_time' => $_POST['end_time_'.$latlang],
                'created_at' =>  Carbon::now(),
                'updated_at' => Carbon::now(),
            );
            if ($start_date > $max_date) {
                $max_date = $start_date;
            }
            if ($start_date < $min_date) {
                $min_date = $start_date;
            }
            $latlang++;
        }
        DB::table('event_locations')->insert($location_data);
        Event::where('id', $request->event_id)->update(['end_date_event' => $max_date, 'start_date_event' => $min_date]);
        return redirect('create_event_gift/' . $request->event_id);
    }
    public function create_event_gift($id)
    {
        // echo $id;die;
        $event_gifts = EventGift::where('event_id', $id)->get();
        $event_registries = DB::table('event_registries')->where('event_id', $id)->get();
        $event_details = EventDetail::where('event_id', $id)->orderBy('id', 'desc')->first();
        return view('dashboard.owner.pages.create_event_birthday_detail2', compact('event_details', 'event_gifts', 'event_registries'));
    }
    public function add_event_gifts(Request $request)
    {
        $payment_counter = 0;
        $user = Auth::user();
        if ($request->gift == 1) {
            $event = Event::find($request->event_id);
            $event->gift = 1;
            $event->save();
        }
        if ($request->registry == 1) {
            $event = Event::find($request->event_id);
            $event->registry = 1;
            $event->save();
        }
        if ($request->gift == 1) {
            foreach ($request->payment_type as $payment_type) {
                if ($payment_type == 'bank_account') {
                    $name_of_bank = $request->name_of_bank[$payment_counter];
                    $name_of_account = $request->name_of_account[$payment_counter];
                    $acount_number = $request->account_number[$payment_counter];
                    $payment_email = "";
                    $paymant_image = "";
                } else {
                    $name_of_bank = "";
                    $name_of_account = "";
                    $acount_number = "";
                    $paymant_image = $payment_type . ".png";
                    $payment_email = $request->payment_email[$payment_counter];
                }

                $payment_data = [
                    'user_id' => $user->id,
                    'event_id' => $request->event_id,
                    'payment_type' => $payment_type,
                    'payment_image' => $paymant_image,
                    'name_of_bank' => $name_of_bank,
                    'name_of_account' => $name_of_account,
                    'account_number' => $acount_number,
                    'payment_email' => $payment_email,
                    'gift' => $request->gift,
                    'registry' => $request->registry,
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
        $registry = $request->only('registryname', 'registrylink');
        if ($request->registry == 1) {
            if (isset($registry['registryname'])) {
                for ($i = 0; $i < sizeof($registry['registryname']); $i++) {

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
        return redirect('create_event_fashion/' . $request->event_id);
    }

    public function create_event_fashion($id)
    {
        $event_fashions = DB::table('event_fashions')->where('event_id', $id)->get();
        return view('dashboard.owner.pages.create_event_fashion_detail', compact('event_fashions'));
    }

    public function add_event_fashion(Request $request)
    {

        $data = $request->all();
        $user = Auth::user();
        if ($data['fashion'] != 0) {
            if ($data['fashion'] == 1) {
                $event = Event::find($request->event_id);
                $event->fashion = 1;
                $event->save();
            }
            if ($request->dresscode_type == "general_dress_code") {
                foreach ($request->dreescode_description as $description) {
                    $fashion_data[] = array(
                        'user_id' => $user->id,
                        'event_id' => $request->event_id,
                        'code_for_guest' => $request->code_for_guest,
                        'dress_code_description' => $description,
                        'type' => $request->dresscode_type,
                        'name' => "",
                        'description' => "",
                        'image' => "",
                        'price' => "",
                        'link' => "",
                        'coupon_code' => "",
                        'created_at' =>  Carbon::now(),
                        'updated_at' => Carbon::now(),
                    );
                }
            }
            if ($request->dresscode_type == "link_to_purchase") {
                for ($i = 0; $i < sizeof($data['item_name']); $i++) {

                    if (isset($data['item_image'][$i])) {

                        $event_image = time() . $data['item_image'][$i]->getClientOriginalName();
                        $destinationPath = public_path('/images/event_images');
                        $data['item_image'][$i]->move($destinationPath, $event_image);
                    } else {
                        $event_image = NULL;
                    }

                    $fashion_data[] = array(
                        'user_id' => $user->id,
                        'event_id' => $request->event_id,
                        'code_for_guest' => $request->code_for_guest,
                        'dress_code_description' => "",
                        'type' => $request->dresscode_type,
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
            }
            if ($request->dresscode_type == "purchase_event_outfit") {
                for ($i = 0; $i < sizeof($data['outfit_name']); $i++) {

                    if (isset($data['outfit_image'][$i])) {

                        $event_image = time() . $data['outfit_image'][$i]->getClientOriginalName();
                        $destinationPath = public_path('/images/event_images');
                        $data['outfit_image'][$i]->move($destinationPath, $event_image);
                    } else {
                        $event_image = NULL;
                    }

                    $fashion_data[] = array(
                        'user_id' => $user->id,
                        'event_id' => $request->event_id,
                        'code_for_guest' => $request->code_for_guest,
                        'type' => $request->dresscode_type,
                        'dress_code_description' => "",
                        'name' => ($data['fashion'] == 1 ? $data['outfit_name'][$i] : NULL),
                        'description' => ($data['fashion'] == 1 ? $data['outfit_description'][$i] : NULL),
                        'image' => $event_image,
                        'price' => ($data['fashion'] == 1 ? $data['outfit_price'][$i] : NULL),
                        'link' => "",
                        'coupon_code' => "",
                        'created_at' =>  Carbon::now(),
                        'updated_at' => Carbon::now(),
                    );
                }
            }
            DB::table('event_fashions')->insert($fashion_data);
        }
        return redirect('add_event_program_details/' . $request->event_id);
    }
    public function add_event_program_details($id)
    {
        $user_id = Auth::user()->id;
        $event_locations = DB::table('event_locations')->where('user_id', $user_id)->where('event_id', $id)->get();
        $event_programs =  EventLocation::where('event_id', $id)->with('event_program_details.event_program_description')->get();
        return view('dashboard.owner.pages.create-event-program-detail', compact('event_locations', 'event_programs'));
    }
    public function show_event($id)
    {
        $total_donation = 0;
        $user = Auth::user();
        $event = Event::with('event_details', 'event_fashions', 'event_gifts', 'event_locations', 'event_registries')->where('id', $id)->get();
        $products = OrdersTable::where('event_id', $id)->with('user', 'orders.product')->get();
        // return $products;
        if (empty($event[0]->event_gifts)) {
            $donations = DB::table('gift_donations')->where('gift_id', $event[0]->event_gifts[0]->id)->get();
        }
        if (!empty($donations)) {
            foreach ($donations as $donation) {
                $total_donation += $donation->donation_amount;
            }
        }
        $notifications = Notification::where('notify_to', Auth::user()->id)->with('notify_by')->orderby('id','DESC')->get();
        // return $event;
        // return view('dashboard.owner.pages.my_events_detail')->with('event',$event);
        return view('dashboard.owner.pages.my_events_detail', compact('event', 'user', 'total_donation', 'notifications', 'products'));
    }
    public function create_event_program_details(Request $request)
    {
        $data['user_id'] = Auth::user()->id;
        $data['event_id'] = $request->event_id;
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        //delete old data of details and decription if exist
        if (isset($request->program_details_id)) {
            foreach ($request->event_location_id as $location_id) {
                DB::table('event_program_details')->where('event_location_id', $location_id)->delete();
            }
            foreach ($request->program_details_id as $details_id) {
                DB::table('event_program_descriptions')->where('event_program_details_id', $details_id)->delete();
            }
        }

        // create new data
        foreach ($request->event_location_id as $event_location_id) {
            $data['event_location_id'] = $event_location_id;
            $show_payment = (isset($_POST['show_payment_' . $event_location_id][0])) ? $_POST['show_payment_' . $event_location_id][0] : '';
            if ($show_payment == 1 || $show_payment == "") {
                $data['program_location_bit'] = 1;

                if ($show_payment == 1) {
                    $dt_time = (explode("-", $_POST['event_date_' . $event_location_id][0]));
                    $data['start_date'] = date('Y-m-d', strtotime($dt_time[0]));
                    $data['start_time'] = date('h:i:s', strtotime($_POST['event_time_'.$event_location_id]));
                }
                DB::table('event_program_details')->insert($data);

                $description['event_program_details_id'] = DB::getPdo()->lastInsertId();
                if (isset($_POST['event_program_' . $event_location_id])) {
                    foreach ($_POST['event_program_' . $event_location_id] as $event_program) {
                        $description['description'] = $event_program;
                        $description['created_at'] = Carbon::now();
                        $description['updated_at'] = Carbon::now();
                        DB::table('event_program_descriptions')->insert($description);
                    }
                }
            }
        }
        if (isset($_POST['show_payment_' . $event_location_id][0])) {
            return redirect('add_single_meal/' . $request->event_id);
        } else {
            return redirect('event-program/' . $request->event_id);
        }
    }
    public function add_single_meal($id)
    {
        $user_id = Auth::user()->id;
        $event_locations = DB::table('event_locations')->where('user_id', $user_id)->where('event_id', $id)->get();
        $event_menu = EventLocation::where('event_id', $id)->with('get_single_menus', 'get_platted_menu.platted_items')->get();
        return view('dashboard.owner.pages.create-events-menu-add-single', compact('event_locations', 'event_menu'));
    }
    public function event_menus($id)
    {
        $user = Auth::user();
        $notifications = Notification::where('notify_to', Auth::user()->id)->with('notify_by')->orderby('id','DESC')->get();
        $user_id = Auth::user()->id;
        $event_locations = DB::table('event_locations')->where('user_id', $user_id)->where('event_id', $id)->get();
        $event_menu = EventLocation::where('event_id', $id)->with('get_single_menus', 'get_platted_menu.platted_items')->get();
        // return $event_menu;
        return view('dashboard.owner.pages.event_menus', compact('event_locations', 'id', 'user', 'notifications', 'event_menu'));
    }
    public function create_event_menu(Request $request)
    {
        // $data['type'] = $request->menu_type;
        $data['user_id'] = Auth::user()->id;
        $data['event_id'] = $request->event_id;
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();
        $redirect_Dashboard = true;
        foreach ($request->event_location_id as $event_location_id) {
            $enter_details = (isset($_POST['enter_details_' . $event_location_id])) ? $_POST['enter_details_' . $event_location_id] : '';
            DB::table('event_single_menus')->where('event_location_id', $event_location_id)->delete();
            PlattedDishName::where('event_location_id', $event_location_id)->delete();
            $data['event_location_id'] = $event_location_id;

            if ($enter_details == 1 || $enter_details == "") {
                if ($_POST['menu_type' . $event_location_id] == 0) {
                    if (isset($_POST['food_' . $event_location_id])) {
                        foreach ($_POST['food_' . $event_location_id] as $food) {
                            $data['status'] = 0;   // type 0 for food
                            $data['name'] = $food;
                            if (!empty($food)) {
                                DB::table('event_single_menus')->insert($data);
                            }
                        }
                    }

                    if (isset($_POST['drink_' . $event_location_id])) {
                        foreach ($_POST['drink_' . $event_location_id] as $drink) {
                            $data['status'] = 1;   // type 1 for drink
                            $data['name'] = $drink;
                            if (!empty($drink)) {
                                DB::table('event_single_menus')->insert($data);
                            }
                        }
                    }
                } else {
                    $hidden = 0;
                    foreach ($_POST['platted_food_' . $event_location_id] as $category) {
                        $pallted_dish_name_data = [
                            'user_id' => Auth::user()->id,
                            'event_id' => $request->event_id,
                            'event_location_id' => $event_location_id,
                            'dish_name' => $category,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                        $platted_dish = PlattedDishName::create($pallted_dish_name_data);
                        if (isset($_POST['platted_food_item_' . $event_location_id . '_' . $_POST['platted_food_hidden' . $event_location_id][$hidden]])) {
                            // PlattedDishItem::where('platted_dish_name_id',$platted_dish->id)->delete();
                            foreach ($_POST['platted_food_item_' . $event_location_id . '_' . $_POST['platted_food_hidden' . $event_location_id][$hidden]] as $food_item) {
                                $platted_dish_item_data = [
                                    'platted_dish_name_id' => $platted_dish->id,
                                    'platted_dish_item' => $food_item,
                                ];
                                PlattedDishItem::create($platted_dish_item_data);
                            }
                        }
                        $hidden++;
                    }
                }
                DB::table('events')->where('id', $request->event_id)->update(['food_type' => 1]);
            }
        }
        if ($enter_details == "") {
            return redirect('event-menus/' . $request->event_id);
        }
        if (!$redirect_Dashboard) {
            return redirect('add_paired_meal/' . $request->event_id);
        } else {
            DB::table('events')->where('id', $request->event_id)->update(['completion_bit' => 1]);
            return redirect('dashboard');
        }
    }
    public function create_event_paired_meal($id)
    {
        $single_meal = EventLocation::with('get_single_menus')->where('event_id', $id)->get();
        return view('dashboard.owner.pages.create_event_menu_paired_meal', compact('single_meal'));
    }
    public function create_paired_meal(Request $request)
    {
        $counter = 0;
        $data['event_id'] = $request->event_id;
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::today();
        $data['updated_at'] = Carbon::today();
        foreach ($request->event_location_id as $event_location_id) {
            if (isset($_POST['pair_meal_name_' . $event_location_id])) {
                $data['event_location_id'] = $event_location_id;
                foreach ($_POST['pair_meal_name_' . $event_location_id] as $pair_meal_name) {
                    $data['name'] = $pair_meal_name;
                    DB::table('paired_meal_names')->insert($data);
                    $food['paired_meal_name_id'] = DB::getPdo()->lastInsertId();
                    $food['created_at'] = Carbon::today();
                    $food['updated_at'] = Carbon::today();
                    if (isset($_POST['ids_' . $counter])) {
                        foreach ($_POST['ids_' . $counter] as $food_id) {
                            $food_id_arr = explode(",", $food_id);
                            foreach ($food_id_arr as $id) {
                                $food['food_id'] = $id;
                                PairedMealFoodId::create($food);
                            }
                        }
                    }
                    $counter++;
                }
            }
        }
        return redirect('categorize_meal/' . $request->event_id);
    }
    public function categorize_meal($id)
    {
        $user_id = Auth::user()->id;
        $paired_meals = EventLocation::with('paired_meal_names.food_ids')
            ->where('event_id', $id)->get();
        foreach ($paired_meals as $paired_meal) {
            foreach ($paired_meal->paired_meal_names as $paired_meal_name) {
                foreach ($paired_meal_name->food_ids as $food_id) {
                    $single_food = DB::table('event_single_menus')->where('id', $food_id->food_id)->first();
                    $food_id->food_name = $single_food->name;
                }
            }
        }
        return view('dashboard.owner.pages.create_event_catagory_meal', compact('paired_meals'));
    }
    public function create_categorize_meal(Request $request)
    {
        $data['user_id'] = Auth::user()->id;
        $data['event_id'] = $request->event_id;
        $data['created_at'] = Carbon::today();
        $data['updated_at'] = Carbon::today();
        foreach ($request->event_location_id as $event_location_id) {
            $data['event_location_id'] = $event_location_id;
            $counter = 0;
            if (isset($_POST['name_' . $event_location_id])) {
                foreach ($_POST['name_' . $event_location_id] as $category_name) {
                    $data['category_title'] = $category_name;
                    DB::table('categorize_meal_titles')->insert($data);
                    $pair['title_id'] = DB::getPdo()->lastInsertId();
                    $categorize_meal_arr = explode(",", $_POST['id_' . $event_location_id][$counter]);
                    foreach ($categorize_meal_arr as $pair_id) {
                        $pair['paired_meal_id'] = $pair_id;
                        $pair['created_at'] = Carbon::now();
                        $pair['updated_at'] = Carbon::now();
                        DB::table('categorize_meal_paires')->insert($pair);
                    }
                    $counter++;
                }
            }
        }
        DB::table('events')->where('id', $request->event_id)->update(['completion_bit' => 1]);
        return redirect('dashboard');
    }
    public function final_menu($id)
    {
        return view('dashboard.owner.pages.create_menu_final');
    }

    //Delete Events
    public function delete_events(Request $request)
    {
        Event::whereIn('id', explode(",", $request->deleted_events))->delete();
        EventDetail::whereIn('event_id', explode(",", $request->deleted_events))->delete();
        return redirect('dashboard');
    }

    /*///////////////////////////////////////////////
        Event programs
    ////////////////////////////////////////////////*/
    public function event_program($id)
    {
        $user = Auth::user();
        $notifications = Notification::where('notify_to', Auth::user()->id)->with('notify_by')->orderby('id','DESC')->get();
        $event_programs = EventLocation::where('event_id', $id)->with('event_program_details.event_program_description')->get();
        // return $event_programs[0]->event_program_details;              
        return view('dashboard.owner.pages.event_programs', compact('event_programs', 'id', 'notifications', 'user'));
    }

    /*///////////////////////////////////////////////
        Delete program description
    ////////////////////////////////////////////////*/

    public function delete_event_description(Request $request)
    {
        $status = EventProgramDescription::where('id', $request->description_id)->delete();
        return response()->json($status);
    }

    /*///////////////////////////////////////////////
        Get participants of specific event
    ////////////////////////////////////////////////*/
    public function event_participants($id)
    {
        $user = Auth::user();
        $notifications = Notification::where('notify_to', Auth::user()->id)->with('notify_by')->orderby('id','DESC')->get();
        $participants = EventParticipant::where('event_id', $id)->with('user')->get();
        return view('dashboard.owner.pages.participants', compact('participants', 'id', 'user', 'notifications'));
    }

    /*///////////////////////////////////////////////
        Delete Participant
    ////////////////////////////////////////////////*/

    public function delete_participant($id)
    {
        $event_id = EventParticipant::where('id', $id)->first()->event_id;
        EventParticipant::where('id', $id)->delete();
        return redirect('event_participants/' . $event_id);
    }

    /*///////////////////////////////////////////////
        Delete Participants
    ////////////////////////////////////////////////*/
    public function delete_participants(Request $request)
    {
        $event_ids = explode(",", $request->deleted_participants);
        $event_id = EventParticipant::where('id', $event_ids[0])->first()->event_id;
        EventParticipant::whereIn('id', $event_ids)->delete();
        return redirect('event_participants/' . $event_id);
    }

    public function guest_access()
    {
        $user = Auth::user();
        $notifications = Notification::where('notify_to', Auth::user()->id)->with('notify_by')->orderby('id','DESC')->get();
        $event_ids = Event::where('user_id', Auth::user()->id)->pluck('id');
        $participants = EventParticipant::whereIn('event_id', $event_ids)->with('user', 'event')->get();
        return view('dashboard.owner.pages.guestAccess', compact('participants', 'user', 'notifications'));
    }

    public function update_media(Request $request)
    {
        // return $request->all();
        EventParticipant::where('id', $request->participant_id)->update(['media' => $request->media]);
    }

    public function update_note(Request $request)
    {
        EventParticipant::where('id', $request->participant_id)->update(['note' => $request->note]);
    }

    //remove view only munu item
    public function remove_view_only(Request $request)
    {
        EventSingleMenu::where('id', $request->id)->delete();
    }

    //remove view only munu item
    public function remove_platted_only(Request $request)
    {
        PlattedDishItem::where('id', $request->id)->delete();
    }

    //read notification
    public function read_notification(Request $request)
    {
        Notification::where('id', $request->notification_id)->update(['status' => 0]);
        $total_notification = Notification::where('notify_to', Auth::user()->id)->where('status', 1)->count();
        return response()->json($total_notification);
    }

    //read all notification
    public function mark_all_read(Request $request)
    {
        if (Notification::where('notify_to', Auth::user()->id)->update(['status' => 0])) {
            $response = true;
        } else {
            $response = false;
        }
        return response()->json($response);
    }

    //edit event
    public function edit_event($event_id)
    {
        $event = Event::where('id',$event_id)->first();
        return view('dashboard.owner.pages.create_event',compact('event_id','event'));
    }
}
