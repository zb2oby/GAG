jQuery(document).ready(function($) {

	$(document).on('click', '.add', function(event) {
		//event.preventDefault();
		$('.context-add').toggleClass('context-add-visible');
	});

	$('.container').click(function(event) {
		if (!$(event.target).hasClass('.add')) {
			$('.context-add').removeClass('context-add-visible');
		}
	});
	
	
//affichage duformulaire d'expo depuis bouton + (traitement dans expo.js)
	$(document).on('click', '.context-addExpo', function(event) {
		$('.context-add').removeClass('context-add-visible');
		$('#newExpo').css('display', 'block');
		$('.overlay').show();
	});
	// $('.context-addExpo').click(function(event) {
		
	// });

//traitmeent de l'ajout de type d'oeuvre depuis le bouton + 
	$(document).on('click', '.context-addType', function(event) {

		$('.context-add').removeClass('context-add-visible');
		
		$('.overlay').show();
		//$('.addArt').load('../js/type.js');
		$('.addArt').load('../includes/popType.php');
	
	});



//traitmeent de l'ajout d'artiste depuis le bouton + 
	$(document).on('click', '.context-addArtiste', function(event) {

		$('.context-add').removeClass('context-add-visible');
		var idExpo = 0;
		var idUser = $('.addArt').data('iduser');
		var data = 'createArtiste=create&idExpo=' + idExpo; 
		$.ajax({
			url: '../modules/traitementListes.php',
			type: 'GET',
			dataType: 'html',
			data: data,
		})
		.done(function(response) {
			console.log("success");
			
			$('.overlay').show();
			$('.addArt').load('../js/artisteCard.js');
			$('.addArt').load('../includes/popArtiste.php?idArtiste='+response+'&idUser='+idUser);
			$('.form-add select').prepend('<option value="'+response+'">Artiste Sans Nom</option>');
			//ajout de l'artiste dans le select du boutons + de la liste artiste
			$('.popAddArtiste select').append('<option value="'+response+'">Artiste Sans Nom</option>');
			
			//ajout de l'artiste dans le select des creation d'oeuvre depuis bouton + des listes d'oeuvre
			$('.popAddOeuvrePrevue select').append('<option value="'+response+'">Artiste Sans Nom</option>');
			
			//ajout de l'artiste dans le select des creation d'oeuvre depuis bouton + des listes d'oeuvre
			$('.popAddOeuvreRecue select').append('<option value="'+response+'">Artiste Sans Nom</option>');
			
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});


//traitement de l'ajout d'oeuvre depuis le bouton +
	$(document).on('click', '.context-addOeuvre', function(event) {
		$('.modalAddOeuvre').css('display', 'block');
		$('.overlay').show();
		$('.context-add').removeClass('context-add-visible');
	});

	$(document).on('submit', '.modalAddOeuvre .form-add', function(event) {

		$('.modalAddOeuvre').css('display', 'none');
		var idArtiste = parseFloat($(event.target).find('#idArtiste').val());
		var data = 'req=add&idArtiste='+idArtiste;
		var nomOeuvre = 
		$.ajax({
			url: '../modules/traitementOeuvre.php',
			type: 'GET',
			dataType: 'html',
			data: data,
		})
		.done(function(response) {
			console.log("success");
			var idLastOeuvre = response;
			var idUser = $('.addArt').data('iduser');
			$('.overlay').show();
			$('.addArt').load('../js/artisteCard.js');
			$('.addArt').load('../includes/popArtiste.php?idLastOeuvre='+idLastOeuvre+'&idArtiste='+idArtiste+'&idUser='+idUser);

			//ajout de l'oeuvre dans les select d'ajout d'oeuvre Prevue et Recue si l'Artiste est présent dans la liste des artistes de l'expo
			var listArtistePresent = $('.artistes .portlet');
			for (var i = listArtistePresent.length - 1; i >= 0; i--) {
				if ($(listArtistePresent[i]).data('id') == idArtiste) {
					$('.popAddCard select').append('<option value="'+idLastOeuvre+'">Oeuvre sans titre</option>');
					$('.popAddRecue select').append('<option value="'+idLastOeuvre+'">Oeuvre sans titre</option>');
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

//traitement de l'ajout de collectif depuis le bouton +
$(document).on('click', '.context-addCollectif', function(event) {

		$('.context-add').removeClass('context-add-visible');
		var idUser = $('.addArt').data('iduser');
		var data = 'createColl=create'; 
		$.ajax({
			url: '../modules/traitementCollectif.php',
			type: 'GET',
			dataType: 'html',
			data: data,
		})
		.done(function(response) {
			console.log("success");
			$('.overlay').show();
			$('.addArt').load('../includes/popCollectif.php?idCollectif='+response+'&idUser='+idUser);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});

	});
	
});