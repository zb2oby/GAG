<?php 
include('../includes/phpqrcode/qrlib.php');
$i=25;
for ($i=25; $i <= 64; $i++) {
	$oeuvre = 'oeuvre'.$i;
	$lien='http://gag.zb2oby.fr/visiteur/oeuvreselectionner.php?oeuvre='.$i; 
	//à remplacer par la valeur de votre choix
	QRcode::png($lien, '../img/oeuvres/qrCode/'.$oeuvre.'.png');
	echo 'QrCode pour : '.$oeuvre. ' crée avec succes';

}

 ?>