jQuery(document).ready(function($) {

//GESTION AFFICHAGE LOGO DEPLACEMENT
    $(document).on('click', '.emplacement', function(event) {
   
        //par defaut on cache les logo actifs
        $('.emplacement-handle, .deletePlace').css('visibility', 'hidden');
        //on affiche le logo de deplacement si on a cliqué sur une div "emplacement"
        // if (($(event.target).hasClass('emplacement ui-draggable')) ) {

        if ( ($(event.target).hasClass('oeuvre-place')) ) {
            
            //cas d'emplacement vide
            $(event.target).parent().find('.emplacement-handle').css({
                visibility: 'visible'
            });;
            $(event.target).parent().find('.deletePlace').css({
                visibility: 'visible'
            });;
        }
        if ( ($(event.target).parent().parent().hasClass('oeuvre-place')) ) {
            
            //cas d'emplacement plein
            $(event.target).parent().parent().parent().find('.emplacement-handle').css({
                visibility: 'visible'
            });;
            $(event.target).parent().parent().parent().find('.deletePlace').css({
                visibility: 'visible'
            });;
        }  
    })

    $('.container').click(function(event) {
        if (!$(event.target).hasClass('.emplacement')) {
            $('.emplacement-handle, .deletePlace').css('visibility', 'hidden');
        }
    });

//GESTION NOUVELLES COORDONNEES DES EMPLACEMENTS
    function  doDrag() {
        $('.gestionPlan .emplacement').draggable({
            handle: '.emplacement-handle',
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
                console.log(idExpo);
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
                        $(event.target).closest('.plan').prepend('<div id="default-place" class="emplacement" data-id="'+response+'" style="top:50%; left:50%;"><div class="emplacement-handle ion-arrow-move" title="Déplacer"></div><div class="deletePlace ion-android-close" title="Supprimer"></div><div title="Cliquez pour plus d\'options" class="oeuvre-place" data-idemplacement="'+response+'"></div></div>');
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

    $(document).ajaxComplete(function () {
        doDrag();
    });
    
});