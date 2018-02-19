<?php 
if (isset($_GET['oeuvre'])) {
	$idOeuvre = htmlentities($_GET['oeuvre']);
	echo 'ici affichage de loeuvre '.$idOeuvre.' et son contenu + en fonction de son id envoyée dans lurl du qrcode';
}


 ?>