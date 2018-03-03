jQuery(document).ready(function($) {

    //$(document).on('click', '.oeuvre-place', function(event) {
    $('.emplacement').click(function(event) {
        event.stopPropagation();
        if ($(this).hasClass('noclick')) {
            $(this).removeClass('noclick');
        }else{
            //event.preventDefault();
            //console.log($('.overlay'));
           $('body .overlay').show();
            var idOeuvre = $(event.currentTarget).find('.img').data('id');
            var contextOeuvre = $('.context-oeuvre');
            for (var i = contextOeuvre.length - 1; i >= 0; i--) {
                var idCardOeuvre = $(contextOeuvre[i]).find('.form-oeuvre').data('idoeuvre');
                if (idCardOeuvre == idOeuvre) {
                    $(contextOeuvre[i]).closest('.context-artiste').css({
                        display: 'block',
                    });
                    $(contextOeuvre[i]).css({
                        display: 'block',
                        top: 0
                    });
                }
                
            }
        }
    });

//GESTION NOUVELLES COORDONNEES DES EMPLACEMENTS
    function  doDrag() {

        $('.gestionPlan .emplacement').draggable({
            //handle: '.oeuvre-place',
    		containment: '.gestionPlan .plan',
            start: function(event, ui) {
                $(this).addClass('noclick');
            },
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
                    // if (response != '') {
                    //      console.log(response); 
                    // }
                   
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

    $(document).ajaxComplete(function () {
        doDrag();
    });
    


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
            //console.log(idEmplacement);
            //suppression de l'image du plan d'impression
            var listPlace = $('.imprPlan .emplacement');
            for (var i = listPlace.length - 1; i >= 0; i--) {
                if ($(listPlace[i]).data('id') == idEmplacement) {
                    $(listPlace[i]).remove();
                }
                
            }

            //on remet la classe item sur lelement dans la liste recue 
            var listRecue = $('.column.recue .img');
            for (var i = listRecue.length - 1; i >= 0; i--) {
                if ($(ui.draggable).find('.img').data('id') == $(listRecue[i]).data('id')) {
                    $(listRecue[i]).removeClass('already');
                    $(listRecue[i]).addClass('item');
                    $(listRecue[i]).draggable({disabled: false});
                }
                
            }

                //mise a jour de l'emplacement :: suppression de l'oeuvre droppé
                var place = 'delete=' + idEmplacement; //+ '&idExpo=' + idExpo;
                $.ajax({
                    url: '../modules/traitementEmplacement.php',
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
            //suppression de l'oeuvre du plan de l'expo
            ui.draggable.remove();


            //ceci creer une erreur mais en empeche une autre bien plus embetante qui est que lorsque l'element est trashé, 
            //le doDrag() s'execute avec une erreur pdo
 
            // ==> ce qu'il se passe : l'idemplacement de la fonction doDrag existe. apres le trash il n'existe plus 
            //MAIS le script repasse tout de meme dans la fonction doDrag() à cause du document.ajaxComplete (seule methode trouvée pour deleguer un draggable au document et ainsi recreer des draggable en boucle)
            //IL y repasse donc (inutilement d'ailleur) mais avec un id qui n'existe plus d'ou l'erreur PDO qui ne peut pas hydrater d'objet vide
            //en generant cette erreur on evite la reexecution de doDrag apres un trash
            console.log('Erreur volontaire : voir commentaires');
            ui.draggable.draggable('destroy');

            //CECI SEMBLE FONCTIONNER MAIS RESORT L'ERREUR PDO ===========>>> A CREUSER
            //ui.draggable.draggable({ disabled: true });

        }
    });
    
});