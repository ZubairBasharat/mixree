@extends('dashboard.owner.layout')

@section('content')
<div class="container-fluid">
   <div class="cross-section">
   <a href="javascript:;" onclick="return isconfirm('{{url('dashboard')}}');">
     <div class="text-right">
      <span class="cancel-btn pr-2">Cancel</span>
      <img src="{{ asset('public/assets/imgs/cross.png') }}" class=" cross-btn">
      </a>
      </div>
      <form id="details_form" action="{{ url('create_event_program_details') }}" method="post" enctype="multipart/form-data">
      <input type="hidden" name="event_id" value="@php echo $event_locations[0]->event_id; @endphp">
         {{ csrf_field() }}
      <div class="row data-viewer">
         <div class="col-md-3 responsive-section-col-3  d-md-none d-block">
            <div class="form  head-create-event radio-btn-1 d-block d-md-none  ">
               
            </div>
         </div>
         <div class="col-md-3 responsive-section-col-3 d-none d-md-block">
            <div class="form  head-create-event radio-btn  ">
               <label class="container-radio">
               <input type="radio"  name="radio"  >
               <span class="checkmark recent"></span>
               </label>
               <div class="vl"></div>
               <label class="container-radio">
               <input type="radio" onclick="jump('{{url('create_event_detail',request()->route('id'))}}')" name="radio">
               <span class="checkmark recent"></span>
               </label>
               <div class="vl"></div>
               <label class="container-radio">
               <input type="radio" onclick="jump('{{url('create_event_gift',request()->route('id'))}}')"  name="radio" >
               <span class="checkmark recent"></span>
               </label>
               <div class="vl"></div>
               <label class="container-radio">
               <input type="radio" onclick="jump('{{url('create_event_fashion',request()->route('id'))}}')" name="radio" >
               <span class="checkmark recent"></span>
               </label>
               <div class="vl"></div>
               <label class="container-radio">
               <input type="radio"  onclick="jump('{{url('add_event_program_details',request()->route('id'))}}')" name="radio" checked>
               <span class="checkmark" ></span>
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
            <p class="head-create-event text-center">Create Event</p>
            <p class="head_create_event_2">5. Event Program</p>
            <div class="mt-20px">
               <!-- Section: Live preview -->
               <div class="tabe-sections" >
                  <ul class="nav nav-tabs border-0 " id="myTab" role="tablist">
                     @php $active = 1; @endphp
                     @foreach($event_locations as $event_location)
                     <li class="nav-item  srt all_tabs tab_@php echo $active @endphp" data-value="@php echo $event_location->id @endphp">
                        <a class="nav-link @if($active==1){{'active'}}@endif" id="home-tab" data-toggle="tab" href="#event_location_@php echo $event_location->id @endphp"  role="tab" aria-controls="home" aria-selected="false">@php echo $event_location->name @endphp </a>
                     </li>
                     @php $active++; @endphp
                     @endforeach
                     <!-- <li class="nav-item  srt ">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Club Party</a>
                     </li>
                     <li class="nav-item srt ">
                        <a class="nav-link " id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true">Garden Party</a>
                     </li> -->
                  </ul>
                  <div class="tab-content" id="myTabContent">
                  @php $active = 1; @endphp
                  @foreach($event_programs as $location)
                     <input type="hidden" class="locations" id="" name="event_location_id[]" value="@php echo $location->id @endphp">
                     <div class="tab-pane @if($active==1){{'active'}}@endif " data-id="@php echo $location->id @endphp" id="event_location_@php echo $location->id @endphp" role="tabpanel" aria-labelledby="home-tab">
                     <div class="row m-0">
                        <div class="col-md-8">
                           <p class="head_detail_ce-1">Is there a program for this location?</p>
                        </div>
                        <div class="col-md-4 pr-0">
                           <div class="button-radio">
                              <div class=" btn-radi0-style mt-30px">
                                 <label class="tog-radio-label ">
                                 <input type="radio" class="option-input radio show-payment payment_@php echo $active @endphp" value="1" id="radio_btn_@php echo $active @endphp" name="show_payment_@php echo $location->id @endphp[]"  {{(count($location->event_program_details)>0)?'checked':''}}/>
                                 Yes
                                 </label>
                                 <label class="tog-radio-label ml-23px">
                                 <input type="radio" class="option-input radio hide-payment" value="0" id="radio_btn_@php echo $active @endphp" name="show_payment_@php echo $location->id @endphp[]"  {{(count($location->event_program_details)>0)?'':'checked'}}/>
                                 No
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                        <div id="show-dive-payment" style="display:{{((count($location->event_program_details)>0)?'':'none')}}">
                           <!-- <div class="mt-20">
                                 <ul class="sortable" id="description_@php echo $active @endphp"></ul>
                           </div> --> 
                           @if(count($location->event_program_details)>0)
                           @foreach($location->event_program_details as $details)
                           <input type="hidden" name="program_details_id[]" value="{{$details->id}}">
                           @if(count($details->event_program_description)>0)
                           @foreach($details->event_program_description as  $description)
                           <div class="mt-40px click-target uy row">
                              <div class="col-12"> 
                              <div class="input-bg-preview-whit" style="padding: 0px 18px !important;width:100%">
                                 <div class="material-form-field">
                                 <input type="text" value="{{$description->description}}" class="custom_@php echo $location->id @endphp" name="event_program_@php echo $location->id @endphp[]" id="event_program" placeholder="Ex : Program Details">
                                 </div>
                                 </div> 
                              </div>
                           <label style="color: red;display:none" class="dexcription_warning" id="description_warn_">Please Enter Detail</label>
                           </div>
                           @endforeach
                           @else
                           <div class="mt-40px click-target uy row">
                              <div class="col-12"> 
                              <div class="input-bg-preview-whit" style="padding: 0px 18px !important;width:100%">
                                 <div class="material-form-field">
                                 <input type="text"  class="custom_@php echo $location->id @endphp" name="event_program_@php echo $location->id @endphp[]" id="event_program" placeholder="Ex : Program Details">
                                 </div>
                                 </div> 
                              </div>
                           <label style="color: red;display:none" class="dexcription_warning" id="description_warn_">Please Enter Detail</label>
                           </div>
                           @endif
                           @endforeach
                           @else
                           <div class="mt-40px click-target uy row">
                              <div class="col-12"> 
                              <div class="input-bg-preview-whit" style="padding: 0px 18px !important;width:100%">
                                 <div class="material-form-field">
                                 <input type="text"  class="custom_@php echo $location->id @endphp" name="event_program_@php echo $location->id @endphp[]" id="event_program" placeholder="Ex : Program Details">
                                 </div>
                                 </div> 
                              </div>
                           <label style="color: red;display:none" class="dexcription_warning" id="description_warn_">Please Enter Detail</label>
                           </div>
                           @endif  
                           <div id='custom_fields_container'>

                           </div>
                           <div class="row " style="margin-top: 50px;">
                                    <div class="col-md-6">
                                       <div class="input-bg-preview">
                                          <label class="lb-start-date w-100 m-0"> Display Date</label>
                                          <div class="input-append date form_datetime" data-date="">
                                             <input size="16" type="text" value="{{((count($location->event_program_details)>0)?date('d M Y',strtotime($location->event_program_details[0]->start_date)):'')}}" name="event_date_@php echo $location->id @endphp[]" id="event_date_@php echo $active @endphp" value="" class="frt select_event_date startdate" readonly>
                                             <!-- <span class="add-on"><i class="fa fa-calendar" aria-hidden="true"></i></span> -->
                                          </div>
                                       </div>
                                       <span class="date_warn_@php echo $active @endphp date_warning"  style="color: red;display:none;">Select Date</span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-bg-preview">
                                          <label class="lb-start-date w-100 m-0"> Display Time</label>
                                          <!-- <div class="input-append " data-date="">
                                             <input  type="time"  name="event_time_@php echo $event_location->id @endphp" id="event_time_@php echo $active @endphp"  value="" class="frt " > -->
                                             <!-- <input size="16" type="text" style="font-size:13px" name="" value="" id="create_event_date" class="frt" readonly name="start_dt_${counter}" required> -->
                                          <!-- </div> -->
                                          <div class="input-append date form_datetime-1" data-date="">
                                             <input size="16" type="text" style="font-size:13px" value="{{((count($location->event_program_details)>0)?date('h:i a',strtotime($location->event_program_details[0]->start_time)):'')}}" name="event_time_@php echo $location->id @endphp" id="event_time_@php echo $active @endphp" class="frt datetime" readonly name="start_dt_${counter}" required>
                                             <!-- <span class="add-on"><i class="fa fa-clock-o" aria-hidden="true"></i></span> -->
                                          </div>
                                        </div>
                                       <span class="time_warn_@php echo $active @endphp time_warning"  style="color: red;display:none;">Select Time</span>
                                    </div>
                                 </div>
                        <div class=" addCF mt-38px  ">
                           <button type="button"class="add-div-on input-bg-preview end-add-bg-0 button-0" onclick="add_custom_field()">Add Event Program</button>
                        </div>
                        </div>
                       
                     </div>
                     @php $active++; @endphp
                   @endforeach
                  </div>
               </div>
            </div>
            <!-- Section: Live preview -->
         </div>
         <!-- Tab panes -->
         <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="profile">...</div>
            <div role="tabpanel" class="tab-pane fade" id="buzz">bbb</div>
            <div role="tabpanel" class="tab-pane fade" id="references">ccc</div>
         </div>
      </div>
   </div>
</div>
<div class="row mt-80px mb-60px mx-0">
   <div class="col-md-6 col">
      <a class="btn_preview_main"><button class="btn_preview float-right" onclick="eventPreview()" data-toggle="modal" data-target="#exampleModal">Preview</button></a>
   </div>
   <div class="col-md-6 col">
      <button class="btn_next">Next</button>
   </div>
</div>
</form>
<div class="col-md-3"></div>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
@php
$eve_name = App\EventDetail::where(['event_id' => request()->route('id')])->orderBy('id','desc')->first();
@endphp
   <div class="modal-dialog" role="document">
      <div class="modal-content border_radius">
         <div class="modal-body p-0">
            <div class="img_back_model " style="background-image: url({{asset('public/images/event_images/'.$eve_name->bg_img)}});">
               <h2 class="head_natasha text-white text-center m-0 pt-5">{{$eve_name->eve_name}}</h2>
            </div>
            <div class="main_div">
               <div class="current_back_img">
               </div>
               <div class="white_sec">
                  <h3>Mother & Son Dance</h3>
               </div>
               <ul id="event-program" class="list-group vertical-steps">
                  <li class="list-group-item completed">
                     <div class="div_space">
                        <span>Lorem.</span>
                     </div>
                     <div class="d-inline-flex">
                        <img src="assets/imgs/female.png" height="w-50" >
                        <img src="assets/imgs/female.png" height="w-50" class="img_mr">
                        <img src="assets/imgs/female.png" height="w-50" class="img_mr">
                        <p>Daniella Dewitt and 5 other share memories</p>
                     </div>
                  </li>
                  <li class="list-group-item active">
                     <span>Aliquam.</span
                     <div class="d-inline-flex">
                        <img src="assets/imgs/female.png" height="w-50" >
                        <img src="assets/imgs/female.png" height="w-50" class="img_mr">
                        <img src="assets/imgs/female.png" height="w-50" class="img_mr">
                        <p>Daniella Dewitt and 5 other share memories</p>
                     </div>
                  </li>
               </ul>
            </div>
            <div class="bottom_nav_product p-0"></div>
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
   var custom_field_counter = 1;
   function add_custom_field()
   {
      var event_program = $(".tab-pane.active").attr('data-id');
      $(".tab-pane.active").find(("#custom_fields_container")).append(' <div id="field_'+custom_field_counter+'" class="mt-40px click-target uy row"><div class="col-10"> <div class="input-bg-preview-whit" style="padding: 0px 18px !important;width:100%"><div class="material-form-field"> <input type="text"  class="custom_'+event_program+'" name="event_program_'+event_program+'[]" id="description_'+custom_field_counter+'" placeholder="Ex : Program Details"></div></div></div><div class="col-2"><div class="del-img-3 mt-20px ml-4"><img src="../public/assets/imgs/ic_round-delete.png" id="deleteLiItem" onclick="remove_custom_field('+custom_field_counter+')" ></div></div><label style="color: red;display:none" class="dexcription_warning" id="description_warn_">Please Enter Detail</label></div>');
      custom_field_counter++;
   }
   function remove_custom_field(id)
   {
     $("#field_"+id).remove();
   }
   function jump(url)
   {
   window.location.href = url;
   }
</script>
@endsection
