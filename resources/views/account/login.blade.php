@extends('login')

@section('pageTitle')
	Login
@endsection

@section('body')
	<div id=login>
		<div id="container">
			<img src="/images/whitelogo.png">
		</div>
		<div id="container">

			@include('_template.alert')

			<div id=form>
				<form method="POST" action="/account/login">
					{{ csrf_field() }}
					<div class='row'>
						<div class='col-md-6'>
						  	<div class="form-group">
						    	<label for="username">Username</label>
						    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter your username" name="username" required value="{{ old('username') }}">
					 		</div>
				 		</div>
					  	<div class="col-md-6">
						  	<div class="form-group">
						    	<label for="exampleInputPassword1">Password</label>
						    	<input type="password" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="enter your password" name="password" required>
						  	</div>
					  	</div>
					</div>
				  <button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
		<div id="container">
			@include('_template.footer')
		</div>
	</div>
@endsection	