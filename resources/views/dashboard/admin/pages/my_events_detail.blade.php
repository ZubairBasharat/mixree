@extends('dashboard.admin.app')

@section('content')

<div class="container-fluid">
<div class="row data-viewer">
   
   <!-- /***************
      Right side section start
      *******************/ -->
   <div class="w-100" id="main">
      <!-- /***************
         heder start
         *******************/ -->
      <div class="row data-viewer">
         <div class="d-inline-flex col-md-12 header-search">
            <div class="search-toogle d-inline-flex">
               <div class="d-md-none d-block">
                  <span class="close mr-3" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
               </div>
               <form>
                  <div class="search">
                     <input type="text" placeholder="Search" name="search2">
                     <img class="search-btn" src="../assets/imgs/search-btn.png">
                  </div>
               </form>
            </div>
            <div class="ml-auto d-inline-flex">
               <img class="help" src="../assets/imgs/help.png">
               <img class="notif" src="../assets/imgs/notif.png">
               <div class="dropdown dashbord-dropdown">
                  <button class="btn dropdown-toggle admin-btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img class="dp-icon" src="../assets/imgs/dp-icon.png">
                  <span>David</span>
                  <img class="arrow-down" src="../assets/imgs/arrow-down.png">
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                     <a class="dropdown-item" href="#">
                     Login
                     </a>
                     <a class="dropdown-item" href="#">
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
            <h1 class="events-title">Events / </h1>
            <h1 class="natasha-title ml-2">Natasha’s Wedding</h1>
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
               <li class="d-inline-flex item_nav_active">
                  <img src="../assets/imgs/octicon_info.png" class="icon_tab">
                  <a class="nav-link" href="#">Active</a>
               </li>
               <li class="d-inline-flex item_nav_disable">
                  <img src="../assets/imgs/jam_task-list.png" class="icon_tab">
                  <a class="nav-link" href="#">Event Programs</a>
               </li>
               <li class="d-inline-flex item_nav_disable">
                  <img src="../assets/imgs/whh_foodtray.png" class="icon_tab">
                  <a class="nav-link" href="#">Event menus</a>
               </li>
               <li class="d-inline-flex item_nav_disable">
                  <img src="../assets/imgs/bx-store.png" class="icon_tab">
                  <a class="nav-link" href="#">Vendor</a>
               </li>
               <li class="d-inline-flex item_nav_disable">
                  <img src="../assets/imgs/heroicons-solid_user-group.png" class="icon_tab">
                  <a class="nav-link" href="#">Participant</a>
               </li>
            </ul>
         </div>
      </div>
      <!-- *******************
         Image Section
         ********************-->
      <div class="row data-viewer" >
         <div class="col-md-12">
            <img src="../assets/imgs/mask-Group.png" class="img_slide">
         </div>
      </div>
      <div class="row data-viewer">
         <div class="col-md-12 col-lg-6 d-inline-flex div_wedding">
            <img src="../assets/imgs/male.png">
            <div class="div_detail">
               <p>Wedding</p>
               <h2>Natasha's Wedding</h2>
            </div>
         </div>
         <div class="col-md-2 div_modified">
            <p>Last Modified</p>
            <h2>June 15, 2020</h2>
         </div>
         <div class="col-md-2 div_vendor">
            <p>Vendor</p>
            <h2>56 Vendors</h2>
         </div>
         <div class="col-md-2 div_btn_edit p-0">
            <button class="btn-edit-details"><img class="edit_icon" src="../assets/imgs/ic_round-edit.png"> Edit Details</button>
         </div>
      </div>
      <hr>
      <p class="p_wed_detail">It’s a party to celebrate David Clemon born for the 17th years old. In this sweet seventeen, he become a young and success businessman on developing a product. We hope that he will be join on Forbes 20</p>
      <!-- *******************
         peoples Section
         ********************-->
      <p class="create-events-label mb-12px">People who join this event</p>
      <div class="row data-viewer-event">
         <div class="col-md-6 col-lg-4 coll-4">
           <div class="d-flex">
           <div class="col-50 mt-md-1 mt-1">
                  <div class="create-box ">
                     <div class="row data-viewer">
                        <div class="col-4 pr-md-0">
                           <img src="../assets/imgs/imageedit_4_8890050283.png" class="bg-create">
                        </div>
                        <div class="col-8 pl-md-0">
                           <div class="create-head">
                              <p class="mb-0">Total Guest</p>
                           </div>
                           <div class="create-dash">
                              <span>182 people
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
           <div class="col-50 mt-md-1 mt-1">
                  <div class="create-box ">
                     <div class="row data-viewer">
                        <div class="col-4 pr-md-0">
                           <img src="../assets/imgs/imageedit_6_2212810369.png" class="bg-create">
                        </div>
                        <div class="col-8 pl-md-0">
                           <div class="create-head">
                              <p class="mb-0">Total Guest</p>
                           </div>
                           <div class="create-dash">
                              <span>182 people
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

           </div>
         </div>
         <div class="col-md-12 col-lg-8 coll-8">
            <div class="users-list  mt-3">
               <img class="avatar" src="http://placeimg.com/80/80/people">
               <img class="avatar" src="http://placeimg.com/80/80/animals">
               <img class="avatar" src="http://placeimg.com/80/80/tech">
               <img class="avatar" src="http://placeimg.com/80/80/sport">
               <img class="avatar" src="http://placeimg.com/80/80/people">
               <img class="avatar" src="http://placeimg.com/80/80/animals">
               <img class="avatar" src="http://placeimg.com/80/80/tech">
               <img class="avatar" src="http://placeimg.com/80/80/sport">
               <img class="avatar" src="http://placeimg.com/80/80/animals">
               <img class="avatar" src="http://placeimg.com/80/80/tech">
               <img class="avatar" src="http://placeimg.com/80/80/tech">
               <span class="user-number">
               +76 people
               </span>
            </div>
         </div>
      </div>
      <!-- *******************
         shedule Section
         ********************-->
      <div class="row data-viewer-1">
         <div class="col-md-6 col-lg-6 colll-50 ">
            <p class="create-events-label mt-20px">Schedule</p>
            <div class="d-flex8">
               <div class="coll-4">
                  <div class="shedule-box">
                     <div class="row data-viewer">
                        <div class="col-3">
                           <div class="imag-shedule">
                              <img src="../assets/imgs/clarity_date-solid.png">
                           </div>
                        </div>
                        <div class="col-8">
                           <div class="heading-shedule">
                              Started
                           </div>
                           <div class="shedule-date">
                              June 13, 2020
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="coll-4">
                  <div class="shedule-box shedule-box-3">
                     <div class="row data-viewer">
                        <div class="col-3">
                           <div class="imag-shedule">
                              <img src="../assets/imgs/clarity_date-solid.png">
                           </div>
                        </div>
                        <div class="col-8">
                           <div class="heading-shedule">
                              Second Date
                           </div>
                           <div class="shedule-date">
                              June 13, 2020
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
</div>
               <div class="coll-4 mt-20px">
                  <div class="shedule-box">
                     <div class="row">
                        <div class="col-3">
                           <div class="imag-shedule">
                              <img src="../assets/imgs/clarity_date-solid.png">
                           </div>
                        </div>
                        <div class="col-8">
                           <div class="heading-shedule">
                              Third Date
                           </div>
                           <div class="shedule-date">
                              June 13, 2020
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         <div class="col-md-12 col-lg-6 coll-50">
            <p class="create-events-label mt-20px">Location</p>
            <div class="location-box">
               <div class="row data-viewer">
                  <div class="col-1">
                     <img src="../assets/imgs/location.png">
                  </div>
                  <div class="col-11">
                     <div class="location-head">
                        First Day
                     </div>
                     <div class="address">
                        516 Longbury Dr, Eastbury, Phoenix, 4068, South Africa
                     </div>
                  </div>
               </div>
            </div>
            <div class="location-box mt-16px">
               <div class="row data-viewer">
                  <div class="col-1">
                     <img src="../assets/imgs/location.png">
                  </div>
                  <div class="col-11">
                     <div class="location-head">
                        First Day
                     </div>
                     <div class="address">
                        516 Longbury Dr, Eastbury, Phoenix, 4068, South Africa
                     </div>
                  </div>
               </div>
            </div>
            <div class="location-box mt-16px">
               <div class="row data-viewer">
                  <div class="col-1">
                     <img src="../assets/imgs/location.png">
                  </div>
                  <div class="col-11">
                     <div class="location-head">
                        First Day
                     </div>
                     <div class="address">
                        516 Longbury Dr, Eastbury, Phoenix, 4068, South Africa
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row data-viewer mt-40px">
         <div class="col-md-12 col-lg-6">
            <div class="row data-viewer">
               <div class="col-6">
                  <p class="total-donation">Total Donations</p>
               </div>
               <div class="col-6">
                  <p class="see-details"> See Details</p>
               </div>
               <div class="col-md-6">
                  <div class="row">
                     <div class="col-md-4">
                        <div class="circlewithbg">
                           <img src="../assets/imgs/target.png" class="taer-bg">
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="price-details">
                           $5,000
                        </div>
                        <div class="price-text">
                           Amount expected
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="row data-viewer">
                     <div class="col-md-4">
                        <div class="circlewithbg-navy">
                           <img src="../assets/imgs/raised.png" class="taer-bg">
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="price-details">
                           $3,523
                        </div>
                        <div class="price-text">
                           Rasied so far
                        </div>
                     </div>
                  </div>
               </div>
               <div class="range-img mt-30px">
                  <img src="../assets/imgs/range-slide.png" class="range-sli">
               </div>
               <div class="col-md-12 mt-12px">
                  <p class="wed-text mt-30px">Wedding Registry</p>
                  <div class="list_wedding list-wed-width row data-viewer">
                     <div class="col-md-10">
                        <p class="p_wedding_list">Amazon Wedding Registry</p>
                     </div>
                     <div class="col-md-2">
                        <a href="https:iorhfwesdg.com" target="_blank">
                        <img src="../assets/imgs/expand.png" class="icon_expand ">
                        </a>
                     </div>
                  </div>
                  <div class="list_wedding list-wed-width row data-viewer">
                     <div class="col-md-10">
                        <p class="p_wedding_list">Amazon Wedding Registry</p>
                     </div>
                     <div class="col-md-2">
                        <a href="https:iorhfwesdg.com" target="_blank">
                        <img src="../assets/imgs/expand.png" class="icon_expand ">
                        </a>
                     </div>
                  </div>
                  <div class="list_wedding list-wed-width row">
                     <div class="col-md-10">
                        <p class="p_wedding_list">Amazon Wedding Registry</p>
                     </div>
                     <div class="col-md-2">
                        <a href="https:iorhfwesdg.com" target="_blank">
                        <img src="../assets/imgs/expand.png" class="icon_expand ">
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-12 col-lg-6">
            <div class="row">
               <div class="col-md-6">
                  <p class="total-donation">Fashion Event</p>
               </div>
               <div class="col-md-6">
                  <p class="see-details"> See Details</p>
               </div>
            </div>
            <div class="fashion-box">
               <div class="row">
                  <div class="col-md-4">
                     <div class="fashion-image">
                        <img src="../assets/imgs/0920019250_1_1_3 1.png">
                     </div>
                     <div class="text-fashion">
                        152 items left
                     </div>
                  </div>
                  <div class="col-md-8">
                     <div class="row">
                        <div class="col-6">
                           <p class="total-donation-09">Men Tie</p>
                        </div>
                        <div class="col-6">
                           <p class="see-details-09"> $52.00</p>
                        </div>
                     </div>
                     <div class="fashion-par">
                        <p class="mb-0">Shweshwe Wedding dresses are the most popular choice for wedding stylists and brides alike, infact a Shweshwe Wedding dress is a must have for every woman who dreams of a fairy tale traditional wedding.</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="fashion-box mt-20px">
               <div class="row">
                  <div class="col-md-4">
                     <div class="fashion-image">
                        <img src="../assets/imgs/0920019250_1_1_3 1.png">
                     </div>
                     <div class="text-fashion">
                        152 items left
                     </div>
                  </div>
                  <div class="col-md-8">
                     <div class="row">
                        <div class="col-6">
                           <p class="total-donation-09">Men Tie</p>
                        </div>
                        <div class="col-6">
                           <p class="see-details-09"> $52.00</p>
                        </div>
                     </div>
                     <div class="fashion-par">
                        <p class="mb-0">Shweshwe Wedding dresses are the most popular choice for wedding stylists and brides alike, infact a Shweshwe Wedding dress is a must have for every woman who dreams of a fairy tale traditional wedding.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection