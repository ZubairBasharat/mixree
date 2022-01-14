@extends('dashboard.owner.layout')
@section('content')
<div id="page">
   <div class="container-fluid">
      <div class="cross-section">
         <a href="javascript:;" onclick="return isconfirm('{{url('dashboard')}}');">
            <div class="text-right">
            <!-- <span class="cancel-btn pr-2">Save</span>
               <img src="{{ asset('public/assets/imgs/ticky.png') }}" class=" cross-btn"> -->
               <span class="cancel-btn pr-2">Cancel</span>
               <img src="{{ asset('public/assets/imgs/cross.png') }}" class=" cross-btn">
            </div>
         </a>
      </div>
      <form action="{{ (isset($event_id)?url('update_event'):url('add_event'))  }}" id="create_event_form" method="post">
         {{ csrf_field() }}
         <input type="hidden" value="{{(isset($event_id)?$event_id:'')}}" name="event_id">
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
                  <input type="radio"  name="radio" checked >
                  <span class="checkmark"></span>
                  </label>
                  <div class="vl"></div>
                  <label class="container-radio">
                  <input type="radio" name="radio">
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
               </div>
            </div>
            <div class="col-md-6 responsive-section">
               <p class="head-create-event text-center">Create Event</p>
               <p class="head_create_event_2">1. General Information</p>
               <p class="head_detail_ce">What kind of Events are you planning?</p>
               <input type="hidden" name="type" value="birthday" id="event_type">
               <div class="boxes-create-event">
                  <div class="row">
                     <div class="col-md-4 col-sm-6 ">
                        <a class="box-1-text" >
                           <div class="box-1 {{(isset($event_id)?(($event->type=='engagement')?'birthday_active':''):'')}}"  onclick="select(this.id)" id="engagement">
                              <img src="{{ asset('public/assets/imgs/engagement.png') }}" class="mx-auto d-block mt-3 img_block">
                              <p class="p_bloks text-center">Engagement</p>
                           </div>
                        </a>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <a class="box-1-text">
                           <div class="box-1 {{(isset($event_id)?(($event->type=='birthday')?'birthday_active':''):'birthday_active')}}" id="birthday" onclick="select(this.id)">
                              <img src="{{ asset('public/assets/imgs/birthday-cake.png') }}" class="mx-auto d-block mt-3 img_block">
                              <p class="p_bloks text-center">Birthday</p>
                           </div>
                        </a>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <a class="box-1-text">
                           <div class="box-1 {{(isset($event_id)?(($event->type=='wedding')?'birthday_active':''):'')}}" id="wedding" onclick="select(this.id)" >
                              <img src="{{ asset('public/assets/imgs/wedding.png') }}" class="mx-auto d-block mt-3 img_block"  >
                              <p class="p_bloks text-center">Wedding</p>
                           </div>
                        </a>
                     </div>
                     <div class="col-md-4 col-sm-6">
                     <!-- <div class="box-1" id="other" onclick="select(this.id)">
                     <p class="p_others text-center">Others</p>
                  </div> -->
                  <div class="box-1 {{(isset($event_id)?(($event->type!='wedding' && $event->type!='birthday' && $event->type!='engagement' )?'birthday_active':''):'')}}" id="other" onclick="select(this.id)">
                     <p class="p_others text-center">Others</p>
                  </div>
                     </div>
                    
                     <div id="type_of_event" class="col-md-8 mt-40px" style="display: {{(isset($event_id)?(($event->type!='wedding' && $event->type!='birthday' && $event->type!='engagement' )?'block':'none'):'none')}};">
                           <div class="input-bg-preview calendar hide-dev">
                              <label class="lb-start-date w-100 m-0">Type of event</label>
                              <div id="ComboBox">
                                 <input id="other_type" value="{{(isset($event_id))?$event->type:''}}" type="text" >
                                 <select>
                                    <option>Graduation</option>
                                    <option>Baby Shower</option>
                                    <option>Conference</option>
                                    <option>Funeral</option>
                                    <option>Seminar</option>
                                    <option>Reunion</option>
                                    <option>Fundraiser</option>
                                    <option>Bridal Shower</option>
                                    <option>Dinner Party</option>
                                    <option>Others</option>
                                 </select>
                              </div>
                           </div>
                           <label id="type_event_warn" style="color: red;display:none">Type of event is required*</label>
                        </div>
                  </div>
               </div>
               <div class="events-section">
                  <div class="repeat-on-clicl mt-5">
                     <div class="row">
             
                        <div class="col-md-12 mt-30px">
                           <div class="input-bg-preview">
                              <label class="lb-start-date w-100 m-0">Event Code <span class="fa fa-question-circle-o ml-2" style="margin-top: 2px;"  aria-hidden="true" data-toggle="tooltip" data-placement="top" title="This is the code which you will share with other people to join this event. Generate yours or pick random"></span> </label>
                              <div class="input-append date">
                                 <input size="6" id="event_code"  type="text" value="{{(isset($event_id)?$event->event_code:'')}}" required name="event_code">
                                 <span class="add-on" onclick="generate_event_code()"><i class="fa fa-refresh" aria-hidden="true"></i></span>
                              </div>
                           </div>
                           <label style="color: red; display:none" id="code_warn">Event code already exist</label>
                        </div>
                        <!-- <div class="col-md-8 mt-30px">
                           <p class="event-going">How long the event going? (days)</p>
                        </div> -->
                        <!-- <div class="col-md-4 mt-30px">
                           <div id="customFields">
                              <div class="wrap bt-right-counter ml-1">
                                 <button type="button" id="sub" class="sub" >-</button>
                                 <input class="count" type="text" value="1" min="1" max="100"  name="days" id="myInput" readonly/>
                                 <button type="button" id="add" class="add addCF">+</button>
                              </div>
                           </div>
                        </div> -->
                     </div>
                     <div class="row mt-5">
                        <div class="col-md-8">
                           <p class="event-going">Collect Guest Address mailing detail to send invitation</p>
                        </div>
                        <div class="col-md-4">
                           <div class="button-radio">
                              <div class=" btn-radi0-style ">
                                 <label class="tog-radio-label ">
                                 <input type="radio" class="option-input radio" name="collect_info" value="1" {{(isset($event_id)?(($event->collect_info==1)?'checked':''):'')}}  />
                                 Yes
                                 </label>
                                 <label class="tog-radio-label ml-23px">
                                 <input type="radio" class="option-input radio" name="collect_info" value="0"  {{(isset($event_id)?(($event->collect_info==0)?'checked':''):'checked')}}/>
                                 No
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- <div class="row mt-5">
                        <div class="col-md-12">
                           <div class="input-bg-preview">
                              <label class="lb-start-date w-100 m-0">Event Code</label>
                              <div class="input-append date">
                                 <input size="6" id="event_code" type="text" value="" required name="event_code">
                                 <span class="add-on" onclick="generate_event_code()"><i class="fa fa-refresh" aria-hidden="true"></i></span>
                              </div>
                           </div>
                        </div>
                        </div> -->
                  </div>
                  <div class="repeat-on-clicl mt-5">
                     <div class="row">
                        <div class="col-md-8">
                           <p class="event-going">Is an RVSP required for event?</p>
                        </div>
                        <div class="col-md-4">
                           <div class="button-radio">
                              <div class=" btn-radi0-style ">
                                 <label class="tog-radio-label ">
                                 <input type="radio" class="option-input radio" onclick="handleChange('${id}', '${fieldID}', 'true')" id='${id}' name='need_reservation'  {{(isset($event_id)?(($event->need_reservation==1)?'checked':''):'')}} value="yes"/>
                                 Yes
                                 </label>
                                 <label class="tog-radio-label ml-23px">
                                 <input type="radio" class="option-input radio" onclick="handleChange('${id}', '${fieldID}', 'false')" id='${id}' name='need_reservation' {{(isset($event_id)?(($event->need_reservation==0)?'checked':''):'checked')}} value="no"/>
                                 No
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
               </div>
                        <!-- <div class="repeat-on-clicl mt-5">
                           <div class="row">
                              <div class="col-md-8">
                                 <p class="event-going">How many persons allowed?</p>
                              </div>
                              <div class="col-md-4">
                                 <div id="customFields">
                                    <div class="wrap bt-right-counter">
                                       <button type="button"  class="sub-1" >-</button>
                                       <input class="count" type="text" value="1" min="1" max="100"  id="myInput" name="no_of_people[]">
                                       <button type="button"  class="add-1">+</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div> -->
                     </div>
                  <!-- repeat div -->
                  
                     <div id="fields">
                     </div>
                     </div>
                  <!-- end repeat -->
               </div>
            <!-- </div> -->
         <!-- </div> -->
         <div class="text-center end-btn">
            <button type="button" onclick="{{(isset($event_id)?'update_event()':'create_event()')}}" class="btn_next">Next</button>
         </div>
      </form>
   </div>
   <div class="col-md-3"></div>
</div>
<div id="loading"></div>
<script>
   function update_event()
   {
      var counter = 1;
    var move = true;
    var code = $("#event_code").val();
    if($("#type_of_event").is(':visible'))
    {
        if($("#other_type").val()=="")
        {
            $("#type_event_warn").css('display','block');
            move = false;
        }else{
            $('#event_type').val($("#other_type").val());
        }
    }
    $('.create_event_date').each(function() {
        if($(this).val()=="")
        {
          $("#start_date_warn"+counter).css('display','block');
          move = false;
        }else{
            $("#start_date_warn"+counter).css('display','none');
        }
        counter++;
    });
    $.ajax({
        url : '{{url("check_event_code")}}',
        type : 'POST',
        data : {code: code, _token: '{{ csrf_token() }}'},
        success:function(response){
            if(response==false)
            {
               $("#code_warn").css('display','block');
               return false;
            } else {
                $("#code_warn").css('display','none');
                if(move==false){
                    return false;
                }
                $("#preloader").css("display", 'block');
                $("#create_event_form").submit();
            }
        },
    });
   }
   function select(id){
       var v = document.getElementById(id);
       $( "div" ).removeClass( "birthday_active" )
       v.classList.add("birthday_active");
       $('#event_type').val(id); 
       if(id=="other")
       {
          $("#type_of_event").css('display','block');
          $("#other_type").prop('required', true);
       }else{
         $("#type_of_event").css('display','none');
         $("#type_event_warn").css('display','none');
         $("#other_type").prop('required', false);
       }
       // vlue.val(id);
       
   }
   
   function isconfirm(url_val) {
   		// alert(url_val);
   		if (confirm('Are you sure want to cancel?') == false) {
   			return false;
   
   		} else {
   			location.href = url_val;
   
   		}
      }
      var ComboBox = function(container, customStyles) {
     this.container = container;
     this.container.className += ' cb--container';
     this.input = container.getElementsByTagName('input')[0];
     this.input.className += ' cb--input';
     this.select = container.getElementsByTagName('select')[0];
     this.select.className += ' cb--select';
   
     this.value = this.input.value;
   
     var optionZero = document.createElement('option');
     optionZero.innerHTML = 'type of event';
     this.select.insertBefore(optionZero, this.select.options[0]);
   
     this.options = this.select.options;
     for (var i = 0; i < this.options.length; i++) {
       var element = this.options[i];
       element.className += ' cb--option';
     }
   
     this.input.setAttribute('aria-label', 'Special inputfield with '+this.options.length+' prefilled options available, use the down/up arrow keys to chose one or write your own text.');
     this.select.setAttribute('aria-hidden', 'true');
   
     this.addEventListeners();
     this.createVisualHint();
   
     this.hideSelect();
     if(!customStyles) this.setStyles();
   };
   
   ComboBox.prototype.addEventListeners = function() {
     this.input.addEventListener('focus', this.showSelect.bind(this));
     this.input.addEventListener('blur', this.hideSelect.bind(this));
     this.input.addEventListener('keyup', this.handleInput.bind(this));
   
     this.select.addEventListener('focus', this.showSelect.bind(this));
     this.select.addEventListener('change', this.handleSelection.bind(this));
     this.select.addEventListener('keydown', this.handleSelection.bind(this));
     this.select.addEventListener('click', function(e) { this.handleSelection(e, 'click'); }.bind(this));
     this.select.addEventListener('blur', function(e) {
       this.hideSelect();
   
       if(!this.preventTriggerSelection) {
       this.triggerSelection();
       } else { 
         this.preventTriggerSelection = false;
       }
   
     }.bind(this));
   
     return this;
   };
   
   ComboBox.prototype.handleInput = function(e) {
     var code = this.getKey(e);
     if(code === 'ArrowDown') {
       this.handleWriting(e.target.value);
       this.select.focus();
     } else if(code === 'Escape') {
       this.hideSelect();
     } else if(code === 'Enter' && !this.preventDoubleEnter) {
       this.setValue(this.select.value, 'hideSelect');
       this.triggerSelection('force');
     } else {
       this.preventDoubleEnter = false;
       this.handleWriting(this.input.value);
     }
   
     return this;
   };
   
   ComboBox.prototype.handleWriting = function(text) {
     this.value = text;
     var option = this.isTextInOptions(text, this.options);
     if(option && text != '') {
       this.setOptionZero(text);
       this.select.value = option;
   
       // if the text is absolutely equal to the option, trigger a selection
       if(text.length === option.length) this.triggerSelection();
     } else {
       this.select.value = this.setOptionZero(text);
     }
   
     return this;
   };
   
   ComboBox.prototype.isTextInOptions = function(text, options) {
     for(var i = 1, il = options.length; i < il; i++) {
       if(text.toLowerCase() == options[i].value.substring(0, text.length).toLowerCase()) {
         return options[i].innerHTML;
       }
     }
     return false;
   };
   
   ComboBox.prototype.setOptionZero = function(text) {
     var setText = (text != '') ? ' ' + text : '';
     this.options[0].innerHTML = setText;
     return setText;
   };
   
   ComboBox.prototype.handleSelection = function(e, click) {
     var code = this.getKey(e);
     if(code === 'Escape') {
       this.preventTriggerSelection = true;
       this.setValue(this.options[0].value, 'hideSelect');
       // the selection might have changed by user, so to reset
       // the preselection we have to check the input text again
       this.handleWriting(this.value);
     } else if(code === 'Enter') {
       this.preventDoubleEnter = true;
       this.setValue(e.target.value, 'hideSelect');
     } else {
       this.setValue(e.target.value, false);
     }
   
     if(click) this.triggerSelection('force');
   
     return this;
   };
   
   ComboBox.prototype.setValue = function(value, hideSelect) {
     if(!value || value == '') return this;  // do nothing if value is empty
   
     if(value.substring(0, 3) != '---') {  // check if value is not the fallback option
       this.input.value = value;
     } else {  // if it is, don’t add the '--- '
       this.input.value = value.substring(4, value.length);
     }
   
     if(hideSelect) {
       this.input.focus();
       this.hideSelect();
     }
   
     this.value = this.input.value;
   
     return this;
   };
   
   ComboBox.prototype.getKey = function(e) {
     if(!e) return false;
   
     if(e.key === 'Enter' || e.code === 'Enter' || e.keyCode === 13) {
       return 'Enter';
     } else if(e.key === 'Escape' || e.code === 'Escape' || e.keyCode === 27) {
       return 'Escape';
     } else if(e.key === 'ArrowDown' || e.code === 'ArrowDown' || e.keyCode === 40) {
       return 'ArrowDown';
     }
   };
   
   ComboBox.prototype.hideSelect = function() {
     this.select.setAttribute('aria-hidden', 'true');
     this.select.style.left = '-10000px';
     this.select.style.pointerEvents = 'none';
     this.select.style.opacity = 0;
   
     return this;
   };
   
   ComboBox.prototype.showSelect = function() {
     this.select.setAttribute('aria-hidden', 'false');
     this.select.style.left = '0';
     this.select.style.pointerEvents = 'all';
     this.select.style.opacity = 1;
   
     return this;
   };
   
   ComboBox.prototype.createVisualHint = function() {
     this.hint = document.createElement('span');
     this.hint.setAttribute('aria-hidden', 'true');
     this.hint.className = 'cb--hint';
     this.hint.innerHTML = '▼';
     this.container.insertBefore(this.hint, this.input);
   };
   
   ComboBox.prototype.setStyles = function() {
     this.container.style.display = 'inline-block';
     this.container.style.verticalAlign = 'top';
     this.container.style.position = 'relative';
     this.input.style.boxSizing = 'border-box';
     this.input.style.height = '100%';
     this.input.style.width = '100%';
     this.select.style.border = '1px solid lightgrey';
     this.select.style.background = '#E0E9FC';
     this.select.style.borderTop = '0';
     this.select.style.position = 'absolute';
     this.select.style.top = '100%';
     this.select.style.width = '100%';
     this.hint.style.fontSize = '8px';
     this.hint.style.pointerEvents = 'none';
     this.hint.style.position = 'absolute';
     this.hint.style.right = '5%';
     this.hint.style.top = '50%';
     this.hint.style.lineHeight = '0.1';
   
   
     // this makes the down arrow key the only way to select the dropdown via keyboard
     this.select.tabIndex = -1;
     // this is inportant to get a list instead of a dropdown
     this.select.size = 4;
   };
   
   // setup the onSelect handler passed by user
   ComboBox.prototype.onSelect = function(cb) {
     this.cb = cb;
     this.handleInput(this.value);
     return this;
   };
   
   ComboBox.prototype.triggerSelection = function(force) {
     if(force || this.value !== this.previousValue) {
       this.cb(this);
       this.previousValue = this.value;
     }
   
     return this;
   };
   
   
   
   //___
   var element = document.getElementById('ComboBox');
   var cb = new ComboBox(element, false);
   
</script>
@endsection
@push('custom-script')
<script src="{{ asset('public/assets/js/append.js')}}"></script>
<script type="text/javascript">
   function generate_event_code()
   {
      $('#event_code').val(Math.random().toString(36).substr(2, 6));
   }
   
   $(window).on('load', function(){
      "<?php if(!isset($event_id)){ ?>"
      generate_event_code();
      "<?php } ?>"
   });
   function myFunction() {
  document.getElementById("hide-dev").style.display = "block";
}
</script>
@endpush