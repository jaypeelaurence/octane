@extends('login')

@section('pageTitle')
	Login
@endsection

@section('body')
	<div id=login>
		<div id="container">
			<img src="{{ url('/') }}/images/whitelogo.png">
		</div>
		<div id="container">

			@include('_template.alert')

			<div id=form>
				<form method="POST" action="{{ url('/') }}/account/login">
					{{ csrf_field() }}
					<div class='row'>
						<div class='col-md-6'>
						  	<div class="form-group">
						    	<label for="email">Email Address</label>
						    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email address" name="email" required value="{{ old('email') }}">
					 		</div>
				 		</div>
					  	<div class="col-md-6">
						  	<div class="form-group">
						    	<label for="exampleInputPassword1">Password</label>
						    	<input type="password" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="Enter your password" name="password" required>
						  	</div>
					  	</div>
					</div>
				  <button type="submit" class="btn btn-primary">Login</button>
				</form>
				<a class='action' href="{{ url('/') }}/account/forgot-password">Forgot your password?</a>
			</div>
		</div>
		<div id="container">
			@include('_template.footer')
		</div>
	</div>
@endsection	