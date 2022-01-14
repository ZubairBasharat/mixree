@extends('dashboard.owner.app')
@php
 $user_count = 0;
 $total_guest = App\EventParticipant::where(['event_id' => $event[0]->event_details['event_id']])->with('user')->get();
@endphp
@section('content')
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
         <div class="col-md-12 d-inline-flex">
            <h1 class="events-title gray">Events / </h1>
            <h1 class="natasha-title ml-2">{{$event[0]->event_details->eve_name}}</h1>
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
               <li class="d-inline-flex item_nav_active">
                  <img src="{{ asset('public/assets/imgs/octicon_info.png') }}" class="icon_tab">
                  <a class="nav-link" href="{{url('/show_event',$event[0]->id)}}">Event Details</a>
               </li>
               <li class="d-inline-flex item_nav_disable">
                  <img src="{{ asset('public/assets/imgs/jam_task-list.png') }}" class="icon_tab">
                  <a href="{{url('/event-program',$event[0]->id)}}" class="nav-link">Event Programs</a>
               </li>
               <li class="d-inline-flex item_nav_disable">
                  <img src="{{ asset('public/assets/imgs/whh_foodtray.png') }}" class="icon_tab">
                  <a class="nav-link" href="{{url('event-menus',$event[0]->id)}}">Event menus</a>
               </li>
               
               <li class="d-inline-flex item_nav_disable">
                  <img src="{{ asset('public/assets/imgs/heroicons-solid_user-group.png') }}" class="icon_tab">
                  <a class="nav-link" href="{{url('event_participants',$event[0]->id)}}">Guests</a>
               </li>
            </ul>
         </div>
      </div>
      <!-- *******************
         Image Section
         ********************-->
         @foreach($event as $eve_detail)
      <div class="row data-viewer" >
         <div class="col-md-12">
            <!-- <img src="{{ asset('public/images/event_images/'.$eve_detail->event_details->bg_img) }}" class="img_slide" height="252" style="border-radius: 15px;"> -->
         </div>
      </div>

      <div class="row data-viewer">
         <div class="col-md-12 col-lg-6 d-inline-flex div_wedding" style="max-width:50%">
            <img src="{{ asset('public/images/event_images/'.$eve_detail->event_details->icon) }}" style="border-radius:50% !important">
            <div class="div_detail">
               <p>{{ucwords($eve_detail->type)}}</p>
               <h2>{{ucwords($eve_detail->event_details->eve_name)}}</h2>
            </div>
         </div>
         <div class="col-md-2 div_modified">
            <p>Event Code</p>
            <h2>{{ucwords($eve_detail->event_code)}}</h2>
         </div>
         <div class="col-md-2 div_modified">
            <p>Last Modified</p>
            <h2>{{date('M d,Y', strtotime($eve_detail->updated_at))}}</h2>
         </div>
         <!-- <div class="col-md-2 div_vendor">
            <p>Vendor</p>
            <h2>56 Vendors</h2>
         </div> -->
         <div class="col-md-2 div_btn_edit p-0">
            <a href="{{url('edit_event',$event[0]->id)}}"><button class="btn-edit-details"> <img class="edit_icon" src="{{ asset('public/assets/imgs/ic_round-edit.png') }}"> Edit Details</button></a>
         </div>
      </div>

      <hr>
      <h4>Introduction</h4>
      <p class="p_wed_detail">{{$eve_detail->event_details->guest_note}}</p>
      @endforeach
      <!-- *******************
         peoples Section
         ********************-->
      <p class="create-events-label mb-12px">People who join this event</p>
      <div class="row data-viewer-event">
         <div class="col-md-6 col-lg-4 coll-4">
           <div class="d-flex-l">
           <div class="col-50 mt-md-1 mt-1">
                  <div class="create-box ">
                     <div class="row data-viewer">
                        <div class="col-4 pr-md-0">
                           <img src="{{ asset('public/assets/imgs/imageedit_4_8890050283.png') }}" class="bg-create">
                        </div>
                        <div class="col-8 pl-md-0">
                           <div class="create-head">
                              <p class="mb-0">Total Guest</p>
                           </div>
                           <div class="create-dash">
                              <span>{{count($total_guest)}} people
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
           <!-- <div class="col-50 mt-md-1 mt-1">
                  <div class="create-box ">
                     <div class="row data-viewer">
                        <div class="col-4 pr-md-0">
                           <img src="{{ asset('public/assets/imgs/imageedit_6_2212810369.png') }}" class="bg-create">
                        </div>
                        <div class="col-8 pl-md-0">
                           <div class="create-head">
                              <p class="mb-0">Total Guest</p>
                           </div>
                           <div class="create-dash">
                              <span>182 people
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div> -->

           </div>
         </div>
         <div class="col-md-12 col-lg-8 coll-8">
            <div class="users-list  mt-3">
               @foreach($total_guest as $guest)
               @if($user_count < 10)
               <img class="avatar" src="{{($guest->user['image']!=Null)?asset($guest->user['image']):asset('/public/assets/imgs/default-user-image.png')}}">
               
               @php $user_count++;@endphp
               @endif
               @endforeach
               <span class="user-number">
                  @php if(count($total_guest)>=10)
                  echo  count($total_guest)-$user_count. ' Guests'
                  @endphp
               <!-- +76 people -->
               </span>
            </div>
         </div>
      </div>
      <!-- *******************
         shedule Section
         ********************-->
      <div class="row data-viewer-1">
         <div class="col-md-6 col-lg-6 colll-50 ">
            <p class="create-events-label mt-20px">Schedule</p>
            <div class="row">
                @php $i=0;
                @endphp
            @foreach($eve_detail->event_locations()->get() as $reserv)
               <div class="coll-4 form-group">
                  <div class="shedule-box">
                     <div class="row data-viewer">
                        <div class="col-3">
                           <div class="imag-shedule">
                              <img src="{{ asset('public/assets/imgs/clarity_date-solid.png') }}">
                           </div>
                        </div>

                        <div class="col-8">
                           <div class="heading-shedule">

                               @if($i == 0)
                              Started
                              @elseif($i==1)
                              Second
                              @elseif($i==2)
                              Third
                              @else
                              $i.'th'
                              @endif
                           </div>
                           <div class="shedule-date">
                              {{date('M-d-Y',strtotime($reserv->start_date))}}
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
               @php $i++;
               @endphp
               @endforeach
                </div>
               
            </div>
         <div class="col-md-12 col-lg-6 coll-50">
            <p class="create-events-label mt-20px">Location</p>
            @foreach($eve_detail->event_locations()->get() as $location)
            <div class="location-box mt-16px">
               <div class="row data-viewer">
                  <div class="col-1">
                     <img src="{{ asset('public/assets/imgs/location.png') }}">
                  </div>
                  <div class="col-11">
                     <div class="location-head">
                        {{ucwords($location->name)}}
                     </div>
                     <div class="address">
                        {{ucwords($location->address)}}
                     </div>
                  </div>
               </div>
            </div>
            @endforeach
         </div>
      </div>
      <div class="row data-viewer mt-40px">
         <div class="col-md-12 col-lg-6">
            <div class="row data-viewer">
               <div class="col-md-12 mt-0px">
                  <pre class="wed-text ">Registry Website Links</pre>
                  @foreach($eve_detail->event_registries as $registry)
                  @if($registry->name!="" || $registry->name!=Null)
                  <div class="list_wedding list-wed-width row ">
                     <div class="col-10">
                        <h5 class="p_wedding_list">{{$registry->name}}</h5>
                     </div>
                     <div class="col-2">
                        <a href="{{'https://'.$registry->link}}" target="_blank"><img src="{{ asset('public/assets/imgs/expand.png') }}" class="icon_expand "></a>
                     </div>
                  </div>
                  @endif
                  @endforeach
               </div>
            </div>
         </div>
         <div class="col-md-12 col-lg-6">
            <div class="row">
               <div class="col-md-6">
                  <p class="total-donation">Fashion Event</p>
               </div>
               <div class="col-md-6">
                  <p class="see-details" data-toggle="modal" data-target="#exampleModal" style="cursor:default"> See Details</p>
               </div>
            </div>
            @if(!empty($eve_detail->event_fashions()))
            @foreach($eve_detail->event_fashions()->get() as $fashion)
            @if($fashion->type != "general_dress_code")
            <div class="fashion-box mt-20px">
               <div class="row">
                  <div class="col-md-4">
                     <div class="fashion-image">
                        <img src="{{ asset('public/images/event_images/'.$fashion->image) }}" height="100" width="100">
                     </div>
                     <!--<div class="text-fashion">-->
                     <!--   152 items left-->
                     <!--</div>-->
                  </div>
                  <div class="col-md-8">
                     <div class="row">
                        <div class="col-6">
                           <p class="total-donation-09">{{$fashion->name}}</p>
                        </div>
                        <div class="col-6">
                           <p class="see-details-09"> ${{$fashion->price}}</p>
                        </div>
                     </div>
                     <div class="fashion-par">
                        <p class="mb-0">{{$fashion->description}}.</p>
                     </div>
                  </div>
               </div>
            </div>
            @endif
            @endforeach
            @endif
         </div>
      </div>
   </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 950px;" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border: none;">
        <h5 class="modal-title" id="exampleModalLabel">Fashion Event Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
            <!-- <button class="btn-icon-menu"><img class="plus_icon" src="{{ asset('public/assets/imgs/icon_menu.png') }}"></button> -->
            <button class="btn-events-1">Acs ( A - Z ) <img class="close_icon" src="{{ asset('public/assets/imgs/close-icon.png') }}"></button>
            <button class="btn-events-2">Today <img class="close_icon" src="{{ asset('public/assets/imgs/close-icon.png') }}"></button>
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
                     <th class="p_name">Name <img class="icon_sorting" src="{{ asset('public/assets/imgs/Group-642.png') }}"></th>
                     <th class="p_name">Item Name <img class="icon_sorting" src="{{ asset('public/assets/imgs/Group-642.png') }}"></th>
                     <th class="p_name">Quantity <img class="icon_sorting" src="{{ asset('public/assets/imgs/Group-642.png') }}"></th>
                     <th class="p_name">Total Order <img class="icon_sorting" src="{{ asset('public/assets/imgs/Group-642.png') }}"></th>
                  </tr>
               </thead>
               <tbody>
               @php $items = "";
               $quantity = 0;
                @endphp
               @if(!empty($products))
               @foreach($products as $order_detail)
               @if(count($order_detail->orders)>0)
               @foreach($order_detail->orders as $order)
               @php 
               $items .= $order->product->name.', ';
               $quantity += $order->product_quantity; 
                @endphp
               @endforeach
               @endif
                  <tr id="{{$eve_detail->id}}" class="tbl_gray" id="{{$eve_detail->event_details->event_id}}tbl_gray">
                        <td class="txt_participants color-black " id="">{{$order_detail->user->name}}</td>
                        <td class="txt_participants color-black " id="">{{$items}}</td>
                        <td class="txt_participants color-black " id="">{{$quantity}}</td>
                        <td class="txt_participants color-black " id="">{{$order_detail->total_price}}</td>
                  </tr>
               @php $items = "";
                $quantity = 0;
                @endphp
               @endforeach
               @endif   
						</tbody>
				</table>
      </div>
   </div>
</div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
<script>
    
</script>
@endsection
