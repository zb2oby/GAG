<?php
//$mail = $_POST['email']; // Déclaration de l'adresse de destination.
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}
if (isset($adminEmail) && !empty($adminEmail)){
	if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $adminEmail)) // On filtre les serveurs qui rencontrent des bogues.
	{
		$passage_ligne = "\r\n";
	}
	else
	{
		$passage_ligne = "\n";
	}
}
//=====Déclaration des messages au format texte et au format HTML.
// $message_txt = "Bonjour Si vous recevez cet e-mail c'est que vous avez laissé un message sur le site AM-Tool. Votre message a bien été transmis. Vous recevrez une réponse dans les plus brefs délais.";
// $message_html = "<html><head></head><body><b>Bonjour</b>, Si vous recevez cet e-mail c'est que vous avez laissé un message sur le site AM-Tool. Votre message a bien été transmis. Vous recevrez une réponse dans les plus brefs délais.</body></html>";
//==========
 
//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
//$sujet = $_POST['sujet'];
//=========
 
//=====Création du header de l'e-mail.
$header = "From: \"Grand Angle\"<contact@gag.fr>".$passage_ligne;
$header.= "Reply-to: \"Grand Angle\" <contact@gag.fr>".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========
 
//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========
//=====Envoi de l'e-mail.
if (isset($adminEmail) && !empty($adminEmail)) {
	for ($i=0; $i <count($adminEmail) ; $i++) { 
	mail($adminEmail[$i],$sujet,$message,$header);
	}
}else{
	mail($mail,$sujet,$message,$header);
}
//==========




?>