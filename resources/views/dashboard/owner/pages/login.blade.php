@extends('dashboard.owner.layout')

@section('content')

<div class="container-fluid signup-cols-container">
	<div class="row signup-cols login-cols">
		<div class="col-md-5 signup-cols-container">
			<div class="login-inner">
				<h1 class="mixrre-title1">Log in to your account</h1>
			<div class="d-inline-flex">
				<p class="mixrre-titlep">Don’t have an account?</p><a class="mixrre-titlea" href="{{ url('signup') }}">Sign up</a>
			</div>
			@if(session('error_message'))
			 
			  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('error_message')}}
                    <button type="button" class="close" style="padding:0;right:12px" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
					@endif
					
			<div class="login-inputs mt-36px">
				<form action="{{ url('user_login')}}" method="post">
				       {{ csrf_field() }}
				       
				       <div class="input-bg-preview ">
				            <div class="field">
					<input type="email" name="email" id="email" placeholder="Enter Email" value="{{ old('email') }}" required>
					<label for="email">Email</label>
 					 </div>
                  </div>
                  
				  <!--<div class="form-group">-->
				  <!--  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email Address" name="email" value="{{ old('email') }}" required>-->
				  <!--</div>-->
				  
				   @if ($errors->has('email'))
				  
				   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $errors->first('email') }}
                    <button type="button" class="close"  style="padding:0;right:12px" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>

                    @endif
                    
                     <div class="input-bg-preview mt-15px">
                     <div class="material-form-field">
                        <input type="password" name="password" required>
                        <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Password</label>
                     </div>
                  </div>
                  
				  <!--<div class="form-group mt-30px">-->
				  <!--  <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password" name="password" required>-->
				  <!--</div>-->
				  
				  @if ($errors->has('password'))
				  
				   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $errors->first('password') }}
                    <button type="button" class="close" style="padding:0;right:12px" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>

                    @endif
                    
				  <div class="col-auto mt-38px p-0">
				    <div class="d-inline-flex w-100">
				    	<label class="container-checkbox-3"> Remember Me
						  <input type="checkbox">
						  <span class="checkmark-3"></span>
						</label>
					    <a class="mixrre-titlea mt-89 ml-auto" style="margin-top:4px" href="{{ url('forget_password') }}">Forgot Password?</a>
				    </div>
				  </div>
				  <button type="submit" class="btn btn-primary signup-btn"><a style="color:#2F3034;">Log in</a></button>
				</form>
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

@endsection