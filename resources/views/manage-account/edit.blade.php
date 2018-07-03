@extends('master')

@section('pageTitle')
	Edit Account
@endsection

@section('body')
	<div id="content">
		<div id="wrapper">
			<h1 class='title'>{{ $user->name }} | Edit</h1>
			<div id="edit-account">
				<form method="POST" action="/manage-account/{{ $user->id }}/edit">
					{{ csrf_field() }}
				  	<div class="row">
				  		<div class="col-md-6">
						  	<div class="form-group username">
						   		<label for="username">Username</label>
						    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{ $user->username }}" name='username' value="{{ old('username') }}">
						  	</div>
					  	</div>
				  		<div class="col-md-6">
						  	<div class="form-group emailAddress">
						    	<label for="username">Email Address</label>
						    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{ $user->email }}" name='email' value="{{ old('email') }}">
						  	</div>
					  	</div>
				  		<div class="col-md-6">
						  	<div class="form-group password">
						    	<label for="exampleInputPassword1">Password</label>
						    	<input type="password" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="enter new password" name='password'>
						  	</div>
					  	</div>
				  		<div class="col-md-6">
						  	<div class="form-group password">
						    	<label for="password_confirmation">Password Confirmation</label>
						    	<input type="password" class="form-control form-control-sm" id="password_confirmation" placeholder="re-enter password" name='password_confirmation'>
						  	</div>
					  	</div>
				  		<div class="col-md-6">
						  	<div class="form-group accountName">
						    	<label for="username">Employee Name</label>
						   	 	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{ $user->name }}" name='name' value="{{ old('name') }}">
						  	</div>
					  	</div>
				  		<div class="col-md-6">
						  	<div class="form-group role">
						    	<label for="username">Role</label>
								<select class="form-control form-control-sm"  name='role'>
									@if(old('role'))
								  		<option value='role'>{{ old('role') }}</option>
								  		@else
							 				<option value='{{ $user->role }}'>{{ $user->role }}</option>
							 			@endelse
							  		@endif

							 	 	@if ($user->role == 'Admin')
								  		<option value='User'>User</option>
									@else
								 		<option value='Admin'>Admin</option>
									@endif
								</select>
							</div>
						</div>
					</div>
				  	<button type="submit" class="btn btn-primary">Update Account</button>
				</form>
			</div>
		</div>
	</div>
@endsection	