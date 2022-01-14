@extends('dashboard.admin.app')

@section('content')

<div class="container-fluid">
<div class="row">

<!-- /***************
   Right side section start
   *******************/ -->
<div class="w-100" id="main">
   <!-- /***************
      heder start
      *******************/ -->
      <div class="row">
      <div class="d-inline-flex1-1 col-md-12 header-search">
         <div class="search-toogle d-inline-flex1-1">
            <div class="d-lg-none d-block">
               <!-- <span class="open mr-3" style="font-size:30px;cursor:pointer" onclick="closeNav()">&#9776;</span> -->
               <span class="close mr-3" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
            </div>
            <form>
               <div class="search">
                  <input type="text" placeholder="Search" name="search2">
                  <img class="search-btn" src="../assets/imgs/search-btn.png">
               </div>
            </form>
         </div>
         <div class="ml-auto d-inline-flex1-1">
            <img class="help" src="../assets/imgs/help.png">
            <img class="notif" src="../assets/imgs/notif.png">
            <div class="dropdown dashbord-dropdown">
               <button class="btn  admin-btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
   <div class="row  mt-30px">
      <div class="col-md-6">
         <h1 class="events-title">Dashboard</h1>
      </div>
   </div>
     <!-- /***************
      Data section
      *******************/ -->
      <div class="row mt-10px">
      <div class="col-md-6 col-lg-3 mt-md-1 mt-1">
          <div class="dashboard-box ">
              <div class="row">
                  <div class="col-4 pr-md-0">
                  <img src="../assets/imgs/imageedit_2_8537823779.png" class="bg-das">
                  </div>
            
             <div class="col-8 pl-md-0 ">
              <div class="das-head">
                  <p class="mb-0">Account Created</p>
              </div>
              <div class="counter-dash">
                  <span>21,000
                  <img src="../assets/imgs/drop-icon.png" class="ml-2">
                  </span>
                  </div>
              </div>
              </div>
          </div>
      </div>
      <div class="col-md-6 col-lg-3 mt-md-1 mt-1">
          <div class="dashboard-box ">
              <div class="row">
                  <div class="col-4 pr-md-0">
                  <img src="../assets/imgs/imageedit_4_8890050283.png" class="bg-das">
                  </div>
            
             <div class="col-8 pl-md-0">
              <div class="das-head">
                  <p class="mb-0">Events Created</p>
              </div>
              <div class="counter-dash">
                  <span>600
                  <img src="../assets/imgs/drop-icon.png" class="ml-2">
                  </span>
                  </div>
              </div>
              </div>
          </div>
      </div>
      <div class="col-md-6 col-lg-3 mt-md-1 mt-1">
          <div class="dashboard-box ">
              <div class="row">
                  <div class="col-4 pr-md-0">
                  <img src="../assets/imgs/imageedit_6_2212810369.png" class="bg-das">
                  </div>
            
             <div class="col-8 pl-md-0">
              <div class="das-head">
                  <p class="mb-0">Notes Created</p>
              </div>
              <div class="counter-dash">
                  <span>15,657
                  <img src="../assets/imgs/drop-red-icon.png" class="ml-2">
                  </span>
                  </div>
              </div>
              </div>
          </div>
      </div>
      <div class="col-md-6 col-lg-3 mt-md-1 mt-1">
          <div class="dashboard-box ">
              <div class="row">
                  <div class="col-4 pr-md-0">
                  <img src="../assets/imgs/imageedit_8_3101651138.png" class="bg-das">
                  </div>
            
             <div class="col-8 pl-md-0">
              <div class="das-head">
                  <p class="mb-0">Media Shared</p>
              </div>
              <div class="counter-dash">
                  <span>58,674
                  <img src="../assets/imgs/drop-red-icon.png" class="ml-2">
                  </span>
                  </div>
              </div>
              </div>
          </div>
      </div>
      <div class="col-md-6 text-right">
      </div>
   </div>
   
@endsection