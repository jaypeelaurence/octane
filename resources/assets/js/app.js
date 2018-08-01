$(document).ready(function(){
	// console.log(window.location.origin);
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
		$('#btn-account').hide();
		$('#btn-sender').hide();
		$('#senderContainer .searchField').prop("disabled", true);
		$('#senderContainer button').prop("disabled", true);

		$("div.pickedAccount button").attr('class','down');
		$("div.pickedAccount button").html("<i class='fa fa-angle-down'></i>");

		$('div.pickedSender button').attr('class','down');
		$('div.pickedSender button').html("<i class='fa fa-angle-down'></i>");

		$("body").click(function(event){
			if($(event.target).parent('div.pickedAccount').length == 1 || $(event.target).parent('div#accountContainer').length == 1 || $(event.target).parent('div#btn-account').length == 1){

				var pickedAccount = $('div.pickedAccount button');

				if(pickedAccount.attr('class') == 'down'){
					pickedAccount.attr('class','up');
					pickedAccount.html("<i class='fa fa-angle-up'></i>");
					$('#btn-account').show();
				}else{
					pickedAccount.attr('class','down');
					pickedAccount.html("<i class='fa fa-angle-down'></i>");
					$('#btn-account').hide();
				}

				if($(event.target).parent('div#btn-account').length == 1 || $(event.target).parent('div#dropDown').length == 1){
					pickedAccount.attr('class','up');
					pickedAccount.html("<i class='fa fa-angle-up'></i>");
					$('#btn-account').show();
				}
			}else{
				$('#btn-account').hide();

				$('div.pickedAccount button').attr('class','down');
				$('div.pickedAccount button').html("<i class='fa fa-angle-down'></i>");
			}

			if($(event.target).parent('div.pickedSender').length == 1 || $(event.target).parent('div#senderContainer').length == 1 || $(event.target).parent('div#btn-sender').length == 1){

				var pickedSender = $('div.pickedSender button');

				if(pickedSender.attr('class') == 'down'){
					pickedSender.attr('class','up');
					pickedSender.html("<i class='fa fa-angle-up'></i>");

					$('#btn-sender').show();
				}else{
					pickedSender.attr('class','down');
					pickedSender.html("<i class='fa fa-angle-down'></i>");
					$('#btn-sender').hide();
				}

				if($(event.target).parent('div#btn-sender').length == 1){
					pickedSender.attr('class','up');
					pickedSender.html("<i class='fa fa-angle-up'></i>");
					$('#btn-sender').show();

					var set = $(event.target);

					if(set.hasClass('unPick')){
					    $('#btn-sender button').removeClass('pick');
					    $('#btn-sender button').addClass('unPick');

					    set.removeClass('unPick');
					    set.addClass('pick');
					}else{
					    $('#btn-sender button').removeClass('pick');
					    $('#btn-sender button').addClass('unPick');

						set.removeClass('pick');
					    set.addClass('unPick');
					}

					$('.senderId .senderField').val(set.val());
					$('.senderId .searchField').val(set.val());
				}
			}else{
				$('#btn-sender').hide();

				$('div.pickedSender button').attr('class','down');
				$('div.pickedSender button').html("<i class='fa fa-angle-down'></i>");
			}
		});

		var obj = {};

		$('#btn-account button').click(function(){
			var picked = $(this).val().split("|");

			$('.senderId .senderField').val('');
			$('.senderId .searchField').val('');

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

			$.each(obj, function(key, value) {
				list += key + "|";
			});

			$(".accountField").val(list);

			if(selected != 0){
				$('.pickedAccount .searchField').attr('placeholder',selected + " account(s) selected");
			}else{
				$('.pickedAccount .searchField').attr('placeholder',"-- type account name --");
			}

	// SenderSelection
			if(obj != '' && selected != 0){
				$('#senderContainer .searchField').prop("disabled", false);
				$('#senderContainer button').prop("disabled", false);

				$(this).parent().append("<input type='hidden' class='accountField' name='account' value='"+ list +"'/>");

				$('#btn-sender').html("<button type='button' class='unPick' value='ALL SENDER ID'>-- ALL SENDER ID --</button>");

				$.ajax({
				    url: "/report/sender/" + list,
				    type: "GET",
				    success: function(data){
				    	console.log(data);
				    	
			    		$.each(data, function(key, value){
							$('#btn-sender').append("<button type='button' class='unPick' value='" + value + "'>" + value + "</button>");
						});
				    },
			      	error: function(jqXHR, textStatus, errorThrown){
					    console.log(textStatus + " - " + errorThrown)
				  	}
				});
			}else{
				$('#senderContainer .searchField').prop("disabled", true);
				$('#senderContainer .searchField').attr('placeholder',"-- n/a --");
			}
		});

	// var sourceAccount = [];

	// $.ajax({
	//     url: "/report/account/",
	//     type: "GET",
	//     success: function(data){
 //    		$.each(data, function(key, value){
	// 			$('#btn-account').append("<button type='button' class='unPick' value='" + value.id + "|" + value.system_id + "'>" + value.system_id + "</button>");

	// 			sourceAccount = value.system_id;
	// 		});
	//     },
 //      	error: function(jqXHR, textStatus, errorThrown){
	// 	    console.log(textStatus + " - " + errorThrown)
	//   	}
	// });

	// var strAcct = "";

	// $(".pickedAccount .searchField" ).keyup(function(event){
	//   	if(event.which <= 90 && event.which >= 48){
 //        	strAcct += event.key;
 //       	}

 //   		$.ajax({
	// 	    url: "/report/account/search/" + strAcct,
	// 	    type: "GET",
	// 	    success: function(data){
 //       			console.log(data);
	//     		$.each(data, function(key, value){
	// 				$('#btn-account').append("<button type='button' class='unPick' value='" + value.id + "|" + value.system_id + "'>" + value.system_id + "</button>");

	// 				sourceAccount = value.system_id;
	// 			});
	// 	    },
	//       	error: functio(textStatus + " - " + errorThrown)
	// 	  	}n(jqXHR, textStatus, errorThrown){
	// 		    console.log
	// 	});
	// });
});