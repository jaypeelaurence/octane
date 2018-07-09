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
								<select class="form-control form-control-sm"  name='account' required>
								  	<option value=''>-- select a role --</option>
								  	<option value='Admin'>Admin</option>
								  	<option value='User'>User</option>
								</select>	
						  	</div>
					  	</div>
					  	<div id="column">
						  	<div class="form-group senderId">
						    	<label for="senderId">Sender ID </label>
								<select class="form-control form-control-sm"  name='sender'>
								  	<option value=''>-- all sender id --</option>
								  	<option value='Admin'>Admin</option>
								  	<option value='User'>User</option>
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
        var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        $('#startDate').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            minDate: today,
            maxDate: function () {
                return $('#endDate').val();
            }
        });
        $('#endDate').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            minDate: function () {
                return $('#startDate').val();
            }
        });
    </script>
@endsection