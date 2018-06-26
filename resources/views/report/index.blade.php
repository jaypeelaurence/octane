@extends('master')

@section ('pageTitle')
	Reports
@endsection

@section ('body')
	<div id="content" class="add-account">
		<div id="form">
			<h1 class='formTitle'>Add Account</h1>
			<form>
			  	<div class="form-group username">
			   		<label for="username">Username</label>
			    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username">
			  	</div>
			  	<div class="form-group password">
			    	<label for="exampleInputPassword1">Password</label>
			    	<input type="password" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="Password">
			  	</div>
  			  	<div class="form-group emailAddress">
			    	<label for="username">Email Address</label>
			    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username">
			  	</div>
			  	<div class="form-group accountName">
			    	<label for="username">Employee Name</label>
			   	 	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username">
			  	</div>
			  	<div class="form-group role">
			    	<label for="username">Role</label>
					<select class="form-control form-control-sm">
					  <option value=''>-- select a role --</option>
					  <option value=''>Admin</option>
					  <option value=''>User</option>
					</select>
				</div>
			  	<button type="submit" class="btn btn-primary">Create Account</button>
			</form>
		</div>
	</div>
@endsection	