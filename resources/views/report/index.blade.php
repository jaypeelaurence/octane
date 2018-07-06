@extends('master')

@section ('pageTitle')
	Generate Report
@endsection

@section ('body')
	<div id="content" class="filter">
		<div id="wrapper">
			<div id="add-account">
				<form method="POST" action="/manage-account/add">
					{{ csrf_field() }}
				  	<div class="row">
				  		<div class="col-md-3">
						  	<div class="form-group monthYear">
						    	<label for="monthYear">Month/Year</label>
						    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter first name" name='firstname' required value="{{ old('firstname') }}">
						  	</div>
					  	</div>
					  	<div class="col-md-3">
						  	<div class="form-group accountName">
						    	<label for="accountName">Account Name</label>
						    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter middle name" name='middlename' value="{{ old('middlename') }}">
						  	</div>
					  	</div>
					  	<div class="col-md-3">
						  	<div class="form-group senderId">
						    	<label for="senderId">Sender ID </label>
						    	<input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter last name" name='lastname' required value="{{ old('lastname') }}">
						  	</div>
					  	</div>
					  	<div class="col-md-3">
							<button type="submit" class="btn btn-primary">Submit</button>
					  	</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	@include('report.table')
@endsection	