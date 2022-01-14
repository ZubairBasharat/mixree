@extends('dashboard.owner.layout')

@section('content')
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUOIYzc0m9aZH8m18kecDRnQgT6HNDiAc&callback=initAutocomplete&libraries=places&v=weekly"
      defer
    ></script>
<script src="{{asset('/public/assets/js/append.js')}}"></script>
<div class="container-fluid">

   <div class="cross-section">
   <a href="javascript:;" onclick="return isconfirm('{{url('dashboard')}}');">
   <div class="text-right">
      <span class="cancel-btn pr-2">Cancel</span>
      <img src="{{asset('public/assets/imgs/cross.png')}}" class=" cross-btn">
   </a>
   </div>
   </div>
   <!-- <div id="map" style="display: none;" ></div> -->
 <form action="{{ (empty($event_details))?url('add_event_detail'):url('update_event_detail') }}" id="event_details" method="post" enctype="multipart/form-data">
         {{ csrf_field() }}
   <div class="row data-viewer">
      <div class="col-md-3 responsive-section-col-3 d-none d-md-block">
            <div class="form  head-create-event radio-btn  ">
               <label class="container-radio">
               <input type="radio"  name="radio"  >
               <span class="checkmark recent"></span>
               </label>
               <div class="vl"></div>
               <label class="container-radio">
               <input onclick="jump('{{url('create_event_detail',$event->id)}}')" type="radio" name="radio" checked>
               <span class="checkmark"></span>
               </label>
               <div class="vl"></div>
               <label class="container-radio">
               <input type="radio"  name="radio">
               <span class="checkmark"></span>
               </label>
               <div class="vl"></div>
               <label class="container-radio">
               <input type="radio"  name="radio">
               <span class="checkmark"></span>
               </label>
               <div class="vl"></div>
               <label class="container-radio">
               <input type="radio"  name="radio">
               <span class="checkmark"></span>
               </label>
               <div class="vl"></div>
               <label class="container-radio">
               <input type="radio"  name="radio">
               <span class="checkmark"></span>
               </label>
               <!-- <div class="vl"></div>
               <label class="container-radio">
               <input type="radio"  name="radio">
               <span class="checkmark"></span>
               </label>
               <div class="vl"></div>
               <label class="container-radio">
               <input type="radio"  name="radio">
               <span class="checkmark"></span>
               </label> -->
            </div>
         </div>
      <div class="col-md-6 responsive-section">
          <input type="hidden" value="{{ $event->id}}" name="event_id" >
         <p class="head-create-event text-center">Create Event</p>
         <p class="head_create_event_2 ">2. Detail Information</p>
         <div class="row mt-26px">
            <div class="col-md-2 col-3 text-center">
               <p class="event-icon text-center mb-2">Event Icon</p>
               <div class="avatar-upload">
                  <div class="avatar-edit">
                     <input class="form-control {{((isset($event_details))?asset('public/assets/imgs/icon-upload.png'):((isset($event_details->icon)))?(($event_details->icon!=Null)?'':'icon'):'icon')}}" style="display: none;" type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="icon"  />
                     <label for="imageUpload"></label>
                  </div>
                  <div class="avatar-preview">
                     <div id="imagePreview" style="background-image: url({{((isset($event_details))?asset('public/assets/imgs/icon-upload.png'):((isset($event_details->icon)))?(($event_details->icon!=Null)?asset('/public/images/event_images/'.$event_details->icon):asset('public/assets/imgs/icon-upload.png')):asset('public/assets/imgs/icon-upload.png'))}});">
                     </div>
                  </div>
                  <label  id="iconwarning" style="color: red;display:none">Required *</label>
               </div>
            </div>
            <div class="col-md-10 col-9">
                  <div class="input-bg-preview " style="padding: 0px 18px !important;">
                        <div class="material-form-field">
                           <input type="text" value="{{!empty($event_details)?$event_details->eve_name:''}}" name="eve_name" id="eventName" />
                           <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Name of Event</label>
                        </div>
                     </div>
                     <label class="warning" id="event_name_warn" style="color: red;display:none">Event name required *</label>
               </div>
         </div>
         <input type="hidden" id="event_type" value="{{$event->type}}">
         @if($event->type=="wedding")
         <h1 class="groom-name">Groom Name</h1>
         <div class="row mt-16px">
            <div class="col-lg-3 col-md-4 text-center">
               <div class="avatar-upload-big mb-md-0 mb-2">
                  <div class="avatar-edit">
                     <input type='file' style="display: none;" id="imageUpload-big" accept=".png, .jpg, .jpeg" name="groom_img" class="{{((!isset($event_details))?'':((isset($event_details->groom_img)))?(($event_details->groom_img!=Null)?'':'groom_img'):'groom_imgr')}}"/>
                     <label for="imageUpload-big"></label>
                  </div>
                  <div class="avatar-preview">
                     <div id="imagePreview-big" style="background-image: url({{((isset($event_details))?asset('public/assets/imgs/upload-image.png'):((isset($event_details->groom_img)))?(($event_details->groom_img!=Null)?asset('/public/images/event_images/'.$event_details->groom_img):asset('public/assets/imgs/upload-image.png')):asset('public/assets/imgs/upload-image.png'))}});">
                     </div>
                  </div>
               </div>
               <label id="groom_warning" style="color: red;display:none">Upload image *</label>
            </div>
            <div class="col-lg-9 col-md-8">
              <div class="input-bg-preview " style="padding: 0px 18px !important;">
                        <div class="material-form-field">
                           <input type="text" class="groom_f_name" value="{{!empty($event_details)?$event_details->groom_first_name:''}}" name="groom_first_name" id="groom-first_name"/>
                           <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">First Name</label>
                        </div>
                     </div>
                     <label id="groom_f_name_warn" style="color: red;display:none">First name required *</label>
              <div class="input-bg-preview mt-12px " style="padding: 0px 18px !important;">
                        <div class="material-form-field">
                           <input type="text" class="groom_l_name" value="{{!empty($event_details)?$event_details->groom_last_name:''}}" name="groom_last_name" id="groom-last_name"/>
                           <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Last Name</label>
                        </div>
                     </div>
                     <label id="groom_l_name_warn" style="color: red;display:none">Last name required *</label>
        </div>
         </div>
         @endif
         @if($event->type=="wedding")
         <h1 class="groom-name">Bride Name</h1>
         <div class="row mt-16px">
            <div class="col-lg-3 col-md-4 text-center">
               <div class="avatar-upload-bride mb-md-0 mb-2">
                  <div class="avatar-edit">
                     <input type='file' style="display: none;" id="{{((!isset($event_details))?'':((isset($event_details->groom_img)))?(($event_details->groom_img!=Null)?'':'imageUpload-bride'):'imageUpload-bride')}}" accept=".png, .jpg, .jpeg" name="bride_img" />
                     <label for="imageUpload-bride"></label>
                  </div>
                  <div class="avatar-preview">
                     <div id="imagePreview-bride" style="background-image: url({{((isset($event_details))?asset('public/assets/imgs/upload-image.png'):((isset($event_details->bride_img)))?(($event_details->bride_img!=Null)?asset('/public/images/event_images/'.$event_details->bride_img):asset('public/assets/imgs/upload-image.png')):asset('public/assets/imgs/upload-image.png'))}})">
                     </div>
                  </div>
               </div>
               <label id="bride_warning" style="color: red;display:none">Upload image</label>
            </div>
               <div class="col-lg-9 col-md-8">
              <div class="input-bg-preview " style="padding: 0px 18px !important;">
                        <div class="material-form-field">
                           <input type="text" class="bride_f_name" value="{{!empty($event_details)?$event_details->bride_first_name:''}}" name="bride_first_name" id="bride-first_name"/>
                           <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">First Name</label>
                        </div>
                     </div>
                     <label id="bride_f_name_warn" style="color: red;display:none">First name required *</label>
              <div class="input-bg-preview mt-12px " style="padding: 0px 18px !important;">
                        <div class="material-form-field">
                           <input class="bride_l_name" type="text" value="{{!empty($event_details)?$event_details->bride_last_name:''}}" id="bride-last_name" name="bride_last_name" />
                           <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Last Name</label>
                        </div>
                     </div>
                     <label id="bride_l_name_warn" style="color: red;display:none">Last name required *</label>
        </div>
            </div>
            @endif
            <div class=" mt-20px">
               <div class="input-bg-preview">
                  <label class="lb-start-date w-100 m-0"> Note for Your Guest</label>
                  <textarea class="form-control guestDescription"  id="event-description" rows="3"  name="guest_note">{{!empty($event_details)?$event_details->guest_note:''}}</textarea>
               </div>
               <label class="warning" id="note_warning" style="color: red;display:none">Note required *</label>
            </div>
            @if($event->type=="wedding")
            <div class=" mt-20px">
               <div class="input-bg-preview">
                  <label class="lb-start-date w-100 m-0"> Tell your story</label>
                  <textarea class="form-control guestDescription" id="event-description" rows="3" placeholder="It’s a party to celebrate David Clemon born for the 17th years old. In this sweet seventeen, he become a young and success businessman on developing a product. We hope that he will be join on Forbes 20 under 20th." name="story">
                  {{!empty($event_details)?$event_details->story:''}}
                  </textarea>
               </div>
            </div>
            @endif
         <div class="row mt-16px">
            <div class="col-md-12">
               <div class="avatar-upload-cover mb-md-0 mb-2">
                  <div class="avatar-edit">
                     <input type='file' style="display: none;" id="{{((!isset($event_details))?'':((isset($event_details->bg_img)))?(($event_details->bg_img!=Null)?'':'imageUpload-cover'):'imageUpload-cover')}}" accept=".png, .jpg, .jpeg" name="bg_img" />
                     <label for="imageUpload-cover"></label>
                  </div>
                  <div class="avatar-preview">
                     <div id="imagePreview-cover" style="background-image: url({{((isset($event_details))?asset('public/assets/imgs/upload-cover.png'):((isset($event_details->bg_img)))?(($event_details->bg_img!=Null)?asset('/public/images/event_images/'.$event_details->bg_img):asset('public/assets/imgs/upload-cover.png')):asset('public/assets/imgs/upload-cover.png'))}});">
                     </div>
                  </div>
               </div>
               <label id="backgroundwarning" style="color: red;display:none">Background image required *</label>
            </div>
         </div>
         <!-- <h1 class="groom-name">Groom Name</h1> -->
         @if($event->type=="wedding")
         @if(!empty($event_details))
         @if(count($event_witness)>0)
         <div class="bridesmaid_container">
         <div class="row ">
               <div class="col-md-6">
                  </div>
                <div class="col-md-6">
                   <div id="customFields">
                        <div class="wrap bt-right-counter mt-20px">
                           <button type="button" id="" onclick="sub_custom_fields()" class="bridesmaid_btn" >-</button>
                           <input class="count custom_counter" type="text" name="no_of_witness" value="{{(count($event_witness)>0)?count($event_witness):1}}" min="0" max="100"  id="" name="no_of_days" readonly/>
                           <button type="button" id="" onclick="add_custom_fields()" class="bridesmaid_btn_1">+</button>
                        </div>
                     </div>
                </div>
          </div>
          @php $counter = 1; @endphp
          @foreach($event_witness as $witness)
          <div class="row " id="options_{{$counter}}">
               <div class="col-md-6">
                  <div class="input-bg-preview mt-20px" style="padding: 20px 18px !important;">
                        <select name="witness_type[]" class="form-control select-bosmaid " >
                           <option {{($event_witness[0]->witness_type=='bridesmaid')?'selected':''}} value="bridesmaid">Bridesmaid</option>
                           <option {{($event_witness[0]->witness_type=='groosman')?'selected':''}} value="groosman">Groosman</option>
                           <option {{($event_witness[0]->witness_type=='maid_of_honor')?'selected':''}} value="maid_of_honor">Maid of Honor</option>
                           <option {{($event_witness[0]->witness_type=='best_man')?'selected':''}} value="best_man">Best Man</option>
                        </select>
                     </div>
                  </div>
          </div>
         <div class="row mt-16px " id="container_{{$counter}}">
         <div class="col-lg-3 col-md-4 text-center">
               <div class="avatar-upload-big mb-md-0 mb-2">
                  <div class="avatar-edit">
                     <input type='file' style="display: none;" data-warning="witness_warning_{{$counter}}" data-id="witness_image-{{$counter}}" class="" id="witness_image_{{$counter}}" accept=".png, .jpg, .jpeg" name="witness_images[]" />
                     <label for="witness_image_{{$counter}}"></label>
                  </div>
                  <div class="avatar-preview">
                     <div id="witness_image-{{$counter}}" style="background-image: url({{(!empty($witness->witness_image) || $witness->witness_image!=Null)?asset('/public/images/event_images/'.$witness->witness_image):''}});">
                     </div>
                  </div>
                  <label id="witness_warning_{{$counter}}" style="color: red;display:none">Upload imgae *</label>
               </div>
            </div>
            <input type="hidden" name="old_img[]" value="{{$witness->witness_image}}">
            <div class="col-lg-9 col-md-8">
               <div class="row">
                  <div class="col-md-6">
              <div class="input-bg-preview " style="padding: 0px 18px !important;">
                        <div class="material-form-field">
                           <input type="text" value="{{$witness->first_name}}" class="witness_f_name" name="witness_first_name_{{$counter}}" id="groom-first_name"/>
                           <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">First Name</label>
                        </div>
                     </div>
                     <label  class="witness_f_name_warn" style="color: red;display:none">First name required *</label>
                     </div>
                     <div class="col-md-6">
              <div class="input-bg-preview " style="padding: 0px 18px !important;">
                        <div class="material-form-field">
                           <input type="text" value="{{$witness->last_name}}" class="witness_l_name" name="witness_last_name_{{$counter}}" id="groom-first_name"/>
                           <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Last Name</label>
                        </div>
                     </div>
                     <label  class="witness_l_name_warn" style="color: red;display:none">Last name required *</label>
                     </div>
                     </div>
              <div class="input-bg-preview mt-12px " style="padding: 0px 18px !important;">
                        <div class="material-form-field">
                           <input class="biography" value="{{$witness->biography}}" type="text"  name="witness_biography_{{$counter}}" id="groom-last_name"/>
                           <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Biogrophy</label>
                        </div>
                     </div>
                     <label class="biography_warn" style="color: red; display:none">Biography Required</label>
        </div>
         </div>
         @php $counter++; @endphp
         @endforeach
        </div>
        @endif
        @else
        <div class="bridesmaid_container">
         <div class="row ">
               <div class="col-md-6">
                  <div class="input-bg-preview mt-20px" style="padding: 20px 18px !important;">
                        <select name="witness_type[]" class="form-control select-bosmaid " >
                           <option value="bridesmaid">Bridesmaid</option>
                           <option value="groosman">Groom's man</option>
                           <option value="maid_of_honor">Maid of Honor</option>
                           <option value="best_man">Best Man</option>
                        </select>
                     </div>
                  </div>
                <div class="col-md-6">
                   <div id="customFields">
                        <div class="wrap bt-right-counter mt-20px">
                           <button type="button" id="" onclick="sub_custom_fields()" class="bridesmaid_btn" >-</button>
                           <input class="count custom_counter" type="text" name="no_of_witness" value="1" min="0" max="100"  id="" name="no_of_days" readonly/>
                           <button type="button" id="" onclick="add_custom_fields()" class="bridesmaid_btn_1">+</button>
                        </div>
                     </div>
                </div>
          </div>
         <div class="row mt-16px ">
         <div class="col-lg-3 col-md-4 text-center">
               <div class="avatar-upload-big mb-md-0 mb-2">
                  <div class="avatar-edit">
                     <input type='file' style="display: none;" data-warning="witness_warning_1" data-id="witness_image-1" class="witness_images" id="witness_image_1" accept=".png, .jpg, .jpeg" name="witness_images[]" />
                     <label for="witness_image_1"></label>
                  </div>
                  <div class="avatar-preview">
                     <div id="witness_image-1" style="background-image: url({{asset('public/assets/imgs/upload-image.png')}});">
                     </div>
                  </div>
                  <label id="witness_warning_1" style="color: red;display:none">Upload imgae *</label>
               </div>
            </div>
            <div class="col-lg-9 col-md-8">
               <div class="row">
                  <div class="col-md-6">
              <div class="input-bg-preview " style="padding: 0px 18px !important;">
                        <div class="material-form-field">
                           <input type="text" class="witness_f_name" name="witness_first_name_1" id="groom-first_name"/>
                           <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">First Name</label>
                        </div>
                     </div>
                     <label  class="witness_f_name_warn" style="color: red;display:none">First name required *</label>
                     </div>
                     <div class="col-md-6">
              <div class="input-bg-preview " style="padding: 0px 18px !important;">
                        <div class="material-form-field">
                           <input type="text" class="witness_l_name" name="witness_last_name_1" id="groom-first_name"/>
                           <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Last Name</label>
                        </div>
                     </div>
                     <label  class="witness_l_name_warn" style="color: red;display:none">Last name required *</label>
                     </div>
                     </div>
              <div class="input-bg-preview mt-12px " style="padding: 0px 18px !important;">
                        <div class="material-form-field">
                           <input class="biography" type="text"  name="witness_biography_1" id="groom-last_name"/>
                           <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Biogrophy</label>
                        </div>
                     </div>
                     <label class="biography_warn" style="color: red; display:none">Biography Required *</label>
        </div>
         </div>
        </div>
        @endif
        @endif
         <!-- append section -->
         <div class="repeat-on-clicl mt-5">
            <div class="row">
               <div class="col-md-8">
                  <p class="event-going">How long the event going? (days)</p>
               </div>
               <div class="col-md-4">
                  <div id="customFields">
                     <div class="wrap bt-right-counter">
                        <button type="button" id="sub"  class="sub-preview" >-</button>
                        <input class="count" type="text" value="@if(count($event_location)>0)  {{count($event_location)}}  @else {{ 1}} @endif " min="0" max="100"  id="myInput_count" name="no_of_days" readonly/>
                        <button type="button" id="add"  class="add-preview addCF">+</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- repeat div -->
         <div id="fields-1">
         @if(count($event_location)>0)
         @php $counter = 1; @endphp
         @foreach($event_location as  $location)
         <div class="append-section">
            <div class="input-bg-preview">
               <label class="lb-start-date w-100 m-0"> Name of Location</label>
               <input class="name_of_location" value="{{$location->name}}" onkeyup="addLocation('{{$location->id}}')" id='{{$location->id}}_name' type="" placeholder="" name="name[]" >
            </div>
            <label class="name_of_location_warn" style="color:red;display:none">Name of location required *</label>
            <div class="input-bg-preview mt-12px">
               <label class="lb-start-date w-100 m-0">Address Location</label>
               <input class="addresslocation" value="{{$location->address}}" type="text"  id="pac-input_{{$counter}}" data-id="{{$counter}}" name="location[]" />
               <input type="hidden" id="lat_1" value="{{$location->lat}}" name="lat_{{$counter}}" >
               <input type="hidden" id="lang_1" value="{{$location->lang}}" name="lang_{{$counter}}">
            </div>
            <input type="hidden" value="{{$location->id}}" name="locations[]">
            <label class="address_location_warn" style="color:red;display:none">Address location required *</label>
               <div class="row mt-20px">
                  <div class="col-md-6">
                     <div class="input-bg-preview calendar">
                        <label class="lb-start-date w-100 m-0">Date</label>
                        <div class="input-append date" data-date="${current_date}">
                           <input size="16" type="text" style="font-size:13px" value="{{$location->start_date}}" data-id="{{$counter}}" id="start_dt_{{$counter}}" class="frt dates startdate" readonly name="start_dt_{{$counter}}" >
                           <!-- <span class="add-on"><i class="fa fa-calendar" aria-hidden="true"></i></span> -->
                        </div>
                  </div>
                  <label id="select_date_warn_{{$counter}}" style="color:red;display:none">Select date *</label>
                  </div>
                  <div class="col-md-6">
                     <div class="input-bg-preview calendar">
                        <label class="lb-start-date w-100 m-0"> Start Time Event</label>
                        <div class="input-append date form_datetime-1" data-date="${current_date}">
                           <input size="16" type="text" style="font-size:13px" name="start_time_{{$counter}}" value="{{$location->start_time}}" id="start_time_{{$counter}}" class="frt times datetime" readonly name="start_dt_{{$counter}}" required>
                           <!-- <span class="add-on"><i class="fa fa-clock-o" aria-hidden="true"></i></span> -->
                        </div>
                    </div>
                     <label id="select_time_warn_{{$counter}}" style="color:red;display:none">Select Time *</label>
                  </div>
                     <div class="col-md-4">
                  </div>
               </div>
             </div>
             @php $counter++; @endphp
        @endforeach
        @else
        <div class="append-section">
            <div class="input-bg-preview">
               <label class="lb-start-date w-100 m-0"> Name of Location</label>
               <input class="name_of_location" onkeyup="addLocation(1)" id='1_name' type="" placeholder="" name="name[]" >
            </div>
            <label class="name_of_location_warn" style="color:red;display:none">Name of location required *</label>
            <div class="input-bg-preview mt-12px">
               <label class="lb-start-date w-100 m-0">Address Location</label>
               <input class="addresslocation" type="text"  id="pac-input_1" data-id="1" name="location[]" />
               <input type="hidden" id="lat_1" name="lat_1" >
               <input type="hidden" id="lang_1" name="lang_1">
            </div>
            <label class="address_location_warn" style="color:red;display:none">Address location required *</label>
               <div class="row mt-20px">
                  <div class="col-md-6">
                     <div class="input-bg-preview calendar">
                        <label class="lb-start-date w-100 m-0">Date</label>
                        <div class="input-append date" data-date="${current_date}">
                           <input size="16" type="text" style="font-size:13px" data-id="1" value="" id="start_dt_1" class="frt dates startdate" readonly name="start_dt_1" >
                           <!-- <span class="add-on"><i class="fa fa-calendar" aria-hidden="true"></i></span> -->
                        </div>
                  </div>
                  <label id="select_date_warn_1" style="color:red;display:none">Select date *</label>
                  </div>
                  <div class="col-md-6">
                     <div class="input-bg-preview calendar">
                        <label class="lb-start-date w-100 m-0"> Start Time Event</label>
                        <div class="input-append date form_datetime-1" data-date="${current_date}">
                           <input size="16" type="text" style="font-size:13px" name="start_time_1" value="" id="start_time_1" class="frt times datetime" readonly name="start_dt_${counter}" required>
                           <!-- <span class="add-on"><i class="fa fa-clock-o" aria-hidden="true"></i></span> -->
                        </div>
                    </div>
                     <label id="select_time_warn_1" style="color:red;display:none">Select Time *</label>
                  </div>
                     <div class="col-md-4">
                  </div>
               </div>
             </div>
        @endif     
      <!-- end repeat div -->
   </div>

<div class="col-md-3"></div>
<div class="row mt-80px mb-60px mx-0">
   <div class="col-md-6 col">
      <a class="btn_preview_main"><button type="button" class="btn_preview float-right" data-toggle="modal" data-target=".bd-example-modal-sm">Preview</button></a>
   </div>
   <div class="col-md-6 col">
      <a><button class="btn_next">Next</button></a>
   </div>
</div>
</form>
<!-- Natasha Wedding modal -->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
   <div class="modal-dialog ">
      <div class="modal-content my_model">
         <div class="img_back">
            <h2 class="head_natasha text-white text-center" id="appendTitle"></h2>
            <img src="{{ asset('assets/imgs/information-nav.png')}}" class="img_information_nav">
         </div>
         <div class="section_white">
            <p class="p_model_detail" id="append_guestDescription"> </p>
            <div class="div_date_time">
               <p class="p_date_time">Date & Time</p>
                @php
                $event = App\Event::where(['id' => $event->id])->first();

                $date = $event->start_date_event;
                $unixTimestamp = strtotime($date);
                $dayOfWeek = date("l", $unixTimestamp);
                @endphp
               <p class="p_crunnet_date" >{{$dayOfWeek}}. {{substr($event->start_date_event,-2) }} {{str_replace("-"," ",date('F Y', strtotime($event->start_date_event)))}}</p>
            </div>
            <div class="div_location">
               <!-- <div>
                  <p class="p_chruch_loc">Church Location</p>
                  <p class="p_crunnet_loc">81 Blenford Cres, Sunford, Phoenix, 4068. South Africa</p>
                  <img src="assets/imgs/map.png" class="img_chruch_location">
               </div>
 -->
            </div>
            <div class="div_bride">
               <p class="p_bride">The Bride</p>
               <div class="row">
                  <div class="col-md-6 bride_sec_1 bideData p-0">
                     <img src="{{ asset('/assets/imgs/default-user-image.png')}}" class="img_bride_2" id="brideImg" >
                     <p class="text-center" id="brideName"></p>
                  </div>
                  <div class="col-md-6 bride_sec_1 groomData p-0">
                     <img src="{{ asset('/assets/imgs/default-user-image.png')}}" class="img_bride_2" id="groomImg" >
                     <p class="text-center" id="groomName"></p>
                  </div>
               </div>
            </div>
            <div class="  bottom_nav p-0"></div>
         </div>
      </div>
   </div>
</div>
</div>

<script>
function isconfirm(url_val) {
		// alert(url_val);
		if (confirm('Are you sure want to cancel?') == false) {
			return false;

		} else {
			location.href = url_val;

		}
   }
   function sub_custom_fields(){
      var counter = $(".custom_counter").val();
      if(counter>1){
         $("#container_"+counter).remove();
         $("#options_"+counter).remove();
      $(".custom_counter").val(parseInt(counter)-1);
      }
   }
   function add_custom_fields(){
      var counter = parseInt($(".custom_counter").val())+1;
      $(".bridesmaid_container").append('<div class="appen_container" id="container_'+counter+'"><div class="row" ><div class="col-md-6"><div class="input-bg-preview mt-20px" style="padding: 20px 18px !important;"><select name="witness_type[]" class="form-control select-bosmaid " > <option value="bridesmaid">Bridesmaid</option><option value="groosman">Groosman</option><option value="maid_of_honor">Maid of Honor</option><option  value="best_man">Best Man</option></select> </div> </div><div class="col-md-6"></div> </div> <div class="row mt-16px ">'+
            '<div class="col-lg-3 col-md-4 text-center">'+
               '<div class="avatar-upload-big mb-md-0 mb-2">'+
                  '<div class="avatar-edit">'+
                     '<input type="file" style="display: none;" data-warning="witness_warning_'+counter+'" data-id="witness_image-'+counter+'" class="witness_images" id="witness_image_'+counter+'" accept=".png, .jpg, .jpeg" name="witness_images[]" />'+
                    ' <label for="witness_image_'+counter+'"></label>'+
                  '</div>'+
                 ' <div class="avatar-preview">'+
                     '<div id="witness_image-'+counter+'" style="background-image: url({{asset("public/assets/imgs/upload-image.png")}});">'+
                     '</div>'+
                 '</div>'+
                 ' <label id="witness_warning_'+counter+'" style="color: red;display:none">Upload imgae</label>'+
              '</div>'+
           '</div>'+
           ' <div class="col-lg-9 col-md-8">'+
              '<div class="row">'+
                 '<div class="col-md-6">'+
              '<div class="input-bg-preview " style="padding: 0px 18px !important;">'+
                        '<div class="material-form-field">'+
                           '<input type="text" class="witness_f_name"  name="witness_first_name_'+counter+'" id="groom-first_name"/>'+
                          '<label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">First Name</label>'+
                        '</div>'+
                     '</div>'+
                     '<label  class="witness_f_name_warn" style="color: red;display:none">First name required </label>'+
                     '</div>'+
                     '<div class="col-md-6">'+
              '<div class="input-bg-preview " style="padding: 0px 18px !important;">'+
                        '<div class="material-form-field">'+
                           '<input class="witness_l_name" type="text" name="witness_last_name_'+counter+'" id="groom-first_name"/>'+
                           '<label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Last Name</label>'+
                        '</div>'+
                     '</div>'+
                     '<label  class="witness_l_name_warn" style="color: red;display:none">last name required </label>'+
                     '</div>'+
                     '</div>'+
              '<div class="input-bg-preview mt-12px " style="padding: 0px 18px !important;">'+
                        '<div class="material-form-field">'+
                           '<input class="biography" type="text"  name="witness_biography_'+counter+'" id="groom-last_name"/>'+
                           '<label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Biogrophy</label>'+
                        '</div>'+
                     '</div>'+
                     '<label class="biography_warn" style="color: red; display:none">Biography Required</label>'+
        '</div>'+
         "</div></div>");
         $(".custom_counter").val(counter);
   }
   function initAutocomplete(id) {
  const input = document.getElementById("pac-input_"+id);
  $("#pac-input_"+id).attr('placeholder',"");
  const searchBox = new google.maps.places.SearchBox(input);
  searchBox.addListener("places_changed", () => {
    const places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }
    markers = [];
    // For each place, get the icon, name and location.
    const bounds = new google.maps.LatLngBounds();
    places.forEach((place) => {
      lat = place.geometry.location.lat();
      lang = place.geometry.location.lng();
      $("#lat_"+id).val(lat);
      $("#lang_"+id).val(lang);
      if (!place.geometry) {
        console.log("Returned place contains no geometry");
        return;
      }
    });
  });
}
function jump(url)
{
  window.location.href = url;
}
</script>
@endsection
@push('custom-script')
<script src="{{ asset('public/assets/js/create.js')}}"></script>

@endpush
