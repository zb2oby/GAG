jQuery(document).ready(function($) {

	$('.add').click(function(event) {
		event.stopPropagation();
		$('.context-add').toggleClass('context-add-visible');
		
	});

	$('body').click(function(event) {
		event.stopPropagation();
		$('.context-add').removeClass('context-add-visible');
	});
//affichage duformulaire d'expo depuis bouton + (traitement dans expo.js)
	$('.context-addExpo').click(function(event) {
		$('.context-add').css('display', 'none');
		$('#newExpo').css('display', 'block');
		$('#newExpo').parent().find('.overlay').show();
	});

//traitmeent de l'ajout d'artiste depuis le bouton + 
	$(document).on('click', '.context-addArtiste', function(event) {

		$('.context-add').css('display', 'none');
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
			// console.log(response);
			// console.log(idUser);
			$('.overlay').show();
			$('.addArt').load('../js/artisteCard.js');
			$('.addArt').load('../includes/popArtiste.php?idArtiste='+response+'&idUser='+idUser);
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
		$('.context-add').css('display', 'none');
	});

	$(document).on('submit', '.modalAddOeuvre .form-add', function(event) {
		$('.modalAddOeuvre').css('display', 'none');
		var idArtiste = parseFloat($(event.target).find('#idArtiste').val());
		var data = 'req=add&idArtiste='+idArtiste;
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
		$('.context-add').css('display', 'none');
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