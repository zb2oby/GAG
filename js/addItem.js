jQuery(document).ready(function($) {
	$('.add').click(function(event) {
		event.stopPropagation();
		$('.context-add').css('display', 'block');
	});

	$('body').click(function(event) {
		$('.context-add').css('display', 'none');
	});

	$('.context-addExpo').click(function(event) {
		$('.context-add').css('display', 'none');
		$('#newExpo').css('display', 'block');
		$('#newExpo').parent().find('.overlay').show();
	});

});