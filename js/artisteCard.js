jQuery(document).ready(function($) {

	$(document).on('click', '.action-button', function(event) {
		var classe = $(this).attr('id');
		$(event.target).closest('.context-menu').find('.context-overlay').show();
		$(event.target).closest('.context-menu').find('.pop-'+classe+'.popGestionCard-artiste').show();
		$(event.currentTarget).closest('.context-menu').find('.pop-'+classe+'.popGestionCard').show();
		
	});

	$(document).on('click', '.context-overlay', function(event) {
		$(this).hide();
		$('.popGestionCard-artiste').hide();
		$('.popGestionCard').hide();
	});
	//FERMETURE DES FORMULAIRES INTEGRE A LA CARTE
	$(document).on('click', '.closeButton-context', function(event) {
		$(this).parent().hide();
		$('.context-overlay').hide();
	});
	

	$(document).on('click', '.cancelButton', function(event) {
		// $(this).parent().parent().parent().hide();
		// $('.context-overlay').hide();
	});
	


	//AFFICHAGE CONTEXT MENU DUNE CARTE ARTISTE
	$('.portlet-artiste').click(function(event) {
        $(event.target).parent().find('.context-artiste').css('display', 'block');
        $(this).parent().find('.context-oeuvre').hide();
        //$(event.target).closest('.container').find('.overlay').show();
        
    });
    $('.portlet-artiste .titre').click(function(event) {
        $(event.target).parent().parent().find('.context-artiste').css('display', 'block');
        $(this).parent().find('.context-oeuvre').hide();
        //$(event.target).closest('.container').find('.overlay').show();
        
    });
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
		//info generale
		var nom = $(event.target).find('#nom').val();
		var prenom = $(event.target).find('#prenom').val();
		var tel = $(event.target).find('#tel').val();
		var email = $(event.target).find('#email').val();
		var descriptif = $(event.target).find('#descriptif').val();
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
		var nbMsg = parseInt($(event.currentTarget).parent().parent().parent().find('#messagerieArtiste .nbMsg').text());
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
		//suppression d'un artiste
		var delArtiste = $(event.currentTarget).find('#delArtiste').val();


		//donnee generales
		if (typeof nom != 'undefined' || typeof prenom != 'undefined' || typeof tel != 'undefined' || typeof email != 'undefined' || typeof descriptif != 'undefined') {
			method = 'GET';
			var data = 'idArtiste=' + idArtiste + '&nom=' + nom + '&prenom=' + prenom + '&tel=' + tel + '&email=' + email + '&descriptif=' + descriptif;
			
			var gnl = 'ok';
		}

		//suppression artiste
		if (typeof delArtiste != 'undefined') {
			method = 'GET';
			var data = 'idArtiste=' + idArtiste + '&req=' + delArtiste;
			$(event.currentTarget).closest('.portlet-artiste').remove();
			//suppression des option de select correspondant a l'artiste supprimé
			var arraySelect = $('select#artiste option');
			console.log(arraySelect);
			for (var i = arraySelect.length - 1; i >= 0; i--) {
				if ($(arraySelect[i]).val() == idArtiste ) {
					$(arraySelect[i]).remove();
				}
				
			}
			$('.overlay').hide();
			$('.context-overlay').hide();
			$(event.target).closest('.context-menu').remove();
		}

		//creation nouvelle oeuvre
		if (typeof addOeuvreArtiste != 'undefined') {
			method = 'GET';
			var data = 'idArtiste=' + idArtiste + '&req=' + addOeuvreArtiste;
			//ajout de la nouvelle oeuvre dans les selects oeuvre prevue et recue
			if (typeof titre == 'undefined') {
				var titre = 'Oeuvre sans titre';
			}
			var url = window.location.href;
			var urlSplit = url.split('/');
			var urlParam = urlSplit[urlSplit.length -1].split('?');
			var page = urlParam[0];
			if (page == 'gestionPanel.php') {
				$(document).find('.popAddCard select#oeuvre').append('<option value="'+idOeuvre+'">'+titre+'</option>');
				$(document).find('.popAddRecue select#oeuvre').append('<option value="'+idOeuvre+'">'+titre+'</option>')
			}
			var html = 'ok';
		}

		//ajout de collectif
		if (typeof idCollectif != 'undefined') {
			method = 'GET';
			var data = 'idCollectif=' + idCollectif + '&idArtiste=' + idArtiste;
			$(event.target).closest('.context-menu').find('.card-communaute ul').prepend('<li class="comInfo" >Collectif '+libelleCollectif+'<form class="form-artiste" data-idArtiste="'+idArtiste+'" action="../modules/traitementArtiste.php" method="GET"><input type="hidden" id="req" name="req" value="deleteColl"><input type="hidden" id="idColl" name="idColl" value="'+idCollectifDeleted+'"><button type="submit" class="delColl"><i class="ion-ios-trash-outline" title="Supprimer"></i></button></form></li>');
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
			$(event.target).closest('.context-menu').find('.card-msg').prepend('<div class="message" data-idmessage=""><div class="message-header"> Message de '+nomUser+' Le '+newDate+'<span class="delMsgArt delMsg"><a>supprimer le message</a></span></div><div class="message-content">'+message+'</div></div>');
			nbMsg++;
			$(event.target).closest('.card-action').find('#messagerieArtiste .nbMsg').text(nbMsg);
			$(event.target).find('#newMsg').val('');
			var messagerie = 'ok';
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
				//si l'envoie ajax concerne les info generales
				if (gnl == 'ok') {
					//si il y a deja des erreur on les supprime avant de les reafficher
					$('.card-error').hide();
					//lorsque la reponse n'est pas vide cela signifie qu'il y a des erreur
					if (response != '') {
						//on defini la varaible d'erreur a true
						var error = true;
						//traitement du retour json
						var msg = JSON.parse(response);
						//pour chaque entree du tableau renvoyé en json on l'affiche dans une div error
						$.each(msg, function(index, el) {
							if (el != null) {
								var input = '#'+index;
								$(event.target).find(input).closest('div').append('<div class="card-error" style="position:absolute;">'+msg[index]+'</div>');
								
							}
							
						});
					}
					//lorsque la reponse est vide la varaible error n'est pas a true
					if (error != true) {
						//on peut donc afficher les modification dans le DOM car la base a été mise à jour.
						$(event.target).closest('.portlet-artiste').find('.titre').html(nom+' '+prenom);
						$(event.target).closest('.context-artiste').find('.card-title h4').html('"'+nom+'"');
						$('.confirmSet').css('display', 'block');
						$('.context-overlay').show();
						setTimeout(function(){
							$('.confirmSet').css('display', 'none');
							$('.context-overlay').hide();
						}, 1500);
					}
					
					
				}

				if (messagerie == 'ok') {
					$(event.target).closest('.context-menu').find('.card-msg').prepend('<div class="message" data-idmessage="'+response+'"><div class="message-header"> Message de '+nomUser+' Le '+newDate+'<span class="delMsgArt delMsg"><a>supprimer le message</a></span></div><div class="message-content">'+message+'</div></div>');
				}
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


// A FACTORISER
	$(document).on('click', '.delMsgArt', function(event) {
		var idMessage = $(event.currentTarget).closest('.message').data('idmessage');
		var nbMsg = parseInt($(event.target).closest('.card-action').find('#messagerieArtiste .nbMsg').html());
		nbMsg --;
		$(event.target).closest('.card-action').find('#messagerieArtiste .nbMsg').text(nbMsg);
		$(event.target).closest('.message').remove();
		var data = 'idMessage=' + idMessage;


		$.ajax({
			url: '../modules/traitementArtiste.php',
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
		//return false;
	});

	
});