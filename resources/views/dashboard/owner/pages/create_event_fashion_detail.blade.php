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
<input type="hidden" id="visibility" value="{{(count($event_fashions)>0)?'1':'0'}}">
   <form action="{{ ((count($event_fashions)>0)?url('update_event_fashion'):url('add_event_fashion')) }}" id="event_fashion_details_form" method="post" enctype="multipart/form-data">
   <input type="hidden" id="showdata_status" value="show"> 
         {{ csrf_field() }}
<div class="row data-viewer">
   <div class="col-md-3 responsive-section-col-3 d-md-none d-block">
   <div class="form  head-create-event radio-btn-1  ">
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
            <input type="radio" onclick="jump('{{url('create_event_fashion',request()->route('id'))}}')" name="radio" checked>
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
      <p class="head-create-event text-center">Create Event</p>
      <p class="head_create_event_2">4. Event Dresscode </p>
      <div class="row m-0">
         <div class="col-md-8">
            <p class="head_detail_ce-1">Is there a dresscode for event?</p>
         </div>
         <input type="hidden" value="{{ request()->route('id')}}" name="event_id" >
         <div class="col-md-4 pr-0">
             <div class="button-radio">
               <div class=" btn-radi0-style mt-30px">
                     <label class="tog-radio-label ">
                     <input type="radio" class="option-input radio" id="show-payment" onclick="event_fashion('show')" name="fashion" value="1"  {{(count($event_fashions)>0)?'checked':''}}/>
                     Yes
                     </label>
                     <label class="tog-radio-label ml-23px">
                     <input type="radio" class="option-input radio" id="hide-payment" onclick="event_fashion('hide')" name="fashion" value="0" {{(count($event_fashions)>0)?'':'checked'}}/>
                     No
                     </label>
                  </div>
            </div>
         </div>
      </div>
      <div class="showTheData" style="display:{{(count($event_fashions)>0)?'block':'none'}}">
      <!-- <div class="row m-0">
         <div class="col-md-8">
            <p class="head_detail_ce-1">Will the dresscode be applicable to everyone or select?</p>
         </div>
         <div class="col-md-4 pr-0" >
             <div class="button-radio">
               <div class=" btn-radi0-style mt-30px">
                     <label class="tog-radio-label ">
                     <input type="radio" class="option-input radio" id="show-payment" onclick="code_select_guest(1)" name="fashionEveryone" value="1" {{((count($event_fashions)>0)?(($event_fashions[0]->code_for_guest!="" || $event_fashions[0]->code_for_guest!=Null)?'':'checked'):'')}} />
                     Yes
                     </label>
                     <label class="tog-radio-label ml-23px">
                     <input type="radio" class="option-input radio" id="hide-payment" onclick="code_select_guest(0)" name="fashionEveryone"  value="0" {{((count($event_fashions)>0)?(($event_fashions[0]->code_for_guest!="" || $event_fashions[0]->code_for_guest!=Null)?'checked':''):'checked')}} />
                     No
                     </label>
                  </div>
            </div>
         </div>
      </div> -->
        <div class="row mt-3">
           <div id="select_guest" style="display:contents">
            <!-- <div class="col-11" >
               <div class="form-group w-100">
                  <div class="input-bg-preview " style="padding: 1px 19px !important;">
                     <div class="material-form-field">
                        <input type="text" name="code_for_guest" value="{{((count($event_fashions)>0)?$event_fashions[0]->code_for_guest:'')}}" class="" />
                        <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Code for select guest</label>
                     </div>
                  </div>
               </div>
            </div> -->
            <!-- <div class="col-1 p-0">
                 <i class="fa fa-question-circle circleFont"></i>
            </div> -->
         </div>
            <div class="col-md-11">
               <div class="form-group">
                  <label id="dresscode_warn" style="color: red;display:none">Please select dresscode </label>
                  <div class="input-bg-preview">
                     <select class="frt-1" name="dresscode_type" id="event_dresscode">
                     <!-- <option {{(count($event_fashions)>0)?'':'selected'}} value="">Select Dress Code</option> -->
                        <option  selected value="general_dress_code">General Dress Code Information</option>
                        <!-- <option {{((count($event_fashions)>0)?(($event_fashions[0]->type=="purchase_event_outfit")?'selected':''):'')}} value="purchase_event_outfit">Purchase Event Outfit</option> -->
                        <!-- <option {{((count($event_fashions)>0)?(($event_fashions[0]->type=="link_to_purchase")?'selected':''):'')}} value="link_to_purchase">Link to Purchase</option> -->
                     </select>
                  </div>
               </div>
            </div>
        </div>
            <!--<div class="boxes-create-event pr-md-3">
                    <div id="show-dive-payment">
                        <div id="customField">

                        </div>
                    </div>
                </div> -->
            <div class="boxes-create-event pr-md-3">
                  @if(count($event_fashions)>0)
                  @if($event_fashions[0]->type=="general_dress_code")
                  <div id="general_dress_code_div" style="display: block;">
                  @foreach($event_fashions as $dress_code)
                        <div id="customFieldGeneralDressCode">
                            <div class="row">
                                <div class="col-11 pr-0">
                                    <div class="form-group">
                                        <div class="input-bg-preview">
                                            <label class="lb-start-date w-100 m-0">Enter dresscode for Guest</label>
                                            <textarea class="form-control dresscode_description description" id="event-description" rows="3" placeholder="" name="dreescode_description[]" >{{$dress_code->dress_code_description}}</textarea>
                                        </div>
                                        <label style="color: red;display:none" class="warning">Required *</label>
                                    </div>
                                </div>
                                <!-- <div class="col-1">
                                    <div class="del-btn-dresscode remGeneralDressCode">
                                        <img src="{{asset('/public/assets/imgs/delete.png')}}" class="del-img ">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    @endforeach
                    @if($event_fashions[0]->type=="general_dress_code")
                    <!-- <div class="row">
                           <div class="col-12">
                              <div class="end-add general_dress_code mt-38px" onclick="add_custom_fields()">
                                 <butto  href="javascript:void(0);" class="add-div-on">Add Item Fashion</butto>
                              </div>
                           </div>
                     </div> -->
                     </div>
                     @endif
                     @else  
                     <div id="general_dress_code_div" style="display: block;">
                        <div id="customFieldGeneralDressCode">
                            <div class="row">
                                <div class="col-11 pr-0">
                                    <div class="form-group">
                                        <div class="input-bg-preview">
                                            <label class="lb-start-date w-100 m-0">Enter dresscode for Guest</label>
                                            <textarea class="form-control dresscode_description description" id="event-description" rows="3" placeholder="" name="dreescode_description[]" ></textarea>
                                        </div>
                                        <label style="color: red;display:none" class="warning">Required *</label>
                                    </div>
                                </div>
                                <!-- <div class="col-1">
                                    <div class="del-btn-dresscode remGeneralDressCode">
                                        <img src="{{asset('/public/assets/imgs/delete.png')}}" class="del-img ">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-12">
                                <div class="end-add general_dress_code mt-38px" onclick="add_custom_fields()">
                                    <butto  href="javascript:void(0);" class="add-div-on">Add Item Fashion</butto>
                                </div>
                            </div>
                        </div> -->
                    </div>  
                    @endif
                    @else
                    <div id="general_dress_code_div" style="display: block;">
                        <div id="customFieldGeneralDressCode"> 
                            <div class="row">
                                <div class="col-11 pr-0">
                                    <div class="form-group">
                                        <div class="input-bg-preview">
                                            <label class="lb-start-date w-100 m-0">Enter dresscode for Guest</label>
                                            <textarea class="form-control dresscode_description description" id="event-description" rows="3" placeholder="" name="dreescode_description[]" ></textarea>
                                        </div>
                                        <label style="color: red;display:none" class="warning">Required *</label>
                                    </div>
                                </div>
                                <!-- <div class="col-1">
                                    <div class="del-btn-dresscode remGeneralDressCode">
                                        <img src="{{asset('/public/assets/imgs/delete.png')}}" class="del-img ">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-12">
                                <div class="end-add general_dress_code mt-38px" onclick="add_custom_fields()">
                                    <butto  href="javascript:void(0);" class="add-div-on">Add Item Fashion</butto>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    @endif
                    @if(count($event_fashions)>0)
                    @if($event_fashions[0]->type=="purchase_event_outfit")
                    @php $counter = 0; @endphp
                     <div id="purchaseEventOutfit" style="display: block;">
                        <div id="{{($event_fashions[0]->type=='purchase_event_outfit')?'customField':''}}">
                        @foreach($event_fashions as $event_outfit)
                        <input type="hidden" value="{{$event_outfit->image}}" name="hidden_outfit_image[]">
                        <div class="row event_fashion">
                           <div class="col-md-11 col-lg-11">
                              <div class="row mt-16px">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <div class="input-bg-preview " style="padding: 1px 19px !important;">
                                          <div class="material-form-field">
                                             <input type="text" class="item_name outfit_name" value='{{$event_outfit->name}}' maxlength="16" onkeyup="addDonation({{$counter}})" id='{{$counter}}_name' name="outfit_name[]" id="field-text" />
                                             <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Name of Item</label>
                                          </div>
                                       </div>
                                       <label class="warning" style="color: red;display:none">Required * </label>
                                    </div>
                                 </div>
                                 <div class="col-lg-3 col-md-4 text-center">
                                    <div class="avatar-upload-big mb-md-0 mb-2">
                                       <div class="avatar-edit">
                                          <input class="image" onchange="addDonation({{$counter}},{{$counter}},'image_{{$counter}}')" type='file' styele="display:none" id='{{$counter}}' accept=".png, .jpg, .jpeg" name="outfit_image[]"  />
                                          <label for='{{$counter}}'></label>
                                       </div>
                                       <div class="avatar-preview preview-1">
                                          <div id="image_{{$counter}}" style="background-image: url({{(!empty($event_outfit->image) || $event_outfit->image !=Null)?asset('/public/images/event_images/'.$event_outfit->image):'/public/assets/imgs/upload-image.png'}});">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-9 col-md-8">
                                    <div class="form-group">
                                       <div class="input-bg-preview">
                                          <label class="lb-start-date w-100 m-0"> Item Description</label>
                                          <textarea class="form-control description out_fit_description" id="event-description" rows="3" placeholder="" name="outfit_description[]" >{{$event_outfit->description}}</textarea>
                                       </div>
                                       <label class="warning" style="color: red; display:none">Required *</label>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <div class="input-bg-preview " style="padding: 1px 19px !important;">
                                          <div class="material-form-field">
                                             <input class="price outfit_price" value='{{$event_outfit->price}}' type="text" onkeyup="addDonation({{$counter}})" id='{{$counter}}_price' name="outfit_price[]" id="field-text" />
                                             <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Price</label>
                                          </div>
                                       </div>
                                       <label class="warning" style="color:red;display:none">Required *</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-1 col-md-1 p-md-0">
                              <div class="del-btn-icon remCF mt-3">
                                 <img src="../public/assets/imgs/delete.png" class="del-img ">
                              </div>
                           </div>
                        </div>
                        @php $counter++; @endphp
                        @endforeach
                        @if($event_fashions[0]->type=="purchase_event_outfit")
                        </div>
                        <div class="row ml-0">
                           <div class="input-bg-preview end-add addCF mt-38px  ">
                              <butto  href="javascript:void(0);" class="add-div-on">Add Item Fashion</butto>
                           </div>
                        </div>
                        @endif
                    </div>
                  @else
                  <div id="purchaseEventOutfit" style="display: none;">
                           <div id="{{((count($event_fashions)>0)?'customField':'customField')}}">
                           <div class="row event_fashion">
                              <div class="col-md-11 col-lg-11">
                                 <div class="row mt-16px">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <div class="input-bg-preview " style="padding: 1px 19px !important;">
                                             <div class="material-form-field">
                                                <input type="text" class="item_name outfit_name" maxlength="16" onkeyup="addDonation(0)" id='0_name' name="outfit_name[]" id="field-text" />
                                                <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Name of Item</label>
                                             </div>
                                          </div>
                                          <label class="warning" style="color: red;display:none">Required * </label>
                                       </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 text-center">
                                       <div class="avatar-upload-big mb-md-0 mb-2">
                                          <div class="avatar-edit">
                                             <input class="image outfit_image" onchange="addDonation(0, 0,'image_0')" type='file' styele="display:none" id='0' accept=".png, .jpg, .jpeg" name="outfit_image[]"  />
                                             <label for='0'></label>
                                          </div>
                                          <div class="avatar-preview preview-1">
                                             <div id="image_0" style="background-image: url('/public/assets/imgs/upload-image.png');">
                                             </div>
                                          </div>
                                       </div>
                                       <label class="warning" style="color: red;display:none">Required *</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                       <div class="form-group">
                                          <div class="input-bg-preview">
                                             <label class="lb-start-date w-100 m-0"> Item Description</label>
                                             <textarea class="form-control description out_fit_description" id="event-description" rows="3" placeholder="" name="outfit_description[]" ></textarea>
                                          </div>
                                          <label class="warning" style="color: red; display:none">Required *</label>
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <div class="input-bg-preview " style="padding: 1px 19px !important;">
                                             <div class="material-form-field">
                                                <input class="price outfit_price" type="text" onkeyup="addDonation(0)" id='0_price' name="outfit_price[]" id="field-text" />
                                                <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Price</label>
                                             </div>
                                          </div>
                                          <label class="warning" style="color:red;display:none">Required *</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-1 col-md-1 p-md-0">
                                 <div class="del-btn-icon remCF mt-3">
                                    <img src="../public/assets/imgs/delete.png" class="del-img ">
                                 </div>
                              </div>
                           </div>
                           </div>
                           <div class="row ml-0">
                              <div class="input-bg-preview end-add addCF mt-38px  ">
                                 <butto  href="javascript:void(0);" class="add-div-on">Add Item Fashion</butto>
                              </div>
                           </div>
                     </div>
                    @endif
                    @else
                     <div id="purchaseEventOutfit" style="display: none;">
                           <div id="{{((count($event_fashions)>0)?'':'customField')}}">
                           <div class="row event_fashion">
                              <div class="col-md-11 col-lg-11">
                                 <div class="row mt-16px">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <div class="input-bg-preview " style="padding: 1px 19px !important;">
                                             <div class="material-form-field">
                                                <input type="text" class="item_name outfit_name" maxlength="16" onkeyup="addDonation(0)" id='0_name' name="outfit_name[]" id="field-text" />
                                                <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Name of Item</label>
                                             </div>
                                          </div>
                                          <label class="warning" style="color: red;display:none">Required * </label>
                                       </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 text-center">
                                       <div class="avatar-upload-big mb-md-0 mb-2">
                                          <div class="avatar-edit">
                                             <input class="image outfit_image" onchange="addDonation(0, 0,'image_0')" type='file' styele="display:none" id='0' accept=".png, .jpg, .jpeg" name="outfit_image[]"  />
                                             <label for='0'></label>
                                          </div>
                                          <div class="avatar-preview preview-1">
                                             <div id="image_0" style="background-image: url('/public/assets/imgs/upload-image.png');">
                                             </div>
                                          </div>
                                       </div>
                                       <label class="warning" style="color: red;display:none">Required *</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                       <div class="form-group">
                                          <div class="input-bg-preview">
                                             <label class="lb-start-date w-100 m-0"> Item Description</label>
                                             <textarea class="form-control description out_fit_description" id="event-description" rows="3" placeholder="" name="outfit_description[]" ></textarea>
                                          </div>
                                          <label class="warning" style="color: red; display:none">Required *</label>
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <div class="input-bg-preview " style="padding: 1px 19px !important;">
                                             <div class="material-form-field">
                                                <input class="price outfit_price" type="text" onkeyup="addDonation(0)" id='0_price' name="outfit_price[]" id="field-text" />
                                                <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Price</label>
                                             </div>
                                          </div>
                                          <label class="warning" style="color:red;display:none">Required *</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-1 col-md-1 p-md-0">
                                 <div class="del-btn-icon remCF mt-3">
                                    <img src="../public/assets/imgs/delete.png" class="del-img ">
                                 </div>
                              </div>
                           </div>
                           </div>
                           <div class="row ml-0">
                              <div class="input-bg-preview end-add addCF mt-38px  ">
                                 <butto  href="javascript:void(0);" class="add-div-on">Add Item Fashion</butto>
                              </div>
                           </div>
                     </div>
                    @endif
                    @if(count($event_fashions)>0)
                    @if($event_fashions[0]->type=="link_to_purchase")
                    @php $link_counter = 1; @endphp
                     <div id="linkToPurchase" style ="display:block">
                        <div id="customFieldPurchase">
                          @foreach($event_fashions as $purchase_link)
                          <input type="hidden" value="{{$purchase_link->image}}" name="hidden_link_image[]">
                          <div class="row event_fashion">
                              <div class="col-md-11 col-lg-11">
                                 <div class="row mt-16px">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <div class="input-bg-preview " style="padding: 1px 19px !important;">
                                             <div class="material-form-field">
                                                <input type="text" class="item_name link_item_name" value="{{$purchase_link->name}}" maxlength="16" onkeyup="addDonation('{{$link_counter}}')" id='{{$link_counter}}_name' name="item_name[]" id="field-text" />
                                                <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Name of Item</label>
                                             </div>
                                          </div>
                                          <label class="warning" style="color: red;display:none">Required *</label>
                                       </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 text-center">
                                       <div class="avatar-upload-big mb-md-0 mb-2">
                                          <div class="avatar-edit">
                                             <input class="image " onchange="addDonation({{$link_counter}}, {{$link_counter}},'linkImage_{{$link_counter}}')" type='file' styele="display:none" id='{{$link_counter}}' accept=".png, .jpg, .jpeg" name="item_image[]"  />
                                             <label for='{{$link_counter}}'></label>
                                          </div>
                                          <div class="avatar-preview preview-1">
                                             <div id="linkImage_{{$link_counter}}" style="background-image: url({{(!empty($purchase_link->image) || $purchase_link->image !=Null)?asset('/public/images/event_images/'.$purchase_link->image):'/public/assets/imgs/upload-image.png'}});">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                       <div class="form-group">
                                          <div class="input-bg-preview">
                                             <label class="lb-start-date w-100 m-0"> Item Description</label>
                                             <textarea class="form-control link_description description" id="event-description" rows="3" placeholder="" name="item_description[]" >{{$purchase_link->description}}</textarea>
                                          </div>
                                          <label class="warning" style="color: red;display:none">Required *</label>
                                       </div>
                                    </div>
                                    <div class="col-md-8">
                                       <div class="form-group">
                                          <div class="input-bg-preview " style="padding: 1px 19px !important;">
                                             <div class="material-form-field">
                                                <input type="text" class="link_to_purchase" value="{{$purchase_link->link}}" onkeyup="addDonation('${donationID}')" id='${donationID}_purchase' name="item_link[]" id="field-text" />
                                                <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Link to the Purchase</label>
                                             </div>
                                          </div>
                                          <label class="warning" style="color: red;display:none">Required *</label>
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <div class="input-bg-preview " style="padding: 1px 19px !important;">
                                             <div class="material-form-field">
                                                <input class="price link_price" type="text" value="{{$purchase_link->price}}" onkeyup="addDonation('${donationID}')" id='${donationID}_price' name="item_price[]" id="field-text" />
                                                <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Price</label>
                                             </div>
                                          </div>
                                          <label class="warning" style="color: red;display:none">Required *</label>
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <div class="input-bg-preview " style="padding: 1px 19px !important;">
                                             <div class="material-form-field">
                                                <input class="price coupon" value="{{$purchase_link->coupon_code}}" type="text" onkeyup="addDonation('${donationID}')" id='${donationID}_code' name="coupon_code[]" id="field-text" />
                                                <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">CouponCode</label>
                                             </div>
                                          </div>
                                          <label class="warning" style="color: red;display:none">Required *</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-1 col-md-1 p-md-0">
                                 <div class="del-btn-icon remPurchase mt-3">
                                    <img src="../public/assets/imgs/delete.png" class="del-img ">
                                 </div>
                              </div>
                           </div>
                        </div>
                           @php $link_counter++; @endphp
                          @endforeach
                          @if(count($event_fashions)>0)
                          @if($event_fashions[0]->type=="link_to_purchase")
                          <div class="row ml-0">
                              <div class="input-bg-preview end-add addPurchase mt-38px  ">
                                 <butto  href="javascript:void(0);" class="add-div-on">Add Item  Link</butto>
                              </div>
                           </div>
                           </div>
                          @endif
                          @endif 
                    @else
                     <div id="linkToPurchase" style ="display:none">
                           <div id="customFieldPurchase">
                           <div class="row event_fashion">
                              <div class="col-md-11 col-lg-11">
                                 <div class="row mt-16px">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <div class="input-bg-preview " style="padding: 1px 19px !important;">
                                             <div class="material-form-field">
                                                <input type="text" class="item_name link_item_name" maxlength="16" onkeyup="addDonation('${donationID}')" id='${donationID}_name' name="item_name[]" id="field-text" />
                                                <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Name of Item</label>
                                             </div>
                                          </div>
                                          <label class="warning" style="color: red;display:none">Required *</label>
                                       </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 text-center">
                                       <div class="avatar-upload-big mb-md-0 mb-2">
                                          <div class="avatar-edit">
                                             <input class="image link_image" onchange="addDonation('${donationID}', '${imgInputID}','${imgPreviewID}')" type='file' styele="display:none" id='${imgInputID}' accept=".png, .jpg, .jpeg" name="item_image[]"  />
                                             <label for='${imgInputID}'></label>
                                          </div>
                                          <div class="avatar-preview preview-1">
                                             <div id="${imgPreviewID}" style="background-image: url('/public/assets/imgs/upload-image.png');">
                                             </div>
                                          </div>
                                          <label class="warning" style="color: red;display:none">Required *</label>
                                       </div>
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                       <div class="form-group">
                                          <div class="input-bg-preview">
                                             <label class="lb-start-date w-100 m-0"> Item Description</label>
                                             <textarea class="form-control link_description description" id="event-description" rows="3" placeholder="" name="item_description[]" ></textarea>
                                          </div>
                                          <label class="warning" style="color: red;display:none">Required *</label>
                                       </div>
                                    </div>
                                    <div class="col-md-8">
                                       <div class="form-group">
                                          <div class="input-bg-preview " style="padding: 1px 19px !important;">
                                             <div class="material-form-field">
                                                <input type="text" class="link_to_purchase" onkeyup="addDonation('${donationID}')" id='${donationID}_purchase' name="item_link[]" id="field-text" />
                                                <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Link to the Purchase</label>
                                             </div>
                                          </div>
                                          <label class="warning" style="color: red;display:none">Required *</label>
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <div class="input-bg-preview " style="padding: 1px 19px !important;">
                                             <div class="material-form-field">
                                                <input class="price link_price" type="text" onkeyup="addDonation('${donationID}')" id='${donationID}_price' name="item_price[]" id="field-text" />
                                                <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Price</label>
                                             </div>
                                          </div>
                                          <label class="warning" style="color: red;display:none">Required *</label>
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <div class="input-bg-preview " style="padding: 1px 19px !important;">
                                             <div class="material-form-field">
                                                <input class="price coupon" type="text" onkeyup="addDonation('${donationID}')" id='${donationID}_code' name="coupon_code[]" id="field-text" />
                                                <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">CouponCode</label>
                                             </div>
                                          </div>
                                          <label class="warning" style="color: red;display:none">Required *</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-1 col-md-1 p-md-0">
                                 <div class="del-btn-icon remPurchase mt-3">
                                    <img src="../public/assets/imgs/delete.png" class="del-img ">
                                 </div>
                              </div>
                           </div>
                           </div>
                           <div class="row ml-0">
                              <div class="input-bg-preview end-add addPurchase mt-38px  ">
                                 <butto  href="javascript:void(0);" class="add-div-on">Add Item  Link</butto>
                              </div>
                           </div>
                     </div>
                    @endif
                    @else
                    <div id="linkToPurchase" style ="display:none">
                        <div id="customFieldPurchase">
                        <div class="row event_fashion">
                           <div class="col-md-11 col-lg-11">
                              <div class="row mt-16px">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <div class="input-bg-preview " style="padding: 1px 19px !important;">
                                          <div class="material-form-field">
                                             <input type="text" class="item_name link_item_name" maxlength="16" onkeyup="addDonation('${donationID}')" id='${donationID}_name' name="item_name[]" id="field-text" />
                                             <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Name of Item</label>
                                          </div>
                                       </div>
                                       <label class="warning" style="color: red;display:none">Required *</label>
                                    </div>
                                 </div>
                                 <div class="col-lg-3 col-md-4 text-center">
                                    <div class="avatar-upload-big mb-md-0 mb-2">
                                       <div class="avatar-edit">
                                          <input class="image link_image" onchange="addDonation('${donationID}', '${imgInputID}','${imgPreviewID}')" type='file' styele="display:none" id='${imgInputID}' accept=".png, .jpg, .jpeg" name="item_image[]"  />
                                          <label for='${imgInputID}'></label>
                                       </div>
                                       <div class="avatar-preview preview-1">
                                          <div id="${imgPreviewID}" style="background-image: url('/public/assets/imgs/upload-image.png');">
                                          </div>
                                       </div>
                                       <label class="warning" style="color: red;display:none">Required *</label>
                                    </div>
                                 </div>
                                 <div class="col-lg-9 col-md-8">
                                    <div class="form-group">
                                       <div class="input-bg-preview">
                                          <label class="lb-start-date w-100 m-0"> Item Description</label>
                                          <textarea class="form-control link_description description" id="event-description" rows="3" placeholder="" name="item_description[]" ></textarea>
                                       </div>
                                       <label class="warning" style="color: red;display:none">Required *</label>
                                    </div>
                                 </div>
                                 <div class="col-md-8">
                                    <div class="form-group">
                                       <div class="input-bg-preview " style="padding: 1px 19px !important;">
                                          <div class="material-form-field">
                                             <input type="text" class="link_to_purchase" onkeyup="addDonation('${donationID}')" id='${donationID}_purchase' name="item_link[]" id="field-text" />
                                             <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Link to the Purchase</label>
                                          </div>
                                       </div>
                                       <label class="warning" style="color: red;display:none">Required *</label>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <div class="input-bg-preview " style="padding: 1px 19px !important;">
                                          <div class="material-form-field">
                                             <input class="price link_price" type="text" onkeyup="addDonation('${donationID}')" id='${donationID}_price' name="item_price[]" id="field-text" />
                                             <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Price</label>
                                          </div>
                                       </div>
                                       <label class="warning" style="color: red;display:none">Required *</label>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <div class="input-bg-preview " style="padding: 1px 19px !important;">
                                          <div class="material-form-field">
                                             <input class="price coupon" type="text" onkeyup="addDonation('${donationID}')" id='${donationID}_code' name="coupon_code[]" id="field-text" />
                                             <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">CouponCode</label>
                                          </div>
                                       </div>
                                       <label class="warning" style="color: red;display:none">Required *</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-1 col-md-1 p-md-0">
                              <div class="del-btn-icon remPurchase mt-3">
                                 <img src="../public/assets/imgs/delete.png" class="del-img ">
                              </div>
                           </div>
                        </div>
                        </div>
                        <div class="row ml-0">
                            <div class="input-bg-preview end-add addPurchase mt-38px  ">
                                <butto  href="javascript:void(0);" class="add-div-on">Add Item  Link</butto>
                            </div>
                        </div>
                    </div>
                    @endif
            </div>
        </div>

     <!-- <div class="event_fashion">
         <div class="input-bg-preview end-add addCF mt-38px  ">
            <butto  href="javascript:void(0);" class="add-div-on">Add Item Fashion</butto>
         </div>
         <div class="input-bg-preview mt-38px">
            <label class="lb-start-date w-100 m-0"> Start Date Event</label>
            <div class="input-append date form_datetime"  id="form-date">
               <input size="16" id="fashion_details_date" type="text" value="" readonly class="frt" id="input-date"  name="st_dt">
               <span class="add-on"><i class="fa fa-calendar" aria-hidden="true"></i></span>
            </div>
         </div>
      </div> -->
      <label id="fashion_details_warn" style="color: red;display:none">Select Date</label>
      <div class="row mt-80px mb-60px mx-0">
         <div class="col-md-6 col">
            <a class="btn_preview_main"><button type="button" class="btn_preview float-right" data-toggle="modal" data-target=".bd-example-modal-sm-event-fashion">Preview</button></a>
         </div>
         <div class="col-md-6 col">
            <a><button class="btn_next">Next</button></a>
         </div>
      </div>
   </div>
</div>
</form>
<!-- Natasha Wedding Event Fashion modal -->
<div class="modal fade bd-example-modal-sm-event-fashion" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
@php
$eve_name = App\EventDetail::where(['event_id' => request()->route('id')])->orderBy('id','desc')->first();
@endphp
   <div class="modal-dialog modal-sm product_model">
      <div class="modal-content border_radius">
         <div class="img_back_product" style="background-image: url({{asset('public/images/event_images/'.$eve_name->bg_img)}});">
            <h2 class="head_natasha text-white text-center">{{$eve_name->eve_name}}</h2>
            <img src="{{ asset('public/assets/imgs/event-fashion-nav.png')}}" class="img_information_nav_product">
         </div>
         <div class="section_product">
            <div class="alert alert-danger d-inline-flex alert_div" role="alert">
               <img src="{{ asset('public/assets/imgs/error.png')}}" class="img_error">
               <p class="p_error"></p>
            </div>
            <div class="div_products">
               <div class="row m-0 div_products_row">
               </div>
            </div>
            <div class="bottom_nav_product p-0"></div>
         </div>
      </div>
   </div>
</div>
<!-- <script>
$(document).ready(function() {
    alert('ho')
    $('#event_dresscode').on('change', function() {
         alert('hi');
    });
    $('#event_dresscode').change(function() {

        var selectedValue = $(this).val();

        if(selectedValue  === 'general_dress_code') {
            $('#general_dress_code_div').show();
        } else if (selectedValue === 'B') {
            $groundSprayTr.show();
            $aerialTr.hide();
        } else {
            $groundSprayTr.hide();
            $aerialTr.hide();
        }
    });
 });
</script> -->
<script>
function isconfirm(url_val) {
		// alert(url_val);
		if (confirm('Are you sure want to cancel?') == false) {
			return false;

		} else {
			location.href = url_val;

		}
   }
   function event_fashion(status)
   {
      $("#showdata_status").val(status);
      if(status=="show")
      {
          $(".showTheData").css('display','block');
         $(".event_fashion").css('display','flex');
         $("#visibility").val(1);
         // $(".item_name").prop('required', true);
         // $(".description").prop('required', true);
         // $(".image").prop('required',true);
         // $(".link_to_purchase").prop('required',true);
         // $(".price").prop('required',true);
         // $("#fashion_details_date").prop('required',true);
      }
      if(status=="hide")
      {
          $(".showTheData").css('display','none');
         $(".event_fashion").css('display','none');
         $("#visibility").val(0);
         // $(".item_name").prop('required', false);
         // $(".description").prop('required', false);
         // $(".image").prop('required',false);
         // $(".link_to_purchase").prop('required',false);
         // $(".price").prop('required',false);
         // $("#fashion_details_date").prop('required',false);
      }
   }
</script>
<!-- <script>
   // $("#input-date").click(function(){
   //    var a= $("#form-date").attr('data-date').value;
   // console.log(a);
   // alert('success');
   // })
   $("#form-date").datepicker({
    onSelect: function() {
        var dateObject = $(this).datepicker('getDate');
        console.log(dateObject);
    }
});

</script> -->
<script>
     function add_custom_fields(){
      $("#customFieldGeneralDressCode").append('<div class="row">'+
                       '<div class="col-11 pr-0">'+
                            '<div class="form-group">'+
                                '<div class="input-bg-preview">'+
                                    '<label class="lb-start-date w-100 m-0">Enter dresscode for Guest</label>'+
                                    '<textarea class="form-control dresscode_description description" id="event-description" rows="3" placeholder="" name="dreescode_description[]" ed></textarea>'+
                                '</div>'+
                                ' <label style="color: red;display:none" class="warning">Required *</label>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-1">'+
                                    '<div class="del-btn-dresscode remGeneralDressCode">'+
                                        '<img src="../public/assets/imgs/delete.png" class="del-img">'+
                                    '</div>'+
                                '</div>'+
                    '</div>');
   }
   function code_select_guest(status)
   {
      if(status==1){
         $("#select_guest").css('display','none');
      }else{
         $("#select_guest").css('display','contents');
      }
   }
function jump(url)
{
  window.location.href = url;
}
</script>
@endsection
