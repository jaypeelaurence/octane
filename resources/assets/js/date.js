$(document).ready(function(){
	var date = new Date;
	var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

	if($('div.filter').is('.report')){
		var yesterday = new Date(date.getFullYear(), date.getMonth(), date.getDate()-1);

	    $('#startDate').datepicker({
	        uiLibrary: 'bootstrap4',
	        iconsLibrary: 'fontawesome',
	        minDate: function(){
	        	return new Date(date.getFullYear(), date.getMonth() - 3, date.getDate());
	        },
	        maxDate: yesterday
	    });

	 	$('#endDate').datepicker({
	        uiLibrary: 'bootstrap4',
	        iconsLibrary: 'fontawesome',
	        minDate: function(){
	        	pickedDate = new Date($('#startDate').val());

	        	return $('#startDate').val();
	        },
	        maxDate: function(){
				var timeDiff = Math.abs(today.getTime() - pickedDate.getTime());
				var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

				var maxDate = new Date();

				if(diffDays > 7){
		        	maxDate = new Date(pickedDate.getFullYear(), pickedDate.getMonth(), pickedDate.getDate() + 7);
				}else{
					maxDate = new Date(pickedDate.getFullYear(), pickedDate.getMonth(), pickedDate.getDate() + (diffDays - 1));
				}

				return maxDate;
	        }
	    });

	    $('.end #endDate').prop('disabled', true);
    	$('.end button').prop('disabled', true);

		$("#startDate").change(function(){
        	var startDate = new Date($('#startDate').val());
        	var pickedDate = new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate());

	    	$('.end #endDate').prop('disabled', true);
	    	$('.end button').prop('disabled', true);

			if($(this).val().length != 0){
		    	$('.end #endDate').prop('disabled', false);
		    	$('.end button').prop('disabled', false);
		    	$('#endDate').val('');
			}
		});
	}else{
	    $('#startDate').datepicker({
	        uiLibrary: 'bootstrap4',
        	iconsLibrary: 'fontawesome',
	        maxDate: today,
	    });

	    $('#endDate').datepicker({
	        uiLibrary: 'bootstrap4',
        	iconsLibrary: 'fontawesome',
        	minDate: function(){
        		return startDate;
        	},
        	maxDate: function(){
	        	return today;
        	}
	    });

	    $('.end #endDate').prop('disabled', true);
    	$('.end button').prop('disabled', true);

		$("#startDate").change(function(){
			var startDate = new Date($('#startDate').val());

	    	$('.end #endDate').prop('disabled', true);
	    	$('.end button').prop('disabled', true);

			if($(this).val().length != 0){
		    	$('.end #endDate').prop('disabled', false);
		    	$('.end button').prop('disabled', false);
		    	$('#endDate').val('');
			}
		});
	}
});