<?php
    $user_info= Auth::user();
    $url= url()->current();


$value= basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));


    //exit;
?>
<div class="side_bar sidenav" id="mySidenav">
   <div class="d-inline-flex logo">
      <img class="logo-img" src="{{ asset('/public/assets/imgs/vector.png') }}">
      <p class="logo-txt">Mixrre</p>
   </div>
   <!-- NavLinks -->
   <ul class="navbar-nav dashbord-nav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <li class="nav-item d-inline-flex active">
         <img class="nav-img" src="{{ asset('/public/assets/imgs/clarity_event-solid-alerted.png') }}">
         <a class="nav-link text-white nav-txt" href="{{ url('dashboard') }}">My Events</a>
      </li>
      <!-- <li class="nav-item d-inline-flex mt-26px">
         <img class="nav-img" src="{{ asset('/public/assets/imgs/ant-design_control-filled.png') }}">
         <a class="nav-link text-white nav-txt" id="guestAccess" href="#">Access Controls</a>
      </li>
      <div class="subMenuGuest">
         <li class="nav-item d-inline-flex mt-26px">
            <a class="nav-link text-white nav-txt pl-3" href="{{ url('guest-access') }}">Guest Access</a>
         </li>
      </div> -->
      <li class="nav-item d-inline-flex mt-26px">
         <img class="nav-img" src="{{ asset('/public/assets/imgs/si-glyph_person-people.png') }}">
         <a class="nav-link text-white nav-txt" href="#">Events Manager</a>
      </li>
      <!-- <li class="nav-item d-inline-flex mt-26px">
         <img class="nav-img" src="{{ asset('/public/assets/imgs/bx_bxs-store.png') }}">
         <a class="nav-link text-white nav-txt" href="#">Vendor</a>
      </li> -->
      <li class="nav-item d-inline-flex logout-tab ">
         <img class="nav-img" src="{{ asset('/public/assets/imgs/simple-line-icons_logout.png') }}">
         <a class="nav-link text-white nav-txt" href="{{ url('logout')}}">Log out</a>
      </li>
   </ul>
   <!-- Nav Links end-->
</div>
<script>
   //read notification
    function read_notification(id)
    {
       $.ajax({
          url : "{{url('read_notification')}}",
          type : 'post',
          data : {notification_id: id, '_token': '{{ csrf_token() }}'},
          success:function(response)
          {
             $("#new_notifications").text(response);
             $("#notificatio_"+id).css('color','');
          }
       });
    }

    //read all notifications
    function mark_all_read()
    {
      $.ajax({
          url : "{{url('mark_all_read')}}",
          type : 'GET',
          data : {'_token': '{{ csrf_token() }}'},
          success:function(response)
          {
             $("#new_notifications").text(response);
             $(".notifications").css('color','');
          }
       });
    }
   </script>