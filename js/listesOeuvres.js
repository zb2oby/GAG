

    function doClone(){
        $('#items .item').draggable({
            helper: 'clone',
            drag: function (event, ui) {
                //on recupere la position par rapport au document de l'element draggué 
                var planPosLeft = $('.gestionPlan').offset().left;
                //console.log('planLeft' + planPosLeft);
                var eltPosLeft = ui.offset.left - planPosLeft ;
                //console.log('elt' + eltPosLeft);
                var planPosTop = $('.gestionPlan').offset().top;
                //console.log('planTop' + planPosTop);
                var eltPosTop = ui.offset.top - planPosTop;
                
                //on modifie l'emplacement de la drop-area en fonction de l'emplacement de l'element draggué
                $('.emplacement#default-place').css( {
                    //visibility: 'visible',
                    left: eltPosLeft,
                    top: eltPosTop
                })    
            },
           
        });
    }   
  



 jQuery(document).ready( function($) {

    //s'il n'y a pas de carte de présente (portlet) sur l'expo n'afficher que la liste artiste
    if ($('.portlet').length == 0) {
        $('.oeuvres').hide();
        $('.recues').hide();
    }


    //Au chargement si l'oeuvre est deja présente dans prévue ou recue on la retire des select d'ajout d'oeuvre
    var listOeuvre = $('.portlet-oeuvre .img');
    var listOptionPrevue = $('.popAddCard option');
    var listOptionRecue = $('.popAddRecue option');
    for (var i = listOeuvre.length - 1; i >= 0; i--) {

        var idOeuvre = $(listOeuvre[i]).data('id');
         
        for (var j = listOptionPrevue.length - 1; j >= 0; j--) {
            var idPrevue = parseInt($(listOptionPrevue[j]).val());
            if (idPrevue == idOeuvre) {
                $(listOptionPrevue[j]).remove();
            }
            
        }
        for (var j = listOptionRecue.length - 1; j >= 0; j--) {
            var idRecue = parseInt($(listOptionRecue[j]).val());
            if (idRecue == idOeuvre) {
                $(listOptionRecue[j]).remove();
            }
            
        }
        
    }
    
    //Au chargement si l'artiste est deja présent dans la liste on le retire du select d'ajout d'artiste
    var listArtiste = $('.portlet-artiste');
    var listOptionArtiste = $('.popAddArtiste option');
    for (var i = listArtiste.length - 1; i >= 0; i--) {

        var idArtiste = $(listArtiste[i]).data('id');
         
        for (var j = listOptionArtiste.length - 1; j >= 0; j--) {
            var idArtisteListe = parseInt($(listOptionArtiste[j]).val());
            if (idArtisteListe == idArtiste) {
                $(listOptionArtiste[j]).remove();
            }
            
        }
        
    }



    function disableDrag() {
        //EMPECHER UN ELEMENT PLACE SUR LE PLAN DETRE A NOUVEAU DRAGGABLE
        //recuperation des listes delement recue et placés
        var listOeuvrePlacee = $('.gestionPlan .oeuvre-place .img');
        var listOeuvreRecue = $('.column.recue .img');
        var arrayIdPlace = new Array();
        var arrayIdRecue = new Array();
        //remplissage des tableaux d'ID
        for (var i = listOeuvrePlacee.length - 1; i >= 0; i--) {
           arrayIdPlace[i] = $(listOeuvrePlacee[i]).data('id');
        }
        for (var i = listOeuvreRecue.length - 1; i >= 0; i--) {
           arrayIdRecue[i] = $(listOeuvreRecue[i]).data('id');
        }
         //comparaison des deux tableaux d'id
         $.arrayIntersect = function(a, b)
        {
            return $.grep(a, function(i)
            {
                var arrayDragNo = $.inArray(i, b) > -1;
                return arrayDragNo;
            });
        };

        //suppression de la classe item pour les element dont l'id esr présent dans le tableaux de comparaison
        for (var i = listOeuvreRecue.length - 1; i >= 0; i--) {
           var idRecue = $(listOeuvreRecue[i]).data('id');
           var stopDrag = $.arrayIntersect(arrayIdRecue, arrayIdPlace);
           for (var j = stopDrag.length - 1; j >= 0; j--) {
               
                if (idRecue == stopDrag[j]) {
                    $(listOeuvreRecue[i]).removeClass('item');
                    $(listOeuvreRecue[i]).addClass('already');
                    $(listOeuvreRecue[i]).attr('title', 'Déjà placée');
                    $(listOeuvreRecue[i]).draggable({ disabled: true });
                }
           }
           
        }
    }



	doSort();
    doDrop();
    disableDrag();
    $(document).ajaxComplete(function () {
        doDrop();
        disableDrag();
    });
	


    //par defaut si un element a la classe item on lui permet d'être draggable sur un emplacement du plan
	if ($('.column').find('.img').hasClass('item')) {
		doClone();
	}
    //}
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
            //console.log("success");
        })
        .fail(function() {
            //console.log("error");
        })
        .always(function() {
            //console.log("complete");
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
            delay: 325,
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
                //s'il n'y a plus de carte en retard dans la liste prevue on supprime le message retard dans le header du site
                var listRetard = $('.prevue .retard');
                if (listRetard.length == 0 ) {
                    $('header .retard').hide();
                }else {
                    var nbRetard = listRetard.length;
                    $('header .retard').html('<i class="ion-alert-circled" style="color:red; font-size:2em; position:absolute; left:-30px; top:-10px;"></i>Il y a '+nbRetard+' Oeuvre(s) en retard !');
                    $('header .retard').show();
                }
               
            }
	    });

	    
        
	};


//affichage de la place par defaut au clic sur l'image draggable
//$('#default-place').css('visibility', 'visible');
// $(document).on('mousedown', '.recue .item', function(event) {
//    $('.gestionPlan #default-place').css({
//        visibility: 'visible',
//        border: '1px solid red'
//    });
// });
// $(document).on('mouseup', '.recue .item', function(event) {
//      $('.gestionPlan #default-place').css({
//        visibility: 'hidden',
//        border: 'none'
//    });
// });



//CLONAGE DE LIMAGE SUR LE PLAN
	// function doClone(){
 //        //$('#items .item')
 //        $('#items .item').draggable({
 //            helper: 'clone',
 //            drag: function (event, ui) {
 //                //on recupere la position par rapport au document de l'element draggué 
 //                var planPosLeft = $('.gestionPlan').offset().left;
 //                //console.log('planLeft' + planPosLeft);
 //                var eltPosLeft = ui.offset.left - planPosLeft ;
 //                //console.log('elt' + eltPosLeft);
 //                var planPosTop = $('.gestionPlan').offset().top;
 //                //console.log('planTop' + planPosTop);
 //                var eltPosTop = ui.offset.top - planPosTop;
                
 //                //on modifie l'emplacement de la drop-area en fonction de l'emplacement de l'element draggué
 //                $('.emplacement#default-place').css( {
 //                    //visibility: 'visible',
 //                    left: eltPosLeft,
 //                    top: eltPosTop
 //                })    
 //            },
           
 //        });

        

 //    }               
  


    function doDrop() {
        $('.plan').droppable({
            accept: "#items .item",
            activeClass: "ui-state-highlight",
            drop: function( event, ui ) {
                //on rend l'emplacement visible
                $('#default-place').css({
                    visibility: 'visible',
                });
                //on clone l'element draggué a l'interieur de l'emplacement
                var $item = ui.draggable.clone();
                $(this).find('#default-place .oeuvre-place').addClass('has-drop').html($item);

                //preparation des variable à envoyer en base.
                 var idOeuvreExposee = $item.data('idoeuvreexposee');
                 var idEmplacement = $('#default-place').data('id');
                 //on ajoute la div de numero d'meplacement utile pour la numerotation sur l'impression
                 $(this).find('#default-place .oeuvre-place .img').append('<div class="numEmplacement">'+idEmplacement+'</div>');
                 //on clone aussi l'élément sur le plan d'impression
                    var listPlace = $('.imprPlan .emplacement');
                    for (var i = listPlace.length - 1; i >= 0; i--) {
                        if ($(listPlace[i]).data('id') == idEmplacement) {
                            $(listPlace[i]).find('.oeuvre-place').addClass('has-drop').html($item.clone());
                            $(listPlace[i]).attr('id', '');
                        }
                        
                    }
                //on change aussi l'etat de non placé a placé sur la liste dans l'impression
                var listLignes = $('.impression tr.ligne-oeuvre');
                for (var i = listLignes.length - 1; i >= 0; i--) {
                    if ($(listLignes[i]).data('idoeuvreexposee') == idOeuvreExposee) {
                        $(listLignes[i]).find('td.case-emplacement').html(idEmplacement);
                    }
                    
                }
                 var idExpo = $(event.target).closest('.plan').data('idexpo');
                 //recuperation de la taille a l'instant T de la div "plan"
                var widthPlan = parseFloat($('.gestionPlan .plan').css('width'));
                var heightPlan = parseFloat($('.gestionPlan .plan').css('height'));
                //recuperation des coordonnées à l'instant T de l'emplacement
                var posTop = parseFloat($('.emplacement#default-place').css('top'));
                var posLeft = parseFloat($('.emplacement#default-place').css('left'));
                //transformation des coordonnées en pourcentage de la div plan
                var coordTop = (posTop/heightPlan)*100;
                var coordLeft = (posLeft/widthPlan)*100;

                
                //envoie en base
                 var place = 'idOeuvreExposee=' + idOeuvreExposee + '&idExpo='+idExpo+ '&coordTop=' + coordTop + '&coordLeft=' + coordLeft + '&idEmplacement=' + idEmplacement;
                 $.ajax({
                    url: '../modules/traitementEmplacement.php',
                    type: 'GET',
                    dataType: 'html',
                    data: place,
                })
                .done(function(response) {
                    //console.log("success");
                    //au retour on recreer un nouvel emplacement par defaut
                    //Supression de l'id defaut
                    $('.emplacement#default-place').attr('id', '');
                    //creation du nouvel emplacement par defaut sur les différents plans
                    if (response) {
                        $('.plan').prepend('<div id="default-place" class="emplacement" data-id="'+response+'" style="top:50%; left:50%;"><div class="oeuvre-place" data-idemplacement="'+response+'"></div></div>');
                    }
                    


                })
                .fail(function() {
                    //console.log("error");
                })
                .always(function() {
                    //console.log("complete");
                });     
               
            },
        });


    };



//SUPPRESSION OEUVRE PREVUE OU RECUE ET ARTISTE ET EMPLACEMENTS PLAN

function deleteCard(target, idExpo) {
    if (target.hasClass('portlet-artiste')) {
        var idArtiste = target.data('id');
        var place = 'idArtiste=' + idArtiste + '&req=delete' +'&idExpo=' + idExpo;
        target.remove();

        //lorsqu'ion retire unartiste des listes il reapparait dans le select d'ajout d'artiste
        var nomArtiste = $(target).find('.titre').text();
        $('.popAddArtiste select').prepend('<option value="'+idArtiste+'">'+nomArtiste+'</option>');
        ////lorsqu'ion retire un artiste des listes il disparait dans les select de creation d'oeuvre prevue ou recue
        var listAddRecue = $('.popAddOeuvreRecue select option');
        for (var i = listAddRecue.length - 1; i >= 0; i--) {
            if ($(listAddRecue[i]).val() == idArtiste ) {
                $(listAddRecue[i]).remove();
            }
            
        }
        var listAddPrevue = $('.popAddOeuvrePrevue select option');
        for (var i = listAddPrevue.length - 1; i >= 0; i--) {
            if ($(listAddPrevue[i]).val() == idArtiste ) {
                $(listAddPrevue[i]).remove();
            }
            
        }
    }else{
	   var idOeuvreExposee = target.find('.context-oeuvre').data('idoeuvreexposee');
	   var place = 'idOeuvreExposee=' + idOeuvreExposee + '&req=delete';
       var arrayPortlet = $('.portlet-oeuvre');
       for (var i = arrayPortlet.length - 1; i >= 0; i--) {
            if ($(arrayPortlet[i]).data('id') == idOeuvreExposee) {
                arrayPortlet[i].remove();

                //lorsqu'ion retire une oeuvre des listes elle reapparait dans les select d'ajout d'oeuvre prevue et recue
                var idOeuvre = $(arrayPortlet[i]).find('.img').data('id');
                var nomOeuvre = $(arrayPortlet[i]).find('.nomOeuvre-portlet').text();
                $('.popAddCard select').prepend('<option value="'+idOeuvre+'">'+nomOeuvre+'</option>');
                $('.popAddRecue select').prepend('<option value="'+idOeuvre+'">'+nomOeuvre+'</option>');  
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
            //console.log("success");
        })
        .fail(function() {
            //console.log("error");
        })
        .always(function() {
            //console.log("complete");
        });
        
        $('.confirmPopup').css('display', 'none');
        $('.context-menu').css('display', 'none');
        $('.overlay').hide();
}
function deletePlace(target) {
	// var emplacement = target.parent();
 //    var idEmplacement = emplacement.data('id');
    

 //    emplacement.remove();
 //    $('.confirmPopup').css('display', 'none');
 //    $('.overlay').hide();
 //    var deletePlace = 'delete=' + idEmplacement;
 //    //traitement ajax
 //    $.ajax({
 //        url: '../modules/traitementEmplacement.php',
 //        type: 'GET',
 //        dataType: 'html',
 //        data: deletePlace,
 //    })
 //    .done(function() {
 //        console.log("success");
 //    })
 //    .fail(function() {
 //        console.log("error");
 //    })
 //    .always(function() {
 //        console.log("complete");
 //    });
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

    // $(document).on('click', '.deletePlace', function(event) {
    //    var target = $(event.target);
    //     deleteElt(target);
    //     $('.overlay').show();
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
   
    $(document).on('click', '.cancelButton-global', function(event) {
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
        $('.popGestionCard-artiste').hide();
    });
    
    $(document).on('click', '.deleteButton', function(event) {
        $('.context-overlay').css('display', 'none');
    });
    
    

});