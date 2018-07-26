$(document).ready(function(){
	console.log(window.location.origin);
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

		// $("body").click(function(event){
		// 	if($(event.target).parent('div#accountContainer').length == 1){
		// 		console.log("accountContainer");

		// 		$('#btn-account').show();

		// 		if($(event.target).attr('class') == 'pickedAccount'){
		// 			$('#btn-account').show();
		// 		}
		// 	}else{
		// 		$('#btn-account').hide();
		// 	}
		// });		

		$(".pickedAccount").click(function(event){
			if($(this).children("button").attr('class') == 'down'){
				$(this).children("button").attr('class','up');
				$(this).children("button").html("<i class='fa fa-angle-up'></i>");
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

			var selected = Object.keys(obj).length;

			var list = '';

			// if(selected < 5){
			$.each(obj, function(key, value) {
				list += key + "|";
			});

			$(".accountField").val(list);
			$('.pickedAccount span').html(selected + " account(s) selected");
			// }else{
			// 	$('.pickedAccount span').html(selected + " account(s) selected <i>(max of 5 accounts)</i>");
			// 	delete obj[picked[0]];

			// 	$(this).removeClass('pick');
			// 	$(this).addClass('unPick');
			// }

	// SenderSelection
			if(obj != '' && selected != 0){
				$('#btn-sender').prop("disabled", false);
				$('#btn-sender').attr('placeholder',"-- all sender Id --");

				$(this).parent().append("<input type='hidden' class='accountField' name='account' value='"+ list +"'/>");

				$.ajax({
				    url: window.location.origin + "/report/sender/" + list,
				    type: "GET",
				    success: function(data){
				    	console.log(data);
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