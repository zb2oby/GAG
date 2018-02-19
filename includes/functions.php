<?php 

 
function dateDiff($date1, $date2){
    $diff = abs($date1 - $date2);
    $retour = array();
 
    $tmp = $diff;
    $retour['second'] = $tmp % 60;
 
    $tmp = floor( ($tmp - $retour['second']) /60 );
    $retour['minute'] = $tmp % 60;
 
    $tmp = floor( ($tmp - $retour['minute'])/60 );
    $retour['hour'] = $tmp % 24;
 
    $tmp = floor( ($tmp - $retour['hour'])  /24 );
    $retour['day'] = $tmp;
 
    return $retour;
}

function loader($class) {
    require '../class/'.$class.'.class.php';
}


function sendMdpMail($email, $id, $mdp){
    $mail = $email;
    $sujet = 'Vos identifiants';
    $message_txt = "Bonjour, voici vos identifiants de compte sur GAG gestion : -identifiant : ".$id." Mot de passe : ".$mdp;
    $message_html = "<html><head></head><body><b>Bonjour</b>,<br> Voici vos identifiants sur le site GAG Gestion<br>Identifiant : ".$id."<br>Mot de passe : ".$mdp."</body></html>";
    include('../modules/mail.php');
}





