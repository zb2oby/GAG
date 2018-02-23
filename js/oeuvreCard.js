jQuery(document).ready(function($) {

	$(document).on('submit', '.form-oeuvre', function(event) {
		//varaibles communes
		var method = '';
		var idOeuvre = $(event.currentTarget).data('idoeuvre');
		//donnee Generale
		var titre = $(event.currentTarget).find('#titre').val();
		var longueur = $(event.currentTarget).find('#longueur').val();
		var hauteur = $(event.currentTarget).find('#hauteur').val();
		var etat = $(event.currentTarget).find('#etat').val();
		var descriptif = $(event.currentTarget).find('#descriptif').val();
		//modif date entree oeuvre exposee
		var idOeuvreExposee = $(event.currentTarget).data('idoeuvreexposee');
		var dateEntree = $(event.currentTarget).find('#dateEntree').val();
		//poidif type oeuvre
		var idTypeOeuvre = $(event.currentTarget).find('#idType').val();
		var typeOeuvre = $(event.currentTarget).find('#idType option:selected').text();
		//modif artiste ou clooectif
		var idArtiste = $(event.currentTarget).find('#idArtiste').val();
		var idCollectif = $(event.currentTarget).find('#idCollectif').val();
		var nomArtiste = $(event.currentTarget).find('#idArtiste option:selected').text();
		var nomCollectif = $(event.currentTarget).find('#idCollectif option:selected').text();
		//modif image oeuvre
		var formImage = $(event.currentTarget).get(0);
		var fileImage = new FormData(formImage);
		var maxSize = $(event.currentTarget).find('#maxSize').val();
		var existImage = $(event.currentTarget).find('#existImage').val();
		//ajout message oeuvre
		var message = $(event.currentTarget).find('#newMsg').val();
		var dateMsg = $(event.currentTarget).find('#dateMsg').val();
		var idUser = $(event.currentTarget).find('#idUser').val();
		var nomUser = $(event.currentTarget).find('#nomUser').val();
		var nbMsg = parseInt($(event.currentTarget).closest('.card-action').find('#messagerieOeuvre .nbMsg').text());
		//suppression contenu+
		var idDonneeDeleted = $(event.currentTarget).find('#idDonnee').val();
		var delDonnee = $(event.currentTarget).find('#req').val();
		//ajout contenu+
		var formMeta = $(event.currentTarget).get(0);
		var formData = new FormData(formMeta);
		var idTypeDonnee = $(event.currentTarget).find('#typeDonnee').val();
		var libelleTypeDonnee = $(event.currentTarget).find('#typeDonnee option:selected').text();
		var libelleDonnee = $(event.currentTarget).find('#libelleDonnee').val();
		//suppression d'une oeuvre
		var delOeuvre = $(event.currentTarget).find('#delOeuvre').val();


		//suppression oeuvre
		if (typeof delOeuvre != 'undefined') {
			method = 'GET';
			data = 'idOeuvre=' + idOeuvre + '&req=' + delOeuvre;
			var arrayPortlet = $('.portlet-oeuvre');
			for (var i = arrayPortlet.length - 1; i >= 0; i--) {
				if ($(arrayPortlet[i]).find('.img').data('id') == idOeuvre) {
					$(arrayPortlet[i]).remove();

				}
				
			}
			var arraySelect = $('select#oeuvre option');
			//console.log(arraySelect);
			for (var i = arraySelect.length - 1; i >= 0; i--) {
				if ($(arraySelect[i]).val() == idOeuvre ) {
					$(arraySelect[i]).remove();
				}
				
			}
			$(event.currentTarget).closest('.li-oeuvre-artiste').remove();
			$('.context-menu').hide();
			$('.popGestionCard').hide();
			$('.overlay').hide();
		}
		//donnee generale
		if (typeof titre != 'undefined' || typeof longueur != 'undefined' || typeof hauteur != 'undefined' || typeof etat != 'undefined' || typeof descriptif != 'undefined') {
			var method = 'GET';
			var data = 'idOeuvre=' + idOeuvre + '&titre=' + titre + '&longueur=' + longueur + '&hauteur=' + hauteur + '&etat=' + etat + '&descriptif=' + descriptif;
			var gnl = 'ok';

			
		}
		//suppression contenu+
		if (typeof idDonneeDeleted != 'undefined' || typeof delDonnee != 'undefined') {
			method = 'GET';
			var data = 'idDonnee=' + idDonneeDeleted + '&req=' + delDonnee + '&idOeuvre=' + idOeuvre;
			$(event.currentTarget).parent().remove();
		}

		//ajout contenu+
		if (typeof formMeta != 'undefined' && typeof idTypeDonnee != 'undefined' && typeof libelleDonnee != 'undefined') {
			method = 'POST';
			var data = formData;
			var html = 'ok';
		}

		//modification de l'image oeuvre
		if (typeof fileImage != 'undefined' && typeof maxSize != 'undefined' && typeof existImage != 'undefined') {
			method = 'POST';
			var data = fileImage;
			var imageOeuvre = 'ok';
			//return true;
		}
		
		//ajout de message oeuvre
		if (typeof message != 'undefined' || typeof dateMsg != 'undefined' || typeof idUser != 'undefined' ) {
			method = 'GET';
			var dateFormat = dateMsg.split('-');
			var newDate = dateFormat[2]+'/'+dateFormat[1]+'/'+dateFormat[0];
			var data = 'idOeuvre=' + idOeuvre + '&message=' + message + '&dateMsg=' + dateMsg + '&idUser=' + idUser;
			// $(event.currentTarget).closest('.context-menu').find('.card-msg').prepend('<div class="message"><div class="message-header"> Message de '+nomUser+' Le '+newDate+'<span class="delMsgOeuvre delMsg"><a>supprimer le message</a></span></div><div class="message-content">'+message+'</div></div>');
			nbMsg++;
			$(event.currentTarget).closest('.card-action').find('#messagerieOeuvre .nbMsg').text(nbMsg);
			$(event.currentTarget).find('#newMsg').val('');
			var messagerie = 'ok';
		}
		//update nom artiste et collectif
		if (typeof idArtiste != 'undefined' || typeof idCollectif != 'undefined') {
			method = 'GET';
			$(event.currentTarget).closest('.context-menu').find('#afficheArtiste').html('Artiste : '+nomArtiste);
			$(event.currentTarget).closest('.context-menu').find('#afficheCollectif').html('Collectif : '+nomCollectif);
			var data = 'idArtiste=' + idArtiste + '&idCollectif=' + idCollectif + '&idOeuvre=' + idOeuvre;
		}

		//update type d'oeuvre
		if (typeof idTypeOeuvre != "undefined") {
			method = 'GET';
			var data = 'idTypeOeuvre=' + idTypeOeuvre + '&idOeuvre=' + idOeuvre;
			$(event.currentTarget).closest('.context-menu').find('#afficheType').html('Type : '+typeOeuvre);
			
		}

		//modification date d'entree oeuvre prevue-recue
		if (typeof idOeuvreExposee != "undefined" || typeof dateEntree != "undefined") {
			method = 'GET';
			var dateFormat = dateEntree.split('-');
			var newDate = dateFormat[2]+'/'+dateFormat[1]+'/'+dateFormat[0];
			$(event.currentTarget).closest('.context-menu').find('#afficheDateEntree').html('Date d\'entrée : '+newDate);
			var data = 'idOeuvreExposee=' + idOeuvreExposee + '&dateEntree=' + dateEntree;
		}
			

		$.ajax({
				url: '../modules/traitementOeuvre.php',
				type: method,
				dataType: 'html',
				data: data,
				processData: false,
				contentType: false
			})
			.done(function(response) {
				//console.log("success");
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
						var arrayPortlet = $('.portlet-oeuvre');
						for (var i = arrayPortlet.length - 1; i >= 0; i--) {
							if ($(arrayPortlet[i]).find('.img').data('id') == idOeuvre) {
								$(arrayPortlet[i]).find('.titre').html(titre);

							}
							
						}
						var arrayOeuvre = $('.oeuvreArtiste');
						for (var i = arrayOeuvre.length - 1; i >= 0; i--) {
							if ($(arrayOeuvre[i]).data('idoeuvre') == idOeuvre) {
								$(arrayOeuvre[i]).parent().find('.titreOeuvreArtiste').html(titre);
							}
						}
						
						$(event.target).closest('.context-oeuvre').find('.card-header h4').html('"'+titre+'"');
						$('.confirmSet').css('display', 'block');
						$('.context-overlay').show();
						setTimeout(function(){
							$('.confirmSet').css('display', 'none');
							$('.context-overlay').hide();
						}, 1500);
					}
					
					
				}
				if (messagerie == 'ok') {

					$(event.currentTarget).closest('.context-menu').find('.card-msg').prepend('<div class="message" data-idmessage="'+response+'"><div class="message-header"> Message de '+nomUser+' Le '+newDate+'<span class="delMsgOeuvre delMsg"><a>supprimer le message</a></span></div><div class="message-content">'+message+'</div></div>');
				}
				if (html == 'ok') {
					var idDonneeDeleted = parseFloat(response);
					$(event.currentTarget).closest('.context-menu').find('.card-data ul').prepend('<li class="metaData">Type de donnée : '+libelleTypeDonnee+' <br>Libellé : '+libelleDonnee+'<br><form class="form-oeuvre" data-idOeuvre="'+idOeuvre+'" action="../modules/traitementOeuvre.php" method="GET"><input type="hidden" id="req" name="req" value="deleteMeta"><input type="hidden" id="idDonnee" name="idDonnee" value="'+idDonneeDeleted+'"><button type="submit" class="delData"><i class="ion-ios-trash-outline" title="Supprimer"></i></button></form></li>');
					$(event.currentTarget).each(function(){
					    this.reset();
					});
				}
				if (imageOeuvre == 'ok') {
					$(document).load('../img/oeuvres/'+response);
					//changement de l'image sur la carte oeuvre
					// console.log($(event.currentTarget).closest('.context-oeuvre').find('.card-image img'));
					$(event.currentTarget).closest('.context-oeuvre').find('.card-image').html('<img src="../img/oeuvres/'+response+'">');
					
					//changement de l'image sur le portlet
					var arrayPortlet = $('.portlet-oeuvre');
					for (var i = arrayPortlet.length - 1; i >= 0; i--) {
						if ($(arrayPortlet[i]).find('.img').data('id') == idOeuvre) {
							$(arrayPortlet[i]).closest('.portlet').find('.img').html('<img src="../img/oeuvres/'+response+'">');
						}
						
					}
					//changement de l'image sur la liste des oeuvre de la carte artiste
					var arrayOeuvre = $('.oeuvreArtiste');
					for (var i = arrayOeuvre.length - 1; i >= 0; i--) {
						if ($(arrayOeuvre[i]).data('idoeuvre') == idOeuvre ){
							$(arrayOeuvre[i]).parent().find('.imgOeuvreArtiste').remove();
							$(arrayOeuvre[i]).parent().append('<img class="imgOeuvreArtiste" style="width:20px; height:20px;" src="../img/oeuvres/'+response+'">');

						}
					}
					$(event.currentTarget).closest('.pop-modifImageOeuvre').hide();
					$('.context-overlay').hide();
				}
				
				
			}) 
			.fail(function() {
				//console.log("error");
			})
			.always(function() {
				//console.log("complete");
			});
			
		return false;

	});
//A FACTORISER
	$(document).on('click', '.delMsgOeuvre', function(event) {
		var idMessage = $(event.currentTarget).closest('.message').data('idmessage');
		var nbMsg = parseInt($(event.target).closest('.card-action').find('#messagerieOeuvre .nbMsg').text());
		nbMsg --;
		$(event.target).closest('.card-action').find('#messagerieOeuvre .nbMsg').html(nbMsg);
				$(event.target).closest('.message').remove();
		var data = 'idMessage=' + idMessage;


		$.ajax({
			url: '../modules/traitementOeuvre.php',
			type: 'GET',
			dataType: 'html',
			data: data
		})
		.done(function() {
			//console.log("success");
		})
		.fail(function() {
			//console.log("error");
		})
		.always(function() {
			//console.log("complete");
		});
		//return false;

	});
	
});