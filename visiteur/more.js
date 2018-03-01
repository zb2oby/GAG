jQuery(document).ready(function($) {
	$('.readmore').click(function(event) {
		event.preventDefault();
		//var scroll = $(this).offset().top;
		$(this).remove();
		$('.more').css('display', 'inline');
		//$('html, body').animate({scrollTop: scroll}, 'slow');
	});
});