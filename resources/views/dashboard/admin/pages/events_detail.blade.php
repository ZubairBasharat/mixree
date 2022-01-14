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
                  <button class="btn admin-btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
         <div class="col-md-3 div_modified">
            <p>Last Modified</p>
            <h2>June 15, 2020</h2>
         </div>
         <div class="col-md-3 div_vendor">
            <p>Vendor</p>
            <h2>56 Vendors</h2>
         </div>
         
      </div>
      <hr>
      <p class="p_wed_detail">It’s a party to celebrate David Clemon born for the 17th years old. In this sweet seventeen, he become a young and success businessman on developing a product. We hope that he will be join on Forbes 20</p>
      <!-- *******************
         peoples Section
         ********************-->
      <p class="create-events-label mb-12px">People who join this event</p>
      <div class=" data-viewer-event">
         
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
         <div class="col-md-3  colll-50 ">
            <p class="create-events-label mt-20px">Schedule</p>
            <div class="row">
               <div class="col-md-12">
                  <div class="shedule-box-1 m-0">
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
               <div class="col-md-12">
                  <div class="shedule-box-1 mt-16px">
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
            </div>
         <div class="col-md-9  coll-50">
            <p class="create-events-label mt-20px">Location</p>
            <div class="location-box lcb-padding">
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
            <div class="location-box lcb-padding mt-16px">
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
   </div>

   <div id="sidenav-right" class="sidenav-right">
  <div id="slidebtn" class="slideBtn">&#9776; Click</div>  
<div class="right-side-sidebar">
<div class=" mt-40px">
            <div class="row">
               <div class="col-md-3 pr-md-0">
               <img class="dp-icon-12" src="../assets/imgs/Img-Male-06.png"></div>
               <div class="col-md-6 pl-md-0">
               <span class="staff-name"> Jacob Ginnish</span><br>
               <span class="staff-email">jacob.ginnish@gmail.com</span>
               </div>
            </div>
            </div>
            <div class="mt-40px">
               <p class="jion-table-date">Join since June 26, 2020</p>
            </div>
            <div class="mt-40px">
               <p class="jion-table-date">Memories</p>
            </div>
            <div class="mt-60px">
               <p class="jion-table-date">Memories</p>
            </div>
</div>
</div>

@endsection