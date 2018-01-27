jQuery(document).ready(function($) {


//GESTION OUVERTURE DES POPUP SUR ONGLET EXPO
$(document).on('click', '.action-button', function(event) {
	var classe = $(this).attr('id');
	$('.overlay').show();
	$(event.currentTarget).closest('.onglet-content').find('.pop-'+classe+'.popGestionCard').show();
	
});


//GESTION ENVOI FORMULAIRE INFO GENERALES DEPUIS LE FORMULAIRE NEW EXPO CONTENU DANS CALENDRIER
	$(document).on('submit', '#newExpo', function(event) {

		var $form = $(this);
    	var data = new FormData($form[0]);

	    $.ajax({
	        url: '../modules/traitementExpo.php',
	        method: 'POST',
	        dataType: 'json',
	        data: data,
	        processData: false,
	        contentType: false,
	    	})
	        .done(function(response) {
	        	//dateDebut dateFin couleur et idExpo titre
	        	var arrayJour = $(document).find('.jours');
	        	for (var i = arrayJour.length - 1; i >= 0; i--) {
	        		if ($(arrayJour[i]).data('debut') >= response.dateDebut && $(arrayJour[i]).data('debut') <= response.dateFin) {
	        			var nJour = $(arrayJour[i]).text();
	        			var todayColor = '#DE9318';
	        			var today = '';

	        			$(arrayJour[i]).removeClass('jours');
	        			$(arrayJour[i]).removeClass('aujourdhui');
	        			$(arrayJour[i]).removeAttr('title');
	        			$(arrayJour[i]).off('click');


	        			
	        			$(arrayJour[i]).addClass('jourExpo');
	        			$(arrayJour[i]).html('<a href="../content/gestionPanel.php?expo='+response.idExpo+'">'+nJour+'<br>'+response.titre+'</a>');
	        			
	        			if ($(arrayJour[i]).data('debut') == response.today) {
	        				today = 'Aujourd\'hui';
	        				$(arrayJour[i]).addClass('aujourdhui');
	        				$(arrayJour[i]).find('a').prepend('<span style="background-color: '+todayColor+'; width: 100%; position:absolute; top:0; left:0; padding:5px;">'+today+'</span>');
	        			}


	        			$(arrayJour[i]).css({
	        				position: 'relative',
	        				backgroundColor: response.couleur
	        			});
	        			$('#newExpo').css('display', 'none');
	        			$('.overlay').hide();

	        		}
	        		
	        	}
	        	
          
	        })
	        .fail(function() {
	            
	        })
	        .always(function() {
	        
	    	});
		return false;
	});

});