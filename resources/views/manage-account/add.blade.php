@extends('master')

@section ('pageTitle')
	Manage Account
@endsection

@section ('body')
	<div id="content">
		<div id="wrapper">
			<h1 class='title'>Add Account</h1>
			<div id="add-account">
				<form method="POST" action="/manage-account/add">
					{{ csrf_field() }}
				  	<div class="form-group username">
				   		<label for="username">Username</label>
				    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username" name='username' required>
				  	</div>
				  	<div class="form-group password">
				    	<label for="password">Password</label>
				    	<input type="password" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="******" name='password' required>
				  	</div>				  	<div class="form-group password">
				    	<label for="password_confirmation">Password Confirmation</label>
				    	<input type="password" class="form-control form-control-sm" id="password_confirmation" placeholder="******" name='password_confirmation' required>
				  	</div>
					  	<div class="form-group emailAddress">
				    	<label for="username">Email Address</label>
				    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="your@email.com" name='email' required>
				  	</div>
				  	<div class="form-group accountName">
				    	<label for="username">Employee Name</label>
				   	 	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Juan Dela Cruz" name='name' required>
				  	</div>
				  	<div class="form-group role">
				    	<label for="username">Role</label>
						<select class="form-control form-control-sm"  name='role' required>
						  <option value=''>-- select a role --</option>
						  <option value='Admin'>Admin</option>
						  <option value='User'>User</option>
						</select>
					</div>
				  	<button type="submit" class="btn btn-primary">Create Account</button>
				</form>
			</div>
		</div>
	</div>
@endsection	