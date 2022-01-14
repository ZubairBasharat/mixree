@extends('dashboard.owner.layout')

@section('content')

<div class="container-fluid signup-cols-container">
<div class="row signup-cols">
   <div class="col-md-5 signup-cols-container">
      <div class="signup-inner">
         <h1 class="mixrre-title1">Sign up for your account</h1>
         <div class="d-inline-flex">
            <p class="mixrre-titlep">Already have an account?</p>
            <a class="mixrre-titlea" href="{{ url('signin') }}">Log in</a>
         </div>
         
                @if(session('success_message'))
				    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success_message')}}
                    <button type="button" class="close" style="padding:0;right:12px" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
				@endif
				
				
         <div class="login-inputs">
            <form action="{{ url('user_registration')}}" id="registration_form" method="post">
                {{ csrf_field() }}
 					 
			        <div class="input-bg-preview" >
                    	 <div class="field">
					<input type="email" name="email" id="email" placeholder="Enter Email" value="{{ old('email') }}" required>
					<label for="email">Email</label>
 					 </div>
                    </div>
                    <label id="invalid_email_warn" style="color: red;display:none">Invalid Email</label>
                    @if ($errors->has('email'))

                    <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">

                    {{ $errors->first('email') }}
                    <button type="button" class="close" style="padding:0;right:12px" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>

                    @endif
                    
                    
                  <div class="input-bg-preview mt-15px " >
                     <div class="material-form-field">
                        <input type="text" name="user_name" maxlength="16" value="{{ old('user_name') }}" required>
                        <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">First Name</label>
                     </div>
                  </div>
                  
                       @if ($errors->has('user_name'))
					   
					    <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
                        The first name may only contain letters. 
                        <button type="button" class="close" style="padding:0;right:12px" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>

                        @endif

                  <div class="input-bg-preview mt-15px">
                     <div class="material-form-field">
                        <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                        <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Last Name</label>
                     </div>
                  </div>
                  
                       @if ($errors->has('last_name'))
					   
					    <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
                        {{ $errors->first('last_name') }}
                        <button type="button" class="close" style="padding:0;right:12px" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>

                        @endif

                  <div class="input-bg-preview mt-15px">
                     <div class="material-form-field">
                        <input type="password" minlength="6" name="password" value="{{ old('password') }}" required>
                        <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Password</label>
                     </div>
                  </div>
                  
                        @if ($errors->has('password'))
					   
					   <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
                        {{ $errors->first('password') }}
                        <button type="button" class="close" style="padding:0;right:12px" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>

                        @endif
                    
                    
                  <div class="col-auto mt-19px p-0">
                     <label class="container-checkbox-3"> Accept Terms and Conditions
                     <input type="checkbox" required>
                     <span class="checkmark-3"></span>
                     </label>
                  </div>
                  <button type="submit" class="btn btn-primary signup-btn"><a style="color:#2F3034;">Sign up</a></button>
            </form>
            <img class="w-100 mt-15px" src="{{ asset('public/assets/imgs/or.png') }}">
            <button type="submit" class="btn btn-primary signup-btn google-btn mt-15px">
            <img src="{{ asset('public/assets/imgs/google-icon.png') }}">
            <a href="{{ url('auth/google') }}">Login with Google</a>
            </button>
            <button type="submit" class="btn btn-primary signup-btn fb-btn mt-15px">
            <img src="{{ asset('public/assets/imgs/fb-icon.png') }}">
            <a href="{{ url('auth/facebook') }}">Login with Facebook</a>
            </button>
            </div>
         </div>
      </div>
      <div class="col-md-7 login-bg-right text-center signup-cols-container">
         <div class="signup-logo-inner">
            <img class="signup-img" src="{{ asset('public/assets/imgs/vector.png') }}">
            <h1 class="mixrre-title">Mixrre</h1>
         </div>
      </div>
   </div>
</div>
<!-- <div class="form">
   <h1>Pure CSS floating label input</h1>
   
   <br />
   
   <div class="floating">
     <input id="input__username" class="floating__input" name="username" type="text" placeholder="Username" />
     <label for="input__username" class="floating__label" data-content="Username">
     <span class="hidden--visually">
       Username</span></label>
   </div>
   
   <div class="floating">
     <input id="input__password" type="password" class="floating__input" name="password" type="text" placeholder="Password" />
     <label for=" label-name" class="floating__label" data-content="Password"><span class="hidden--visually label-name">Password</span></label>
   </div>
   
   <button class="button">Log in</button>
   </div> -->
   
<!--<div class="container-fluid signup-cols-container">-->
<!--	<div class="row signup-cols">-->
<!--		<div class="col-md-5 signup-cols-container">-->
<!--			<div class="signup-inner">-->
<!--					<h1 class="mixrre-title1">Sign up for your account</h1>-->
<!--				<div class="d-inline-flex">-->
<!--					<p class="mixrre-titlep">Already have an account?</p><a class="mixrre-titlea" href="{{ url('signin') }}">Log in</a>-->
<!--				</div>-->
				
<!--				@if(session('success_message'))-->
<!--				 <div class="alert alert-success alert-dismissible fade show" role="alert">-->
<!--                    {{session('success_message')}}-->
<!--                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
<!--                    <span aria-hidden="true">&times;</span>-->
<!--                    </button>-->
<!--                    </div>-->
<!--					@endif-->
				
<!--				<div class="login-inputs">-->
<!--					<form action="{{ url('user_registration')}}" method="post">-->
<!--					    {{ csrf_field() }}-->
					    
<!--					  <div class="form-group">-->
<!--					    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email Address" name="email" value="{{ old('email') }}" required>-->
<!--					  </div>-->
					  
<!--					  @if ($errors->has('email'))-->

<!--                    <div class="alert alert-danger alert-dismissible fade show" role="alert">-->
<!--                    {{ $errors->first('email') }}-->
<!--                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
<!--                    <span aria-hidden="true">&times;</span>-->
<!--                    </button>-->
<!--                    </div>-->

<!--                    @endif-->
                    
<!--					  <div class="form-group mt-15px">-->
<!--					    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="First Name" name="user_name" value="{{ old('user_name') }}" required>-->
<!--					  </div>-->
					  
<!--					    @if ($errors->has('user_name'))-->
					   
<!--					    <div class="alert alert-danger alert-dismissible fade show" role="alert">-->
<!--                        The first name may only contain letters. -->
<!--                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
<!--                        <span aria-hidden="true">&times;</span>-->
<!--                        </button>-->
<!--                        </div>-->

<!--                        @endif-->
                        
<!--					  <div class="form-group mt-15px">-->
<!--					    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" required>-->
<!--					  </div>-->
					  
<!--					  @if ($errors->has('last_name'))-->
					   
<!--					    <div class="alert alert-danger alert-dismissible fade show" role="alert">-->
<!--                        {{ $errors->first('last_name') }}-->
<!--                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
<!--                        <span aria-hidden="true">&times;</span>-->
<!--                        </button>-->
<!--                        </div>-->

<!--                        @endif-->
                      
<!--					  <div class="form-group mt-15px">-->
<!--					    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password" name="password" value="{{ old('password') }}" required>-->
<!--					  </div>-->
					  
<!--					  @if ($errors->has('password'))-->
					   
<!--					   <div class="alert alert-danger alert-dismissible fade show" role="alert">-->
<!--                        {{ $errors->first('password') }}-->
<!--                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
<!--                        <span aria-hidden="true">&times;</span>-->
<!--                        </button>-->
<!--                        </div>-->

<!--                        @endif-->
                    
<!--					  <div class="col-auto mt-19px p-0">-->
<!--					    <label class="container-checkbox-3"> Accept Terms and Conditions-->
<!--						  <input type="checkbox" required>-->
<!--						  <span class="checkmark-3"></span>-->
<!--						</label>-->
<!--					  </div>-->
<!--					  <button type="submit" class="btn btn-primary signup-btn"><a>Sign up</a></button>-->
<!--					</form>-->
<!--					<img class="w-100 mt-15px" src="assets/imgs/or.png">-->
<!--					<button type="submit" class="btn btn-primary signup-btn google-btn mt-15px">-->
<!--						<img src="assets/imgs/google-icon.png">-->
<!--						<a href="{{ url('auth/google') }}">Login with Google</a>-->
<!--					</button>-->
<!--					<button type="submit" class="btn btn-primary signup-btn fb-btn mt-15px">-->
<!--						<img src="assets/imgs/fb-icon.png">-->
<!--						<a href="{{ url('auth/facebook') }}">Login with Facebook</a>-->
<!--					</button>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--		<div class="col-md-7 login-bg-right text-center signup-cols-container">-->
<!--			<div class="signup-logo-inner">-->
<!--				<img class="signup-img" src="assets/imgs/vector.png">-->
<!--				<h1 class="mixrre-title">Mixrre</h1>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
@endsection