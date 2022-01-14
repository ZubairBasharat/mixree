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
<form method="POST" id="category_form" action="{{url('create_categorize_meal')}}">
{{ csrf_field() }}
<input type="hidden" name="event_id" value="@php echo $paired_meals[0]->event_id; @endphp">
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
         <input type="radio"  name="radio">
         <span class="checkmark recent"></span>
         </label>
         <div class="vl"></div>
         <label class="container-radio">
         <input type="radio"  name="radio" checked>
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
            @php $active = 1; @endphp
            @foreach($paired_meals as $event_location)
            <input type="hidden" name="event_location_id[]" value="@php echo $event_location->id @endphp">
               <li class="nav-item  srt ">
                  <a class="nav-link  @if($active==1){{'active show'}}@endif"  id="home-tab" data-toggle="tab" href="#categorize_meal_@php echo $event_location->id @endphp" role="tab" aria-controls="home" aria-selected="false">{{$event_location->name}}</a>
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
            @foreach($paired_meals as $event_location)
               <div class="tab-pane @if($active==1){{'active show'}}@endif" data-id="@php echo $event_location->id @endphp" id="categorize_meal_@php echo $event_location->id @endphp" role="tabpanel" aria-labelledby="home-tab">
                  <div id="show-dive-payment">
                     <div class="mt-20px">
                        <div class="row">
                           <div class="col-8">
                              <p class="head_detail_ce-1">Categorize your meal</p>
                           </div>
                           <div class="col-4 text-right">
                           </div>
                        </div>
                        <div class="mt-15px">
                           <div id="customFields-1-ad">
                              <div class="row">
                               @foreach($event_location->paired_meal_names as $paired_meal_name)
                               @php $i=0; $foods=array(); @endphp
                               @foreach($paired_meal_name->food_ids as $food)
                                @php
                                 $foods[$i] = $food['food_name'];
                                 $i++;
                                @endphp
                               @endforeach
                                 <div class="col-11 mt-20px">
                                    <div class="form-group">
                                       <div class="input-bg-preview-ex-padding">
                                          <input readonly id="uniqueId" type="text" value="{{$paired_meal_name->name.'('.implode(',',$foods) .')'}}" />
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-1">
                                    <div class="del-img-1-2 res-12 ">
                                       <label class="container-check">
                                       <input class="check" type="checkbox" id="burger" >
                                       <span onclick="handleCatagoryCheck('{{$paired_meal_name->name.'('.implode(',',$foods) .')'}}','{{$paired_meal_name->id}}')" class="checkmark-check"></span>
                                       </label>                              
                                    </div>
                                 </div>
                                 @endforeach
                                 <div class="col-md-12 mt-20px">
                                    <div class="form-group">
                                       <div class="input-bg-preview-ex-padding">
                                          <input class="form-control srt-bar custom-catagory-meal"  type="text" placeholder="Complete Fun Dish" >
                                       </div>
                                    </div>
                                    <label id="category_warn_@php echo $active @endphp" style="color: red;display:none">Select One Category</label>
                                 </div> 
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="text-center end-btn">
                        <button type="button" class="btn_next-paired" id="btn_next-catagory">Categorize</button>
                     </div>
                     <div class="mt-20px">
                     <div class="row">
                           <div class="col-8">
                              <p class="head_detail_ce-1">Categorized Meal</p>
                           </div>
                           <div class="col-4 text-right">
                           </div>
                        </div>
                        <div class="categorized_meal_segment" id="categorized-meal-segment">

                           <div class="col-8 mt-20px">
                              <p class="head_detail_ce-1-double" id="category-heading"></p>
                           </div>
                        
                           <div class="mt-15px">
                              <div class="row">
                                 <!-- <div class="col-md-12 ">
                                    <div class="form-group">
                                       <div class="input-bg-preview-ex-padding">
                                          <input readonly  type="text" value="Burger (Beef Burger, Sandwich Burger, Cheese Burger)"/>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 ">
                                    <div class="form-group">
                                       <div class="input-bg-preview-ex-padding">
                                          <input readonly  type="text" value="Drink until drunk (Cocktail, Wine, Vodka)"/>
                                       </div>
                                    </div>
                                 </div> -->
                                 <div class="col-md-12 paired_catagory" id="paired-catagory">
                                   
                                 </div>
                              </div>
                           </div>
                        </div>
                        </div>
                  </div>
               </div>
               @php $active++; @endphp
                @endforeach
               <!-- <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
               </div>
               <div class="tab-pane fade  " id="contact" role="tabpanel" aria-labelledby="contact-tab">
               </div> -->
               <!-- Section: Live preview -->
            </div>
            <!-- Tab panes -->
         </div>
      </div>
   </div>
</div>
<div class=" mt-80px mb-60px mx-0">
   <div class="text-center end-btn">
      <button type="submit" class="btn_next">Next</button>
   </div>
</div>
</form>
<div class="col-md-3"></div>

<script>

        function getInputValue(){
            var inputVal = document.getElementById("myInput").value;
            alert(inputVal);
        }
        function checkbox() {
  var checked = false;
  if (document.querySelector('#opt1:checked')) {
     checked = true;
  }
  function getInputValue(){
            var inputVal = document.getElementById("myInput").value;
            alert(inputVal);
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
    </script>
    @endsection
