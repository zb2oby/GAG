<?php 
include('../includes/phpqrcode/qrlib.php');
$lien='http://10.22.0.10/GAG/visiteur/oeuvreselectionner.php?oeuvre=24'; 
//à remplacer par la valeur de votre choix
QRcode::png($lien, '../img/oeuvres/qrCode/oeuvre24.png');


 ?>