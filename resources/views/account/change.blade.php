@extends('master')

@section('pageTitle')
	Change Password
@endsection

@section('body')
	<div id="content">
		<div id="wrapper">
			<h1 class='title'>{{ $user->firstname }} {{ $user->lastname }} | Edit</h1>
			<div id="change-password">
				<form method="POST" action="{{ url('/') }}/account/{{ $user->id }}/change-password">
					{{ csrf_field() }}
				  	<div class="row">
				  		<div class="col-md-4">
						  	<div class="form-group password">
						    	<label for="exampleInputPassword1">Current Password</label>
						    	<input type="password" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="Enter current password" name='oldPassword'>
						  	</div>
					  	</div>
				  		<div class="col-md-4">
						  	<div class="form-group password">
						    	<label for="exampleInputPassword1">New Password</label>
						    	<input type="password" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="Enter new password" name='password'>
						  	</div>
					  	</div>
				  		<div class="col-md-4">
						  	<div class="form-group password">
						    	<label for="exampleInputPassword1">New Password Confirmation</label>
						    	<input type="password" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="Re-enter new password" name='password_confirmation'>
						  	</div>
					  	</div>
				  	</div>
				  	<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
@endsection	