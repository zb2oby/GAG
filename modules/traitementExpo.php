<?php 
require('../class/Exposition.class.php');
require('../class/ExpositionManager.class.php');
require('../includes/bdd/connectbdd.php');

if (isset($_POST['dateDebut'], $_POST['dateFin'], $_POST['titre'], $_POST['couleurExpo'])) {
	$dateDebut = htmlentities($_POST['dateDebut']);
	$dateFin = htmlentities($_POST['dateFin']);
	$titre = htmlentities($_POST['titre']);
	$couleur = htmlentities($_POST['couleurExpo']);

	$managerExpo = new ExpositionManager($bdd);
	$exposition = new Exposition(['dateDebut' => $dateDebut, 'dateFin' => $dateFin, 'titre' => $titre, 'couleurExpo' => $couleur]);
	
	$exposition->setDateDeb($dateDebut);
	$exposition->setDateFin($dateFin);
	$exposition->setTitre($titre);
	$exposition->setCouleurExpo($couleur);

	if (isset($_POST['theme'])) {
		$theme $ htmlentities($_POST['theme']);
		$exposition->setTheme($theme);
	}

	if (isset($_POST['descriptif'])) {
	$descriptif = htmlentities($_POST['descriptif']);
	$exposition->setDescriptifFR($descriptif);
	}

	if (isset($_FILES['teaser'])) {
		//echo $_FILES['teaser']['name'][0];
	}

	if (isset($_FILES['affiche'])) {
		//echo $_FILES['affiche']['name'][0];
	}

	$managerExpo->addExposition($exposition);
	$lastExpo = $managerExpo->lastExpo();
	$idExpo = $lastExpo->getIdExpo();
	echo $idExpo;

}



?>