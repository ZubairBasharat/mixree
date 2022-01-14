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
      Filteration Section
      *******************/ -->
   <div class="row mt-80px ">
      <div class="col-md-6">
         <h1 class="events-title">Menu<span>24 entries</span></h1>
      </div>
      <div class="col-md-6 text-right">
      </div>
   </div>
   <div class="row mt-40px">
      <div class="col-md-10">
         <div class="d-inline-flex">
            <div class="dropdown dashbord-dropdown ml-auto">
               <button class="btn  btn-icon-menu" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <img class="plus_icon" src="../assets/imgs/icon_menu.png">
               </button>
               <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">
                  Acs ( A - Z )
                  </a>
                  <a class="dropdown-item" href="#">
                  Today
                  </a>
               </div>
            </div>
            <!-- <button class="btn-icon-menu"><img class="plus_icon" src="assets/imgs/icon_menu.png"></button> -->
            <button class="btn-events-1">Acs ( A - Z ) <img class="close_icon" src="../assets/imgs/close-icon.png"></button>
            <button class="btn-events-2">Today <img class="close_icon" src="../assets/imgs/close-icon.png"></button>
         </div>
      </div>
      <div class="col-md-2 text-right">
         <div class="ml-auto d-inline-flex">
            <p class="txt_sorted_by">Sorted by</p>
            <p class="span_all"><a href="#">All</a></p>
         </div>
      </div>
   </div>
   <!-- /***************
      Data table
      *******************-->
   <div class="row">
      <div class="col-md-12 p-0">
    <div class="container-1">
  <!-- <input type="radio" id="reset" name="filter"/>
  <label for="reset">Alle</label>
  <input type="radio" id="architecture" name="filter"/>
  <label for="architecture">Architecture</label>
  <input type="radio" id="landscape" name="filter"/>
  <label for="landscape">Landscape</label>
  <input type="radio" id="people" name="filter"/>
  <label for="people">People</label> -->
  <div class="grid">
    <div class="tile architecture"><a href="#img1001"><img class="thumb-img" src="https://unsplash.it/463/234?image=1001" id="image1#{x}"/></a><a class="lightbox" href="#image1#{x}" id="img1001"><img src="https://unsplash.it/600/400?image=1001"/></a></div>
    <div class="tile landscape"><a href="#img1041"><img class="thumb-img" src="https://unsplash.it/555/332?image=1041" id="image2#{x}"/></a><a class="lightbox" href="#image2#{x}" id="img1041"><img src="https://unsplash.it/600/400?image=1041"/></a></div>
    <div class="tile people"><a href="#img1021"><img class="thumb-img" src="https://unsplash.it/641/334?image=1021" id="image3#{x}"/></a><a class="lightbox" href="#image1#{x}" id="img1021"><img src="https://unsplash.it/600/400?image=1021"/></a></div>
    <div class="tile architecture"><a href="#img1002"><img class="thumb-img" src="https://unsplash.it/442/343?image=1002" id="image1#{x}"/></a><a class="lightbox" href="#image1#{x}" id="img1002"><img src="https://unsplash.it/600/400?image=1002"/></a></div>
    <div class="tile landscape"><a href="#img1042"><img class="thumb-img" src="https://unsplash.it/553/437?image=1042" id="image2#{x}"/></a><a class="lightbox" href="#image2#{x}" id="img1042"><img src="https://unsplash.it/600/400?image=1042"/></a></div>
    <div class="tile people"><a href="#img1022"><img class="thumb-img" src="https://unsplash.it/518/442?image=1022" id="image3#{x}"/></a><a class="lightbox" href="#image1#{x}" id="img1022"><img src="https://unsplash.it/600/400?image=1022"/></a></div>
    <div class="tile architecture"><a href="#img1003"><img class="thumb-img" src="https://unsplash.it/497/414?image=1003" id="image1#{x}"/></a><a class="lightbox" href="#image1#{x}" id="img1003"><img src="https://unsplash.it/600/400?image=1003"/></a></div>
    <div class="tile landscape"><a href="#img1043"><img class="thumb-img" src="https://unsplash.it/490/278?image=1043" id="image2#{x}"/></a><a class="lightbox" href="#image2#{x}" id="img1043"><img src="https://unsplash.it/600/400?image=1043"/></a></div>
    <div class="tile people"><a href="#img1023"><img class="thumb-img" src="https://unsplash.it/401/439?image=1023" id="image3#{x}"/></a><a class="lightbox" href="#image1#{x}" id="img1023"><img src="https://unsplash.it/600/400?image=1023"/></a></div>
    <div class="tile architecture"><a href="#img1004"><img class="thumb-img" src="https://unsplash.it/474/349?image=1004" id="image1#{x}"/></a><a class="lightbox" href="#image1#{x}" id="img1004"><img src="https://unsplash.it/600/400?image=1004"/></a></div>
    <div class="tile landscape"><a href="#img1044"><img class="thumb-img" src="https://unsplash.it/476/461?image=1044" id="image2#{x}"/></a><a class="lightbox" href="#image2#{x}" id="img1044"><img src="https://unsplash.it/600/400?image=1044"/></a></div>
    <div class="tile people"><a href="#img1024"><img class="thumb-img" src="https://unsplash.it/487/257?image=1024" id="image3#{x}"/></a><a class="lightbox" href="#image1#{x}" id="img1024"><img src="https://unsplash.it/600/400?image=1024"/></a></div>
    <div class="tile architecture"><a href="#img1005"><img class="thumb-img" src="https://unsplash.it/364/329?image=1005" id="image1#{x}"/></a><a class="lightbox" href="#image1#{x}" id="img1005"><img src="https://unsplash.it/600/400?image=1005"/></a></div>
    <div class="tile landscape"><a href="#img1045"><img class="thumb-img" src="https://unsplash.it/470/325?image=1045" id="image2#{x}"/></a><a class="lightbox" href="#image2#{x}" id="img1045"><img src="https://unsplash.it/600/400?image=1045"/></a></div>
    <div class="tile people"><a href="#img1025"><img class="thumb-img" src="https://unsplash.it/475/367?image=1025" id="image3#{x}"/></a><a class="lightbox" href="#image1#{x}" id="img1025"><img src="https://unsplash.it/600/400?image=1025"/></a></div>
    <div class="tile architecture"><a href="#img1006"><img class="thumb-img" src="https://unsplash.it/430/324?image=1006" id="image1#{x}"/></a><a class="lightbox" href="#image1#{x}" id="img1006"><img src="https://unsplash.it/600/400?image=1006"/></a></div>
    <div class="tile landscape"><a href="#img1046"><img class="thumb-img" src="https://unsplash.it/639/220?image=1046" id="image2#{x}"/></a><a class="lightbox" href="#image2#{x}" id="img1046"><img src="https://unsplash.it/600/400?image=1046"/></a></div>
    <div class="tile people"><a href="#img1026"><img class="thumb-img" src="https://unsplash.it/474/219?image=1026" id="image3#{x}"/></a><a class="lightbox" href="#image1#{x}" id="img1026"><img src="https://unsplash.it/600/400?image=1026"/></a></div>
    <div class="tile architecture"><a href="#img1007"><img class="thumb-img" src="https://unsplash.it/412/289?image=1007" id="image1#{x}"/></a><a class="lightbox" href="#image1#{x}" id="img1007"><img src="https://unsplash.it/600/400?image=1007"/></a></div>
    <div class="tile landscape"><a href="#img1047"><img class="thumb-img" src="https://unsplash.it/458/257?image=1047" id="image2#{x}"/></a><a class="lightbox" href="#image2#{x}" id="img1047"><img src="https://unsplash.it/600/400?image=1047"/></a></div>
    <div class="tile people"><a href="#img1027"><img class="thumb-img" src="https://unsplash.it/446/234?image=1027" id="image3#{x}"/></a><a class="lightbox" href="#image1#{x}" id="img1027"><img src="https://unsplash.it/600/400?image=1027"/></a></div>
    <div class="tile architecture"><a href="#img1008"><img class="thumb-img" src="https://unsplash.it/640/326?image=1008" id="image1#{x}"/></a><a class="lightbox" href="#image1#{x}" id="img1008"><img src="https://unsplash.it/600/400?image=1008"/></a></div>
    <div class="tile landscape"><a href="#img1048"><img class="thumb-img" src="https://unsplash.it/417/330?image=1048" id="image2#{x}"/></a><a class="lightbox" href="#image2#{x}" id="img1048"><img src="https://unsplash.it/600/400?image=1048"/></a></div>
    <div class="tile people"><a href="#img1028"><img class="thumb-img" src="https://unsplash.it/476/237?image=1028" id="image3#{x}"/></a><a class="lightbox" href="#image1#{x}" id="img1028"><img src="https://unsplash.it/600/400?image=1028"/></a></div>
    <div class="tile architecture"><a href="#img1009"><img class="thumb-img" src="https://unsplash.it/547/349?image=1009" id="image1#{x}"/></a><a class="lightbox" href="#image1#{x}" id="img1009"><img src="https://unsplash.it/600/400?image=1009"/></a></div>
    <div class="tile landscape"><a href="#img1049"><img class="thumb-img" src="https://unsplash.it/453/426?image=1049" id="image2#{x}"/></a><a class="lightbox" href="#image2#{x}" id="img1049"><img src="https://unsplash.it/600/400?image=1049"/></a></div>
    <div class="tile people"><a href="#img1029"><img class="thumb-img" src="https://unsplash.it/363/403?image=1029" id="image3#{x}"/></a><a class="lightbox" href="#image1#{x}" id="img1029"><img src="https://unsplash.it/600/400?image=1029"/></a></div>
  </div>
</div>
   </div>
</div>
</div>
@endsection