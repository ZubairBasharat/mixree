<?php
    $user_info= Auth::user();
    $url= url()->current();


$value= basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));


    //exit;
?>
@extends('dashboard.owner.app')
@section('content')
<style type="text/css">
  #sortable {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 100%;
  position: relative;
}
#sortable li {
  margin: 0 3px 3px 3px;
  cursor: move;
}
#sortable li span {
  position: absolute;
  margin-left: -1.3em;
}

</style>
<div class="container-fluid">
<div class="row data-viewer">

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
                        <div class="text-center py-2" style="cursor: default;" onclick="mark_all_read()">
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
         <div class="col-md-12 d-inline-flex">
            <h1 class="events-title gray">Events / </h1>
            <h1 class="natasha-title ml-2">{{App\EventDetail::where('event_id',$id)->first()->eve_name}}</h1>
         </div>
         <!-- <div class="col-md-4">
            <h1 class="events-title">Natasha’s Wedding</h1>
            </div> -->
      </div>
            <!-- *******************
                Tabs section
                ********************-->
                <div class="row data-viewer">
                  <div class="col-md-12">
                     <ul class="nav tabs_head">
                        <li class="d-inline-flex">
                           <img src="{{ asset('public/assets/imgs/octicon_info.png') }}" class="icon_tab">
                           <a class="nav-link" href="{{url('/show_event',$id)}}">Event Details</a>
                        </li>
                        <li class="d-inline-flex item_nav_disable ">
                           <img src="{{ asset('public/assets/imgs/jam_task-list.png') }}" class="icon_tab">
                           <a href="{{url('/event-program',$id)}}" class="nav-link">Event Programs</a>
                        </li>
                        <li class="d-inline-flex item_nav_disable ">
                           <img src="{{ asset('public/assets/imgs/whh_foodtray.png') }}" class="icon_tab">
                           <a class="nav-link" href="{{url('event-menus',$id)}}">Event menus</a>
                        </li>
                        <!-- <li class="d-inline-flex item_nav_disable">
                           <img src="{{ asset('public/assets/imgs/bx-store.png') }}" class="icon_tab">
                           <a class="nav-link" href="#">Vendor</a>
                        </li> -->
                        <li class="d-inline-flex item_nav_disable item_nav_active">
                           <img src="{{ asset('public/assets/imgs/heroicons-solid_user-group.png') }}" class="icon_tab">
                           <a class="nav-link" href="{{url('event_participants',$id)}}">Guests</a>
                        </li>
                     </ul>
                  </div>
               </div>
              <!-- /***************
      Filteration Section
      *******************/ -->
   <div class="row mt-45px">
      <div class="col-md-6">
         <h1 class="events-title">Participants<span id="total_events" style="font-size: 15px;">{{count($participants)}} People</span></h1>
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
            <form method="POST" id="delete_participants_form" action="{{url('delete_participants')}}">
            @csrf
           <input type="hidden" name="deleted_participants" id="deleted_participants" value="">
           <button type="submit" id="selected_participants" style="width: 168px;" disabled class="btn-delete text-white ml-3">Disinvite</button>
         </form>
            <!-- <button class="btn-icon-menu"><img class="plus_icon" src="{{ asset('public/assets/imgs/icon_menu.png') }}"></button> -->
            <!-- <button class="btn-events-1">Acs ( A - Z ) <img class="close_icon" src="{{ asset('public/assets/imgs/close-icon.png') }}"></button>
            <button class="btn-events-2">Today <img class="close_icon" src="{{ asset('public/assets/imgs/close-icon.png') }}"></button> -->
         </div>
      </div>
      <div class="col-md-2 text-right">
         <div class="ml-auto d-inline-flex">
            <!-- <p class="txt_sorted_by">Sorted by</p>
            <p class="span_all"><a href="#">All</a></p> -->
         </div>
      </div>
   </div>
   <!-- /***************
      Data table
      *******************-->
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
                        <input type="checkbox" id="checkbox_main_all" onclick="checkAllParticipants(this)">
                        <span class="checkmark_all"></span>
                        </label>
                     </th>
                     <th class="p_name">Name <img class="icon_sorting" src="{{ asset('public/assets/imgs/Group-642.png') }}"></th>
                     <th class="p_last_modified">Email<img class="icon_sorting" src="{{ asset('public/assets/imgs/Group-642.png') }}"></th>
                     <!-- <th class="p_vendor">Vendor<img class="icon_sorting" src="{{ asset('public/assets/imgs/Group-642.png') }}"></th> -->
                     <!-- <th class="p_vendor">Status<img class="icon_sorting" src="{{ asset('public/assets/imgs/Group-642.png') }}"></th> -->
                     <th></th>
                  </tr>
               </thead>
               <tbody>
               @php $total_participant = 0; @endphp
               @foreach($participants as $participant)
               @if(!empty($participant->user))
                  <tr id="" class="tbl_gray" id="">
                     <td class=" ">
                        <label class="container_checkbox">
                        <input type="checkbox" class="participants_checkboxes" value="{{$participant->id}}" id="" >
                        <span class="checkmark-2"></span>
                        </label>
                     </td>
                        <td class="txt_participants color-black"><img class="img_profile_icon" src="{{(empty($participant->user->image))?asset('/public/assets/imgs/default-user-image.png'):asset($participant->user->image)}}" style="border-radius:50% !important"><span class="">{{$participant->user->name}} </span></td>
                        <td class="txt_participants color-black " id="p_white">{{$participant->user->email}}</td>
                        <!-- <td class="txt_event_started color-black ">Waiting</td> -->
                        <td>
                        <p class="custem_doted tbl_gray1 cursor" class="btn dropdown-toggle btn_doted_dropdown" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></p>
                        <div class="dropdown-menu dropdown_custem_style" aria-labelledby="dropdownMenuButton">
                           <a class="dropdown-item" href="{{url('delete_participant',$participant->id)}}">
                            Cancel
                           </a>
                        </div>
                     </td>
                  </tr>
                  @php $total_participant++; @endphp
                  @endif
               @endforeach   
						</tbody>
				</table>
      </div>
   </div>
</div>
      </div>
    </div>
</div>
<script>
 function checkAllParticipants(bx) {
        
        var cbs = document.getElementsByTagName('input');
        for(var i=0; i < cbs.length; i++) {
          if(cbs[i].type == 'checkbox') {
          cbs[i].checked = bx.checked;
          }
        }
        $('#selected_participants').attr('disabled', 'disabled');
         var selected_events = $(".participants_checkboxes:checked").length;
         // $("#selected_participants").text("Cancel ("+selected_events+" Participants)");
         if(selected_events>0)
         {
            $("#selected_participants").removeAttr('disabled');
         }
      }
</script>

@endsection
