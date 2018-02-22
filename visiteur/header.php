<?php 
session_start();
require('../includes/functions.php');
spl_autoload_register('loader');
require('../includes/bdd/connectbdd.php');

$managerExpo = new ExpositionManager($bdd);
$exposition = $managerExpo->currentExpo();
$idExpo = $exposition->getIdExpo();
$_SESSION['idExpo']=$idExpo;
$listlangueExpo = $managerExpo->getIdLangueExpo($idExpo);
$titre = $exposition->getTitre();
// $theme = $exposition->getTheme();
$affiche = $exposition->getAffiche();
$descriptif = $exposition->getDescriptifFR();
$i=0;
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GAG.com</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>
		<div class="header">
			<div class="titre">
				<?php 
				echo $titre; 
				?>
			</div>
			<div class="date">
				<?php 
				echo date('d/m/Y');
				?>
			</div>
			<!-- <div class="theme"> -->
				<!-- <?php 				
				// echo $theme;
				 ?>		 -->
			<!-- </div> -->
			<div class="drapeau">
				<?php 
				foreach ($listlangueExpo as $idLangue):
				echo'<img src="drapeau/drapeau'.$idLangue.'.jpg">';
					?>
				<?php endforeach ?>
			</div>
		</div>

