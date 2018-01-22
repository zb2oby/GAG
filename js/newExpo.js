jQuery(document).ready(function($) {
	
	$(document).on('submit', '#newExpo', function(event) {

		var $form = $(this);
    	var data = new FormData($form[0]);

	    $.ajax({
	        url: '../modules/traitementExpo.php',
	        method: 'POST',
	        dataType: 'html',
	        data: data,
	        processData: false,
	        contentType: false,
	    	})
	        .done(function(response) {
	           console.log(response);
	        })
	        .fail(function() {
	            
	        })
	        .always(function() {
	        
	    	});
		return false;
	});

});