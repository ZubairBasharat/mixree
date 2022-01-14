@extends('dashboard.owner.layout')

@section('content')

<div class="container-fluid signup-cols-container">
	<div class="row reset-cols login-cols">
		<div class="col-md-5 signup-cols-container">
			<h1 class="forget-mixrre">Mixrre</h1>
				<!-- <div class="dropdown forget-select">
					<button class="btn dropdown-toggle country-btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <img class="flag" src="{{ asset('public/assets/imgs/flag.png') }}">
							    <span>US</span>
							    <img class="arrow" src="{{ asset('public/assets/imgs/arrow.png') }}">
					</button>
					<div class="dropdown-menu region" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="#">
							<img class="flag" src="{{ asset('public/assets/imgs/flag.png') }}">
							<span>UK</span>
							<img class="arrow" src="{{ asset('public/assets/imgs/arrow.png') }}">
						</a>
					</div>
				</div> -->
			<div class="forget-inner">
				<h1 class="mixrre-title1">Reset your password</h1>
				<p class="mixrre-titlep">Please enter the email address you use when creating your account, we’ll send you instruction to reset your password.</p>
				
				@if(session('error_message'))
				  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('error_message')}}
                    <button type="button" class="close" style="padding:0;right:12px" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
				@endif
				
				@if(session('success_message'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success_message')}}
                    <button type="button" class="close" style="padding:0;right:12px" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
				@endif
					
					
				<div class="login-inputs mt-36px">
					<form action="{{ url('res_password')}}" method="post">
					       @csrf
					       
					       <div class="input-bg-preview form-group" >
					            <div class="field">
					<input type="email" name="email" id="email" placeholder="Enter Email" value="{{ old('email') }}" required>
					<label for="email">Email</label>
 					 </div>
                  </div>
                  
					  <!--<div class="form-group">-->
					  <!--  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email Address" name="email"  value="{{ old('email') }}" required>-->
					  <!--</div>-->
					  <button type="submit" class="btn btn-primary signup-btn"><a style="color:#2F3034;">Send</a></button>
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