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
      <form action="{{ url('create_event_menu') }}" id="single_dish_form" method="post" enctype="multipart/form-data">
      <input type="hidden" name="event_id" value="@php echo $event_locations[0]->event_id; @endphp">
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
               <span class="checkmark recent" ></span>
               </label>
                  <div class="vl"></div>
                  <label class="container-radio">
                  <input type="radio" onclick="jump('{{url('add_single_meal',request()->route('id'))}}')" name="radio" checked>
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
               <p class="head_create_event_2">6. Event Menu (Food & Drink)</p>
               <div class="mt-20px">
                  <!-- Section: Live preview -->
                  <div class="tabe-sections" >
                     <ul class="nav nav-tabs border-0 " id="myTab" role="tablist">
                     @php $active = 1; @endphp
                     @foreach($event_locations as $event_location)
                        <li class="nav-item  srt tab_@php echo $active @endphp">
                           <a class="nav-link @if($active==1){{'active'}}@endif" id="home-tab" data-toggle="tab" href="#single_meal_@php echo $event_location->id @endphp" role="tab" aria-controls="home" aria-selected="false">@php echo $event_location->name @endphp</a>
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
                     @foreach($event_menu as $event_location)
                     <input type="hidden" name="event_location_id[]" value="@php echo $event_location->id @endphp">
                        <div class="tab-pane  @if($active==1){{'active show'}}@endif" data-id="@php echo $event_location->id @endphp" id="single_meal_@php echo $event_location->id @endphp" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row m-0">
                        <div class="col-md-8">
                           <p class="head_detail_ce-1">Is there a menu for this location?</p>
                        </div>
                        <div class="col-md-4 pr-0">
                           <div class="button-radio">
                              <div class=" btn-radi0-style mt-30px">
                                 <label class="tog-radio-label ">
                                 <input type="radio" class="option-input radio show-payment" value="1" id="show-payment" name="enter_details_@php echo $event_location->id @endphp"  {{((count($event_location->get_single_menus)>0 || count($event_location->get_platted_menu)>0)?'checked':'')}}/>
                                 Yes
                                 </label>
                                 <label class="tog-radio-label ml-23px">
                                 <input type="radio" class="option-input radio hide-payment" value="0" id="hide-payment" name="enter_details_@php echo $event_location->id @endphp"  {{((count($event_location->get_single_menus)>0 || count($event_location->get_platted_menu)>0)?'':'checked')}}/>
                                 No
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>  
                        <div id="show-dive-payment" style="display:{{((count($event_location->get_single_menus)>0 || count($event_location->get_platted_menu)>0)?'block':'none')}}">
                              <div class="mt-20">
                                 <div class="row">
                                    <div class="col-md-11 mt-20px">
                                       <div class="form-group">
                                          <div class="input-bg-preview">
                                             <label class="lb-start-date w-100 m-0">Type of Menu</label>
                                             <select  id="menu_type@php echo $active @endphp" name="menu_type@php echo $event_location->id @endphp" class="frt" onchange="showDiv(this)">
                                             <option data-value="@php echo $event_location->id @endphp" {{((count($event_location->get_single_menus)>0 || count($event_location->get_platted_menu)>0)?((count($event_location->get_single_menus)>0)?'selected':''):'selected')}} value="0" >View Only</option>
                                                <option data-value="@php echo $event_location->id @endphp" value="1" {{((count($event_location->get_single_menus)>0 || count($event_location->get_platted_menu)>0)?((count($event_location->get_platted_menu)>0)?'selected':''):'')}}>Platted</option>
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
                              <div id="view_only@php echo $event_location->id @endphp" style="display:{{((count($event_location->get_single_menus)>0 || count($event_location->get_platted_menu)>0)?((count($event_location->get_single_menus)>0)?'block':'none'):'')}}">
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
                                    @if((count($event_location->get_single_menus)>0))
                                    @foreach($event_location->get_single_menus as $view_only_food)
                                    @if($view_only_food->status==0) 
                                    <!-- status 0 for food -->
                                       <div class=" mt-30px"  id="@php echo $active @endphp">
                                          <div class="input-bg-preview-ex-padding ">
                                             <div class="row">
                                                <div class="col-10">
                                                   <input class="single_meal@php echo $active @endphp" value="{{$view_only_food->name}}"  id='@php echo $event_location->id @endphp' name="food_@php echo $event_location->id @endphp[]" type="text" onkeypress="KeyPress(event, '@php echo $event_location->id @endphp')" class="double"   placeholder="Ex : Chicken"/>   
                                                </div>
                                                <label id="food_warn@php echo $active @endphp" style="color: red;display:none">Enter Dish</label>
                                             </div>
                                          </div>
                                       </div>
                                    @endif   
                                    @endforeach   
                                    @else
                                    <div class=" mt-30px"  id="@php echo $active @endphp">
                                       <div class="input-bg-preview-ex-padding ">
                                          <div class="row">
                                             <div class="col-10">
                                                <input class="single_meal@php echo $active @endphp"   id='@php echo $event_location->id @endphp' name="food_@php echo $event_location->id @endphp[]" type="text" onkeypress="KeyPress(event, '@php echo $event_location->id @endphp')" class="double"   placeholder="Ex : Chicken"/>   
                                             </div>
                                             <label id="food_warn@php echo $active @endphp" style="color: red;display:none">Enter Dish</label>
                                          </div>
                                       </div>
                                    </div>   
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
                                       @if((count($event_location->get_single_menus)>0))
                                       @foreach($event_location->get_single_menus as $view_only_drink)
                                       @if($view_only_drink->status==1) 
                                       <div class=" mt-30px" id="@php echo $event_location->id @endphp">
                                          <div class="input-bg-preview-ex-padding ">
                                             <div class="row">
                                                <div class="col-10">
                                                   <input class="single_drink@php echo $active @endphp" value="{{$view_only_drink->name}}" id='@php echo $event_location->id @endphp' name="drink_@php echo $event_location->id @endphp[]" type="text" onkeypress="KeyPress(event, '@php echo $event_location->id @endphp')" class="double"   placeholder="Ex : Pepsi"/>   
                                                </div>
                                                <label id="drink_warn@php echo $active @endphp" style="color: red;display:none">Enter Drink</label>
                                             </div>
                                          </div>
                                       </div>
                                       @endif   
                                       @endforeach   
                                       @else
                                       <div class=" mt-30px" id="@php echo $event_location->id @endphp">
                                          <div class="input-bg-preview-ex-padding ">
                                             <div class="row">
                                                <div class="col-10">
                                                   <input class="single_drink@php echo $active @endphp"  id='@php echo $event_location->id @endphp' name="drink_@php echo $event_location->id @endphp[]" type="text" onkeypress="KeyPress(event, '@php echo $event_location->id @endphp')" class="double"   placeholder="Ex : Pepsi"/>   
                                                </div>
                                                <label id="drink_warn@php echo $active @endphp" style="color: red;display:none">Enter Drink</label>
                                             </div>
                                          </div>
                                       </div>
                                       @endif
                                    </div>
                                 </div>
                              </div>
                              <div class="input-bg-preview end-add addCF-single mt-38px  ">
                                 <butto  href="javascript:void(0);" class="add-div-on " >Add More</butto>
                              </div> -->
                              </div>
                              <div id="platted@php echo $event_location->id @endphp" style="display:{{((count($event_location->get_single_menus)>0 || count($event_location->get_platted_menu)>0)?((count($event_location->get_platted_menu)>0)?'block':'none'):'none')}};">
                              
                  <div class="row ">
                        <div class="col-md-8">
                        <p class="event-going">How many possible meal option?</p>
                           </div>
                        <div class="col-md-4">
                           <div id="customFields">
                                 <div class="wrap bt-right-counter mt-20px">
                                    <button type="button" id="" class="sub" onclick="sub_custom_fields('@php echo $event_location->id @endphp')" class="" >-</button>
                                    <input class="count custom_counter@php echo $event_location->id @endphp" type="text" value="{{(count($event_location->get_platted_menu)>0)?count($event_location->get_platted_menu):1}}" min="0" max="100"  id="" name="no_of_days" />
                                    <button type="button" id="" class="add" onclick="add_custom_fields('@php echo $event_location->id @endphp')" class=" ">+</button>
                                 </div>
                              </div>
                        </div>
                  </div>
                  <div class="bridesmaid_container@php echo $event_location->id @endphp">
                  <div class="row">
                                    <div class="col-8">
                                       <p class="head_detail_ce-1">Food</p>
                                    </div>
                                    <div class="col-4 text-right">
                                    </div>
                                 </div>
            @if(count($event_location->get_platted_menu)>0)
            @php $counter = 0; @endphp
            @foreach($event_location->get_platted_menu as $platted_menu)
            <div class="mt-15px" id="container_{{$counter}}">
               <div id="customFields-1-add-food-1_@php echo $counter @endphp" data-id="{{$counter}}">
                  <div class=" mt-30px">
                     <div class="input-bg-preview-ex-padding ">
                        <div class="row">
                           <div class="col-10">
                           <input type="hidden" value="{{$counter}}" id="platted_food_hidden@php echo $event_location->id @endphp" name="platted_food_hidden@php echo $event_location->id @endphp[]">
                              <input  value="{{$platted_menu->dish_name}}" class="platted_category_@php echo $active @endphp" id="rd37j" name="platted_food_@php echo $event_location->id @endphp[]" type="text" onkeypress="KeyPress(event, 'rd37j')" class="double platted"  placeholder="Ex : Meal Category">                                 
                           </div>
                           <div class="col-2 text-end-0">
                              <div class="del-img-1-09 " onclick="add_custom_fields_add_1('@php echo $counter @endphp')">
                                 <img src="{{ asset('public/assets/imgs/ady.png') }}"  >
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div> 
               </div>

            @if(count($platted_menu->platted_items)>0)
            @foreach($platted_menu->platted_items as $items)
            <div class=" mt-10px" id="dish_field_{{$items->id}}"> <div class="input-bg-preview-ex-padding " style="height:50px;"> <div class="row">
               <div class="col-10"> 
               <input  type="text" class="double platted" value="{{$items->platted_dish_item}}" name="platted_food_item_{{$event_location->id}}_{{$counter}}[]"  placeholder="Ex : Meal Item">
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
            @php $counter++; @endphp
            @endforeach   
            @else  
            <div class="mt-15px">
               <div id="customFields-1-add-food-1_@php echo $event_location->id @endphp" data-id="0">
                  <div class=" mt-30px">
                     <div class="input-bg-preview-ex-padding ">
                        <div class="row">
                           <div class="col-10">
                           <input type="hidden"  id="platted_food_hidden@php echo $event_location->id @endphp" name="platted_food_hidden@php echo $event_location->id @endphp[]">
                              <input  value="" class="platted_category_@php echo $active @endphp" id="rd37j" name="platted_food_@php echo $event_location->id @endphp[]" type="text" onkeypress="KeyPress(event, 'rd37j')" class="double platted"  placeholder="Ex : Meal Category">                                 
                           </div>
                           <div class="col-2 text-end-0">
                              <div class="del-img-1-09 " onclick="add_custom_fields_add_1('@php echo $event_location->id @endphp')">
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
                  <!-- <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  </div>
                  <div class="tab-pane fade  " id="contact" role="tabpanel" aria-labelledby="contact-tab">
                  </div> -->
           
            <!-- Section: Live preview -->
         </div>
         <!-- Tab panes -->
        
      </div>
   <!-- </div> -->
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
   function showDiv(select){
      var div = $(select).find(':selected').data('value');
      if(select.value==1){
         $("#platted"+div).css('display','block');
         $("#view_only"+div).css('display','none');
      //  document.getElementById('hidden_div').style.display = "block";
      //  document.getElementById('bank-fields').style.display= "none";

      } else{
         $('.tab-pane.active').find((".platted")).prop('required', false);
         $("#view_only"+div).css('display','block');
         $("#platted"+div).css('display','none');
      //  document.getElementById('hidden_div').style.display = "none";
      //  document.getElementById('bank-fields').style.display= "block";
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
      $(".tab-pane.active").find(("#customFields-1-add-food-1_"+id+"")).append('<div class=" mt-10px" id="dish_field_'+dish_counter+'"> <div class="input-bg-preview-ex-padding " style="height:50px;"> <div class="row">'+
      '<div class="col-10"> '+
      '<input  type="text" class="double platted"  name="platted_food_item_'+active_tab+'_'+dish+'[]"  placeholder="Ex : Meal Item">'+
       '</div>'+
       '<div class="col-2 text-end-0">'+
        '<div class="del-img-1-09 remCF-food" style="top:-20%"  onclick="add_custom_fields_add('+dish_counter+')"> '+
        '<img src="../public/assets/imgs/ic_round-delete.png"> '+
        '</div>'+
        '</div>'+
        '</div>'+
        '</div>'+
        "</div>");
        dish_counter++;
   }
   function add_custom_fields_add(id)
   {
      $(".tab-pane.active").find(("#dish_field_"+id+"")).remove();
   }
   function jump(url)
   {
   window.location.href = url;
   }
</script>
@endsection
