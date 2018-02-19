jQuery(document).ready(function($) {
	var nbOngletActif = $('.onglet-actif').length;
	if (nbOngletActif < 1) {
		$('#gestion').addClass('onglet-actif');
	}


//######METHODE MOINS FLUIDE MAIS PERMETTANT DE GARDER l'ONGLET ACTIF AU RELOAD OU AU SUBMIT#####//

	// function nettoyageUrl(elt) {
	// 	var queryParameters = {}, queryString = location.search.substring(1),
	// 	    re = /([^&=]+)=([^&]*)/g, m;

	// 	// Creates a map with the query string parameters
	// 	while (m = re.exec(queryString)) {
	// 	    queryParameters[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
	// 	}

	// 	// Add new parameters or update existing ones
	// 	if (queryParameters['onglet'] != '' ) {
	// 		// queryParameters['active'] = elt;
	// 		queryParameters['onglet'] = elt;
	// 		location.search = $.param(queryParameters);
	// 	}
		
	// }
	
	

	// $('.onglet-title').click(function(event) {
	// 	var elt = $(event.currentTarget).parent();
	// 	var id = elt.attr('id');
	// 	nettoyageUrl(id)
	// });


//#########METHODE PLUS FLUIDE MAIS NE PERMET PAS DE GARDER L'ONGLET ACTIF (reactivée le 06/02/18 a voir si cela fonctionne avec l'ajax)

	$('.onglet-title').click(function(event) {
		$('.onglet-actif').removeClass('onglet-actif');
		var elt = $(event.currentTarget).parent();
		$('.onglet-actif').removeClass('onglet-actif');
		elt.addClass('onglet-actif');	
	});		
});