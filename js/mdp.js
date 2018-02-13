jQuery(document).ready(function($) {
	
	$(document).on('submit', '#mdpForm', function(event) {
		//event.preventDefault();
		var mdp1 = $(event.target).find('#mdp1').val();
		var mdp2 = $(event.target).find('#mdp2').val();
		var idUser = $(event.target).find('#idUser').val();
		var data = 'mdp1=' + mdp1 + '&mdp2=' + mdp2 + '&idUser=' + idUser;
		$.ajax({
			url: '../modules/traitementNewMdp.php',
			type: 'POST',
			dataType: 'html',
			data: data,
		})
		.done(function(response) {
			console.log("success");
			console.log(response);
			if (response == 'noMatch') {
				$('#error-area').addClass('error-area');
				$('#error-area').html('Le second mot de passe ne correspond pas');
			}else if (response == 'mdp2') {
				$('#error-area').addClass('error-area');
				$('#error-area').html('Veuillez resaisir votre mot de passe');
			}else if (response == 'mdp1') {
				$('#error-area').addClass('error-area');
				$('#error-area').html('Veuillez saisir un mot de passe');
			}else if (response == 'short') {
				$('#error-area').addClass('error-area');
				$('#error-area').html('Mot de passe trop court : 8Car Min');
			}
			else {
				window.location.href = response;
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