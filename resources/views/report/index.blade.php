@extends('master')

@section ('pageTitle')
	Generate Report
@endsection

@section ('body')
	<div id="content" class="filter">
		<div id="wrapper">
			<div id="report">
				<form method="POST" action="{{ url('/') }}/report/generate">
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
				    		<div id="accountContainer">
					    		<div class="pickedAccount">
				    				<input type="text" name="" value='' class='searchField' placeholder="-- type account name --">
				    				<button class='list' type="button"></button>
				    			</div>
						    	<div id="dropDown">
							    	<div id="btn-account">
										@foreach ($account as $accountDetails)
										  	<button type='button' class="unPick" value="{{ $accountDetails->id }}|{{ $accountDetails->account }}">{{ $accountDetails->account }}</button>
									  	@endforeach
							    	</div>
						    	</div>
					    	</div>
					  	</div>
				  	</div>
				  	<div id="column">
					  	<div class="form-group senderId">
					    	<label for="senderId">Sender ID </label>
				    		<input type='hidden' class='senderField' name='sender'/>
				    		<div id="senderContainer">
					    		<div class="pickedSender">
				    				<input type="text" name="" value='' class='searchField' placeholder="-- n/a --">
				    				<button class='list' type="button"></button>
				    			</div>
						    	<div id="dropDown">
							    	<div id="btn-sender">
							    	</div>
						    	</div>
					    	</div>
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
	<script src="{{ url('/') }}/js/filter.js" type="text/javascript"></script>
	<script src="{{ url('/') }}/js/date.js" type="text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script>
	<link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
@endsection