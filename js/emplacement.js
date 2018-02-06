jQuery(document).ready(function($) {

//GESTION AFFICHAGE LOGO DEPLACEMENT
    $('.oeuvre-place').click(function(event) {
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

//GESTION NOUVELLES COORDONNEES DES EMPLACEMENTS
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
            var emplacement = 'coordTop=' + coordTop + '&coordLeft=' + coordLeft + '&idEmplacement=' + idEmplacement;
            //traitement ajax
            $.ajax({
                url: '../modules/traitementEmplacement.php',
                type: 'GET',
                dataType: 'html',
                data: emplacement,
            })
            .done(function() {
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

//GESTION DE LA SUPPRESSION DELEMENT

    // $('.deletePlace').click(function(event) {

    //     $('.confirmPopup').css('display', 'block');
        
    //     $('.cancelButton').click(function(e) {
    //         $('.confirmPopup').css('display', 'none');
    //     });

    //     $('.deleteButton').click(function(e) {
    //         var emplacement = $(event.target).parent();
    //         var idEmplacement = emplacement.data('id');
    //         emplacement.remove();
    //         $('.confirmPopup').css('display', 'none');
    //         var deletePlace = 'delete=' + idEmplacement;
    //         //traitement ajax
    //         $.ajax({
    //             url: '../modules/traitementEmplacement.php',
    //             type: 'GET',
    //             dataType: 'html',
    //             data: deletePlace,
    //         })
    //         .done(function() {
    //             // console.log("success");
    //         })
    //         .fail(function() {
    //             // console.log("error");
    //         })
    //         .always(function() {
    //             // console.log("complete");
    //         });
    //     });
    // });

    
    

    // $('.plan').sortable({
    //     connectWith: '.trash',
    //     update: function(event, ui) {
    //         var order = $(this).sortable('serialize');
    //     },
    //     helper: 'clone'
    // });
    // $('.trash').droppable({
    //     // accept: '.emplacement',
    //     activeClass: 'dropArea',
    //     hoverClass: 'dropAreaHover',
    //     drop: function(event, ui) {
    //         ui.draggable.remove();
    //     }
    // });
    
});