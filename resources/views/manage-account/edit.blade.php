@extends('master')

@section('pageTitle')
	Edit Account
@endsection

@section('body')
	<div id="content">
		<div id="wrapper">
			<h1 class='title'>{{ $user->firstname }} {{ $user->lastname }} | Edit</h1>
			<div id="edit-account">
				<form method="POST" action="{{ url('/') }}/manage-account/{{ $user->id }}/edit">
					{{ csrf_field() }}
				  	<div class="row">
				  		<div class="col-md-4">
						  	<div class="form-group firstname">
						    	<label for="firstname">First Name</label>
						    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp"placeholder="@php
						    		echo $user->firstname ?? 'Enter first name';
						    	@endphp" name='firstname' value="{{ old('firstname') }}">
						  	</div>
					  	</div>
					  	<div class="col-md-4">
						  	<div class="form-group middlename">
						    	<label for="middlename">Middle Name</label>
						    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="@php
						    		echo $user->middlename ?? 'Enter middle name';
						    	@endphp" name='middlename' value="{{ old('middlename') }}">
						  	</div>
					  	</div>
					  	<div class="col-md-4">
						  	<div class="form-group lastname">
						    	<label for="lastname">Last Name</label>
						    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="@php
						    		echo $user->lastname ?? 'Enter last name';
						    	@endphp" name='lastname' value="{{ old('lastname') }}">
						  	</div>
					  	</div>
					  	<div class="col-md-6">
						  	<div class="form-group email">
						    	<label for="email">Email Address</label>
						    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="@php
						    		echo $user->email ?? 'Enter email address';
						    	@endphp" name='email' value="{{ old('email') }}">
						  	</div>
					  	</div>
					  	<div class="col-md-6">
						  	<div class="form-group mobile">
						    	<label for="mobile">Mobile <span>(mobile number format: 639XXXXXXXXX)</span></label>
						    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="@php
						    		echo $user->mobile ?? 'Enter moible number';
						    	@endphp" name='mobile' value="{{ old('mobile') }}">
						  	</div>
					  	</div>
				  		<div class="col-md-6">
						  	<div class="form-group password">
						    	<label for="exampleInputPassword1">Password</label>
						    	<input type="password" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="Enter new password" name='password'>
						  	</div>
					  	</div>
				  		<div class="col-md-6">
						  	<div class="form-group password">
						    	<label for="password_confirmation">Password Confirmation</label>
						    	<input type="password" class="form-control form-control-sm" id="password_confirmation" placeholder="Re-enter new password" name='password_confirmation'>
						  	</div>
					  	</div>
				  		<div class="col-md-12">
						  	<div class="form-group role">
						    	<label for="username">Role</label>
								<select class="form-control form-control-sm"  name='role'>
									@if(old('role'))
								  		<option value='{{ old('role') }}'>{{ old('role') }}</option>
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
					<button type="submit" class="btn btn-primary">Submit</button>
					<!-- <button type="reset" class="btn btn-primary reset">Clear</button> -->
				</form>
			</div>
		</div>
	</div>
@endsection