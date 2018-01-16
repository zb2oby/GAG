jQuery(document).ready(function($) {


	$('.action-button').click(function(event) {
		var classe = $(this).attr('id');
		$(event.target).closest('.context-menu').find('.context-overlay').show();
		$(event.target).closest('.context-menu').find('.pop-'+classe+'.popGestionCard-artiste').show();

	});

	$('.context-overlay').click(function(event) {
		$(this).hide();
		$('.popGestionCard-artiste').hide();
	});

	$('.closeButton-context').click(function(event) {
		$(this).parent().hide();
		$('.context-overlay').hide();
	});

	$('.cancelButton').click(function(event) {
		$(this).parent().parent().parent().hide();
		$('.context-overlay').hide();
	});


	$(document).on('submit', '.popGestionCard-artiste form', function(event) {
		//varaibles communes
		var method = '';
		var idArtiste = $(event.target).data('idartiste');
		//modif clooectif
		var idCollectif = $(event.target).find('#idCollectif').val();
		var nomCollectif = $(event.target).find('#idCollectif option:selected').text();
		//modif image artiste
		var fileImage = $(event.target).find('#imageArtiste').val();
		var maxSize = $(event.target).find('#maxSize').val();
		var existImage = $(event.target).find('#existImage').val();
		//ajout message oeuvre
		var message = $(event.target).find('#newMsg').val();
		var dateMsg = $(event.target).find('#dateMsg').val();
		var idUser = $(event.target).find('#idUser').val();
		var nomUser = $(event.target).find('#nomUser').val();
		var nbMsg = parseInt($(event.target).closest('.card-action').find('.nbMsg').text());


		//modification de l'image artiste
		if (typeof fileImage != 'undefined') {
			method = 'POST';
			return true;
		}
		
		//ajout de message artiste
		if (typeof message != 'undefined' || typeof dateMsg != 'undefined' || typeof idUser != 'undefined' ) {
			method = 'GET';
			var dateFormat = dateMsg.split('-');
			var newDate = dateFormat[2]+'/'+dateFormat[1]+'/'+dateFormat[0];
			var data = 'idArtiste=' + idArtiste + '&message=' + message + '&dateMsg=' + dateMsg + '&idUser=' + idUser;
			$(event.target).closest('.context-menu').find('.card-msg').prepend('<div class="message"><div class="message-header"> Message de '+nomUser+' Le '+newDate+'</div><div class="message-content">'+message+'</div></div>');
			nbMsg++;
			$(event.target).closest('.card-action').find('.nbMsg').text(nbMsg);
			$(event.target).find('#newMsg').val('');
		}
		//update nom collectif
		if (typeof idCollectif != 'undefined') {
			method = 'GET';
			$(event.target).closest('.context-menu').find('#afficheCollectif').html('Collectif : '+nomCollectif);
			var data = 'idCollectif=' + idCollectif + '&idArtiste=' + idArtiste;
		}

		$.ajax({
				url: '../modules/traitementArtiste.php',
				type: method,
				dataType: 'html',
				data: data,
				processData: false,
				contentType: false
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
	$('.submit-artiste').click(function(event) {
		var idData = $(this).closest('.form-artiste').data('idartiste');
		var formId = '#form-artiste'+idData;

		$(formId).submit(function(event) {
			var idArtiste = idData;
			var nom = $('#nom'+idData).val();
			var prenom = $('#prenom'+idData).val();
			var tel = $('#tel'+idData).val();
			var email = $('#email'+idData).val();
			var descriptif = $('#descriptif'+idData).val();

			var data = 'idArtiste=' + idArtiste + '&nom=' + nom + '&prenom=' + prenom + '&tel=' + tel + '&email=' + email + '&descriptif=' + descriptif;

			$.ajax({
				url: '../modules/traitementArtiste.php',
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
			
			$(this).closest('.portlet').find('.titre').html(nom+' '+prenom);
			$(this).closest('.portlet').find('.card-header h4').html('"'+nom+'"');
			

			return false;
		});
	 });
	
	
});