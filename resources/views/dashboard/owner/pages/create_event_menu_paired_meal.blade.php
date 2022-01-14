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
<form action="{{ url('create_paired_meal') }}" id="paired_meal_form" method="post" enctype="multipart/form-data">
         {{ csrf_field() }}
   <input type="hidden" name="event_id" value="@php echo $single_meal[0]->event_id; @endphp">
<div class="row data-viewer">
   <div class="col-md-3 responsive-section-col-3  d-md-none d-block">
      <div class="form  head-create-event radio-btn-1 d-block d-md-none  ">
         <label class="container-radio">
         <input type="radio"  name="radio"  >
         <span class="checkmark recent"></span>
         </label>
         <div class="vl-2"></div>
         <label class="container-radio">
         <input type="radio" name="radio">
         <span class="checkmark recent"></span>
         </label>
         <div class="vl-2"></div>
         <label class="container-radio">
         <input type="radio"  name="radio" checked>
         <span class="checkmark"></span>
         </label>
         <div class="vl-2"></div>
         <label class="container-radio">
         <input type="radio"  name="radio">
         <span class="checkmark"></span>
         </label>
         <div class="vl-2"></div>
         <label class="container-radio">
         <input type="radio"  name="radio">
         <span class="checkmark"></span>
         </label>
         <div class="vl-2"></div>
         <label class="container-radio">
         <input type="radio"  name="radio">
         <span class="checkmark"></span>
         </label>
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
         <input type="radio" name="radio">
         <span class="checkmark recent"></span>
         </label>
         <div class="vl"></div>
         <label class="container-radio">
         <input type="radio"  name="radio">
         <span class="checkmark recent"></span>
         </label>
         <div class="vl"></div>
         <label class="container-radio">
         <input type="radio"  name="radio">
         <span class="checkmark recent"></span>
         </label>
         <div class="vl"></div>
         <label class="container-radio">
         <input type="radio"  name="radio">
         <span class="checkmark recent"></span>
         </label>
         <div class="vl"></div>
         <label class="container-radio">
         <input type="radio"  name="radio">
         <span class="checkmark recent"></span>
         </label>
         <div class="vl"></div>
         <label class="container-radio">
         <input type="radio"  name="radio" checked>
         <span class="checkmark "></span>
         </label>
         <div class="vl"></div>
         <label class="container-radio">
         <input type="radio"  name="radio">
         <span class="checkmark"></span>
         </label>
      </div>
   </div>
   <div class="col-md-6 responsive-section">
      <p class="head-create-event text-center">Create Event</p>
      <p class="head_create_event_2">6. Event Menu (Food & Drink)</p>
      <div class="mt-20px">
         <!-- Section: Live preview -->
         <div class="tabe-sections" >
            <ul class="nav nav-tabs border-0 " id="myTab" role="tablist">
               @php $counter = 1; @endphp
               @foreach($single_meal as $meal)
               <li class="nav-item  srt ">
                  <a class="nav-link @if($counter==1){{'active'}}@endif" id="home-tab" data-toggle="tab" href="#single_menu_@php echo $meal->id @endphp" role="tab" aria-controls="home" aria-selected="false">{{$meal->name}}</a>
               </li>
               @php $counter++; @endphp
               @endforeach
               <!-- <li class="nav-item  srt ">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Club Party</a>
               </li>
               <li class="nav-item srt ">
                  <a class="nav-link " id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true">Garden Party</a>
               </li> -->
            </ul>
            <div class="tab-content" id="myTabContent">
            @php $counter = 1; @endphp
            @foreach($single_meal as $meal)
            <input type="hidden" name="event_location_id[]" value="@php echo $meal->id @endphp">
               <div class="tab-pane @if($counter==1){{'active'}}@endif" data-id="@php echo $meal->id @endphp" id="single_menu_@php echo $meal->id @endphp" role="tabpanel" aria-labelledby="home-tab">
                  <div id="show-dive-payment">
                     <div class="mt-20px">
                        <div class="row">
                           <div class="col-8">
                              <p class="head_detail_ce-1">Pair your meal</p>
                           </div>
                           <div class="col-4 text-right">
                           </div>
                        </div>
                        <div class="mt-15px">
                           <div id="customFields-1-ad">
                              <div class="row">
                              @foreach($meal->get_single_menus as $single_menu)
                                 <div class="col-11 mt-20px">
                                    <div class="form-group">
                                       <div class="input-bg-preview-ex-padding">
                                          <input readonly id="input1" type="text" value="{{$single_menu->name}}"  />
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-1">
                                    <div class="del-img-1-2 ">
                                       <label class="container-check">
                                       <input class="selected_check" type="checkbox" id="rice" >
                                       <span onclick="handleMealCheck('{{$single_menu->name}}','{{$single_menu->id}}')" class="checkmark-check"></span>
                                       </label>                              
                                    </div>
                                 </div>
                                 @endforeach
                                 <div class="col-md-12 mt-20px">
                                    <div class="form-group">
                                       <div class="input-bg-preview-ex-padding">
                                          <input class="form-control srt-bar custom-meal-input"  type="text" placeholder="Complete Fun Dish" id="myInput" >
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="text-center end-btn">
                      <button type="button" class="btn_next-paired" id="btn_next-paired">Pair</button>
                     </div>
                     <div class="mt-20px">
                     <label id="pair_warn_@php echo $counter @endphp" style="color: red;display:none">Select One Pair</label>
                     <div class="row">
                           <div class="col-8">
                              <p class="head_detail_ce-1">Paired meal</p>
                           </div>
                           <div class="col-4 text-left">
                           </div>
                        </div>
                           <div class="mt-15px">
                              <div class="row">
                                 <div class="col-md-12 paired_meals" id="paired-values_@php echo $meal->id @endphp">
                                    
                                 </div>
                              </div>
                           </div>
                        </div>
                  </div>
               </div>
               <!-- Section: Live preview -->
               @php $counter++; @endphp
               @endforeach
            </div>
            <!-- Tab panes -->
         </div>
      </div>
   </div>
</div>
<div class=" mt-80px mb-60px mx-0">
   <div class="text-center end-btn">
      <a href="create-event-catagory-meal.php"><button class="btn_next">Next</button></a>
   </div>
</div>
</form>
<div class="col-md-3"></div>
<script>
function isconfirm(url_val) {
		// alert(url_val);
		if (confirm('Are you sure want to cancel?') == false) {
			return false;

		} else {
			location.href = url_val;

		}
   }
</script>
@endsection

