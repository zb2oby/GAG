jQuery(document).ready(function($) {

$(document).on('click', '.closeButton-expo', function(event) {
	$('.overlay').hide();
});

$('.delExpo').click(function(event) {
	$('.confirmPopup').show();
	$('.overlay').show();
	
	return false;
	
});
$('.deleteExpo').click(function(event) {
	var idExpo = $('.delExpo').data('idexpo');
	window.location.href = "../modules/traitementExpo.php?req=deleteExpo&idExpo="+idExpo;
});

//url = window.location.href
	//split = url.split('/')
	//page = split[split.length - 1]
var url = window.location.href;
var urlSplit = url.split('/');
var urlParam = urlSplit[urlSplit.length -1].split('?');
var page = urlParam[0];


//GESTION OUVERTURE DES POPUP SUR ONGLET EXPO
$(document).on('click', '.action-button', function(event) {
	var classe = $(this).attr('id');
	$('.overlay').show();
	$(event.currentTarget).closest('.onglet-content').find('.pop-'+classe+'.popGestionCard').show();
	
});



//GESTION ENVOI FORMULAIRE INFO GENERALES DEPUIS LE FORMULAIRE NEW EXPO CONTENU DANS CALENDRIER ET DANS LA SIDEBAR

	$(document).on('submit', '#newExpo', function(event) {
		//if (page == 'accueil.php') {
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
		        	$('.card-error').hide();
			        if (response.error == 'error') {
			        
			        	if (response != '') {
							//on defini la varaible d'erreur a true
							var error = true;
							//traitement du retour json
							var msg = response;
							//pour chaque entree du tableau renvoyé en json on l'affiche dans une div error
							$.each(msg, function(index, el) {
								if (el != null) {
									var input = '#'+index;
									$(event.target).find(input).closest('div').append('<div class="card-error" style="position:absolute;">'+msg[index]+'</div>');
									
								}
								
	
							});
						}
					}
					else if(response.error != 'error'){

			        	//dateDebut dateFin couleur et idExpo titre
			        	var arrayJour = $(document).find('.jours');
			        	for (var i = arrayJour.length - 1; i >= 0; i--) {

			        		var dateCase = new Date($(arrayJour[i]).data('debut'));
			        		var dateDeb = new Date(response.dateDebut);
			        		var dateFin = new Date(response.dateFin);
			        	//le 07/02 1517961600
			        	//sur la case du 7/02 => 15179580000
			        	//console.log(response.dateDebut);

			        		if (dateCase.getTime() >= (dateDeb.getTime()-3600) && dateCase.getTime() <= dateFin.getTime()) {
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
			        	$('.confirmSet').css('display', 'block');
						$('.context-overlay').show();
						setTimeout(function(){
							$('.confirmSet').css('display', 'none');
							$('.context-overlay').hide();
						}, 1500);
						if (page != 'accueil.php'){
							console.log(response.idExpo);
							document.location.href='../content/gestionPanel.php?onglet=expo&expo='+response.idExpo;
						}
			        }
			        
		        	
	          
		        })
		        .fail(function() {
		            
		        })
		        .always(function() {
		        
		    	});
			return false;
		// }else {
		// 	return true;
		// }
	});

	$(document).on('submit', '.expoForm', function(event) {
		var $form = $(this);
	    	var data = new FormData($form[0]);
	    	$('.card-error').hide();


		    $.ajax({
		        url: '../modules/traitementExpo.php',
		        method: 'POST',
		        dataType: 'json',
		        data: data,
		        processData: false,
		        contentType: false,
		    	})
		        .done(function(response) {
		        	console.log('sucess');
		        	   
		        	//console.log(response);
		        	$('.card-error').hide();
			        if (response.error == 'error') {
			        
			        	if (response != '') {
							//on defini la varaible d'erreur a true
							var error = true;
							//traitement du retour json
							var msg = response;
							//pour chaque entree du tableau renvoyé en json on l'affiche dans une div error
							$.each(msg, function(index, el) {
								if (el != null) {
									var input = '#'+index;
									$(event.target).find(input).closest('div').append('<div class="card-error" style="position:absolute;">'+msg[index]+'</div>');
									
								}
								
	
							});
						}
					}else{
						$('.confirmSet').css('display', 'block');
						$('.overlay').show();
						setTimeout(function(){
							$('.confirmSet').css('display', 'none');
							$('.overlay').hide();
						}, 1500);
						var couleurExpo = $(event.target).find('#couleurExpo').val();
						$('.link-active').find('span').css('backgroundColor', couleurExpo);
					}
					

			})
	        .fail(function() {
	            
	        })
	        .always(function() {
	  
	    	});
		return false;
	});

});