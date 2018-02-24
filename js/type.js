jQuery(document).ready(function($) {

//PROBLEME CAR DELEGUE AU DOC CELA NE FONCTIONNE PLUS ET PAS DELEGUÉ CELA NEFONCTIONNE PAS APRES CREATION DE USER
	$(document).on('click', '.typeItem', function(event) {
		var libelle = $(event.target).data('libelle');
		var idType = $(event.target).data('id');
		$('.typeForm').find('#libelle').val(libelle);
		$('.typeForm').find('#idType').val(idType);
		
	});
	
	//
	$(document).on('click', '.deleteType', function(event) {
		$('.typeForm').trigger('submit');
		$('.confirmPopup-type').css('display', 'none');
		//$('.context-overlay').hide();
	});
	
	//vidage du formulaire sur appuis boutton "annuler/vider"
	$(document).on('click', '#emptyType', function(event) {
		$('.typeForm')[0].reset();
		return false;
	});

	//affichage du popup de confirmation de supression utilisateur et hydratation du champs req
	$(document).on('click', '#delType', function(event) {
		$('.typeForm').find('#req').val('delType');
		$('.confirmPopup-type').css('display', 'block');
		$('.context-overlay').show();
		
		return false;
	});

	$(document).on('click', '.context-type .context-overlay', function(event) {
		$('.confirmPopup-type').css('display', 'none');
		$('.context-overlay').hide();
	});
	

	$(document).on('click', '.cancelButton-type', function(event) {
		$('.confirmPopup-type').css('display', 'none');
		$('.context-overlay').hide();
	});

	$(document).on('submit', '.typeForm', function(event) {
		//event.preventDefault();
		//event.stopPropagation();
		var libelle = $('.typeForm').find('#libelle').val();
		var idType = $('.typeForm').find('#idType').val();
		var del = $('.typeForm').find('#req').val();
		//affichage message enregistrement (mis avant car le temps d'envoie de mail peut etre long donc vaut mieux afficher le message pour pas que l'utilisateur reclic inutilement)
		//creer un effet de bord car lorsque les champs conteinnenet des erreur il y a quand meme le message d'enregistrement qui s'affiche
		$('.confirmSet').css('display', 'block');
		$('.context-overlay').show();
		setTimeout(function(){
			$('.confirmSet').css('display', 'none');
			$('.context-overlay').hide();
		}, 1500);
		
		var data = 'idType=' + idType + '&libelle=' + libelle +'&req=' + del;
		$.ajax({
			url: '../modules/traitementType.php',
			type: 'GET',
			dataType: 'html',
			data: data,
		})
		.done(function(response) {
			console.log("success");
			var msg = JSON.parse(response);
			$('.card-error').hide();
			//console.log(msg.error);
				if (msg.error == 'error') {
			        
		        	if (response != '') {
						//on defini la varaible d'erreur a true
						var error = true;
						//pour chaque entree du tableau renvoyé en json on l'affiche dans une div error
						$.each(msg, function(index, el) {
							if (el != null) {
								var input = '#'+index;
								$(event.target).find(input).closest('div').append('<div class="card-error" style="position:absolute;">'+msg[index]+'</div>');
								
							}
							

						});
					}
				}
				else if(msg.error != 'error'){
					if (msg.del != 'del') {
						var idType = msg.idType;
						
					
						var list = $('.afficheType ul').find('li a');
						
						for (var i = list.length - 1; i >= 0; i--) {
							var idTypeUpdate = $(list[i]).data('id');
							//console.log(idUserUpdate);
							var idTypeList = $('.typeForm').find('#idType').val();
							if (idTypeList == idTypeUpdate) {
								$(list[i]).remove();
							}
						}
						var listSelect = $('.form-oeuvre').find('#idType');
						for (var i = listSelect.length - 1; i >= 0; i--) {
							$(listSelect[i]).append('<option value="'+idType+'">'+libelle+'</option>');
						}
						
						$('.afficheType ul').prepend('<li><a class="typeItem" data-libelle="'+libelle+'" data-id="'+idType+'">LIBELLE : '+libelle+'</a></li>');
					}else if (msg.del == 'del') {
						//suppression du type dans le pop de gestion des types
						var list = $('.afficheType ul').find('li a');
						for (var i = list.length - 1; i >= 0; i--) {
							var idTypeUpdate = $(list[i]).data('id');
							var idType = $('.typeForm').find('#idType').val();
							if (idType == idTypeUpdate) {
								$(list[i]).remove();
							}
						}
						//suppression du type dans les select des cartes oeuvre
						var listOption = $('.form-oeuvre').find('#idType').find('option');
						for (var i = listOption.length - 1; i >= 0; i--) {
							var idType = $('.typeForm').find('#idType').val();
							var idTypeOption = $(listOption[i]).val();
							if (idType == idTypeOption) {
								$(listOption[i]).remove();
							}
						}
					}
					$('.typeForm').find('#req').val('');
					$('.typeForm')[0].reset();
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



	
	


	
});