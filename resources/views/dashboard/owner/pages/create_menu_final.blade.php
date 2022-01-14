@extends('dashboard.owner.layout')

@section('content')
<div class="container-fluid">
<div class="cross-section">
<a href="my-events.php">
         <div class="text-right">
            <span class="cancel-btn pr-2">Cancel</span>
            <img src="assets/imgs/cross.png" class=" cross-btn">
      </a>
</div>
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
      <p class="head_create_event_2">6. Event Menu (Food & Drink)</p>
      <div class="mt-20px">
         <!-- Section: Live preview -->
         <div class="tabe-sections" >
            <ul class="nav nav-tabs border-0 " id="myTab" role="tablist">
               <li class="nav-item  srt ">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">House Party</a>
               </li>
               <li class="nav-item  srt ">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Club Party</a>
               </li>
               <li class="nav-item srt ">
                  <a class="nav-link " id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true">Garden Party</a>
               </li>
            </ul>
            <div class="tab-content" id="myTabContent">
               <div class="tab-pane active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div id="show-dive-payment">
                     <div class="mt-20px">
                        <div class="row">
                           <div class="col-8">
                              <p class="head_detail_ce-1">Desert</p>
                           </div>
                           <div class="col-4 text-right">
                           </div>
                        </div>
                        <div class="mt-15px">
                           <div id="customFields-1-ad">
                              <div class="row">
                                 <div class="col-md-12 mt-20px">
                                    <div class="form-group">
                                       <div class="input-bg-preview-ex-padding">
                                          <input readonly id="uniqueId" type="text" value="Burger (Beef Burger, Sandwich Burger, Cheese Burger)" />
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 ">
                                    <div class="form-group">
                                       <div class="input-bg-preview-ex-padding">
                                          <input readonly id="uniqueId" type="text" value="Noodles (Spagheti, Indomie, Ramen)" >
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 ">
                                    <div class="form-group">
                                       <div class="input-bg-preview-ex-padding">
                                          <!-- <input readonly id="uniqueId" type="text" ondblclick="onDoubleClick(this)"/> -->
                                          <input readonly id="uniqueId" type="text" value="Complete Fun Dish (Rice, Chicken, Cocktail)" >
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="text-center end-btn">
                        <button class="btn_next-paired">Pair</button>
                     </div>
                     <div class="mt-20px">
                        <div class="row">
                           <div class="col-8">
                              <p class="head_detail_ce-1">Main Course</p>
                           </div>
                           <div class="col-4 text-right">
                           </div>
                        </div>
                        <div class="mt-15px">
                           <div class="row">
                              <div class="col-md-12 ">
                                 <div class="form-group">
                                    <div class="input-bg-preview-ex-padding">
                                       <input readonly  type="text" value="Complete Fun Dish (Rice, Chicken, Cocktail)"/>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 ">
                                 <div class="form-group">
                                    <div class="input-bg-preview-ex-padding">
                                       <input readonly  type="text" value="Complete Delicious Dish (Rice, Chicken, Meat, Soup)"/>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
               </div>
               <div class="tab-pane fade  " id="contact" role="tabpanel" aria-labelledby="contact-tab">
               </div>
               <!-- Section: Live preview -->
            </div>
            <!-- Tab panes -->
         </div>
      </div>
   </div>
</div>
<div class="row mt-80px mb-60px mx-0">
   <div class="col-md-6 col">
      <a class="btn_preview_main"><button class="btn_preview float-right" onclick="eventPreview()" data-toggle="modal" data-target="#exampleModal">Preview</button></a>
   </div>
   <div class="col-md-6 col">
      <a href="my-events.php"><button class="btn_next">Next</button></a>
   </div>
</div>
<div class="col-md-3"></div>

<!-- CREATE EVENT MENU PREVIERW MODEL -->
<div class="modal fade bd-example-modal-sm-create-event" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm burger_model">
      <div class="modal-content border_radius">
         <!-- <div class="img_back_product"> -->
         <div class="div_yellow">
            <img src="assets/imgs/bag.png" class="">
         </div>
         <div class="main_div">
            <div class="row m-0 mt-4">
               <div class="col-md-2 col-sm-2 pl-4 ">
                  <img src="assets/imgs/burger.png" class="">
               </div>
               <div class="col-md-8 col-sm-8 p-0">
                  <h4 class="font-weight-bold mt-1">Burger</h4>
               </div>
            </div>
            <div class="section_list">
               <div class="list_burger row m-0 pt-4">
                  <div class="col-md-10">
                     <p class="p_burger_list">Beef Burger</p>
                  </div>
                  <div class="col-md-2">
                     <img src="assets/imgs/plus-blue.png" class="plus_icon_blue">
                  </div>
               </div>
               <div class="list_burger_active row m-0 mt-3 pt-4">
                  <div class="col-md-10">
                     <p class="p_burger_list text-white">Double Cheese Burger</p>
                  </div>
                  <div class="col-md-2">
                     <img src="assets/imgs/tick.png" class="tickicon">
                  </div>
               </div>
               <div class="list_burger row m-0 mt-3 pt-4">
                  <div class="col-md-10">
                     <p class="p_burger_list">Cheese Burger</p>
                  </div>
                  <div class="col-md-2">
                     <img src="assets/imgs/plus-blue.png" class="plus_icon_blue">
                  </div>
               </div>
               <div class="list_burger row m-0 mt-3 pt-4">
                  <div class="col-md-10">
                     <p class="p_burger_list">Turkey Burger</p>
                  </div>
                  <div class="col-md-2">
                     <img src="assets/imgs/plus-blue.png" class="plus_icon_blue">
                  </div>
               </div>
            </div>
            <div class="row m-0">
               <div class="col-md-2 col-sm-2 pl-4 ">
                  <img src="assets/imgs/pizza.png" class="">
               </div>
               <div class="col-md-8 col-sm-8 p-0">
                  <h4 class="font-weight-bold mt-1">Pizza</h4>
               </div>
            </div>
            <div class="section_list">
               <div class="list_burger_active row m-0 pt-4">
                  <div class="col-md-10">
                     <p class="p_burger_list text-white">Double Cheese Burger</p>
                  </div>
                  <div class="col-md-2">
                     <img src="assets/imgs/tick.png" class="tickicon">
                  </div>
               </div>
               <div class="list_burger row mt-3 m-0 pt-4">
                  <div class="col-md-10">
                     <p class="p_burger_list">Beef Burger</p>
                  </div>
                  <div class="col-md-2">
                     <img src="assets/imgs/plus-blue.png" class="plus_icon_blue">
                  </div>
               </div>
               <div class="list_burger row m-0 mt-3 pt-4">
                  <div class="col-md-10">
                     <p class="p_burger_list">Cheese Burger</p>
                  </div>
                  <div class="col-md-2">
                     <img src="assets/imgs/plus-blue.png" class="plus_icon_blue">
                  </div>
               </div>
               <div class="list_burger row m-0 mt-3 pt-4">
                  <div class="col-md-10">
                     <p class="p_burger_list">Turkey Burger</p>
                  </div>
                  <div class="col-md-2">
                     <img src="assets/imgs/plus-blue.png" class="plus_icon_blue">
                  </div>
               </div>
            </div>
         </div>
         <div class="bottom_nav_burger p-0"></div>
      </div>
   </div>
</div>
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
</script>
@endsection