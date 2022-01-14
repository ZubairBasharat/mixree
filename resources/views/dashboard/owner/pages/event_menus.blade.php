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
                        <li class="d-inline-flex item_nav_disable item_nav_active">
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
                Tabs section
                ********************-->
                <nav class="locationTabs my-4">
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <h3 class="mr-4 h6 my-auto font-weight-bold">Location:</h3>
                    @php $location_counter = 0; @endphp
                    @foreach($event_menu as $location)
                    <a class="nav-item nav-link {{($location_counter==0)?'active':''}}" id="nav-home-tab" data-toggle="tab" href="#{{$location->id}}" role="tab" aria-controls="nav-home" aria-selected="true">
                      <button class="locationBtnActive">{{$location->name}}</button>
                    </a>
                    @php $location_counter++; @endphp
                    @endforeach
                    <!-- <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
                      <button class="mr-3">House Party</button>
                    </a> -->
                  </div>
                </nav>
              <form method="post" action="{{ url('create_event_menu') }}">  
              @csrf
              <input type="hidden" name="event_id" value="{{ $id}}">
            <div class="tab-content" id="myTabContent">
                     @php $active = 1; @endphp
                     @foreach($event_menu as $menu)
                     <input type="hidden" name="event_location_id[]" value="@php echo $menu->id @endphp">
                        <div class="tab-pane  @if($active==1){{'active show'}}@endif" data-id="@php echo $menu->id @endphp" id="@php echo $menu->id @endphp" role="tabpanel" aria-labelledby="home-tab"> 
                        {{date('M-d-Y',strtotime($menu->start_date)).'  '.date('h:i a',strtotime($menu->start_time))}}
                        <div id="show-dive-payment">
                              <div class="mt-20">
                                 <div class="row">
                                    <div class="col-md-11 mt-20px">
                                       <div class="form-group">
                                          <div class="input-bg-preview">
                                             <label class="lb-start-date w-100 m-0">Type of Menu</label>
                                             <select  id="menu_type@php echo $active @endphp" name="menu_type@php echo $menu->id @endphp" class="frt" onchange="showDiv(this)">
                                             <option data-value="@php echo $menu->id @endphp" value="0" {{(count($menu->get_single_menus)>0)?'selected':((count($menu->get_single_menus)<=0) && (count($menu->get_platted_menu)<=0))?'active':''}}>View Only</option>
                                                <option data-value="@php echo $menu->id @endphp" {{(count($menu->get_platted_menu)>0)?'selected':''}} value="1" >Platted</option>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-1 ">
                                       <div class="del-img-1-2 ">
                                          <img src="{{ asset('public/assets/imgs/info-icon.png') }}">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div id="view_only@php echo $menu->id @endphp" style="display:  {{(count($menu->get_single_menus)>0)?'block':((count($menu->get_single_menus)<=0) && (count($menu->get_platted_menu)<=0))?'block':'none'}}">
                              <div class="mt-20px">
                                 <div class="row">
                                    <div class="col-8">
                                       <p class="head_detail_ce-1">Menu</p>
                                    </div>
                                    <div class="col-4 text-right">
                                       <!-- <p class="head_detail_ce-1-099">double click to edit</p> -->
                                    </div>
                                 </div>
                                 <div class="mt-15px">
                                    <div id="customFields-1-add-food">
                                   @if(count($menu->get_single_menus)>0) 
                                   @foreach($menu->get_single_menus as $item)
                                   @if($item->status==0)
                                    <div class=" mt-30px"  id="@php echo $item->id @endphp">
                                    <div class="input-bg-preview-ex-padding ">
                                       <div class="row">
                                          <div class="col-10">
                                             <input class="single_meal@php echo $active @endphp"  value="{{$item->name}}" id='@php echo $menu->id @endphp' name="food_@php echo $menu->id @endphp[]" type="text" onkeypress="KeyPress(event, '@php echo $menu->id @endphp')" class="double"   placeholder="Ex : Chicken"/>   
                                          </div>
                                          <div class="col-2 text-end-0">
                                          <div class="del-img-1-09 remCF-food">
                                             <img src="{{asset('/public/assets/imgs/ic_round-delete.png')}}" onclick="removeListItem_viewonly('{{$item->id}}')">
                                          </div>
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
                              <div class="input-bg-preview end-add addCF-food mt-38px  ">
                                 <butto  href="javascript:void(0);" class="add-div-on " >Add More</butto>
                              </div>
                              <!-- <div class="mt-54px">
                                 <div class="row">
                                    <div class="col-8">
                                       <p class="head_detail_ce-1">Drink</p>
                                    </div>
                                    <div class="col-4 text-right">
                                       <p class="head_detail_ce-1-099">double click to edit</p>
                                    </div>
                                 </div>
                                 <div class="mt-15px">
                                    <div id="customFields-1-single-food">
                                    @if(count($menu->get_single_menus)>0) 
                                   @foreach($menu->get_single_menus as $drink)
                                   @if($drink->status==1)
                                    <div class=" mt-30px" id="@php echo $drink->id @endphp">
                                    <div class="input-bg-preview-ex-padding ">
                                       <div class="row">
                                          <div class="col-10">
                                             <input class="single_drink@php echo $active @endphp" value="{{$drink->name}}" id='@php echo $menu->id @endphp' name="drink_@php echo $menu->id @endphp[]" type="text" onkeypress="KeyPress(event, '@php echo $menu->id @endphp')" class="double"   placeholder="Ex : Pepsi"/>   
                                          </div>
                                          <div class="col-2 text-end-0">
                                          <div class="del-img-1-09 remCF-food">
                                             <img src="{{asset('/public/assets/imgs/ic_round-delete.png')}}" onclick="removeListItem_viewonly('{{$drink->id}}')">
                                          </div>
                                       </div>
                                       </div>
                                    </div>
                                    </div>
                                    @endif
                                   @endforeach 
                                   @else

                                   @endif 
                                    </div>
                                 </div>
                              </div>
                              <div class="input-bg-preview end-add addCF-single mt-38px  ">
                                 <butto  href="javascript:void(0);" class="add-div-on " >Add More</butto>
                              </div> -->
                              </div>
                              <div id="platted@php echo $menu->id @endphp" style="display:{{(count($menu->get_platted_menu)>0)?'':'none'}};">
                              
                         <div class="row ">
                        <div class="col-md-8">
                        <p class="event-going">How many possible meal option?</p>
                           </div>
                        <div class="col-md-4">
                           <div id="customFields">
                                 <div class="wrap bt-right-counter mt-20px">
                                    <button type="button" id="" class="sub" onclick="sub_custom_fields('@php echo $menu->id @endphp')" class="" >-</button>
                                    <input class="count custom_counter@php echo $menu->id @endphp" type="text" value="{{(count($menu->get_platted_menu)>0)?count($menu->get_platted_menu):1}}" min="0" max="100"  id="" name="no_of_days" />
                                    <button type="button" id="" class="add" onclick="add_custom_fields('@php echo $menu->id @endphp')" class=" ">+</button>
                                 </div>
                              </div>
                        </div>
                  </div>
                  <div class="bridesmaid_container@php echo $menu->id @endphp">
                  <div class="row">
                     <div class="col-8">
                        <p class="head_detail_ce-1">Food</p>
                     </div>
                  </div>
            @if(count($menu->get_platted_menu)>0) 
            @php $platted_counter = 1; @endphp
            @foreach($menu->get_platted_menu as $platted)
              <div class="mt-15px" id="container_{{ $platted_counter }}">
            <div id="customFields-1-add-food-1_@php echo $platted->id @endphp" data-id="{{$platted_counter}}">
               <div class=" mt-30px">
                  <div class="input-bg-preview-ex-padding ">
                     <div class="row">
                        <div class="col-10">
                        <input type="hidden" value="{{$platted_counter}}"  id="platted_food_hidden@php echo $menu->id @endphp" name="platted_food_hidden@php echo $menu->id @endphp[]">
                           <input value="{{$platted->dish_name}}" class="platted_category_@php echo $active @endphp" id="rd37j" name="platted_food_@php echo $menu->id @endphp[]" type="text" onkeypress="KeyPress(event, 'rd37j')" class="double platted"  placeholder="Ex : Meal Category">                                 
                        </div>
                        <div class="col-2 text-end-0">
                           <div class="del-img-1-09 " onclick="add_custom_fields_add_1('@php echo $platted->id @endphp')">
                              <img src="{{ asset('public/assets/imgs/ady.png') }}"  >
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         @if(count($platted->platted_items)>0)
         @foreach($platted->platted_items as $items)
            <div class=" mt-10px" id="dish_field_{{$items->id}}"> <div class="input-bg-preview-ex-padding " style="height:60px;"> <div class="row">
               <div class="col-10"> 
               <input  type="text" class="double platted" value="{{$items->platted_dish_item}}" name="platted_food_item_{{$menu->id}}_{{$platted_counter}}[]"  placeholder="Ex : Meal Item">
               </div>
               <div class="col-2 text-end-0">
                  <div class="del-img-1-09 remCF-food" style="top:-20%"  onclick="add_custom_fields_add('{{$items->id}}')"> 
                     <img src="{{asset('/public/assets/imgs/ic_round-delete.png')}}"> 
                  </div>
               </div>
               </div>
               </div>
            </div>
         @endforeach
         @endif
         @php $platted_counter++; @endphp
         @endforeach 
         @else
         <div class="mt-15px">
            <div id="customFields-1-add-food-1_@php echo $menu->id @endphp" data-id="0">
               <div class=" mt-30px">
                  <div class="input-bg-preview-ex-padding ">
                     <div class="row">
                        <div class="col-10">
                        <input type="hidden"  id="platted_food_hidden@php echo $menu->id @endphp" name="platted_food_hidden@php echo $menu->id @endphp[]">
                           <input  class="platted_category_@php echo $active @endphp" id="rd37j" name="platted_food_@php echo $menu->id @endphp[]" type="text" onkeypress="KeyPress(event, 'rd37j')" class="double platted"  placeholder="Ex : Meal Category">                                 
                        </div>
                        <div class="col-2 text-end-0">
                           <div class="del-img-1-09 " onclick="add_custom_fields_add_1('@php echo $menu->id @endphp')">
                              <img src="{{ asset('public/assets/imgs/ady.png') }}"  >
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         @endif    
         </div>
        </div>
         </div>
      </div>
      @php $active++; @endphp
         @endforeach
         </div>
      <div class=" addCF mt-38px col-md-12">
         <button class="btn_next" style="width: 100%;">Update</button>
      </div>
    </form>
      <!-- /***************
         Events Section End
         *******************/ -->                  
      </div>
    </div>
</div>
<script>
   function showDiv(select){
      var div = $(select).find(':selected').data('value');
      if(select.value==1){
         $("#platted"+div).css('display','block');
         $("#view_only"+div).css('display','none');
      } else{
         $('.tab-pane.active').find((".platted")).prop('required', false);
         $("#view_only"+div).css('display','block');
         $("#platted"+div).css('display','none');
      }
   } 
   function isconfirm(url_val) {
    // alert(url_val);
    if (confirm('Are you sure want to cancel?') == false) {
      return false;

    } else {
      location.href = url_val;

    }
   }
   function sub_custom_fields(id){
      var counter = $(".custom_counter"+id).val();
      if(counter>1){
         $(".tab-pane.active").find(("#container_"+counter)).remove();
      $(".custom_counter"+id).val(parseInt(counter)-1);
      }
   }
   var food_category_counter = 1;
   function add_custom_fields(id){
      var counter = parseInt($(".custom_counter"+id).val())+1;
      var active_tab = $('.tab-pane.active').attr('data-id');
      $(".bridesmaid_container"+id).append('<div class="append_container" id="container_'+counter+'">'+
       '<input type="hidden" value="'+food_category_counter+'" name="platted_food_hidden'+active_tab+'[]">'+
         '<div class="mt-15px">'+
   '<div id="customFields-1-add-food-1_'+counter+'" data-id="'+food_category_counter+'">'+
     '<div class=" mt-30px">'+
              '<div class="input-bg-preview-ex-padding ">'+
            '<div class="row">'+
               '<div class="col-10">'+
                 '<input  id="rd37j" type="text"  name="platted_food_'+active_tab+'[]" class="double platted" placeholder="Ex : Chicken">'+                            
               '</div>'+
               '<div class="col-2 text-end-0">'+
                  '<div class="del-img-1-09 " onclick="add_custom_fields_add_1('+counter+')">'+
                     '<img src="../public/assets/imgs/ady.png" >'+
                 '</div>'+
               '</div>'+
            '</div>'+
         '</div>'+
     '</div>'+
   '</div>'+
"</div>");
         $(".custom_counter"+id).val(counter);
         food_category_counter++;
   }
   var dish_counter = 1;
   function add_custom_fields_add_1(id)
   {
      var dish = $('.tab-pane.active').find(("#customFields-1-add-food-1_"+id+"")).attr('data-id');
      var active_tab = $('.tab-pane.active').attr('data-id');
      $("#platted_food_hidden"+active_tab).val(0);
      $(".tab-pane.active").find(("#customFields-1-add-food-1_"+id+"")).append('<div class=" mt-10px" id="dish_field_'+dish_counter+'"> <div class="input-bg-preview-ex-padding " style="height:60px;"> <div class="row">'+
      '<div class="col-10"> '+
      '<input  type="text" class="double platted"  name="platted_food_item_'+active_tab+'_'+dish+'[]"  placeholder="Ex : Meal Item">'+
       '</div>'+
       '<div class="col-2 text-end-0">'+
        '<div class="del-img-1-09 remCF-food" style="top:-20%"  onclick="add_custom_fields_add('+dish_counter+')"> '+
        '<img src="..//public/assets/imgs/ic_round-delete.png"> '+
        '</div>'+
        '</div>'+
        '</div>'+
        '</div>'+
        "</div>");
        dish_counter++;
   }
   function add_custom_fields_add(id)
   {
      $.ajax({
          url : '{{url("remove_platted_only")}}',
          type : 'POST',
          data : {id: id, '_token': '{{ csrf_token() }}'},
          
      });
      $(".tab-pane.active").find(("#dish_field_"+id+"")).remove();
   }
   function removeListItem_viewonly(listId) {
      $.ajax({
          url : '{{url("remove_view_only")}}',
          type : 'POST',
          data : {id: listId, '_token': '{{ csrf_token() }}'},
          
      });
    $(`#${listId}`).remove();
}

</script>

@endsection
