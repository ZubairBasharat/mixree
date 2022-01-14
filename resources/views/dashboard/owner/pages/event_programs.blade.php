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
                        <div class="text-center py-2" style="cursor:default" onclick="mark_all_read()">
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
                        <li class="d-inline-flex item_nav_disable item_nav_active">
                           <img src="{{ asset('public/assets/imgs/jam_task-list.png') }}" class="icon_tab">
                           <a href="{{url('/event-program',$id)}}" class="nav-link">Event Programs</a>
                        </li>
                        <li class="d-inline-flex item_nav_disable">
                           <img src="{{ asset('public/assets/imgs/whh_foodtray.png') }}" class="icon_tab">
                           <a class="nav-link" href="{{url('event-menus',$id)}}">Event menus</a>
                        </li>
                        <!-- <li class="d-inline-flex item_nav_disable">
                           <img src="{{ asset('public/assets/imgs/bx-store.png') }}" class="icon_tab">
                           <a class="nav-link" href="#">Vendor</a>
                        </li> -->
                        <li class="d-inline-flex item_nav_disable">
                           <img src="{{ asset('public/assets/imgs/heroicons-solid_user-group.png') }}" class="icon_tab">
                           <a class="nav-link" href="{{url('event_participants',$id)}}">Guests</a>
                        </li>
                     </ul>
                  </div>
               </div>
            <!-- *******************
                Location
                ********************-->
                <nav class="locationTabs my-4">
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <h3 class="mr-4 h6 my-auto font-weight-bold">Location:</h3>
                    @if(count($event_programs)>0)
                    @php $location_counter = 0; @endphp
                    @foreach($event_programs as $event_program)
                    <a class="nav-item nav-link {{($location_counter==0)?'active':''}}" id="nav-home-tab" data-toggle="tab" href="#{{$event_program->id}}" role="tab" aria-controls="nav-home" aria-selected="true">
                      <button class="locationBtnActive">{{$event_program->name}}</button>
                    </a>
                    <br>
                    @php $location_counter++; @endphp
                    @endforeach
                    @endif
                    <!-- <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
                      <button class="mr-3">House Party</button>
                    </a> -->
                  </div>
                </nav>
                <form action="{{ url('create_event_program_details') }}" method="post"> 
                @csrf
                <input type="hidden" value="{{$id}}" name="event_id">
                <div class="tab-content" id="nav-tabContent">
                @php $description_counter = 0; @endphp
                @foreach($event_programs as $location)
                <input type="hidden" name="event_location_id[]" value="{{$location->id}}">
                  <div class="tab-pane fade show {{($description_counter==0)?'active':''}}" id="{{$location->id}}" data-id="{{$location->id}}"  role="tabpanel" aria-labelledby="nav-home-tab">
                  {{date('M-d-Y',strtotime($location->start_date)).'  '.date('h:i a',strtotime($location->start_time))}}
                      <!-- *******************
                        Custom Fields
                        ********************-->
                        <div class="row">
                          <div class="w-100">
                             <div class="mt-20">
                             </div>
                             <div class="mt-40px click-target uy row">
                                <div class="col-12">
                                   <div class="input-bg-preview-whit" style="padding: 0px 18px !important;width:100%"></div>
                                </div>
                             </div>
                                <ul id="sortable">
                                @if(!empty($location->event_program_details))
                                @foreach($location->event_program_details as $details)
                                <input type="hidden" name="program_details_id[]" value="{{$details->id}}">
                                @if(!empty($details->event_program_description))
                                @foreach($details->event_program_description as $description)
                                    <li class="ui-state-default" id='field_@php echo $description->id @endphp'>
                                       <div id="">
                                          <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                          <div id="" class="mt-40px click-target uy row">
                                             <div class="col-11">
                                                <div class="input-bg-preview-whit" style="padding: 0px 58px 0px 18px !important;width:100%">
                                                   <div class="material-form-field">
                                                     <input type="text" value="{{$description->description}}" class="custom_147" name="event_program_{{$location->id}}[]" value="" id="" placeholder="Ex : Program Details">
                                                   </div>
                                                   <img class="drag" src="{{asset('public/assets/imgs/drag.png')}}">
                                                </div>
                                             </div>
                                             <div class="col-1">
                                                <div class="del-img-3 mt-20px ml-4">
                                                  <img src="{{asset('/public/assets/imgs/ic_round-delete.png')}}" id="deleteLiItem" onclick="remove_custom_field('@php echo $description->id @endphp')">
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                 @endforeach  
                                 @endif
                                 @endforeach   
                                 @endif   
                                </ul>
                          </div>
                        </div>
                  </div>
                   @php $description_counter++; @endphp
                  @endforeach()
                  <div class=" addCF mt-38px  ">
                  <button type="button"class="add-div-on input-bg-preview end-add-bg-0 button-0" onclick="add_custom_field()">Add Event Program</button>
               </div>
                </div>
                <div class=" addCF mt-38px col-md-12">
                  <button class="btn_next" style="width: 100%;">Update</button>
               </div>
                </form> 
<script type="text/javascript">
  var custom_field_counter = 1;
  function add_custom_field()
   {
      var location_id = $(".tab-pane.active").attr('data-id');
      $(".tab-pane.active").find(('#sortable')).append('<li class="ui-state-default" id='+custom_field_counter+'>'+
        '<div id="field_'+custom_field_counter+'">'+
        '<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>'+
                            '<div id="field_1" class="mt-40px click-target uy row">'+
                            '<div class="col-11">'+ 
                            '<div class="input-bg-preview-whit" style="padding: 0px 58px 0px 18px !important;width:100%">'+
                            '<div class="material-form-field">'+ 
                            '<input type="text" class="custom_'+location_id+'" name="event_program_'+location_id+'[]" id="description_1" placeholder="Ex : Program Details">'+
                            '</div>'+
                            '<img class="drag" src="../public/assets/imgs/drag.png">'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-1">'+
                            '<div class="del-img-3 mt-20px ml-4">'+
                            '<img src="../public/assets/imgs/ic_round-delete.png" id="deleteLiItem" onclick="remove_custom_field('+custom_field_counter+')">'+
                            '</div>'+
                            '</div>'+
                            '<label style="color: red;display:none" class="dexcription_warning" id="description_warn_">Please Enter Detail</label>'+
                            '</div>'+
                            '</div>'+
                            '</li>');
      custom_field_counter++;
   };
   function remove_custom_field(id){
      $.ajax({
          url : '{{url("delete_event_description")}}',
          method : 'POST',
          data : {description_id:id, '_token': '{{ csrf_token() }}'},
          success:function(response)
          {
             if(response)
             {
             }
          }
      });
      $("#field_"+id).remove();
   }
</script>

@endsection
