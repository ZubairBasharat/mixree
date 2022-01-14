<?php
    $user_info= Auth::user();
    $url= url()->current();


$value= basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));


    //exit;
?>
@extends('dashboard.owner.app')
@section('content')
<style type="text/css">
  /* The container */
.containerCheckbox {
  display: block !important;
  position: relative !important;
  padding-left: 35px !important;
  margin: 0px !important;
  cursor: pointer !important;
  font-size: 16px !important;
  -webkit-user-select: none !important;
  -moz-user-select: none !important;
  -ms-user-select: none !important;
  user-select: none !important;
}

/* Hide the browser's default checkbox */
.containerCheckbox input {
  position: absolute !important;
  opacity: 0 !important;
  cursor: pointer !important;
  height: 0 !important;
  width: 0 !important;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  height: 25px !important;
  width: 25px !important;
  background-color: #DCDDDF !important;
  border-radius: 25% !important;
}

/* On mouse-over, add a grey background color */
.containerCheckbox:hover input ~ .checkmark {
  background-color: #ccc !important;
}

/* When the checkbox is checked, add a blue background */
.containerCheckbox input:checked ~ .checkmark {
  background-color: #2196F3 !important;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "" !important;
  position: absolute !important;
  display: none !important;
}

/* Show the checkmark when checked */
.containerCheckbox input:checked ~ .checkmark:after {
  display: block !important;
}

/* Style the checkmark/indicator */
.containerCheckbox .checkmark:after {
  left: 10px !important;
  top: 6px !important;
  width: 5px !important;
  height: 10px !important;
  border: solid white !important;
  border-width: 0 3px 3px 0 !important;
  -webkit-transform: rotate(45deg) !important;
  -ms-transform: rotate(45deg) !important;
  transform: rotate(45deg) !important;
}
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
.subMenuGuest{
  display: block;
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
                        <div class="text-center py-2">
                           <a class="text-secondary" href="">
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
                              <div class="top-text-heading mb-1 font-12">{{$notification->message}}</div>
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
                  <a class="dropdown-item" href="{{ url('logout')}}">
                  Logout
                  </a>
                  <a class="dropdown-item" href="{{ url('profile-account')}}">
                     Edit Profile
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
            <h1 class="events-title gray">Access Controls / </h1>
            <h1 class="natasha-title ml-2">Guests</h1>
         </div>
         <!-- <div class="col-md-4">
            <h1 class="events-title">Natasha’s Wedding</h1>
            </div> -->
      </div>


<!-- /***************
         Table
         *******************/ -->

      <div class="col-sm-12">
      <table id="example" class="table my-tbl-style " style="width:100%">
               <thead>
                  <tr>
                   
                     <th class="p_vendor">Participant Name<img class="icon_sorting" src="{{ asset('public/assets/imgs/Group-642.png') }}"></th>
                     <th class="p_vendor">Participant Email<img class="icon_sorting" src="{{ asset('public/assets/imgs/Group-642.png') }}"></th>
                     <th class="p_vendor">Evant Name<img class="icon_sorting" src="{{ asset('public/assets/imgs/Group-642.png') }}"></th>
                     <th class="p_vendor">Media<img class="icon_sorting" src="{{ asset('public/assets/imgs/Group-642.png') }}"></th>
                     <th class="p_vendor">Note<img class="icon_sorting" src="{{ asset('public/assets/imgs/Group-642.png') }}"></th>
                     <th> </th>
                  </tr>
               </thead>
               <tbody>
               @foreach($participants as $participant)
               @if(!empty($participant->user))
               @if(!empty($participant->event))
               <tr id="" class="tbl_gray odd" role="row">
                  <td class="name_profile color-black " style="background-color: rgba(237, 237, 237, 0.6); color: black;">
                     <img class="img_profile_icon ml-3" src="{{(empty($participant->user->image))?asset('/public/assets/imgs/default-user-image.png'):asset($participant->user->image)}}" style="border-radius:50% !important"><span class="189tbl_gray">{{$participant->user->name}} </span>
                  </td>
                  <td class="txt_participants color-black " id="p_white" style="background-color: rgba(237, 237, 237, 0.6); color: black;">{{$participant->user->email}}</td>
                  <td class="txt_participants color-black " id="p_white" style="background-color: rgba(237, 237, 237, 0.6); color: black;">{{$participant->event->eve_name}}</td>
                  <td class="txt_participants color-black " style="background-color: rgba(237, 237, 237, 0.6); color: black;" id="">
                    <label class="containerCheckbox">Note
                      <input type="checkbox" value="{{$participant->note}}" onclick="change_note(this,'{{$participant->id}}')" {{($participant->note==0)?'':'checked'}}>
                      <span class="checkmark"></span>
                    </label>
                   </td>
                   <td class="txt_participants color-black " style="background-color: rgba(237, 237, 237, 0.6); color: black;" id="">
                    <label class="containerCheckbox">Media
                      <input type="checkbox" value="{{$participant->media}}" onclick="change_media(this,'{{$participant->id}}')" {{($participant->media==0)?'':'checked'}}>
                      <span class="checkmark"></span>
                    </label>
                   </td>
                  <td style="background-color: rgba(237, 237, 237, 0.6); color: black;">
                     <p class="custem_doted tbl_gray1 cursor" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></p>
                     <div class="dropdown-menu dropdown_custem_style" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="http://localhost/mixrre_admin_apis/show_event/189">
                        Show
                        </a>
                     </div>
                  </td>
               </tr>
            @endif  
            @endif  
            @endforeach   
						</tbody>
				</table>
      </div>
      <!-- <div class="col-md-12 text-right">
        <div class="ml-auto d-inline-flex">
          <a class="guestCencel" href=""><button>Cencel</button></a>
          <a class="ml-3 guestSave"href=""><button>Save</button></a>
        </div>
      </div> -->
    </div>
  </div>
 </div>   
 <script>
      function change_media(e,participant_id)
      {
         var media = $(e).val();
         if(media==0)
         {
            media = 1;
         } else if(media==1) {
            media = 0;
         }
         $(e).val(media);
         $.ajax({
             url : "{{url('update_media')}}",
             method : 'post',
             data   : {media: media, participant_id: participant_id, '_token': '{{csrf_token() }}'},
         });
      }

      function change_note(e,participant_id)
      {
         var note = $(e).val();
         if(note==0)
         {
            note = 1;
         } else if(note==1) {
            note = 0;
         }
         $(e).val(note);
         $.ajax({
             url : "{{url('update_note')}}",
             method : 'post',
             data   : {note: note, participant_id: participant_id, '_token': '{{csrf_token() }}'},
         });
      }
      function read_notification(id)
      {
         $.ajax({
            url : "{{url('read_notification')}}",
            type : 'post',
            data : {notification_id: id, '_token': '{{ csrf_token() }}'},
            success:function(response)
            {
               $("#new_notifications").text(response);
            }
         });
      }
 </script>  
 @endsection
