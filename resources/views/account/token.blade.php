@extends('login')

@section('pageTitle')
	Change Password
@endsection

@section('body')
	<div id=login>
		<div id="container">
			<img src="{{ url('/') }}/images/whitelogo.png">
		</div>
		<div id="container">

			@include('_template.alert')

			<div id=form>
				<form method="POST" action="{{ url('/') }}/token/{{ $hash }}">
					{{ csrf_field() }}
					<input type="hidden" value="{{ $data['type'] }}" name="type">
					<input type="hidden" value="{{ $data['uid'] }}" name="uid">
					<div class='row'>
				  		<div class="col-md-6">
						  	<div class="form-group password">
						    	<label for="exampleInputPassword1">New Password</label>
						    	<input type="password" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="enter new password" name='password'>
						  	</div>
					  	</div>
				  		<div class="col-md-6">
						  	<div class="form-group password">
						    	<label for="exampleInputPassword1">New Password Confirmation</label>
						    	<input type="password" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="re-enter new password" name='password_confirmation'>
						  	</div>
					  	</div>
					</div>
				  <button type="submit" class="btn btn-primary">Change Password</button>
				</form>
			</div>
		</div>
		<div id="container">
			@include('_template.footer')
		</div>
	</div>
@endsection	