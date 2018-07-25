@extends('master')

@section ('pageTitle')
	Generate Report
@endsection

@section ('body')
	<div id="content" class="filter">
		<div id="wrapper">
			<div id="report">
				<form method="POST" action="/report">
					{{ csrf_field() }}
				  	<div id="column">
					  	<div class="form-group monthYear">
					    	<label for="monthYear">Month/Year *</label>
					    	<div id="date">
						    	<div class="start">
					    	      	<input id="startDate" name="start" placeholder="start date" value="{{ old('start') }}"/>
						      	</div>	
						        <div class="end">	
							        <input id="endDate" name="end" placeholder="End date" value="{{ old('end') }}"/>
						    	</div>
					    	</div>
					  	</div>
				  	</div>
				  	<div id="column">
					  	<div class="form-group accountName">
					    	<label for="accountName">Account Name *</label>
				    		<input type='hidden' class='accountField' name='account'/>
				    		<div class="pickedAccount">
			    				<span>-- select account --</span>
			    				<button class='list' type="button"></button>
			    			</div>
					    	<div id="dropDown">
						    	<div id="btn-account">
									@foreach ($account as $accountDetails)
									  	<button type='button' class="unPick" value="{{ $accountDetails->id }}|{{ $accountDetails->system_id }}">{{ $accountDetails->system_id }}</button>
								  	@endforeach
						    	</div>
					    	</div>
					  	</div>
				  	</div>
				  	<div id="column">
					  	<div class="form-group senderId">
					    	<label for="senderId">Sender ID </label>
							<input class="form-control form-control-sm" id="btn-sender" name='sender' placeholder="-- n/a --" value=''/>
					  	</div>
				  	</div>
				  	<div id="column">
						  	<div class="form-group senderId">
							<button type="submit" class="btn btn-primary">Generate</button>
					  	</div>
				  	</div>
				</form>
			</div>
		</div>
	</div>
	@include('report.table')
@endsection	

@section ('custom_script')
	<script src="/js/app.js" type="text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script>
	<link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection