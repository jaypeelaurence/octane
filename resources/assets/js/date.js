$(document).ready(function(){
	var date = new Date;
	var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

	if($('div.filter').is('.report')){
		var startDate;
    	var sd;
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
	        	return $('#startDate').val();
	        },
	        maxDate: function(){
	        	var maxDate = new Date(sd.getFullYear(), sd.getMonth(), sd.getDate()+8);

				if (maxDate.getDate() > 31) {
					days = minDate - 30;
				} else if (maxDate.getDate() > today.getDate()) {
					days = today.getDate() - startDate.getDate() - 1;
				} else {
					days = 6;
				}

				return new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate() + days);
	        }
	    });

	    $('.end #endDate').prop('disabled', true);
    	$('.end button').prop('disabled', true);

		$("#startDate").change(function(){
        	startDate = new Date($('#startDate').val());
        	sd = new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate());

	    	$('.end #endDate').prop('disabled', true);
	    	$('.end button').prop('disabled', true);

			if($(this).val().length != 0){
		    	$('.end #endDate').prop('disabled', false);
		    	$('.end button').prop('disabled', false);
		    	$('#endDate').val('');
			}
		});
	}else{
		var startDate = new Date();
    	var sd;

	    $('#startDate').datepicker({
	        uiLibrary: 'bootstrap4',
        	iconsLibrary: 'fontawesome',
	        maxDate: today
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
			startDate = new Date($('#startDate').val());

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