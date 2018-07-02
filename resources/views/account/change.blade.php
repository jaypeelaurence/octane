@extends('master')

@section('pageTitle')
	Change Password
@endsection

@section('body')
	<div id="content">
		<div id="wrapper">
			<h1 class='title'>{{ $user->name }} | Edit</h1>
			<div id="edit-account">
				<form method="POST" action="/account/{{ $user->id }}/change-password">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
				  	<div class="form-group password">
				    	<label for="exampleInputPassword1">Old Password</label>
				    	<input type="password" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="enter old password" name='password'>
				  	</div>
				  	<div class="form-group password">
				    	<label for="exampleInputPassword1">New Password</label>
				    	<input type="password" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="enter new password" name='password'>
				  	</div>
				  	<button type="submit" class="btn btn-primary">Change Password</button>
				</form>
			</div>
		</div>
	</div>
@endsection	