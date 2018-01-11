jQuery(document).ready(function($) {
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