<?php 
include('includes/phpqrcode/qrlib.php');
$lien='http://www.google.com'; 
//à remplacer par la valeur de votre choix
QRcode::png($lien, '../img/oeuvres/qrCode/qrtest.png');


 ?>