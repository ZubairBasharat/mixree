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
         <div class="table-main">
            <table id="example" class="table my-tbl-style " style="width:100%">
               <thead>
                  <tr>
                     <th class="checkbox_main">
                        <label class="container_checkbox_all">
                        <input type="checkbox" id="checkbox_main_all" onclick="checkAll(this)">
                        <span class="checkmark_all"></span>
                        </label>
                     </th>
                     <th class="p_name">Name <img class="icon_sorting" src="../assets/imgs/Group-642.png"></th>
                     <th class="p_participants">Application<img class="icon_sorting" src="../assets/imgs/Group-642.png"></th>
                     <th class="p_event_started">Dish<img class="icon_sorting" src="../assets/imgs/Group-642.png"></th>
                     <th class="p_last_modified">Drink<img class="icon_sorting" src="../assets/imgs/Group-642.png"></th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  <tr class="tbl_gray" id="tbl_gray1">
                     <td class=" ">
                        <label class="container_checkbox">
                        <input type="checkbox" id="checkbox_single1" onclick="myFunction('tbl_gray1','checkbox_single1');">
                        <span class="checkmark-2"></span>
                        </label>
                     </td>
                     <td class="name_profile color-black">
                        <img class="img_profile_icon" src="../assets/imgs/Img-male.png"><span class="tbl_gray1">Grandpa Funeral  </span>
                     </td>
                     <td class="txt_participants color-black " id="p_white">yes</td>
                     <td class="txt_event_started color-black "> 9</td>
                     <td class="txt_last_modified color-black "> 13</td>
                     <td>
                        <p class="custem_doted tbl_gray1 cursor" class="btn dropdown-toggle btn_doted_dropdown" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></p>
                        <div class="dropdown-menu dropdown_custem_style" aria-labelledby="dropdownMenuButton">
                           <a class="dropdown-item" href="#">
                           Login
                           </a>
                           <a class="dropdown-item" href="#">
                           Logout
                           </a>
                        </div>
                     </td>
                  </tr>
                  <tr class="tbl_gray" id="tbl_gray2">
                     <td class=" ">
                        <label class="container_checkbox">
                        <input type="checkbox" id="checkbox_single2" onclick="myFunction('tbl_gray2','checkbox_single2');">
                        <span class="checkmark-2"></span>
                        </label>
                     </td>
                     <td class="name_profile color-black">
                        <img class="img_profile_icon" src="../assets/imgs/Img-male.png"><span class="tbl_gray2">Grandpa Funeral  </span>
                     </td>
                     <td class="txt_participants color-black ">yes</td>
                     <td class="txt_event_started color-black ">9</td>
                     <td class="txt_last_modified color-black "> 13</td>
                     <td>
                        <p class="custem_doted tbl_gray2 cursor" class="btn dropdown-toggle btn_doted_dropdown" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></p>
                        <div class="dropdown-menu dropdown_custem_style" aria-labelledby="dropdownMenuButton">
                           <a class="dropdown-item" href="#">
                           Login
                           </a>
                           <a class="dropdown-item" href="#">
                           Logout
                           </a>
                        </div>
                     </td>
                  </tr>
                  <tr class="tbl_gray" id="tbl_gray3">
                     <td class="">
                        <label class="container_checkbox">
                        <input type="checkbox" id="checkbox_single3" onclick="myFunction('tbl_gray3','checkbox_single3');">
                        <span class="checkmark-2"></span>
                        </label>
                     </td>
                     <td class="name_profile color-black ">
                        <img class="img_profile_icon" src="../assets/imgs/Img-male.png"><span class="tbl_gray3">Grandpa Funeral  </span>
                     </td>
                     <td class="txt_participants color-black ">yes</td>
                     <td class="txt_event_started color-black "> 9</td>
                     <td class="txt_last_modified color-black "> 13</td>
                     <td class="">
                        <p class="custem_doted tbl_gray3 cursor" class="btn dropdown-toggle btn_doted_dropdown" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></p>
                        <div class="dropdown-menu dropdown_custem_style" aria-labelledby="dropdownMenuButton">
                           <a class="dropdown-item" href="#">
                           Login
                           </a>
                           <a class="dropdown-item" href="#">
                           Logout
                           </a>
                        </div>
        		</div>
							</td>
							</tr>
							<tr class="tbl_gray" id="tbl_gray4">
								<td class=" ">
									<label class="container_checkbox">
									<input type="checkbox" id="checkbox_single4" onclick="myFunction('tbl_gray4','checkbox_single4');">
									<span class="checkmark-2"></span>
									</label>
								</td>
								<td class="name_profile color-black">
								<img class="img_profile_icon" src="../assets/imgs/Img-male.png"><span class="tbl_gray4">Grandpa Funeral  </span></td>
								<td class="txt_participants color-black ">yes</td>
								<td class="txt_event_started color-black "> 9</td>
								<td class="txt_last_modified color-black ">13</td>
								<td>
									<p class="custem_doted tbl_gray4 cursor" class="btn dropdown-toggle btn_doted_dropdown" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></p>
									<div class="dropdown-menu dropdown_custem_style" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="#">
										Login
										</a>
										<a class="dropdown-item" href="#">
										Logout
										</a>
									</div>
								</td>
							</tr>
							</tbody>
					</table>
      </div>
   </div>
</div>
@endsection