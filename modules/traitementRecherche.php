<?php 
require('../class/ArtisteManager.class.php');
require('../class/OeuvreManager.class.php');
require('../class/CollectifManager.class.php');
require('../class/ExpositionManager.class.php');
require('../includes/bdd/connectbdd.php');
if (isset($_GET['type'], $_GET['saisie'])) {
	$type = htmlentities($_GET['type']);
	$recherche = htmlentities($_GET['saisie']);

	switch ($type) {
		case 'artiste':
			$manager = new ArtisteManager($bdd);
			break;
		case 'oeuvre':
			$manager = new OeuvreManager($bdd);
			break;
		case 'collectif':
			$manager = new CollectifManager($bdd);
			break;
		case 'exposition':
			$manager = new ExpositionManager($bdd);
			break;
		
		default:
			# code...
			break;
	}

	$listResultats = $manager->getSearch($recherche);
	echo json_encode($listResultats);
}


 ?>