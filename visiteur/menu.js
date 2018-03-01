jQuery(document).ready(function($) {
    // On cache les sous-menus :
    $(".drapeau  ul.subMenu").hide();
    // On sélectionne tous les items de liste portant la classe "toggleSubMenu"
   
    // On modifie l'évènement "click" sur les liens dans les items de liste
    // qui portent la classe "toggleSubMenu" :
    $(".drapeau li.toggleSubMenu > a").click( function () {
        // Si le sous-menu était déjà ouvert, on le referme :
        if ($(this).next("ul.subMenu:visible").length != 0) {
            $(this).next("ul.subMenu").slideUp("normal");
        }
        // Si le sous-menu est caché, on ferme les autres et on l'affiche :
        else {
            $(".drapeau ul.subMenu").slideUp("normal");
            $(this).next("ul.subMenu").slideDown("normal");
        }
       return false;
    });    



}); 