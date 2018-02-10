jQuery(document).ready(function($) {

    //s'il n'y a pas de carte de présente (portlet) sur l'expo n'afficher que la liste artiste
    if ($('.portlet').length == 0) {
        $('.oeuvres').hide();
        $('.recues').hide();
    }



	doSort();
    doDrop();
    $(document).ajaxComplete(function () {
        doDrop();
    });
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


//affichage de la place par defaut au clic sur l'image draggable
//$('#default-place').css('visibility', 'visible');
$(document).on('mousedown', '.recue .item', function(event) {
   $('.gestionPlan #default-place').css({
       visibility: 'visible',
       border: '1px solid red'
   });
});
$(document).on('mouseup', '.recue .item', function(event) {
     $('.gestionPlan #default-place').css({
       visibility: 'hidden',
       border: 'none'
   });
});




//CLONAGE DE LIMAGE SUR LE PLAN
	function doClone(){
        
        $('.item').draggable({
	        cancel: "a.ui-icon",
	        revert: true, 
	        helper: "clone", 
	        cursor: "move", 
	        revertDuration: 0,
            
            // drag: function (event, ui) {
            //     $('#default-place').css('visibility', 'visible');
            //     var planPosLeft = $('.plan').offset().left;
            //     var eltPosLeft = ui.offset.left - planPosLeft;
            //     var planPosTop = $('.plan').offset().top;
            //     var eltPosTop = ui.offset.top - planPosTop;
            //     $('#default-place').css( {
            //         left: eltPosLeft,
            //         top: eltPosTop
            //     })    
            // },

            // stop: function (e, ui) {
            //     $('#default-place').css({
            //        visibility: 'hidden',
            //        border: 'none'
            //    });
            // }

        });

 }               
     
function doDrop() {
        $('.gestionPlan .oeuvre-place').droppable({
            accept: "#items .item",
            activeClass: "ui-state-highlight",
            drop: function( event, ui ) {

               //on affiche desormais l'emplacement
               $(event.target).parent().attr('id', '');
                $(event.target).parent().css('visibility', 'visible');
                // clone item to retain in original "list"
                var $item = ui.draggable.clone();
                //preparation des variable à envoyer en base.
                var idOeuvreExposee = $item.data('idoeuvreexposee');
                var idEmplacement = $(event.target).data('idemplacement');
                var idExpo = 2;
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
    if (target.hasClass('portlet-artiste')) {
        var idArtiste = target.data('id');
        var place = 'idArtiste=' + idArtiste + '&req=delete' +'&idExpo=' + idExpo;
        target.remove();
    }else{
	   var idOeuvreExposee = target.find('.context-oeuvre').data('idoeuvreexposee');
	   var place = 'idOeuvreExposee=' + idOeuvreExposee + '&req=delete';
       var arrayPortlet = $('.portlet-oeuvre');
       for (var i = arrayPortlet.length - 1; i >= 0; i--) {
            if ($(arrayPortlet[i]).data('id') == idOeuvreExposee) {
                arrayPortlet[i].remove();   
            }
           
       }
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
        
        $('.confirmPopup').css('display', 'none');
        $('.context-menu').css('display', 'none');
        $('.overlay').hide();
}
function deletePlace(target) {
	var emplacement = target.parent();
    var idEmplacement = emplacement.data('id');
    emplacement.remove();
    $('.confirmPopup').css('display', 'none');
    $('.overlay').hide();
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
    $('.context-overlay').show();
    $('.cancelButton').click(function(e) {
        $('.confirmPopup').css('display', 'none');
        $('.context-overlay').hide();
        if (target.parent().hasClass('emplacement')) {
            $('.overlay').hide();
            $('.context-overlay').hide();
        }
    });

    $('.deleteButton').click(function(e) {
		if (target.parent().hasClass('emplacement')) {
			deletePlace(target);
            $('.overlay').hide();
		}else {
			deleteCard(target, idExpoSession);
		}
    });    
}


    $('.deleteCardArtiste').click(function(event) {
        var target = $(event.target).closest('.portlet');
        deleteElt(target);
    });
    $('.deleteCardOeuvreExpo').click(function(event) {
        var target = $(event.target).closest('.li-oeuvre-artiste');
        deleteElt(target);
    });

    $(document).on('click', '.deletePlace', function(event) {
       var target = $(event.target);
        deleteElt(target);
        $('.overlay').show();
    });
	// $('.deletePlace').click(function(event) {
	// 	var target = $(event.target);
	// 	deleteElt(target);
	// });

//>>>>>>>>>>>>>>>>>< POPUP <>>>>>>>>>>>>>>>>>>



    $(document).click(function(event) {
        if ($(event.target).parent().parent().hasClass('oeuvre-place')) {
            $('.overlay').hide();
        }
        
    });

	//AFFICHAGE POPUP AJOUT DE CARTE
	$('.addCard').click(function(event) {
		$('.popAddCard').css('display', 'block');
		$(this).closest('.container').find('.overlay').show();
	});
	$('.addCardRecue').click(function(event) {
		$('.popAddRecue').css('display', 'block');
		$(this).closest('.container').find('.overlay').show();
	});
    $('.addCardArtiste').click(function(event) {
        $('.popAddArtiste').css('display', 'block');
        $(this).closest('.container').find('.overlay').show();
    });








//CLIC SUR LIEN CREATION OEUVRE DANS POPUP addCard
$('.creerOeuvre').click(function(event) {
	$('.popAddCard').css('display', 'none');
	$('.popAddRecue').css('display', 'none');
    $('.popAddArtiste').css('display', 'none');
    $('.popAddOeuvrePrevue').css('display', 'block');
    
});

$('.creerOeuvreRecue').click(function(event) {
    $('.popAddCard').css('display', 'none');
    $('.popAddRecue').css('display', 'none');
    $('.popAddArtiste').css('display', 'none');   
    $('.popAddOeuvreRecue').css('display', 'block');
});





	//AFFICHAGE CONTEXT MENU DUNE CARTE OEUVRE
	$('.portlet-content').click(function(event) {
        //on recupere l'idoeuvre de lelement cliqué
       var idOeuvrePortlet =  $(event.currentTarget).find('.img').data('id');
       //on creer un tableau des element ou se trouve le popup d destination
       var afficheDestination = $('.oeuvreArtiste');
       //on boucle dedans 
       for (var i = afficheDestination.length - 1; i >= 0; i--) {
            //pour chaque element on compare les idoeuvre si l'idoeuvre cliqué correspon a un idoeuvre de la carte artiste on affiche
          if ($(afficheDestination[i]).data('idoeuvre') == idOeuvrePortlet) {
            $(afficheDestination[i]).closest('.context-artiste').css({
                display: 'block',
            });
            $(afficheDestination[i]).parent().find('.context-oeuvre').css({
                display: 'block',
                top: '0'
            });
          } 

       }
       $(event.target).closest('.container').find('.overlay').show();
        //$('.overlay').show();
    });
   
    $('.cancelButton-global').click(function(event) {
        $('.confirmPopup').css('display', 'none');
        $('.overlay').hide();
    });

	//EXTINCTION DES POPUP
    $(document).on('click', '.closeButton i', function(event) {
       $(event.target).parent().parent().css('display', 'none');
        $('.confirmPopup').css('display', 'none');
        $('.context-artiste').css('display', 'none');
        $('.context-oeuvre').css('display', 'none');
        $('.overlay').hide();
        event.stopPropagation();
    });
	// $('.closeButton i').click(function(event) {
		
	// });

	$('.overlay').click(function(event) {
        $('.context-menu').css('display', 'none');
        $('.popAddCard').css('display', 'none');
        $('.popAddRecue').css('display', 'none');
        $('.popAddArtiste').css('display', 'none');
        $('.popAddOeuvrePrevue').css('display', 'none');
        $('.popAddOeuvreRecue').css('display', 'none');
        $('#newExpo').css('display', 'none');
        $('.pop-modifTeaser').css('display', 'none');
        $('.pop-modifAffiche').css('display', 'none');
        $('.modalAddOeuvre').css('display', 'none');
        $('.confirmPopup').css('display', 'none');
        $('.overlay').hide();
        $('.context-overlay').hide();
        $('.popGestionCard').hide();
        

    	
    });
    
    

});