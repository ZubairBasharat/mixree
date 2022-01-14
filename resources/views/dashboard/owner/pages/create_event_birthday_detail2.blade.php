@extends('dashboard.owner.layout')
@section('content')
<div class="container-fluid">
<div class="cross-section">
   <a href="javascript:;" onclick="return isconfirm('{{url('dashboard')}}');">
      <div class="text-right">
         <span class="cancel-btn pr-2">Cancel</span>
         <img src="{{asset('public/assets/imgs/cross.png')}}" class=" cross-btn">
   </a>
   </div>
</div>
<form action="{{(count($event_gifts)>0)?url('update_event_gift'):url('add_event_gift') }}" id="add_event_gift_form" method="post">
   {{ csrf_field() }}
   <div class="row data-viewer">
   <div class="col-md-3 responsive-section-col-3 d-none d-md-block">
      <div class="form  head-create-event radio-btn">
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
         <input type="radio"  onclick="jump('{{url('create_event_gift',request()->route('id'))}}')" name="radio" checked>
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
   <div class="col-md-3 responsive-section-col-3 d-md-none d-block">
      <div class="form  head-create-event radio-btn-1">
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
         <input type="radio"  name="radio" >
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
      <input type="hidden" value="{{ request()->route('id')}}" name="event_id" >
      <p class="head-create-event text-center">Create Event</p>
      <p class="head_create_event_2">3. Gift and Registry</p>
      <div class="row mt-40px ">
         <div class="col-md-8">
            <p class="head_detail_ce-1-12">Add donation or gift?</p>
         </div>
         <div class="col-md-4 pr-md-0">
            <div class="button-radio">
               <div class=" btn-radi0-style ">
                  <label class="tog-radio-label ">
                  <input type="radio" class="option-input radio" id="show-payment" onclick="details(1)" name="gift" value="1" {{(count($event_gifts)>0?'checked':'')}}/>
                  Yes
                  </label>
                  <label class="tog-radio-label ml-23px">
                  <input type="radio" class="option-input radio" id="hide-payment" onclick="details(0)" name="gift" value="0"  {{(count($event_gifts)>0?'':'checked')}}/>
                  No
                  </label>
               </div>
            </div>
         </div>
      </div>
      <div class="boxes-create-event">
         <div class="details_form" style='display:{{(count($event_gifts)>0?"":"none")}}'>
            <div class="payment_show">
            <input type="hidden" id="pament_counter" value="{{count($event_gifts)}}">
            @if(count($event_gifts)>0)
            @php $counter = 0; @endphp
            @foreach($event_gifts as $gift)
            <div id="show-dive-payment" class="payment_parent_{{$counter}}">
            <div id="parent">
               <div class="row  mt-20px">
                  <div class="col-md-6">
                     <div class="form-group">
                        <div class="input-bg-preview">
                           <label class="lb-start-date w-100 m-0">Type of Currency</label>
                           <select id="method" name="payment_type[]" class="frt method"  onchange="showDiv(this,{{$counter}})">
                              <option data-value="bank_" {{($gift->payment_type=="bank_account")?'selected':''}} value="bank_account">Bank Account</option>
                              <option data-image="paypal_" {{($gift->payment_type=="paypal")?'selected':''}} data-value="other_" value="paypal">PayPal</option>
                              <option data-image="zelle_" {{($gift->payment_type=="zelle")?'selected':''}} data-value="other_" value="zelle">Zelle</option>
                              <option data-image="venmo_" {{($gift->payment_type=="venmo")?'selected':''}} data-value="other_" value="venmo">Venmo</option>
                              <option data-image="cashapp_" {{($gift->payment_type=="cashapp")?'selected':''}} data-value="other_" value="cashapp">Cash App</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  @if($counter!=0)
                  <div class="col-md-6 text-right">
                     <div class="del-img-1" onclick="delete_parent({{$counter}})">
                        <img src="{{asset('/public/assets/imgs/ic_round-delete.png')}}" >
                     </div>
                  </div>
                 @endif 
               </div>
               <div id="bank_0" class="payment_div_{{$counter}}" style="{{($gift->payment_type=='bank_account')?'':'display:none'}}">
               <div class="row mt-20px">
                  <div class="col-md-6">
                     <div class="form-group">
                        <div class="input-bg-preview " style="padding: 0px 18px !important;">
                           <div class="material-form-field">
                              <input type="text" value="{{$gift->name_of_bank}}" class="name_of_bank details_field bank_account_{{$counter}}"  name="name_of_bank[]" maxlength = "16" />
                              <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Name of bank</label>
                           </div>
                        </div>
                        <label class="bank_name_warn" style="color: red;display:none">Bank name required *</label>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <div class="input-bg-preview " style="padding: 0px 18px !important;">
                           <div class="material-form-field">
                              <input type="text" value="{{$gift->name_of_account}}" class="name_of_account details_field bank_account_0"  name="name_of_account[]" maxlength = "16" />
                              <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Name of account</label>
                           </div>
                        </div>
                        <label class="account_name_warn" style="color: red;display:none">Account name required *</label>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <div class="input-bg-preview " style="padding: 0px 18px !important;">
                           <div class="material-form-field">
                              <input type="text" id="acc_number" value="{{$gift->account_number}}" class="account_number details_field bank_account_0"  name="account_number[]" maxlength = "16" />
                              <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Account number</label>
                           </div>
                        </div>
                        <label class="account_number_warn" style="color: red;display:none">Account number required *</label>
                     </div>
                  </div>
                  <div class="col-md-6"></div>
               </div>
               </div>
                  <div id="other_{{$counter}}"  style="{{($gift->payment_type!='bank_account')?'display:block':'display:none'}}" class="others payment_div_{{$counter}}">
                     <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-12">
                           <div class="payment-methos mt-12">
                              <div class="Credit-card ">
                                 <img class="imgs{{$counter}}" style="display: {{($gift->payment_type=='paypal')?'':'none'}};" id="paypal_{{$counter}}" src="{{asset('public/assets/imgs/paypal.png')}} ">
                                 <img class="imgs{{$counter}}" style="display: {{($gift->payment_type=='zelle')?'':'none'}};" id="zelle_{{$counter}}" src="{{asset('public/assets/imgs/zelle.png')}} ">
                                 <img class="imgs{{$counter}}" style="display: {{($gift->payment_type=='venmo')?'':'none'}};" style="width: 100%;" id="cashapp_{{$counter}}" src="{{asset('public/assets/imgs/venmo.png')}} ">
                                 <img class="imgs{{$counter}}" style="display: {{($gift->payment_type=='cashapp')?'':'none'}};" id="venmo_{{$counter}}" src="{{asset('public/assets/imgs/cashapp.png')}} ">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group mt-12">
                              <div class="input-bg-preview " style="padding: 0px 18px !important;">
                                 <div class="material-form-field">
                                    <input type="text" class="payment_email" value="{{$gift->payment_email}}"  name="payment_email[]" />
                                    <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Email</label>
                                 </div>
                              </div>
                              <label class="warning" style="color: red;display:none">Payment email required *</label>
                           </div>
                        </div>
                     </div>
                     </div>
                    </div> 
               </div>
               @php $counter++; @endphp
               @endforeach
               @else
               <div id="show-dive-payment">
               <div id="parent">
               <div class="row  mt-20px">
                  <div class="col-md-6">
                     <div class="form-group">
                        <div class="input-bg-preview">
                           <label class="lb-start-date w-100 m-0">Type of Currency</label>
                           <select id="test" name="payment_type[]" class="frt method"  onchange="showDiv(this,0)">
                              <option data-value="bank_" value="bank_account">Bank Account</option>
                              <option data-image="paypal_" data-value="other_" value="paypal">PayPal</option>
                              <option data-image="zelle_" data-value="other_" value="zelle">Zelle</option>
                              <option data-image="venmo_" data-value="other_" value="venmo">Venmo</option>
                              <option data-image="cashapp_" data-value="other_" value="cashapp">Cash App</option>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="bank_0" class="payment_div_0">
               <div class="row mt-20px">
                  <div class="col-md-6">
                     <div class="form-group">
                        <div class="input-bg-preview " style="padding: 0px 18px !important;">
                           <div class="material-form-field">
                              <input type="text" class="name_of_bank details_field bank_account_0"  name="name_of_bank[]" maxlength = "16" />
                              <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Name of bank</label>
                           </div>
                        </div>
                        <label class="bank_name_warn" style="color: red;display:none">Bank name required *</label>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <div class="input-bg-preview " style="padding: 0px 18px !important;">
                           <div class="material-form-field">
                              <input type="text" class="name_of_account details_field bank_account_0"  name="name_of_account[]" maxlength = "16" />
                              <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Name of account</label>
                           </div>
                        </div>
                        <label class="account_name_warn" style="color: red;display:none">Account name required *</label>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <div class="input-bg-preview " style="padding: 0px 18px !important;">
                           <div class="material-form-field">
                              <input type="text" id="acc_number" class="account_number details_field bank_account_0"  name="account_number[]" maxlength = "16" />
                              <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Account number</label>
                           </div>
                        </div>
                        <label class="account_number_warn" style="color: red;display:none">Account number required *</label>
                     </div>
                  </div>
                  <div class="col-md-6"></div>
               </div>
               </div>
                  <div id="other_0" style="display:none;" class="others payment_div_0">
                     <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-12">
                           <div class="payment-methos mt-12">
                              <div class="Credit-card ">
                                 <img class="imgs0" id="paypal_0" src="{{asset('public/assets/imgs/paypal.png')}} ">
                                 <img class="imgs0" id="zelle_0" src="{{asset('public/assets/imgs/zelle.png')}} ">
                                 <img class="imgs0" style="width: 100%;" id="cashapp_0" src="{{asset('public/assets/imgs/cashapp.png')}} ">
                                 <img class="imgs0" id="venmo_0" src="{{asset('public/assets/imgs/venmo.png')}} ">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group mt-12">
                              <div class="input-bg-preview " style="padding: 0px 18px !important;">
                                 <div class="material-form-field">
                                    <input type="text" class="payment_email"  name="payment_email[]" />
                                    <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Email</label>
                                 </div>
                              </div>
                              <label class="warning" style="color: red;display:none">Payment email required *</label>
                           </div>
                        </div>
                     </div>
                     </div>
               </div>  
               </div>
               @endif
               <div class="input-bg-preview end-add  mt-20px" onclick="add_payment_method()">
                     <butto  href="javascript:void(0);" class="add-div-on " >Add another method</butto>
                  </div>
            </div>
            <div class="row mt-30px">
               <div class="col-md-8">
                  <p class="head_detail_ce-2-1">Add gifting links</p>
               </div>
               <div class="col-md-4 pr-md-0">
                  <div class="button-radio">
                     <div class=" btn-radi0-style ">
                        <label class="tog-radio-label ">
                        <input type="radio" class="option-input radio" id="show-wedding" name="registry" value="1" checked  />
                        Yes
                        </label>
                        <label class="tog-radio-label ml-23px">
                        <input type="radio" class="option-input radio" id="hide-wedding" name="registry" value="0"  />
                        No
                        </label>
                     </div>
                  </div>
               </div>
            </div>
            <div id="hide-wed-dive">
               <div id="customFields-1">
               @if(count($event_registries)>0)
               @foreach($event_registries as $registry)
                  <div class="row mt-30px">
                     <div class="col-md-4">
                        <div class="form-group">
                           <div class="input-bg-preview ">
                              <label class="lb-start-date w-100 m-0"> Name of the Registry</label>
                              <input type="" value="{{$registry->name}}" style="font-weight:bold" maxlength="16" class="details_field registry_name" onkeyup="addRegistry(1)" id='1_name' name="registryname[]" placeholder="">
                           </div>
                           <label id="registery_warn" style="color: red;display:none">Required *</label>
                        </div>
                     </div>
                     <div class="col-md-7">
                        <div class="form-group">
                           <div class="input-bg-preview ">
                              <label class="lb-start-date w-100 m-0"> Link to the website</label>
                              <input type="text" value="{{$registry->link}}" style="font-weight:bold" class="details_field registry_link" onkeyup="addRegistry(1)" id='1_link' name="registrylink[]" placeholder="">
                           </div>
                           <label id="link_warn" style="color: red;display:none">Link required *</label>
                        </div>
                     </div>
                     <div class="col-md-1">
                        <div class="del-img-1 remCF-1">
                           <img src="{{asset('/public/assets/imgs/ic_round-delete.png')}}" >
                        </div>
                     </div>
                  </div>
                  @endforeach
               @else
               <div class="row mt-30px">
                     <div class="col-md-4">
                        <div class="form-group">
                           <div class="input-bg-preview ">
                              <label class="lb-start-date w-100 m-0"> Name of the Registry</label>
                              <input type="" style="font-weight:bold" maxlength="16" class="details_field registry_name" onkeyup="addRegistry(1)" id='1_name' name="registryname[]" placeholder="">
                           </div>
                           <label id="registery_warn" style="color: red;display:none">Required *</label>
                        </div>
                     </div>
                     <div class="col-md-7">
                        <div class="form-group">
                           <div class="input-bg-preview ">
                              <label class="lb-start-date w-100 m-0"> Link to the website</label>
                              <input type="text" style="font-weight:bold" class="details_field registry_link" onkeyup="addRegistry(1)" id='1_link' name="registrylink[]" placeholder="">
                           </div>
                           <label id="link_warn" style="color: red;display:none">Link required *</label>
                        </div>
                     </div>
                     <div class="col-md-1">
                        <div class="del-img-1 remCF-1">
                           <img src="{{asset('/public/assets/imgs/ic_round-delete.png')}}" >
                        </div>
                     </div>
                  </div>
               @endif   
               </div>
               <div class="input-bg-preview end-add addCF-1 mt-20px">
                  <butto  href="javascript:void(0);" class="add-div-on " >Add Wedding Registry Website</butto>
               </div>
            </div>
         </div>
      </div>
      <div class="row mt-80px mb-60px mx-0">
         <div class="col-md-6 col">
            <a class="btn_preview_main"><button type="button" class="btn_preview float-right" data-toggle="modal" data-target=".bd-example-modal-sm-natasha-gift">Preview</button></a>
         </div>
         <div class="col-md-6 col">
            <a><button class="btn_next">Next</button></a>
         </div>
      </div>
   </div>
</form>
<!-- Natasha Wedding gift modal --> 
<div class="modal fade bd-example-modal-sm-natasha-gift" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm">
      <div class="modal-content my_model">
         <div class="img_back_gift" style="background-image: url({{asset('public/images/event_images/'.$event_details->bg_img)}});">
            <h2 class="head_natasha text-white text-center">{{$event_details->eve_name}}</h2>
            <!-- <img src="" class="img_information_nav"> -->
         </div>
         <div class="section_white_gift">
            <p class="p_model_detail_gift">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <div class="div_gift_hony_moon">
               <p class="p_gift_hony_moon">Gifts for Honeymoon</p>
            </div>
            <div class="row div_gift_sec">
               <div class="col-md-2 p-0">
                  <img src="{{asset('public/assets/imgs/male.png')}}" class="gift_img">							 
               </div>
               <div class="col-md-4 p-0">
                  <p class="p_gift_prize" id="append_donantion"></p>
                  <p class="p_gift_amount">Amount expected</p>
               </div>
               <div class="col-md-2 p-0">
                  <img src="{{asset('public/assets/imgs/male.png')}}" class="gift_img">
               </div>
               <div class="col-md-4 p-0">
                  <p class="p_gift_prize">$5,000</p>
                  <p class="p_gift_amount">Amount expected</p>
               </div>
            </div>
            <div class="img_seekBar">
               <img src="{{asset('public/assets/imgs/seek-bar.png')}}" class="img_seek_bar">	
               <button class="btn_send_gift">Send Gift</button>				
            </div>
            <div class="div_wedding_registry">
               <p class="p_wedding_regis">Wedding Registry</p>
            </div>
            <div class="  bottom_nav p-0"></div>
         </div>
      </div>
   </div>
</div>
<script>
   function showDiv(select,count){
      var div = $(select).find(':selected').data('value');
      var image = $(select).find(':selected').data('image');
      $(".payment_div_"+count).css('display','none');
      $("#"+div+count).css('display','block');
      $(".imgs"+count).css('display','none');
      $("#"+image+count).css('display','block');
      if(div=="bank_"){
       $(".bank_account_"+count).prop('required',true);
      }else{
         $(".bank_account_"+count).prop('required', false);
      }
      // if(select.value==1){
      //  document.getElementById('hidden_div').style.display = "block";
      //  document.getElementById('bank-fields').style.display= "none";

      // } else{
      //  document.getElementById('hidden_div').style.display = "none";
      //  document.getElementById('bank-fields').style.display= "block";
     // }
   } 
   function isconfirm(url_val) {
   		// alert(url_val);
   		if (confirm('Are you sure want to cancel?') == false) {
   			return false;
   
   		} else {
   			location.href = url_val;
   
   		}
      }
      function details(status)
      {
         if(status)
         {
           $(".details_form").css('display','block');
         //   $(".details_field").prop('required',true);
         }
         else
         {
           $(".details_form").css('display','none');
           $(".details_field").prop('required',false);
         }
      }
     
      alert(payment_counter);
      function add_payment_method()
      {
         var payment_counter = parseInt($("#pament_counter").val())+1;
         $("#show-dive-payment").append('<div id="parent"><div class="row  mt-20px payment_parent_'+payment_counter+'" >'+
                  '<div class="col-md-6">'+
                     '<div class="form-group">'+
                        '<div class="input-bg-preview">'+
                           '<label class="lb-start-date w-100 m-0">Type of Currency</label>'+
                           '<select id="test"  class="frt method" name="payment_type[]" onchange="showDiv(this,'+payment_counter+')">'+
                              '<option data-value="bank_" value="bank_account">Bank Account</option>'+
                              '<option data-image="paypal_" data-value="other_" value="paypal">PayPal</option>'+
                             ' <option data-image="zelle_" data-value="other_" value="zelle">Zelle</option>'+
                              "<option data-image='venmo_' data-value='other_' value='venmo'>Venmo</option>"+
                              '<option data-image="cashapp_" data-value="other_" value="cashapp">Cash App</option>'+
                           '</select>'+
                        '</div>'+
                     '</div>'+
                  '</div>'+
                 ' <div class="col-md-6 text-right">'+
                  '<div class="del-img-1" onclick="delete_parent('+payment_counter+')">'+
                     '<img src="{{asset("/public/assets/imgs/ic_round-delete.png")}}" >'+
                  '</div>'+
               '</div>'+
               '</div>'+
               '<div id="bank_'+payment_counter+'" class="payment_div_'+payment_counter+' payment_parent_'+payment_counter+'">'+
               '<div class="row mt-20px">'+
                 ' <div class="col-md-6">'+
                     '<div class="form-group">'+
                       ' <div class="input-bg-preview " style="padding: 0px 18px !important;">'+
                          ' <div class="material-form-field">'+
                              '<input type="text" class="name_of_bank details_field bank_account_'+payment_counter+'"  name="name_of_bank[]" maxlength = "16" />'+
                              '<label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Name of bank</label>'+
                           '</div>'+
                        '</div>'+
                        '<label class="bank_name_warn" style="color: red;display:none">Bank name required *</label>'+
                     '</div>'+
                  '</div>'+
                  '<div class="col-md-6">'+
                     '<div class="form-group">'+
                       ' <div class="input-bg-preview " style="padding: 0px 18px !important;">'+
                          ' <div class="material-form-field">'+
                              '<input type="text" class="name_of_account details_field bank_account_'+payment_counter+'"  name="name_of_account[]" maxlength = "16" />'+
                             ' <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Name of account</label>'+
                           '</div>'+
                        '</div>'+
                        '<label class="account_name_warn" style="color: red;display:none">Account name required *</label>'+
                     '</div>'+
                  '</div>'+
                  '<div class="col-md-6">'+
                     '<div class="form-group">'+
                        '<div class="input-bg-preview " style="padding: 0px 18px !important;">'+
                           '<div class="material-form-field">'+
                              '<input type="text" class="account_number details_field bank_account_'+payment_counter+'"  name="account_number[]" maxlength = "16" />'+
                             ' <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Account number</label>'+
                           '</div>'+
                        '</div>'+
                        '<label class="account_number_warn" style="color: red;display:none">Account number required *</label>'+
                     '</div>'+
                  '</div>'+
                  '<div class="col-md-6"></div>'+
               '</div>'+
               '</div>'+
               '<div id="other_'+payment_counter+'" style="display:none;" class="others payment_div_'+payment_counter+' payment_parent_'+payment_counter+'">'+
                     '<div class="row">'+
                        '<div class="col-md-6"></div>'+
                        '<div class="col-md-12">'+
                           '<div class="payment-methos mt-12">'+
                              '<div class="Credit-card ">'+
                                 '<img class="imgs'+payment_counter+'" id="paypal_'+payment_counter+'" src="{{asset("public/assets/imgs/paypal.png")}} ">'+
                                 '<img class="imgs'+payment_counter+'" id="zelle_'+payment_counter+'" src="{{asset("public/assets/imgs/zelle.png")}} ">'+
                                 '<img class="imgs'+payment_counter+'" style="width: 100%;" id="cashapp_'+payment_counter+'" src="{{asset("public/assets/imgs/cashapp.png")}} ">'+
                                 '<img class="imgs'+payment_counter+'" id="venmo_'+payment_counter+'" src="{{asset("public/assets/imgs/venmo.png")}} ">'+
                              '</div>'+
                           '</div>'+
                        '</div>'+
                        '<div class="col-md-12">'+
                           '<div class="form-group mt-12">'+
                             ' <div class="input-bg-preview " style="padding: 0px 18px !important;">'+
                                 '<div class="material-form-field">'+
                                    '<input type="text" class="payment_email" name="payment_email[]" />'+
                                   ' <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Email</label>'+
                                 '</div>'+
                             ' </div>'+
                             ' <label class="warning" style="color: red;display:none">Payment email required *</label>'+
                           '</div>'+
                        '</div>'+
                     '</div>'+
                  '</div></div>')
                  $("#pament_counter").val(payment_counter);
      }
      function delete_parent(parent_id)
      {
         $(".payment_parent_"+parent_id).remove();
      }
 function jump(url)
{
  window.location.href = url;
}
</script>
@endsection