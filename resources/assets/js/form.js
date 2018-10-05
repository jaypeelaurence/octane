$(document).ready(function(){
	$('button#prompt').click(function(){
		$(this).prop('disable',true);
		form = $(this).parent('form')
		$("div#prompt").remove();
		form.append("<div id='prompt'>Are you sure? <button type='button' class='no'>No</button> <button type='submit'>Yes</button></div>");
	});

	$('body').on('keypress click', function(event){
		if($(event.target).hasClass('no')){
			$("div#prompt").remove();
			$(this).prop('disable',false);
		}else if($(event.originalEvent)[0].code == "Escape"){
			$(this).prop('disable',false);
			$("div#prompt").remove();
		}
	})
});