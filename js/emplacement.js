jQuery(document).ready(function($) {


//GESTION NOUVELLES COORDONNEES DES EMPLACEMENTS
    function  doDrag() {
        $('.gestionPlan .emplacement').draggable({
            //handle: '.emplacement-handle',
    		containment: '.gestionPlan .plan',
    		stop: function(event,ui) {
                //recuperation de la taille a l'instant T de la div "plan"
                var widthPlan = parseFloat($('.gestionPlan .plan').css('width'));
                var heightPlan = parseFloat($('.gestionPlan .plan').css('height'));
                //recuperation des coordonnées à l'instant T de l'emplacement
                var posTop = parseFloat($(this).css('top'));
                var posLeft = parseFloat($(this).css('left'));
                //transformation des coordonnées en pourcentage de la div plan
                var coordTop = (posTop/heightPlan)*100;
                var coordLeft = (posLeft/widthPlan)*100;
                //preparation des variables a envoyer
                var idEmplacement = $(this).data('id');
                //on prepare l'idExpo pour la verification de l'existence d'un emplacement par defaut
                var idExpo = $(event.target).closest('.plan').data('idexpo');
                //console.log(idExpo);
                var emplacement = 'idExpo='+idExpo+ '&coordTop=' + coordTop + '&coordLeft=' + coordLeft + '&idEmplacement=' + idEmplacement;
                //traitement ajax
                $.ajax({
                    url: '../modules/traitementEmplacement.php',
                    type: 'GET',
                    dataType: 'html',
                    data: emplacement,
                })
                .done(function(response) {
                    console.log(response);
                    if (response) {
                        $('.plan').prepend('<div id="default-place" class="emplacement" data-id="'+response+'" style="top:50%; left:50%;"></div><div class="oeuvre-place" data-idemplacement="'+response+'"></div></div>');
                    }
                    //on modifie les coordonnées sur le plan d'impression
                    var listPlace = $('.imprPlan .emplacement');
                    for (var i = listPlace.length - 1; i >= 0; i--) {
                        if ($(listPlace[i]).data('id') == idEmplacement) {
                            $(listPlace[i]).css({
                                top: posTop,
                                left: posLeft
                            });
                        }
                        
                    }
                    // console.log("success");
                })
                .fail(function() {
                    // console.log("error");
                })
                .always(function() {
                    // console.log("complete");
                });
            }
    	})

    }


    doDrag();


//SUPPRESSION OEUVRE DU PLAN
    $('.gestionPlan .emplacement').sortable({
        connectWith: '.trash',
        update: function(event, ui) {
            //Run this code whenever an item is dragged and dropped out of this list
            var order = $(this).sortable('serialize');
        },
        helper: 'clone'
    });
    $('.trash').droppable({
        accept: '.gestionPlan .emplacement',
        activeClass: 'dropArea',
        hoverClass: 'dropAreaHover',
        drop: function(event, ui) {
            var idOeuvreExposee = '';
            var idEmplacement = $(ui.draggable).data('id');
            //suppression de l'image du plan d'impression
            var listPlace = $('.imprPlan .emplacement');
            for (var i = listPlace.length - 1; i >= 0; i--) {
                if ($(listPlace[i]).data('id') == idEmplacement) {
                    $(listPlace[i]).remove();
                }
                
            }
                //mise a jour de l'emplacement :: suppression de l'oeuvre droppé
                var place = 'delete=' + idEmplacement + '&idExpo=' + idExpo;
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
            //suppression de l'oeuvre du plan de l'expo
            ui.draggable.remove();

        }
    });


    $(document).ajaxComplete(function () {
        doDrag();
    });
    
});