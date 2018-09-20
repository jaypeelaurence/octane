@extends('login')

@section('pageTitle')
	Forgot Password
@endsection

@section('body')
	<div id=login>
		<div id="container">
			<img src="{{ url('/') }}/images/whitelogo.png">
		</div>
		<div id="container">

			@include('_template.alert')

			<div id=form>
				<form method="POST" action="{{ url('/') }}/account/forgot-password">
					{{ csrf_field() }}
					<div class='row'>
						<div class='col-md-12'>
						  	<div class="form-group">
						    	<label for="email">Email Address</label>
						    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter your email address" name="email" required value="{{ old('email') }}">
					 		</div>
				 		</div>
					</div>
				  <button type="submit" class="btn btn-primary">Reset Password</button>
				</form>
				<a class='action' href="{{ url('/') }}/account/login">Go back to login page</a>
			</div>
		</div>
		<div id="container">
			@include('_template.footer')
		</div>
	</div>
@endsection	