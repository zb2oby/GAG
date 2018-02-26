<?php 
session_start();
require('../includes/functions.php');
spl_autoload_register('loader');
require('../includes/bdd/connectbdd.php');

$managerExpo = new ExpositionManager($bdd);
$exposition = $managerExpo->currentExpo();
if (!$exposition) {
	header('location: error.php');
	exit();
}else {
	$idExpo = $exposition->getIdExpo();
	$_SESSION['idExpo']=$idExpo;
	$listlangueExpo = $managerExpo->getIdLangueExpo($idExpo);
	$titre = $exposition->getTitre();
	$theme = $exposition->getTheme();
	$horaireO = $exposition->getHoraireO();
	$horaireF = $exposition->getHoraireF();
	$dateDeb = $exposition->getDateDeb();
	$dateFin = $exposition->getDateFin();
	$affiche = $exposition->getAffiche();
	$descriptif = $exposition->getDescriptifFR();
}

/*if(isset($_SESSION['langue'])){
	$langue=$_SESSION['langue'];
}*/


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

	