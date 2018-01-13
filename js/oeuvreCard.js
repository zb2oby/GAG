jQuery(document).ready(function($) {

	$('.action-button').click(function(event) {
		var classe = $(this).attr('id');
		$(event.target).closest('.context-menu').find('.context-overlay').show();
		$(event.target).closest('.context-menu').find('.pop-'+classe+'.popGestionCard').show();

	});

	$('.context-overlay').click(function(event) {
		$(this).hide();
		$('.popGestionCard').hide();
	});

	$('.closeButton-context').click(function(event) {
		$(this).parent().hide();
		$('.context-overlay').hide();
	});

	$('.cancelButton').click(function(event) {
		$(this).parent().parent().parent().hide();
		$('.context-overlay').hide();
	});


	$('.popGestionCard form').submit(function(event) {
		var idOeuvre = $(event.target).data('idoeuvre');
		var idOeuvreExposee = $(event.target).data('idoeuvreexposee');
		var dateEntree = $(event.target).find('#dateEntree').val();
		var idTypeOeuvre = $(event.target).find('#idType').val();
		var typeOeuvre = $(event.target).find('#idType option:selected').text();
		var idArtiste = $(event.target).find('#idArtiste').val();
		var idCollectif = $(event.target).find('#idCollectif').val();
		var nomArtiste = $(event.target).find('#idArtiste option:selected').text();
		var nomCollectif = $(event.target).find('#idCollectif option:selected').text();

		var fileImage = $(event.target).find('#imageOeuvre').val();
		var maxSize = $(event.target).find('#maxSize').val();
		var existImage = $(event.target).find('#existImage').val();
		
		var message = $(event.target).find('#newMsg').val();
		var dateMsg = $(event.target).find('#dateMsg').val();
		var idUser = $(event.target).find('#idUser').val();
		var nomUser = $(event.target).find('#nomUser').val();
		var nbMsg = parseInt($(event.target).closest('.card-action').find('.nbMsg').text());


		if (typeof fileImage != 'undefined') {
			return true;
		}
		

		if (typeof message != 'undefined' || typeof dateMsg != 'undefined' || typeof idUser != 'undefined' ) {
			var dateFormat = dateMsg.split('-');
			var newDate = dateFormat[2]+'/'+dateFormat[1]+'/'+dateFormat[0];
			var data = 'idOeuvre=' + idOeuvre + '&message=' + message + '&dateMsg=' + dateMsg + '&idUser=' + idUser;
			$(event.target).closest('.context-menu').find('.card-msg').prepend('<div class="message"><div class="message-header"> Message de '+nomUser+' Le '+newDate+'</div><div class="message-content">'+message+'</div></div>');
			nbMsg++;
			$(event.target).closest('.card-action').find('.nbMsg').text(nbMsg);
			$(event.target).find('#newMsg').val('');
		}

		if (typeof idArtiste != 'undefined' || typeof idCollectif != 'undefined') {
			$(event.target).closest('.context-menu').find('#afficheArtiste').html('Artiste : '+nomArtiste);
			$(event.target).closest('.context-menu').find('#afficheCollectif').html('Collectif : '+nomCollectif);
			var data = 'idArtiste=' + idArtiste + '&idCollectif=' + idCollectif + '&idOeuvre=' + idOeuvre;
		}


		if (typeof idTypeOeuvre != "undefined") {
			var data = 'idTypeOeuvre=' + idTypeOeuvre + '&idOeuvre=' + idOeuvre;
			$(event.target).closest('.context-menu').find('#afficheType').html('Type : '+typeOeuvre);
			
		}

		if (typeof idOeuvreExposee != "undefined" || typeof dateEntree != "undefined") {
			var dateFormat = dateEntree.split('-');
			var newDate = dateFormat[2]+'/'+dateFormat[1]+'/'+dateFormat[0];
			$(event.target).closest('.context-menu').find('#afficheDateEntree').html('Date d\'entrée : '+newDate);
			var data = 'idOeuvreExposee=' + idOeuvreExposee + '&dateEntree=' + dateEntree;
		}
			

		$.ajax({
				url: '../modules/traitementOeuvre.php',
				type: 'GET',
				dataType: 'html',
				data: data,
			})
			.done(function() {
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		
		return false;

	});


//A REECRIRE AVEC DES EVENT TARGET AU LIEU D'ID DEGEULASSE
	var formId;
	$('.submit-oeuvre').click(function(event) {
		var idData = $(this).closest('.form-oeuvre').data('idoeuvre');
		var formId = '#form-oeuvre'+idData;

		$(formId).submit(function(event) {
			var idOeuvre = idData;
			var titre = $('#titre'+idData).val();
			var longueur = $('#longueur'+idData).val();
			var hauteur = $('#hauteur'+idData).val();
			var etat = $('#etat'+idData).val();
			var descriptif = $('#descriptif'+idData).val();

			var data = 'idOeuvre=' + idOeuvre + '&titre=' + titre + '&longueur=' + longueur + '&hauteur=' + hauteur + '&etat=' + etat + '&descriptif=' + descriptif;

			$.ajax({
				url: '../modules/traitementOeuvre.php',
				type: 'GET',
				dataType: 'html',
				data: data,
			})
			.done(function() {
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
			$(this).closest('.portlet').find('.titre').html(titre);
			$(this).closest('.portlet').find('.card-header h4').html('"'+titre+'"');
			

			return false;
		});
	 });
	
	
});