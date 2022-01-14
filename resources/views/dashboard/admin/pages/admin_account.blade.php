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
      <div class="row ps-ab" >
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
   <div class="section-width ">
   <div class="row mt-140px">
      <div class="col-md-9">
       
      </div>
      <div class="col-md-3 ">
         <div class="row">
            <div class="col-md-6 sort-di ">
            <label class="text-end-sort">sort by</label>
            </div>
       <div class="col-md-6">
        <select name=" " class="form-control sort-select" id="" style="width: 100px;">
           <option>sort by</option>
        </select>
         </div>
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
                  <tr class="account-tr">
                     <!-- <th class="checkbox_main">
                        <label class="container_checkbox_all">
                        <input type="checkbox" id="checkbox_main_all" onclick="checkAll(this)">
                        <span class="checkmark_all"></span>
                        </label>
                     </th> -->
                     <th class="p_name th-admin-head">Full Name </th>
                     <th class="p_participants th-admin-head">Email</th>
                     <th class="p_event_started th-admin-head ">Event </th>
                     <th class="p_last_modified th-admin-head">Action</th>
                    
                    
                  </tr>
               </thead>
               <tbody>
                  <tr class="tbl_gray-ac" id="tbl_gray1">
                     <!-- <td class=" ">
                        <label class="container_checkbox">
                        <input type="checkbox" id="checkbox_single1" onclick="myFunction('tbl_gray1','checkbox_single1');">
                        <span class="checkmark-2"></span>
                        </label>
                     </td> -->
                     <td class="name_profile color-black tb-pad">
                        <img class="img_profile_icon" src="../assets/imgs/Img-male.png"><span class="tbl_gray1">Google </span>
                     </td>
                     <td class="txt_participants color-black " id="p_white">10</td>
                     <td class="txt_event_started color-black ">June 9, 2020</td>
                   
                     
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
                  <tr class="tbl_gray-ac" id="tbl_gray2">
                     <!-- <td class=" ">
                        <label class="container_checkbox">
                        <input type="checkbox" id="checkbox_single2" onclick="myFunction('tbl_gray2','checkbox_single2');">
                        <span class="checkmark-2"></span>
                        </label>
                     </td> -->
                     <td class="name_profile color-black tb-pad">
                        <img class="img_profile_icon" src="../assets/imgs/Img-male.png"><span class="tbl_gray2">Google </span>
                     </td>
                     <td class="txt_participants color-black ">10</td>
                     <td class="txt_event_started color-black ">June 9, 2020</td>
   
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
                  <tr class="tbl_gray-ac" id="tbl_gray3">
                     <!-- <td class="">
                        <label class="container_checkbox">
                        <input type="checkbox" id="checkbox_single3" onclick="myFunction('tbl_gray3','checkbox_single3');">
                        <span class="checkmark-2"></span>
                        </label>
                     </td> -->
                     <td class="name_profile color-black tb-pad">
                        <img class="img_profile_icon" src="../assets/imgs/Img-male.png"><span class="tbl_gray3">Apple </span>
                     </td>
                     <td class="txt_participants color-black ">10</td>
                     <td class="txt_event_started color-black ">Mar 9, 2020</td>
                  
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
							<tr class="tbl_gray-ac" id="tbl_gray4">
								<!-- <td class=" ">
									<label class="container_checkbox">
									<input type="checkbox" id="checkbox_single4" onclick="myFunction('tbl_gray4','checkbox_single4');">
									<span class="checkmark-2"></span>
									</label>
								</td> -->
								<td class="name_profile color-black tb-pad">
								<img class="img_profile_icon" src="../assets/imgs/Img-male.png"><span class="tbl_gray4">Apple </span></td>
								<td class="txt_participants color-black ">10</td>
								<td class="txt_event_started color-black ">Mar 9, 2020</td>
						
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
</div>
<div id="sidenav-right" class="sidenav-right">
  <div id="slidebtn" class="slideBtn"></div>  
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
   <!-- sidebar -->
@endsection