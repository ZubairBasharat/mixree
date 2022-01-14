@extends('dashboard.admin.layout')

@section('content')
<div class="container-fluid signup-cols-container">
	<div class="row signup-cols login-cols">
		<div class="col-md-5 signup-cols-container">
			<div class="login-inner">
				<h1 class="mixrre-title1">Log in to your account</h1>
			<div class="login-inputs mt-36px">
				<form>
				  <div class="input-bg-preview ">
				<div class="field">
					<input type="email" name="email" id="email" placeholder="Enter Email">
					<label for="email">Email</label>
 					 </div>
                  </div>
				  <div class="form-group mt-30px form-label-group">
					<input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password">
					<label for="label-name">Password</label>
				  </div>
				  <div class="col-auto mt-38px p-0">
				    <div class="d-inline-flex w-100">
				    	<label class="container-checkbox-3"> Remember Me
						  <input type="checkbox">
						  <span class="checkmark-3"></span>
						</label>
				    </div>
				  </div>
				  <button type="submit" class="btn  signup-btn"><a href="dashboard.php">Log in</a></button>
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