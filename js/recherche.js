jQuery(document).ready(function($) {
	$(document).on('submit', '.search-form', function(event) {
		var type = $(event.target).find('#type').val();
		var search = $(event.target).find('#req').val();

		var data = 'saisie=' + search +'&type=' + type;

		$.ajax({
			url: '../modules/traitementRecherche.php',
			type: 'GET',
			dataType: 'json',
			data: data,
		})
		.done(function(response) {
			console.log("success");
			$('.searchResult').html('');
			if (response == '') {
				$('.searchResult').append('Aucun résultat pour votre recherche');
			}else {
				var listeResultats = jQuery.parseJSON(JSON.stringify(response));
			
				for (var i = listeResultats.length - 1; i >= 0; i--) {
					if (type == 'artiste') {
						$('.searchResult').append('<li>nom : '+listeResultats[i].nom+' prénom : '+listeResultats[i].prenom+'</li>');
					}
					if (type == 'oeuvre') {
						$('.searchResult').append('<li>Oeuvre : '+listeResultats[i].titre+'</li>');
					}
					if (type == 'collectif') {
						$('.searchResult').append('<li>Collectif : '+listeResultats[i].libelleCollectif+'</li>');
					}
					if (type == 'exposition') {
						$('.searchResult').append('<li>Exposition : '+listeResultats[i].titre+'</li>');
					}
					
				}
			}
			
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});

		return false;
		
	});
});