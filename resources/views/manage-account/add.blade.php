@extends('master')

@section ('pageTitle')
	Manage Account
@endsection

@section ('body')
	<div id="content">
		<div id="wrapper">
			<h1 class='title'>Add Account</h1>
			<div id="add-account">
				<form method="POST" action="{{ url('/') }}/manage-account/add">
					{{ csrf_field() }}
				  	<div class="row">
				  		<div class="col-md-4">
						  	<div class="form-group firstname">
						    	<label for="firstname">First Name *</label>
						    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter first name" name='firstname' required value="{{ old('firstname') }}">
						  	</div>
					  	</div>
					  	<div class="col-md-4">
						  	<div class="form-group middlename">
						    	<label for="middlename">Middle Name</label>
						    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter middle name" name='middlename' value="{{ old('middlename') }}">
						  	</div>
					  	</div>
					  	<div class="col-md-4">
						  	<div class="form-group lastname">
						    	<label for="lastname">Last Name *</label>
						    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter last name" name='lastname' required value="{{ old('lastname') }}">
						  	</div>
					  	</div>
					  	<div class="col-md-6">
						  	<div class="form-group email">
						    	<label for="email">Email Address *</label>
						    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email address" name='email' required value="{{ old('email') }}">
						  	</div>
					  	</div>
					  	<div class="col-md-6">
						  	<div class="form-group mobile">
						    	<label for="mobile">Mobile <span>(mobile number format: 639XXXXXXXXX)</span></label>
						    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter moible number" name='mobile' required value="{{ old('mobile') }}">
						  	</div>
					  	</div>
						<div class="col-md-12">
						  	<div class="form-group role">
						    	<label for="username">Role *</label>
								<select class="form-control form-control-sm"  name='role' required>
									@if(old('role'))
								  		<option value='{{ old('role') }}'>{{ old('role') }}</option>
									@endif
								  	<option value=''>-- select a role --</option>
								  	<option value='Admin'>Admin</option>
								  	<option value='User'>User</option>
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