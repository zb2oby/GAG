jQuery(document).ready(function($) {

//PROBLEME CAR DELEGUE AU DOC CELA NE FONCTIONNE PLUS ET PAS DELEGUÉ CELA NEFONCTIONNE PAS APRES CREATION DE USER
	$('.containerAdmin').on('click', '.userAdmin', function(event) {
		var nom = $(event.target).data('nom');
		var prenom = $(event.target).data('prenom');
		var identifiant = $(event.target).data('identifiant');
		var idUser = $(event.target).data('id');
		var role = $(event.target).data('role');
		$('.adminForm').find('#nom').val(nom);
		$('.adminForm').find('#prenom').val(prenom);
		$('.adminForm').find('#role').val(role);
		$('.adminForm').find('#identifiant').val(identifiant);
		$('.adminForm').find('#idUser').val(idUser);
		
	});
	// $('.userAdmin').click(function(event) {
	// 	console.log('ok');
	// 	var dataUser = $(event.target).data('user');
	// 	$('.adminForm').find('#nom').val(dataUser[0]);
	// 	$('.adminForm').find('#prenom').val(dataUser[1]);
	// 	$('.adminForm').find('#role').val(dataUser[2]);
	// 	$('.adminForm').find('#identifiant').val(dataUser[3]);
	// 	$('.adminForm').find('#idUser').val(dataUser[4]);
	// });





	$(document).on('submit', '.adminForm', function(event) {
		//event.preventDefault();
		//event.stopPropagation();
		var nom = $('.adminForm').find('#nom').val();
		var prenom = $('.adminForm').find('#prenom').val();
		var role = $('.adminForm').find('#role').val();
		var libelleRole = $('.adminForm').find('#role option:selected').text();
		var identifiant = $('.adminForm').find('#identifiant').val();
		var idUser = $('.adminForm').find('#idUser').val();
		var del = $('.adminForm').find('#req').val();
		
		var data = 'idUser=' + idUser + '&nom=' + nom +'&prenom=' + prenom + '&role=' + role + '&identifiant=' + identifiant + '&req=' + del;
		$.ajax({
			url: '../modules/traitementAdmin.php',
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
						var idUser = msg.idUser;
						
					
						var list = $('.afficheUser ul').find('li a');
						
						for (var i = list.length - 1; i >= 0; i--) {
							var idUserUpdate = $(list[i]).data('id');
							//console.log(idUserUpdate);
							var idUser = $('.adminForm').find('#idUser').val();
							if (idUser == idUserUpdate) {
								$(list[i]).remove();
							}
						}
						$('.confirmSet').css('display', 'block');
						$('.overlay').show();
						setTimeout(function(){
							$('.confirmSet').css('display', 'none');
							$('.overlay').hide();
						}, 1500);
						$('.afficheUser ul').prepend('<li><a class="userAdmin" data-nom="'+nom+'" data-prenom="'+prenom+'" data-identifiant="'+identifiant+'" data-id="'+idUser+'" data-role="'+role+'" href="#">NOM : '+nom+' PRENOM : '+prenom+' ROLE : '+libelleRole+'</a></li>');
					}else if (msg.del == 'del') {
						var list = $('.afficheUser ul').find('li a');
						for (var i = list.length - 1; i >= 0; i--) {
							var idUserUpdate = $(list[i]).data('id');
							var idUser = $('.adminForm').find('#idUser').val();
							if (idUser == idUserUpdate) {
								$(list[i]).remove();
							}
						}
					}
					$('.adminForm').find('#req').val('');
					$('.adminForm')[0].reset();
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



	$('#delUser').click(function(event) {
		
		$('.confirmPopup').css('display', 'block');
		$('.overlay').show();
		
		return false;
	});
	$('.deleteUser').click(function(event) {
		var del = $('.adminForm').find('#req').val('delUser');
		$('.adminForm').trigger('submit');
		$('.confirmPopup').css('display', 'none');
		$('.overlay').hide();
	});
	$('#emptyUser').click(function(event) {
		$('.adminForm')[0].reset();
		return false;
	});
	


	
});