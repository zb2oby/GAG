jQuery(document).ready(function($) {

    //s'il n'y a pas de carte de présente (portlet) sur l'expo n'afficher que la liste artiste
    if ($('.portlet').length == 0) {
        $('.oeuvres').hide();
        $('.recues').hide();
    }



	doSort();

	//par defaut si un element a la classe item on lui permet d'être draggable sur un emplacement du plan
	if ($('.column').find('.img').hasClass('item')) {
		doClone();
	}
	//fonction d'update dans la base ue changement d'etat dune carte oeuvre. soit "prevue" soit "recue"
	function updateSort(update, idOeuvreExposee) {
		var liste = 'update=' + update + '&idOeuvreExposee=' + idOeuvreExposee;
		$.ajax({
            url: '../modules/traitementListes.php',
            type: 'GET',
            dataType: 'html',
            data: liste,
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
	}
	//fonction qui rend sortable un element
	function doSort() {
        
	    $( ".column" ).sortable({
            cursor: "move",
            connectWith: ".column, .deleteCard",
            handle: ".portlet-content",
            cancel: ".portlet-toggle",
            placeholder: "portlet-placeholder ui-corner-all",
            stop: function(event,ui) {
                var provenance = $(event.target);
                var destination = $(ui.item).parent();
                var idOeuvreExposee = $(ui.item).data('id');
                //au stop du sortable : 
                //si le portlet provient de la classe "recue" et qu'il va vers la classe "prevue" on rend l'image passive:
                if (provenance.hasClass('recue') && destination.hasClass('prevue')) {
                   $(ui.item).find('.img').draggable("destroy");
                   $(ui.item).find('.img').removeClass('item');
                   //update de la base
                   updateSort('annuler', idOeuvreExposee);

                //si il provient de la classe "prevue" et qu'il va vers la classe "recue" on lance doClone();
                }else if (provenance.hasClass('prevue') && destination.hasClass('recue')) {
                    $(ui.item).find('.img').addClass('item');
                    updateSort('enregistrer', idOeuvreExposee);
                    doClone();
                }
               
            }
	    });

	    
        
	};

//CLONAGE DE LIMAGE SUR LE PLAN
	function doClone(){
        
        $('.item').draggable({
	        cancel: "a.ui-icon",
	        revert: true, 
	        helper: "clone", 
	        cursor: "move", 
	        revertDuration: 0
        });

        
        $('.oeuvre-place').droppable({
            accept: "#items .item",
            activeClass: "ui-state-highlight",
            drop: function( event, ui ) {
                // clone item to retain in original "list"
                var $item = ui.draggable.clone();
                //preparation des variable à envoyer en base.
                var idOeuvreExposee = $item.data('idoeuvreexposee');
                var idEmplacement = $(event.target).data('idemplacement');
                //ajout du clone de l'element au DOM
                $(this).addClass('has-drop').html($item);
                //mise a jour de l'emplacement avec l'oeuvre droppée
                var place = 'idOeuvreExposee=' + idOeuvreExposee + '&idEmplacement=' + idEmplacement;
                $.ajax({
                    url: '../modules/traitementEmplacement.php',
                    type: 'GET',
                    dataType: 'html',
                    data: place,
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
                
                
            }
        });

        

    };

//SUPPRESSION OEUVRE DU PLAN
    $('.oeuvre-place').sortable({
        connectWith: '.trash',
        update: function(event, ui) {
            //Run this code whenever an item is dragged and dropped out of this list
            var order = $(this).sortable('serialize');
        },
        helper: 'clone'
    });
    $('.trash').droppable({
        accept: '.oeuvre-place > .img',
        activeClass: 'dropArea',
        hoverClass: 'dropAreaHover',
        drop: function(event, ui) {
            var idOeuvreExposee = '';
            var idEmplacement = $(ui.draggable).parent().data('idemplacement');

                //mise a jour de l'emplacement :: suppression de l'oeuvre droppé
                var place = 'idOeuvreExposee=' + idOeuvreExposee + '&idEmplacement=' + idEmplacement;
                $.ajax({
                    url: '../modules/traitementEmplacement.php',
                    type: 'GET',
                    dataType: 'html',
                    data: place,
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

            ui.draggable.remove();
        }
    });

//SUPPRESSION OEUVRE PREVUE OU RECUE ET ARTISTE ET EMPLACEMENTS PLAN

function deleteCard(target, idExpo) {
    if (target.parent().parent().hasClass('portlet-artiste')) {
        var idArtiste = target.parent().parent().data('id');
        var place = 'idArtiste=' + idArtiste + '&req=delete' +'&idExpo=' + idExpo;
    }else{
	   var idOeuvreExposee = target.parent().parent().data('id');
	   var place = 'idOeuvreExposee=' + idOeuvreExposee + '&req=delete';
    }
        $.ajax({
            url: '../modules/traitementListes.php',
            type: 'GET',
            dataType: 'html',
            data: place,
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
        target.parent().parent().remove();
        $('.confirmPopup').css('display', 'none');
        $('.context-menu').css('display', 'none');
        $('.layout').hide();
}
function deletePlace(target) {
	var emplacement = target.parent();
    var idEmplacement = emplacement.data('id');
    emplacement.remove();
    $('.confirmPopup').css('display', 'none');
    $('.layout').hide();
    var deletePlace = 'delete=' + idEmplacement;
    //traitement ajax
    $.ajax({
        url: '../modules/traitementEmplacement.php',
        type: 'GET',
        dataType: 'html',
        data: deletePlace,
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
}


function deleteElt(target) {
	$('.confirmPopup').css('display', 'block');
    $('.layout').show();
    $('.cancelButton').click(function(e) {
        $('.confirmPopup').css('display', 'none');
        $('.layout').hide();
    });
    $('.deleteButton').click(function(e) {
		if (target.parent().hasClass('emplacement')) {
			deletePlace(target);
		}else if (target.parent().parent().hasClass('portlet')) {
			deleteCard(target, idExpoSession);
		}
    });    
}

	$('.deleteCard').click(function(event) {
		var target = $(event.target);
		deleteElt(target);
	});
	$('.deletePlace').click(function(event) {
		var target = $(event.target);
		deleteElt(target);
	});



    // $('.deleteCard').droppable({
    //     accept: '.column > .portlet',
    //     activeClass: 'dropArea',
    //     hoverClass: 'dropAreaHover',
    //     drop: function(event, ui) {
    //     	var idOeuvreExposee = ui.draggable.data('id');

    //         // mise a jour de l'emplacement : suppression de l'oeuvre droppé
    //         var place = 'idOeuvreExposee=' + idOeuvreExposee + '&req=delete';
    //         $.ajax({
    //             url: '../modules/traitementListes.php',
    //             type: 'GET',
    //             dataType: 'html',
    //             data: place,
    //         })
    //         .done(function() {
    //             console.log("success");
    //         })
    //         .fail(function() {
    //             console.log("error");
    //         })
    //         .always(function() {
    //             console.log("complete");
    //         });

    //         ui.draggable.remove();
            
    //     }
    // });


//>>>>>>>>>>>>>>>>>< POPUP <>>>>>>>>>>>>>>>>>>

    $(document).click(function(event) {
        if ($(event.target).parent().hasClass('img')) {
            $('.layout').hide();
        }
        
    });

	//AFFICHAGE POPUP AJOUT DE CARTE
	$('.addCard').click(function(event) {
		$('.popAddCard').css('display', 'block');
		$('.layout').show();
	});
	$('.addCardRecue').click(function(event) {
		$('.popAddRecue').css('display', 'block');
		$('.layout').show();
	});
    $('.addCardArtiste').click(function(event) {
        $('.popAddArtiste').css('display', 'block');
        $('.layout').show();
    });

		//CLIC SUR LIEN CREATION OEUVRE DANS POPUP addCard
		$('.creerOeuvre').click(function(event) {
			$('.popAddCard').css('display', 'none');
			$('.popAddRecue').css('display', 'none');
            $('.popAddArtiste').css('display', 'none');
			//ici on ajoutera le display d'un nouveau popup avec un formulaire de creation d'oeuvre
		});

	//AFFICHAGE CONTEXT MENU DUNE CARTE OEUVRE
	$('.portlet-content').click(function(event) {
        $(event.target).parent().find('.context-menu').css('display', 'block');
        $('.layout').show();
        
        // $('.cancelButton').click(function(e) {
        //     $('.context-menu').css('display', 'none');
        //     $('.layout').hide();
        // });
    });

	//EXTINCTION DES POPUP
	$('.closeButton').click(function(event) {
		$(event.target).parent().css('display', 'none');
		$('.confirmPopup').css('display', 'none');
		$('.layout').hide();
	});

	$('.layout').click(function(event) {
    	$('.context-menu').css('display', 'none');
    	$('.popAddCard').css('display', 'none');
    	$('.popAddRecue').css('display', 'none');
        $('.popAddArtiste').css('display', 'none');
        $('.layout').hide();
    });
    
    

});