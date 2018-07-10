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
						    	      	<input id="startDate" name="startDate" placeholder="start date"/>
							      	</div>	
							        <div class="end">	
								        <input id="endDate" name="endDate" placeholder="End date"/>
							    	</div>
						    	</div>
						  	</div>
					  	</div>
					  	<div id="column">
						  	<div class="form-group accountName">
						    	<label for="accountName">Account Name *</label>
								<select class="form-control form-control-sm" id="btn-account" name='account' required>
								  	<option value=''>-- select a role --</option>
								  	@foreach ($account as $accountDetails)
								  		<option value='{{ $accountDetails->system_id }}'>{{ $accountDetails->system_id }}</option>
								  	@endforeach
								</select>	
						  	</div>
					  	</div>
					  	<div id="column">
						  	<div class="form-group senderId">
						    	<label for="senderId">Sender ID </label>
								<select class="form-control form-control-sm" id="btn-sender" name='sender'>
								  	<option value=''>-- N/A --</option>
								</select>
						  	</div>
					  	</div>
					  	<div id="column">
							  	<div class="form-group senderId">
								<button type="submit" class="btn btn-primary">Generate</button>
						  	</div>
					  	</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	@include('report.table')
	@endsection	

@section ('custom_footer')
    <script>
    	// DatePicker
	    	var date = new Date;
	       	var yesterday = new Date(date.getFullYear(), date.getMonth(), date.getDate()-1);
	       	var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
	       	var days;

	        $('#startDate').datepicker({
	            uiLibrary: 'bootstrap4',
	            iconsLibrary: 'fontawesome',
	            maxDate: yesterday
	        });

      	 	$('#endDate').datepicker({
	            uiLibrary: 'bootstrap4',
	            iconsLibrary: 'fontawesome',
	            minDate: function (){
	                return $('#startDate').val();
	            },
	            maxDate: function (){
					var startDate = new Date($('#startDate').val());

					var checkDate = startDate.getDate() + 7;

					if(checkDate > 31){
		                days = checkDate - 30;
					}else if(checkDate > today.getDate()){
						days = today.getDate() - startDate.getDate() - 1;
					}else{
						days = 6;
					}

					return new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate() + days);
	            },
	        });


	    	if($("#startDate").val() == ''){
	 	    	$('.end #endDate').prop('disabled', true);
	 	    	$('.end button').prop('disabled', true);
	    	}

			$("#startDate").change(function(){
	 	    	$('.end #endDate').prop('disabled', false);
	 	    	$('.end button').prop('disabled', false);
	    	});

		// AccountSelection
			$('#btn-sender').prop("disabled", true);

			$("#btn-account").change(function(){
				if($(this).val() != ''){
					$('#btn-sender').prop("disabled", false);
				}else{
					$('#btn-sender').prop("disabled", true);
				}
			});
    </script>
@endsection