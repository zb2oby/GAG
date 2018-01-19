jQuery(document).ready(function($) {


	$('.action-button').click(function(event) {
		var classe = $(this).attr('id');
		$(event.target).closest('.context-menu').find('.context-overlay').show();
		$(event.target).closest('.context-menu').find('.pop-'+classe+'.popGestionCard-artiste').show();
		$(event.currentTarget).closest('.context-menu').find('.pop-'+classe+'.popGestionCard').show();
	});

	$('.context-overlay').click(function(event) {
		$(this).hide();
		$('.popGestionCard-artiste').hide();
		$('.popGestionCard').hide();
	});
	//FERMETURE DES FORMULAIRES INTEGRE A LA CARTE
	$('.closeButton-context').click(function(event) {
		$(this).parent().hide();
		$('.context-overlay').hide();
	});

	$('.cancelButton').click(function(event) {
		$(this).parent().parent().parent().hide();
		$('.context-overlay').hide();
	});


	//AFFICHAGE CONTEXT MENU DUNE CARTE ARTISTE
	$('.portlet-artiste').click(function(event) {
        $(event.target).parent().find('.context-artiste').css('display', 'block');
        $(this).parent().find('.context-oeuvre').hide();
        $('.overlay').show();
        
    });
    $('.portlet-artiste .titre').click(function(event) {
        $(event.target).parent().parent().find('.context-artiste').css('display', 'block');
        $(this).parent().find('.context-oeuvre').hide();
        $('.overlay').show();
        
    });
 //    //AFFICHAGE POPUP DE CONFIRMATION DE SUPPRESSION (bug avec affichage carte oeuvre contenue dans carte artiste)
 //    //surement un probleme de zindex ou qqch comme ca
 //    $('.oeuvreArtiste').click(function(event) {
	// 	$(event.currentTarget).closest('.li-oeuvre-artiste').find('.pop-delOeuvreArtiste').css('display', 'block');
	// 	$(event.currentTarget).closest('.li-oeuvre-artiste').find('.context-oeuvre').css('display', 'none');
	// 	// $('.context-oeuvre').css('display', 'none');
	// });
    //AFFICHAGE CARTE OEUVRE CONTENUE DANS CARTE ARTISTE
	$(document).on('click', '.li-oeuvre-artiste', function(event) {
		// event.preventDefault();
		$(event.currentTarget).find('.context-menu').css({
    		display: 'block',
    		zIndex: '7',
    		top: '0px',
    	});
	});


	$(document).on('submit', '.form-artiste', function(event) {
		//varaibles communes
		var method = '';
		var idArtiste = $(event.target).data('idartiste');
		//modif clooectif
		var idCollectif = $(event.target).find('#idCollectif').val();
		var nomCollectif = $(event.target).find('#idCollectif option:selected').text();
		//modif image artiste
		var formImage = $(event.currentTarget).get(0);
		var fileImage = new FormData(formImage);
		var maxSize = $(event.target).find('#maxSize').val();
		var existImage = $(event.target).find('#existImage').val();
		//ajout message oeuvre
		var message = $(event.target).find('#newMsg').val();
		var dateMsg = $(event.target).find('#dateMsg').val();
		var idUser = $(event.target).find('#idUser').val();
		var nomUser = $(event.target).find('#nomUser').val();
		var nbMsg = parseInt($(event.target).closest('.card-action').find('.nbMsg').text());
		//suppression Collectif
		var idCollectifDeleted = $(event.target).find('#idColl').val();
		var delColl = $(event.target).find('#req').val();
		//ajout Collectif
		var idCollectif = $(event.target).find('#idCollectif').val();
		var libelleCollectif = $(event.target).find('#idCollectif option:selected').text(); 
		//creation nouvelle oeuvre pour l'artiste
		var addOeuvreArtiste = $(event.target).find('#addArtiste').val();
		//suppression d'une oeuvre de la fiche artiste
		var delOeuvreArtiste = $(event.target).find('#delOeuvre').val();
		var idDelOeuvre = $(event.target).find('#idOeuvre').val();



		// //suppression d'une oeuvre de la fiche artiste
		// if (typeof delOeuvreArtiste != 'undefined' && typeof idDelOeuvre != 'undefined') {
		// 	method = 'GET';
		// 	var data = 'idOeuvre=' + idDelOeuvre;
		// 	$(event.currentTarget).closest('.li-oeuvre-artiste').remove();
		// }

		//creation nouvelle oeuvre
		if (typeof addOeuvreArtiste != 'undefined') {
			method = 'GET';
			var data = 'idArtiste=' + idArtiste + '&req=' + addOeuvreArtiste;
			var html = 'ok';
		}

		//ajout de collectif
		if (typeof idCollectif != 'undefined') {
			method = 'GET';
			var data = 'idCollectif=' + idCollectif + '&idArtiste=' + idArtiste;
			$(event.target).closest('.context-menu').find('.card-communaute ul').prepend('<li>Collectif '+libelleCollectif+'<form data-idArtiste="'+idArtiste+'" action="../modules/traitementArtiste.php" method="GET"><input type="hidden" id="req" name="req" value="deleteColl"><input type="hidden" id="idColl" name="idColl" value="'+idCollectifDeleted+'"><button type="submit" class="delColl"><i class="ion-ios-trash-outline" title="Supprimer"></i></button></form></li>');
			$(event.target).closest('.context-menu').find('#afficheCollectifArtiste').append('<div id="coll-'+idCollectif+'"> - Collectif '+libelleCollectif+'</div>');
		}
		//suppression collectif
		if (typeof idCollectifDeleted != 'undefined' || typeof delColl != 'undefined') {
			method = 'GET';
			var data = 'idCollectif=' + idCollectifDeleted + '&req=' + delColl + '&idArtiste=' + idArtiste;
			$(event.target).closest('.context-menu').find('.cardHeader-bottom #coll-'+idCollectifDeleted).html('');
			$(event.target).parent().remove();	
		}
		//modification de l'image artiste
		if (typeof fileImage != 'undefined' && typeof maxSize != 'undefined' && typeof existImage != 'undefined') {
			method = 'POST';
			var data = fileImage;
			var image = 'ok';
			//return true;
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
			.done(function(response) {
				console.log("success");
				//retour de l'ajout d'oeuvre
				//creation de l'element dans le dom avec include du popOeuvre pour le clic sur lelement ajouté
				if (html == 'ok') {
					var affichageLastOeuvre = response;
					//on cree l'element
					$(event.currentTarget).closest('.context-menu').find('.list-oeuvre-artiste').prepend(affichageLastOeuvre);
					//on recupere l'idOeuvre du dernier element cree
					var idOeuvre = $(event.currentTarget).closest('.context-menu').find('.oeuvreArtiste').data('idoeuvre');
					console.log(idOeuvre);
					//on charge le include popOeuvre seuelement pour le dernier element cree avec l'idoeuvre recuepere pour le fonctionnement du include
					var arrayOeuvre = $('.oeuvreArtiste');
					if ($(arrayOeuvre[0]).data('idoeuvre') == idOeuvre ){
						$(arrayOeuvre[0]).load('../includes/popOeuvre.php?idOeuvre='+idOeuvre);

					}
					//on ferme le formulaire d'ajout d'oeuvre
					$(event.currentTarget).closest('.pop-addOeuvre').hide();
					$('.context-overlay').hide();
				}
				else if (image == 'ok') {
					$(document).load('../img/artistes/'+response);
					$(event.currentTarget).closest('.context-menu').find('.card-image').html('<img src="../img/artistes/'+response+'">');
					$(event.currentTarget).closest('.portlet').find('.img').html('<img src="../img/artistes/'+response+'">');
					$(event.currentTarget).closest('.pop-modifImageArtiste').hide();
					$('.context-overlay').hide();
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
			
			$(this).closest('.portlet-artiste').find('.titre').html(nom+' '+prenom);
			$(this).closest('.context-artiste').find('.card-title h4').html('"'+nom+'"');
			

			return false;
		});
	 });
	
	
});