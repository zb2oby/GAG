jQuery(document).ready(function($) {

	var nbOngletActif = $('.onglet-actif').length;
	if (nbOngletActif < 1) {
		$('.gestion').addClass('onglet-actif');
	}


	function onglet() {
		$('.onglet-title').click(function(event) {
			$('.onglet-actif').removeClass('onglet-actif');
			var elt = $(event.currentTarget).parent();
			elt.addClass('onglet-actif');
		});		
	}


	onglet();
			
});