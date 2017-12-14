jQuery(document).ready(function($) {

	$('.onglet-title').click(function(event) {
		// $(this).addClass('tabs-active');
		$('.onglet-actif').removeClass('onglet-actif');
		$(event.currentTarget).parent().addClass('onglet-actif');
		if (event.currentTarget.hasClass('gestion') != true) {
			$('.down-target').css('visibility', 'hidden');
		}
	});
});