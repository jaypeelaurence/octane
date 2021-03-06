@extends('master')

@section ('pageTitle')
	Audit Trail
@endsection

@section ('body')
	<div id="content" class="filter audit">
		<div id="wrapper">
			<div id="report" class="audit">
				<form method="POST" action="{{ url('/') }}/report/audit">
					{{ csrf_field() }}
				  	<div id="column">
					  	<div class="form-group monthYear">
					    	<label for="monthYear">Date</label>
					    	<div id="date">
						    	<div class="start">
					    	      	<input id="startDate" name="start" placeholder="Start date"/>
						      	</div>	
						        <div class="end">	
							        <input id="endDate" name="end" placeholder="End date"/>
						    	</div>
					    	</div>
					  	</div>
				  	</div>
				  	<div id="column">
					  	<div class="form-group userName">
					    	<label for="userName">User</label>
				    		<input type='hidden' class='userField' name='username'/>
				    		<div id="userContainer">
					    		<div id="searchContainer" class="pickedUser">
				    				<input type="text" name="" value='' class='searchField' placeholder="-- Type username --">
				    				<button class='list' type="button"></button>
				    			</div>
						    	<div id="dropDown">
							    	<div id="btn-user">
							    	</div>
						    	</div>
					    	</div>
					  	</div>
				  	</div>
				  	<div id="column">
						  	<div class="form-group senderId">
							<button type="submit" class="btn btn-primary">Filter</button>
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