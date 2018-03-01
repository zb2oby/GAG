<?php 
session_start();
require('../includes/functions.php');
spl_autoload_register('loader');
require('../includes/bdd/connectbdd.php');

$managerExpo = new ExpositionManager($bdd);
$exposition = $managerExpo->currentExpo();
//pour les test : 
$exposition = $managerExpo->infoExpo(125);
//fin de pour les test
if (!$exposition) {
	header('location: error.php');
	exit();
}else {

	//DEFINITION DES VARIABLES POUR TOUT LE SITE
	$idExpo = $exposition->getIdExpo();
	$_SESSION['idExpo']=$idExpo;
	$titre = $exposition->getTitre();
	$theme = $exposition->getTheme();
	$horaireO = $exposition->getHoraireO();
	$horaireF = $exposition->getHoraireF();
	$affiche = $exposition->getAffiche();
	$descriptif = $exposition->getDescriptifFR();
	
	//COMPTEUR DE VISITE
	if (!isset($_COOKIE['visite'])) {
		//s'il ne possede pas de cookie alors on le creer
		$tomorrow = strtotime(date('Y-m-d'))+(24*3600);
		setcookie('visite', 1, $tomorrow, null, null, false, true);
		//recuperartion du compte actuel en base
		$compte = $exposition->getFrequentation();
		if ($compte == NULL) {
			$compte = 0;
		}
		//incrementation
		$compte++;
		//mise a jour du compte
		$exposition->setFrequentation($compte);
		$managerExpo->updateExposition($exposition);
	}
}

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <meta name="apple-mobile-web-app-capable" content="yes"> -->
	<title>GAG.com</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="header nav-down">
		<div class="titre">
			<h1>
				<?php 
				echo ucfirst($titre); 
				?>
			</h1>
		</div>
		<div class="date">
			<?php 
			$dateDebut = strtotime($exposition->getDateDeb());
			$dateFin = strtotime($exposition->getDateFin());
			echo 'Du '.date('d/m/Y', $dateDebut).' au '.date('d/m/Y', $dateFin);
			?>
		</div>
		<div class="drapeau">
			<?php
			$listlangueExpo = $managerExpo->getIdLangueExpo($idExpo); 
			foreach ($listlangueExpo as $idLangue):
				?>
				<form action="traitement.php" method="GET">
					

					<input type="hidden" name="langue" value="<?php echo $idLangue ; ?>" >
					<input type="hidden" name="artiste" value="<?php if(isset($_GET['artiste'])){ echo $_GET['artiste']; } ?>">
					<input type="hidden" name="oeuvre" value="<?php if(isset($_GET['oeuvre'])) { echo $_GET['oeuvre']; } ?>">
					
					<button type="submit"><img src="drapeau/drapeau<?php echo $idLangue; ?>.jpg" alt="drapeau"></button>
					
				</form>
			<?php endforeach ?>
		</div>
	</div>

	