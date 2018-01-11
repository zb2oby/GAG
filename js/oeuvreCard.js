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
		$('.context-overlay').hide()
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