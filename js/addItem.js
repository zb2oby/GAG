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
	
});