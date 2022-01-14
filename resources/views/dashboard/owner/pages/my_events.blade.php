@extends('dashboard.owner.app')

@section('content')
<div class="container-fluid">
<div class="row">

<!-- /***************
   Right side section start
   *******************/ -->
<div class="w-100" id="main">
   <!-- /***************
      heder start
      *******************/ -->
   <div class="row">
      <div class="d-inline-flex col-md-12 header-search">
         <div class="search-toogle d-inline-flex">
            <div class="d-lg-none d-block">
               <!-- <span class="open mr-3" style="font-size:30px;cursor:pointer" onclick="closeNav()">&#9776;</span> -->
               <span class="close mr-3" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
            </div>
            <form>
               <div class="search">
                  <input type="text" placeholder="Search" name="search2">
                  <img class="search-btn" src="{{ asset('public/assets/imgs/search-btn.png') }}">
               </div>
            </form>
         </div>
         <div class="ml-auto d-inline-flex">
            <!-- <img class="help" src="{{ asset('public/assets/imgs/help.png') }}"> -->
           
            <div class="panel panel-default">
              <div class="panel-body">
                <!-- Single button -->
                <div class="btn-group pull-right top-head-dropdown">
                  <button type="button" class="btn btn-default dropdown-toggle p-0 bgTransparent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <img class="notif" src="{{ asset('public/assets/imgs/notif.png') }}"> <span class="caret"></span>
                  </button>
                  <div>
                     
                     <ul class="dropdown-menu dropdown-menu-right pt-0 position-relative">
                        <div class="d-inline-flex w-100 " 
                        style="background: #FACA43;
                        padding: 18px 16px;
                        border-top-left-radius: 10px;
                        border-top-right-radius: 10px;">
                           <p class="my-auto">Your Notifications</p>
                           <button type="button" class="btn btn-danger font-weight-light ml-auto font-12 px-3"><label id="new_notifications">{{App\Notification::where('notify_to',Auth::user()->id)->where('status',1)->count()}}</label> New</button>
                        </div>
                        <div class="text-center py-2" onclick="mark_all_read()" style="cursor: default;">
                           <a class="text-secondary" >
                              Mark all as read
                           </a>
                        </div>
                     <div class="notifMain" style="overflow: auto;height: 290px;">
                     @foreach($notifications as $notification)
                        <li class="px-2 py-1" onclick="read_notification('{{$notification->id}}')">
                      <a href="#" class="top-text-block new py-2">
                        <div class="d-inline-flex w-100">
                           <img class="mr-2 iconNotification mt-1" src="{{(empty($notification->notify_by->image))?asset('/public/assets/imgs/default-user-image.png'):asset($notification->notify_by->image) }}">
                           <div>
                              <div class="top-text-heading mb-1 font-12 notifications" id="notificatio_{{$notification->id}}" style="color:{{($notification->status==1)?'#007bff':''}}">{{$notification->message}}</div>
                              <div class="top-text-light font-10">{{\Carbon\Carbon::createFromTimeStamp(strtotime($notification->created_at))->diffForHumans()}}</div>
                           </div>
                        </div>
                      </a> 
                    </li>
                   @endforeach 
                   <!-- <li>
                    <div class="loader-topbar"></div>
                   </li> -->
                     </div>
                  </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="dropdown dashbord-dropdown">
               <button class="btn dropdown-toggle admin-btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if($user->image)
               <img class="dp-icon" src="{{ asset($user->image) }}" style="border-radius:50% !important">
               @else
               <img class="dp-icon" src="{{ asset('public/assets/imgs/user_profile.jpeg') }}">
               @endif
               @if($user->name)
               <span>{{ucwords($user->name)}}</span>
               @else
               <span>{{substr($user->email,0,11)}}...</span>
               @endif
               <img class="arrow-down" src="{{ asset('public/assets/imgs/arrow-down.png') }}">
               </button>
               <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="{{ url('profile-account')}}">
                     Edit Profile
                  </a>
                  <a class="dropdown-item" href="{{ url('logout')}}">
                  Logout
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- /***************
      Events Section
      *******************/ -->
   <div class="row mt-45px">
      <div class="col-md-6">
         <!-- <h1 class="events-title">Events</h1> -->
      </div>
      <div class="col-md-6 text-right">
      <a href="{{ url('create_event')}}">  <button class="btn-create-event"><img class="plus_icon" src="{{ asset('public/assets/imgs/plus-icon.png') }}"> Create Event</button></a>
      </div>
   </div>
   <div class="row mt-30px">
      <div class="col-md-12 welcome" style="background: url('public/assets/imgs/welcome-bg.png');">
         <div class="welcome-main w-100">
            <h1 class="welcome-title">Welcome Back {{ucwords($user->name)}}!</h1>
            <p class="welcome-text">This is your dashboard. You can see and manage your events here.</p>
         </div>
      </div>
   </div>
   <!-- /***************
      Recent Events Section
      *******************/ -->
   <div class="row mt-38px">
      <div class="col-md-6">
         <h1 class="events-title">Recent Events</h1>
      </div>
      <div class="col-md-6 text-right">
         <!-- <button class="btn-see-all"><a href="my-events-detail.php">See All<img class="icon_next" src="{{ asset('public/assets/imgs/arrow-next.png') }}"></a></button> -->
      </div>
   </div>
   <div class="row mt-27px mx-0">
      @php $recent = 1; @endphp
      @foreach($recent_events as $recent_event)
      <div class="col-lg-3 col-md-6 pl-md-0 mb-2" onclick="edit_event('{{$recent_event->event_details->event_id}}')">
           <div class="green" style='background-color:{{$recent==2?"#EF6553":" #47C55B"}}'>
            <div class="d-inline-flex w-100">
               <img class="male" src="{{ asset('public/images/event_images/'.$recent_event->event_details->icon) }}" style="border-radius:50% !important">
               <div class="dropdown dashbord-dropdown ml-auto">
                  <button class="btn dropdown-toggle admin-btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img class="three-dots" src="{{ asset('public/assets/imgs/3-dots.png') }}" >
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                     <a class="dropdown-item" href="{{ url('show_event/'.$recent_event->event_details->event_id) }}">
                     Show
                     </a>
                     <!-- <a class="dropdown-item" href="#">
                     Logout
                     </a> -->
                  </div>
               </div>
            </div>
            <h1 class="male-title">{{$recent_event->event_details->eve_name}}</h1>
            <p class="male-text mt-19px"><img src="{{ asset('public/assets/imgs/admin.png') }}">{{count($recent_event->event_participants)}} Guests</p>
            <p class="male-text"><img src="{{ asset('public/assets/imgs/clock.png') }}">Started on {{date('M d, Y', strtotime($recent_event->start_date_event))}}</p>
         </div>
      </div>
      @php $recent++; @endphp
      @endforeach
   </div>
   <!-- /***************
      Filteration Section
      *******************/ -->
   <div class="row mt-45px">
      <div class="col-md-6">
         <h1 class="events-title">Events<span id="total_events">sdf</span></h1>
      </div>
      <div class="col-md-6 text-right">
      </div>
   </div>
   <div class="row mt-45px">
      <div class="col-md-10">
         <div class="d-inline-flex">
            <div class="dropdown dashbord-dropdown ml-auto">
               <button class="btn dropdown-toggle btn-icon-menu" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <img class="plus_icon" src="{{ asset('public/assets/imgs/icon_menu.png') }}">
               </button>
               <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">
                  Acs ( A - Z )
                  </a>
                  <a class="dropdown-item" href="#">
                  Today
                  </a>
               </div>
            </div>
            <form method="POST" id="delete_events_form" action="{{url('delete_events')}}">
            @csrf
            <input type="hidden" name="deleted_events" id="deleted_events" value="">
            <button type="submit" id="selected_events" disabled class="btn-delete text-white ml-3">Delete</button>
            </form>
            <!-- <button class="btn-icon-menu"><img class="plus_icon" src="{{ asset('public/assets/imgs/icon_menu.png') }}"></button> -->
            <!-- <button class="btn-events-1">Acs ( A - Z ) <img class="close_icon" src="{{ asset('public/assets/imgs/close-icon.png') }}"></button>
            <button class="btn-events-2">Today <img class="close_icon" src="{{ asset('public/assets/imgs/close-icon.png') }}"></button> -->
         </div>
      </div>
      <div class="col-md-2 text-right">
         <div class="ml-auto d-inline-flex">
            <p class="txt_sorted_by">Sorted by</p>
            <p class="span_all"><a href="#">All</a></p>
         </div>
      </div>
   </div>
   <!-- /***************
      Data table
      *******************-->
   <div class="row">
      <div class="col-md-12 p-0">
         <div class="table-main">
            <table id="example" class="table my-tbl-style " style="width:100%">
               <thead>
                  <tr>
                     <th class="checkbox_main">
                        <label class="container_checkbox_all">
                        <input type="checkbox" id="checkbox_main_all" onclick="checkAll(this)">
                        <span class="checkmark_all"></span>
                        </label>
                     </th>
                     <th class="p_name">Name <img class="icon_sorting" src="{{ asset('public/assets/imgs/Group-642.png') }}"></th>
                     <th class="p_code" style="color: #B7BABF;font-size:14px">Event Code <img class="icon_sorting" src="{{ asset('public/assets/imgs/Group-642.png') }}"></th>
                     <th class="p_participants">Guests<img class="icon_sorting" src="{{ asset('public/assets/imgs/Group-642.png') }}"></th>
                     <th class="p_event_started">Event Started<img class="icon_sorting" src="{{ asset('public/assets/imgs/Group-642.png') }}"></th>
                     <th class="p_last_modified">Last Modified<img class="icon_sorting" src="{{ asset('public/assets/imgs/Group-642.png') }}"></th>
                     <!-- <th class="p_vendor">Vendor<img class="icon_sorting" src="{{ asset('public/assets/imgs/Group-642.png') }}"></th> -->
                     <th class="p_vendor">Status<img class="icon_sorting" src="{{ asset('public/assets/imgs/Group-642.png') }}"></th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                    @php $total_events = 0; @endphp
                    @foreach($event as $eve_detail)
                    @if($eve_detail->event_details)
                    @php
                    if($eve_detail->completion_bit==0){
                    $color = 'red';
                    }else{
                    $color = 'green';}
                    @endphp
                  <tr id="{{$eve_detail->id}}" class="tbl_gray" id="{{$eve_detail->event_details->event_id}}tbl_gray">
                     <td class=" ">
                        <label class="container_checkbox">
                        <input type="checkbox" class="checkboxes" value="{{$eve_detail->id}}" id="{{$eve_detail->event_details->event_id}}checkbox_single1" onclick="myFunction('{{$eve_detail->event_details->event_id}}tbl_gray','{{$eve_detail->event_details->event_id}}checkbox_single1');">
                        <span class="checkmark-2"></span>
                        </label>
                     </td>
                     
                     <td class="name_profile color-black " onclick="show_detail('{{$eve_detail->event_details->event_id}}')">
                         
                         @if($eve_detail->event_details->icon)
                        <img class="img_profile_icon" src="{{ asset('public/images/event_images/'.$eve_detail->event_details->icon) }}" style="border-radius:50% !important"><span class="{{$eve_detail->event_details->event_id}}tbl_gray">{{$eve_detail->event_details->eve_name}} </span>
                        @else 
                        <img class="img_profile_icon" src="{{ asset('public/assetss/imgs/event_icon.png') }}"><span class="tbl_gray1">{{$eve_detail->event_details->eve_name}} </span>
                        @endif
                        
                     </td>
                        <td class="txt_participants color-black " onclick="show_detail('{{$eve_detail->event_details->event_id}}')">@if($eve_detail->completion_bit==1){{$eve_detail->event_code }}@endif</td>
                        <td class="txt_participants color-black" id="p_white" onclick="show_detail('{{$eve_detail->event_details->event_id}}')">{{count($eve_detail->event_participants)}}</td>
                        <td class="txt_event_started color-black " onclick="show_detail('{{$eve_detail->event_details->event_id}}')">{{date('M d, Y', strtotime($eve_detail->start_date_event))}}</td>
                        <td class="txt_last_modified color-black " onclick="show_detail('{{$eve_detail->event_details->event_id}}')">{{date('M d, Y', strtotime($eve_detail->updated_at))}}</td>
                        <!-- <td class="txt_vendor color-black ">23 Vendors</td> -->
                        <td class="txt_participants color-black " onclick="show_detail('{{$eve_detail->event_details->event_id}}')" style="color:{{$color}} " id="">@if($eve_detail->completion_bit==0) Draft @else Published @endif </td>
                        <td>
                        <!-- <div class="dropdown-menu dropdown_custem_style" aria-labelledby="dropdownMenuButton">
                           <a class="dropdown-item" href="{{ url('show_event/'.$eve_detail->event_details->event_id) }}">
                            Show
                           </a>
                        </div> -->
                     </td>
                  </tr>
                  @php $total_events++; @endphp
                  @endif
                    @endforeach
						</tbody>
				</table>
      </div>
   </div>
</div>
<script>
   document.getElementById('total_events').innerHTML = "<?php echo $total_events; ?>"+" entries";
   function edit_event(event_id)
   {
      window.location.href = "edit_event"+'/'+event_id;
   }
   function show_detail(event_id)
   {
      window.location.href = "show_event"+'/'+event_id;
   }
</script>
@endsection