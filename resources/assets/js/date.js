$(document).ready(function(){
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
	    	$('#endDate').val('');
	});
});