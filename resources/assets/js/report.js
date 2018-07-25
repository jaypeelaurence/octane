
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');	

$(document).ready(function(){
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
		    	$('#endDate').val('');
		});

	// AccountSelection
		$('#btn-sender').prop("disabled", true);
		$('#btn-account').hide();

		$(".pickedAccount button").attr('class','down');
		$(".pickedAccount button").html("<i class='fa fa-angle-down'></i>");

		$(".pickedAccount button").click(function(){
			if($(this).attr('class') == 'down'){
				$(this).attr('class','up');
				$(this).html("<i class='fa fa-angle-up'></i>")
				$('#btn-account').show();
			}else{
				$(this).attr('class','down');
				$(this).html("<i class='fa fa-angle-down'></i>")
				$('#btn-account').hide();
			}
		});

		var obj = {};

		$('#btn-account button').click(function(){
			var picked = $(this).val().split("|");

			if($(this).hasClass('unPick')){
				obj[picked[0]] = picked[1];

				$(this).removeClass('unPick');
				$(this).addClass('pick');
			}else{
				delete obj[picked[0]];

				$(this).removeClass('pick');
				$(this).addClass('unPick');
			}

			var list = '';

			$.each(obj, function(key, value) {
				list += key + "|";
			});

			var selected = Object.keys(obj).length;

			$(".accountField").val(list);
			$('.pickedAccount span').html(selected + " account(s) selected");

	// SenderSelection
			/*if(obj != '' && selected != 0){
				$('#btn-sender').prop("disabled", false);
				$('#btn-sender').attr('placeholder',"-- all sender Id --");

			// 	$(this).parent().append("<input type='hidden' class='accountField' name='account' value='hello'/>");

			// 	$.ajax({
			// 	    url: "/report/sender/" + obj,
			// 	    success: function(data){

			//     	 	$('#btn-sender').append("<option class='senderId' value='all'>-- All Sender ID --</option>");
			// 	    	$.each(data, function(key, value){
			// 			   $('#btn-sender').append("<option class='senderId' value='" + value + "'>" + value + "</option>");
			// 			});
			// 	    }
			// 	});
			}else{
				$('#btn-sender').prop("disabled", true);
				$('#btn-sender').attr('placeholder',"-- n/attr --");
			}*/
	});
});