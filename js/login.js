jQuery(document).ready(function($) {
	
	$(document).on('submit', '#login-form', function(event) {
		//event.preventDefault();
		var login = $(event.target).find('#login').val();
		var passwd = $(event.target).find('#passwd').val();
		var data = 'login=' + login + '&passwd=' + passwd;


		$.ajax({
			url: '../modules/traitementLogin.php',
			type: 'POST',
			dataType: 'html',
			data: data,
		})
		.done(function(response) {
			console.log("success");
			console.log(response);
			if (response == 'error') {
				$('#error-area').addClass('error-area');
				$('#error-area').html('Votre login ou votre mot de passe est incorrect');
			}else if (response == 'login') {
				$('#error-area').addClass('error-area');
				$('#error-area').html('Le login est obligatoire');
			}else if (response == 'passwd') {
				$('#error-area').addClass('error-area');
				$('#error-area').html('Le mot de passe est obligatoire');
			}else if (response == 'empty') {
				$('#error-area').addClass('error-area');
				$('#error-area').html('Merci de renseigner des identifiants');
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