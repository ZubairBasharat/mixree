@extends('dashboard.owner.app')

@section('content')
<style type="text/css">
   .avatar-upload-cover .avatar-preview{
      height: 200px !important;
   }
   .avatar-upload {
  position: relative !important;
  max-width: 100px !important;
  margin: 0px auto 20px auto !important;
}
.avatar-upload .avatar-edit {
  position: absolute !important;
  right: 12px !important;
  z-index: 1 !important;
  top: 10px !important;
}
.avatar-upload .avatar-edit input {
  display: none !important;
}
.avatar-upload .avatar-edit input + label {
  display: inline-block !important;
  width: 34px !important;
  height: 34px !important;
  margin-bottom: 0 !important;
  border-radius: 100% !important;
  background: #FFFFFF !important;
  border: 1px solid transparent !important;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12) !important;
  cursor: pointer !important;
  font-weight: normal !important;
  transition: all 0.2s ease-in-out !important;
  position: absolute;
    bottom: 0px;
    right: -9px;
}
.avatar-upload .avatar-edit input + label:hover {
  background: #f1f1f1 !important;
  border-color: #d6d6d6 !important;
}
.avatar-upload .avatar-edit input + label:after {
  content: "\f040" !important;
    font-family: 'FontAwesome' !important;
    color: #757575 !important;
    position: absolute !important;
    bottom: 10px !important;
    top: inherit !important;
    left: inherit !important;
    right: 0 !important;
    text-align: center !important;
    margin: auto !important;
}
.avatar-upload .avatar-preview {
  width: 100px !important;
  height: 100px !important;
  position: relative !important;
  border-radius: 100% !important;
  border: 3px solid #57576f!important;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1) !important;
}
.avatar-upload .avatar-preview > div {
  width: 100% !important;
  height: 100% !important;
  border-radius: 100% !important;
  background-size: cover !important;
  background-repeat: no-repeat !important;
  background-position: center !important;
}
.fa-camera{
   padding: 8px;
    background: blue;
    border-radius: 50%;
    border: 2px solid white;
    position: absolute;
    bottom: 0px;
    right: 0px;
    z-index: 1;
    color: white;
}
.mtNegative .nav-item {
    border: 0px solid #3a77f6;
}
.mtNegative .nav-tabs .nav-link{
   border: 0px solid;
   color: #6c757d9e !important;
}
.mtNegative .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
   border-bottom: 2px solid #428cf8;
   color: black !important;
}
.mtNegative .nav-item:hover{
   border-left: 0px solid;
}
.input-bg-preview{
   padding: 5px 18px;
}
</style>
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
      <div class="d-inline-flex col-md-12 header-search">
         <div class="search-toogle d-inline-flex">
            <div class="d-lg-none d-block">
               <!-- <span class="open mr-3" style="font-size:30px;cursor:pointer" onclick="closeNav()">&#9776;</span> -->
               <span class="close mr-3" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
            </div>
            <form>
               <div class="search">
                  <input type="text" placeholder="Search" name="search2">
                  <img class="search-btn" src="{{ asset('public/assets/imgs/search-btn.png') }}">
               </div>
            </form>
         </div>
         <div class="ml-auto d-inline-flex">
            <!-- <img class="help" src="{{ asset('public/assets/imgs/help.png') }}"> -->
           
            <div class="panel panel-default">
              <div class="panel-body">
                <!-- Single button -->
                <div class="btn-group pull-right top-head-dropdown">
                  <button type="button" class="btn btn-default dropdown-toggle p-0 bgTransparent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <img class="notif" src="{{ asset('public/assets/imgs/notif.png') }}"> <span class="caret"></span>
                  </button>
                  <div>
                     
                     <ul class="dropdown-menu dropdown-menu-right pt-0 position-relative">
                        <div class="d-inline-flex w-100 " 
                        style="background: #FACA43;
                        padding: 18px 16px;
                        border-top-left-radius: 10px;
                        border-top-right-radius: 10px;">
                           <p class="my-auto">Your Notifications</p>
                           <button type="button" class="btn btn-danger font-weight-light ml-auto font-12 px-3"><label id="new_notifications">{{App\Notification::where('notify_to',Auth::user()->id)->where('status',1)->count()}}</label> New</button>
                        </div>
                        <div class="text-center py-2" style="cursor: default;" onclick="mark_all_read()" >
                           <a class="text-secondary" >
                              Mark all as read
                           </a>
                        </div>
                     <div class="notifMain" style="overflow: auto;height: 290px;">
                     @foreach($notifications as $notification)
                        <li class="px-2 py-1" onclick="read_notification('{{$notification->id}}')">
                      <a href="#" class="top-text-block new py-2">
                        <div class="d-inline-flex w-100">
                           <img class="mr-2 iconNotification mt-1" src="{{(empty($notification->notify_by->image))?asset('/public/assets/imgs/default-user-image.png'):asset($notification->notify_by->image) }}">
                           <div>
                              <div class="top-text-heading mb-1 font-12 notifications" id="notificatio_{{$notification->id}}" style="color:{{($notification->status==1)?'#007bff':''}}">{{$notification->message}}</div>
                              <div class="top-text-light font-10">{{\Carbon\Carbon::createFromTimeStamp(strtotime($notification->created_at))->diffForHumans()}}</div>
                           </div>
                        </div>
                      </a> 
                    </li>
                   @endforeach 
                   <!-- <li>
                    <div class="loader-topbar"></div>
                   </li> -->
                     </div>
                  </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="dropdown dashbord-dropdown">
               <button class="btn dropdown-toggle admin-btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if($user->image)
               <img class="dp-icon" src="{{ asset($user->image) }}" style="border-radius:50% !important">
               @else
               <img class="dp-icon" src="{{ asset('public/assets/imgs/user_profile.jpeg') }}">
               @endif
               @if($user->name)
               <span>{{ucwords($user->name)}}</span>
               @else
               <span>{{substr($user->email,0,11)}}...</span>
               @endif
               <img class="arrow-down" src="{{ asset('public/assets/imgs/arrow-down.png') }}">
               </button>
               <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="{{ url('profile-account')}}">
                     Edit Profile
                  </a>
                  <a class="dropdown-item" href="{{ url('logout')}}">
                  Logout
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>

    <!-- /***************
      cover  upload
      *******************/ -->
      <form method="post" id="update_form" action="{{url('update-profile')}}" enctype="multipart/form-data">
      @csrf
         <div class="row mt-4">
            <div class="col-md-12">
            @if(session('success_msg'))
               <div class="alert alert-success alert-dismissible fade show" role="alert">
               {{session('success_msg')}}
                  <button type="button" class="close" data-dismiss="alert" style="padding:0;right:12px" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
            @endif
               <div class="avatar-upload-cover mb-md-0 mb-2 position-relative">
                  <div class="avatar-edit">
                     <input type="file" style="display: none;" name="cover_image" id="imageUpload-cover" accept=".png, .jpg, .jpeg" name="bg_img">
                     <label for="imageUpload-cover"></label>
                  </div>
                  <div class="avatar-preview">
                     <div id="imagePreview-cover" style="border-radius:14px;background-image: url({{(empty(Auth::user()->cover_image))?asset('/public/assets/imgs/coverBg.png'):asset(Auth::user()->cover_image)}});">
                     </div>
                  </div>
                     <img class="changeCover" src="{{ asset('public/assets/imgs/changeCover.png') }}">
               </div>
            </div>
         </div>

    <!-- /***************
      dp  upload
      *******************/ -->
      <div class="row mx-0 mtNegative px-3">
         <div class="col-md-4">
            <div class="bg-white rounded-5 py-5">
                   <div class="avatar-upload">
                     <i class="fa fa-camera"></i>
                       <div class="avatar-edit">
                           <input type='file' name="image" id="imageUpload" accept=".png, .jpg, .jpeg" />
                           <label for="imageUpload">
                              
                           </label>
                       </div>
                       <div class="avatar-preview">
                           <div id="imagePreview" style="background-image: url({{(empty(Auth::user()->image))?asset('/public/assets/imgs/default-user-image.png'):asset(Auth::user()->image)}});">
                           </div>
                       </div>
                   </div>
               <h1 class="h4 text-center font-weight-bold">{{Auth::user()->name}}</h1>
               <p class="text-center text-secondary">{{Auth::user()->email}}</p>
               <div class="px-4 w-100 mt-4">
                  <div class="eventAlertMain w-100 d-inline-flex border-bottom pb-2">
                     <img src="{{ asset('public/assets/imgs/eventAlert.png') }}">
                     <h5>Events</h5>
                     <h6 class="ml-auto">
                     @php $total_events = 0; @endphp
                     @foreach($event as $eve_detail)
                     @if($eve_detail->event_details)
                     @php $total_events++; @endphp
                     @endif
                     @endforeach
                        <a href="{{url('dashboard')}}">{{$total_events}}</a>
                     </h6>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-8 mt-md-0 mt-3">
            <div class="bg-white rounded-5 py-5">
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                 <li class="nav-item px-4">
                   <a class="nav-link active px-0" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Account Settings</a>
                 </li>
                 <li class="nav-item px-4">
                   <a class="nav-link px-0" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Notifications</a>
                 </li>
                 <li class="nav-item px-4">
                   <a class="nav-link px-0" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Change Password</a>
                 </li>
               </ul>
               <div class="tab-content mt-4" id="myTabContent">
                 <div class="tab-pane fade show active px-4" id="home" role="tabpanel" aria-labelledby="home-tab">
                       <div class="form-group">
                           <div class="input-bg-preview">
                               <label class="lb-start-date w-100 m-0"> Email Address</label>
                               <input  type="email" value="{{Auth::user()->email}}" readonly placeholder="" >
                            </div>
                       </div>
                       <div class="form-group">
                           <div class="input-bg-preview">
                               <label class="lb-start-date w-100 m-0"> Full Name</label>
                               <input  type="text" maxlength="16" id="full_name" name="full_name" value="{{Auth::user()->name}}" placeholder="" >
                            </div>
                            <label id="full_name_warn" style="color: red;display:none">Full name required *</label>
                       </div>
                       <!-- <div class="form-group">
                           <div class="input-bg-preview">
                               <label class="lb-start-date w-100 m-0"> Password</label>
                               <input  type="password" placeholder="" >
                            </div>
                       </div> -->
                 </div> 
                 <div class="tab-pane fade px-4" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                       <div class="d-inline-flex w-100 my-2">
                          <h3 class="h6 font-weight-bold mb-0">Guest</h3>
                          <label class="switch ml-auto">
                             <input name="guest_notification" type="checkbox" {{(Auth::user()->guest_notification==1)?'checked':''}}>
                             <span class="slider round"></span>
                           </label>
                       </div>
                       <!-- <div class="d-inline-flex w-100 my-2">
                          <h3 class="h6 font-weight-bold mb-0">Event Manage</h3>
                          <label class="switch ml-auto">
                             <input type="checkbox">
                             <span class="slider round"></span>
                           </label>
                       </div> -->
                       <!-- <div class="d-inline-flex w-100 my-2">
                          <h3 class="h6 font-weight-bold mb-0">Vendor</h3>
                          <label class="switch ml-auto">
                             <input type="checkbox" checked>
                             <span class="slider round"></span>
                           </label>
                       </div> -->
                 </div>
                 <div class="tab-pane fade px-4" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                 <div class="form-group">
                           <div class="input-bg-preview">
                               <label class="lb-start-date w-100 m-0">Old Password</label>
                               <input id="old_password" maxlength="8" name="old_password" type="password" placeholder="" >
                            </div>
                            <label id="old_password_warn" style="color: red; display:none">Old Password not match</label>
                       </div>
                       <div class="form-group">
                           <div class="input-bg-preview">
                               <label class="lb-start-date w-100 m-0">New Password</label>
                               <input id="new_password" maxlength="8" name="new_password" type="password" placeholder="" >
                            </div>
                       </div>
                       <div class="form-group">
                           <div class="input-bg-preview">
                               <label class="lb-start-date w-100 m-0">Confirm Password</label>
                               <input id="cnfrm_password" maxlength="8" type="password" name="cnfrm_password" placeholder="" >
                            </div>
                            <label id="cnfrm_password_warn" style="color: red; display:none">Confirm Password not match</label>
                       </div>
                 </div>
               </div>
            </div>
         </div>
         <div class="w-100 border-top pt-4 mt-4 text-center">
            <button type="button" onclick="submit_form()" class="btn btn-success accountSettingSubmit">Update</button>
         </div>
      </div>
        </div>
        </form>
   </div>
</div>
<script>
   
</script>
@endsection