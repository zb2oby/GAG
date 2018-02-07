jQuery(document).ready(function($) {

	$(document).on('click', '.action-button', function(event) {
		var classe = $(this).attr('id');
		$(event.target).closest('.context-menu').find('.context-overlay').show();
		$(event.target).closest('.context-menu').find('.pop-'+classe+'.popGestionCard-collectif').show();
		$(event.currentTarget).closest('.context-menu').find('.pop-'+classe+'.popGestionCard').show();
		
	});

	$(document).on('click', '.context-overlay', function(event) {
		$(this).hide();
		$('.popGestionCard-collectif').hide();
		$('.popGestionCard').hide();
	});

	$(document).on('submit', '.form-collectif', function(event) {
		event.preventDefault();
		var method = '';
		var idCollectif = $(event.target).data('idcollectif');

		var libelle = $(event.target).find('#libelle').val();
		var tel = $(event.target).find('#tel').val();
		var email = $(event.target).find('#email').val();
		var descriptif = $(event.target).find('#descriptif').val();

		var message = $(event.target).find('#newMsg').val();
		var dateMsg = $(event.target).find('#dateMsg').val();
		var idUser = $(event.target).find('#idUser').val();
		var nomUser = $(event.target).find('#nomUser').val();
		var nbMsg = parseInt($(event.target).closest('.card-action').find('#messagerieCollectif .nbMsg').text());

		var delColl = $(event.target).find('#delColl').val();
		console.log(delColl);

		//suppression du collectif
		if (delColl == 'delete') {
			var method = 'GET';
			var data = 'idCollectif=' + idCollectif + '&req=' + delColl;
			$(event.currentTarget).closest('.context-menu').remove();
			$('.overlay').hide();
			$('.context-overlay').hide();
		}

		//donnée generale
		if (typeof libelle != 'undefined' || typeof tel != 'undefined' || typeof email != 'undefined' || typeof descriptif != 'undefined') {
			var method = 'GET';
			var data = 'idCollectif=' + idCollectif + '&libelle=' + libelle + '&tel=' + tel +'&email=' + email + '&descriptif=' + descriptif;
			$(this).closest('.context-collectif').find('.card-title h4').html('"'+libelle+'"');			
		}


		//ajout de message collectif
		if (typeof message != 'undefined' || typeof dateMsg != 'undefined' || typeof idUser != 'undefined' ) {
			var method = 'GET';
			var dateFormat = dateMsg.split('-');
			var newDate = dateFormat[2]+'/'+dateFormat[1]+'/'+dateFormat[0];
			var data = 'idCollectif=' + idCollectif + '&message=' + message + '&dateMsg=' + dateMsg + '&idUser=' + idUser;
			$(event.target).closest('.context-menu').find('.card-msg').prepend('<div class="message"><div class="message-header"> Message de '+nomUser+' Le '+newDate+'<span class="delMsgColl delMsg"><a>supprimer le message</a></span></div><div class="message-content">'+message+'</div></div>');
			nbMsg++;
			$(event.target).closest('.card-action').find('.nbMsg').text(nbMsg);
			$(event.target).find('#newMsg').val('');
		}

		$.ajax({
			url: '../modules/traitementCollectif.php',
			type: method,
			dataType: 'html',
			data: data,
		})
		.done(function(response) {
			console.log("success");
			console.log(response);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});

		return false;
		
	});

//A FACTORISER
	$(document).on('click', '.delMsgColl', function(event) {
		var idMessage = $(event.currentTarget).closest('.message').data('idmessage');
		var nbMsg = parseInt($(event.target).closest('.card-action').find('#messagerieCollectif .nbMsg').text());
		nbMsg = --;
		$(event.target).closest('.card-action').find('#messagerieCollectif .nbMsg').text(nbMsg);
		$(event.target).closest('.message').remove();
		var data = 'idMessage=' + idMessage;


		$.ajax({
			url: '../modules/traitementCollectif.php',
			type: 'GET',
			dataType: 'html',
			data: data
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
});