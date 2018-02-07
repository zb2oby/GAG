jQuery(document).ready(function($) {


	//traitement de la recherche
	$(document).on('submit', '.search-form', function(event) {
		var type = $(event.target).find('#type').val();
		var search = $(event.target).find('#req').val();
		var idUser = $(event.target).data('user');

		var data = 'saisie=' + search +'&type=' + type;

		$.ajax({
			url: '../modules/traitementRecherche.php',
			type: 'GET',
			dataType: 'json',
			data: data,
		})
		.done(function(response) {
			console.log("success");
			$('.resultListe').html('');
			if (response == '') {
				$('.resultListe').append('Aucun résultat pour votre recherche');
			}else {
				var listeResultats = jQuery.parseJSON(JSON.stringify(response));
			
				for (var i = listeResultats.length - 1; i >= 0; i--) {
					if (type == 'artiste') {
						$('.resultListe').append('<li><a class="searchArtiste" data-artiste="'+listeResultats[i].idArtiste+'" data-user="'+idUser+'" href="#">nom : '+listeResultats[i].nom+' prénom : '+listeResultats[i].prenom+'</a></li>');
						// $('.resultListe').load('../includes/popArtiste.php?idArtiste='+idArtiste+'&idUser='+idUser);
					}
					if (type == 'oeuvre') {
						$('.resultListe').append('<li><a class="searchOeuvre" data-artiste="'+listeResultats[i].idArtiste+'" data-user="'+idUser+'" data-oeuvre="'+listeResultats[i].idOeuvre+'" href="#">Oeuvre : '+listeResultats[i].titre+'</a></li>');
					}
					if (type == 'collectif') {
						$('.resultListe').append('<li><a class="searchCollectif" data-collectif="'+listeResultats[i].idCollectif+'" data-user="'+idUser+'" href="#">Collectif : '+listeResultats[i].libelleCollectif+'</li>');
					}
					if (type == 'exposition') {
						$('.resultListe').append('<li><a href="../content/gestionPanel.php?onglet=expo&expo='+listeResultats[i].idExpo+'">Exposition : '+listeResultats[i].titre+' '+listeResultats[i].dateDeb+'</a></li>');
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


	//traitement du clic sur une ligne artiste
	$(document).on('click', '.searchArtiste', function(event) {
		var idArtiste = $(event.target).data('artiste');
		var idUser = $(event.target).data('user');
		$('.searchPop.popArt').load('../includes/popArtiste.php?idArtiste='+idArtiste+'&idUser='+idUser);
		$('.overlay').show();
	});
	$(document).on('click', '.searchOeuvre', function(event) {
		var idArtiste = $(event.target).data('artiste');
		var idUser = $(event.target).data('user');
		var idOeuvre = $(event.target).data('oeuvre');
		$('.searchPop.popOeuvre').load('../includes/popArtiste.php?idLastOeuvre='+idOeuvre+'&idArtiste='+idArtiste+'&idUser='+idUser);
		$('.overlay').show();
	});
	$(document).on('click', '.searchCollectif', function(event) {
		var idCollectif = $(event.target).data('collectif');
		var idUser = $(event.target).data('user');
		$('.searchPop.popColl').load('../includes/popCollectif.php?idCollectif='+idCollectif+'&idUser='+idUser);
		$('.overlay').show();
	});
	


});