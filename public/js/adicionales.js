$(document).ready(function(){
	
	$('.btn-addAdcional').click(function(){
		var adicional_id = $(this).attr('id');
		var action = $(this).attr('action');
		var t = $(this);
		$.ajax({
			type: "POST",
			url: "save-adicional",
			data: { adicional_id: adicional_id, action: action }
		})
		.done(function( response ){
			if(response.action === '1'){
				t.attr('action', 2);
				t.attr('class', 'btn-addAdcional saved');
			}else{
				t.attr('action', 1);
				t.attr('class', 'btn-addAdcional');
			}
			console.log(response);
		});
	});

});