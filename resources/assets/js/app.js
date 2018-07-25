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

		$(".pickedAccount").click(function(){
			if($(this).children("button").attr('class') == 'down'){
				$(this).children("button").attr('class','up');
				$(this).children("button").html("<i class='fa fa-angle-up'></i>")
				$('#btn-account').show();
			}else{
				$(this).children("button").attr('class','down');
				$(this).children("button").html("<i class='fa fa-angle-down'></i>")
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
			if(obj != '' && selected != 0){
				$('#btn-sender').prop("disabled", false);
				$('#btn-sender').attr('placeholder',"-- all sender Id --");

				$(this).parent().append("<input type='hidden' class='accountField' name='account' value='"+ list +"'/>");

				$.ajax({
				    url: "/report/sender/" + list,
				    type: "GET",
				    success: function(data){
				    	console.log(data)
				    },

			   //  	 	$('#btn-sender').append("<option class='senderId' value='all'>-- All Sender ID --</option>");
				  //   	$.each(data, function(key, value){
						//    $('#btn-sender').append("<option class='senderId' value='" + value + "'>" + value + "</option>");
						// });
			      	error: function(jqXHR, textStatus, errorThrown){
					    console.log(textStatus + " - " + errorThrown)
				  	}
				});
			}else{
				$('#btn-sender').prop("disabled", true);
				$('#btn-sender').attr('placeholder',"-- n/attr --");
			}
	});
});