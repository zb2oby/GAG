jQuery(document).ready(function($) {

    $(function() {
        $('.emplacement').draggable({
            containment: '.plan',
            stop: function(event,ui) {
                console.log($(this));
                var coordTop = $(this).css('top');
                var coordLeft = $(this).css('left');
                console.log('top : '+coordTop);
                console.log('left : '+coordLeft);
                console.log('ici on va entrer ces coordonnées en base');
            }
        })
    });
    // $(".recue .portlet").find('.img').addClass('item');
    doSort();
    // $('.column').sortable('refresh');
    
	function doSort() {
        
	    $( ".column" ).sortable({
            cursor: "move",
            connectWith: ".column",
            handle: ".portlet-content",
            cancel: ".portlet-toggle",
            placeholder: "portlet-placeholder ui-corner-all",
            stop: function(event,ui) {
                var provenance = $(event.target);
                var destination = $(ui.item).parent();
                //au stop du sortable : 
                //si le portlet provient de la classe "recue" et qu'il va vers la classe "prevue" on rend l'image passive:
                if (provenance.hasClass('recue') && destination.hasClass('prevue')) {
                   $(ui.item).find('.img').draggable("destroy");
                   $(ui.item).find('.img').removeClass('item');
                //si il provient de la classe "prevue" et qu'il va vers la classe "recue" on lance doClone();
                }else if (provenance.hasClass('prevue') && destination.hasClass('recue')) {
                    $(ui.item).find('.img').addClass('item');
                    doClone();
                }
                //s'il provient de la classe recue et qu'il va vers recue, il conserve son draggable lancé prealablement par doClone.
                //s'il va de prevue vers prevue il n'entre pas dans la boucle et doClone ne se lance pas.
            }
	    });

	    // $( ".portlet" )
	    //   .addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" ).find( ".portlet-header" ).addClass( "ui-widget-header ui-corner-all" )
	    //     .prepend( "<span class='ui-icon ui-icon-minusthick portlet-toggle'></span>");
	 
	    // $( ".portlet-toggle" ).on( "click", function() {
	    //   var icon = $( this );
	    //   icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );
	    //   icon.closest( ".portlet" ).find( ".portlet-content" ).toggle();

	    // });
        
	};
 
 //    CONNECTED LIST UI
	// $(function() {
 //        $( "#sortable1" ).sortable({
 //            connectWith: ".connectedSortable",
 //            remove: function(event, ui) {
 //                ui.item.clone().appendTo('#sortable2');
 //                $(this).sortable('cancel');
 //            }
 //        }).disableSelection();
    
	//     $( "#sortable2" ).sortable({
	//             connectWith: ".connectedSortable"
	//         }).disableSelection();
	// });


//CLONAGE DE LIMAGE SUR LE PLAN
	function doClone(){
        //set up background images
        // $('.item').each(function(i,o){
        //     $(o).css('background-image', 'url(' + $(o).data('src') + ')');
        // });


        $('.item').draggable({
        cancel: "a.ui-icon", // clicking an icon won't initiate dragging
        //revert: "invalid", // when not dropped, the item will revert back to its initial position
        revert: true, // bounce back when dropped
        helper: "clone", // create "copy" with original properties, but not a true clone
        cursor: "move", 
        revertDuration: 0 // immediate snap

        });

        
    
        // var $container
        $('.container').droppable({
            accept: "#items .item",
            activeClass: "ui-state-highlight",
            drop: function( event, ui ) {
                // clone item to retain in original "list"
                var $item = ui.draggable.clone();
                var idOeuvre = $item.attr('data-id');
                var idEmplacement = $(event.target).attr('id');

                $(this).addClass('has-drop').html($item);

                var place = 'idOeuvre=' + idOeuvre + '&idEmplacement=' + idEmplacement;
                $.ajax({
                    url: 'updatePlace.php',
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

//SUPPRESSION IMAGE PLAN AU DOUBLE CLIC
    $('.emplacement').dblclick(function(event) {
        $(event.currentTarget).find('.img').attr({
            'style': '',
            'data-src': ''
        });;
        $(event.currentTarget).find('img').attr('src', '');
    });

//SUPPRESSION IMAGE PLAN AU DRAG DANS POUBELLE
    $('.container').sortable({
        connectWith: '.trash',
        update: function(event, ui) {
            //Run this code whenever an item is dragged and dropped out of this list
            var order = $(this).sortable('serialize');
        },
        helper: 'clone'
    });
    $('.trash').droppable({
        accept: '.container > .img',
        activeClass: 'dropArea',
        hoverClass: 'dropAreaHover',
        drop: function(event, ui) {
            ui.draggable.remove();
        }
    });


    
});