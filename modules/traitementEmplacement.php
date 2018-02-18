<?php 
//SCRIPT D'AJOUT OU DE MISE A JOUR D'EMPLACEMENT SUR LE PLAN
require '../includes/bdd/connectbdd.php';
require_once '../class/Emplacement.class.php';
require_once '../class/EmplacementManager.class.php';
// include('../includes/functions.php');

// spl_autoload_register('loader');

$manager = new EmplacementManager($bdd);






//CREATION DUN NOUVEL EMPLACEMENT SUR DEMANDE (clic sur +)
if (isset($_GET['idExpo'])) { 
//=>creation d'une div avec data-id= idEmplacement de la base lié a l'expo ouverte
	$idExpo = $_GET['idExpo'];
	if (isset($_GET['req']) && $_GET['req'] == 'addPlace') {
			# code..
		
		//on creer donc un nouvel objet emplacement a des coordonnée differente de 50/50 pour eviter l'ajout de l'id default-place caché par defaut
		$emplacement = new Emplacement(['idExpo'=>$idExpo, 'idOeuvreExposee'=>0, 'coordTop'=>51, 'coordLeft'=>51]);

		//on l'ajoute en base : il a desormais un id
		$manager->addEmplacement($emplacement);
		//on recupere l'id du dernier enregistrement
		$idEmplacement = $manager->getLast($emplacement);
		
		//on recupere le tableau des coordonnées de cet emplacement
		$coord = $manager->getCoord($idEmplacement);
		//on affiche maintenan la div aux coordonnées presente en base:
		foreach ($coord as $axe) {
			echo '<div class="emplacement" data-id="place'.$idEmplacement.'" style="top:'.$axe->getCoordTop().'%; left:'.$axe->getCoordLeft().'%;"></div>';
		}

		header('location: ../content/gestionPanel.php');
	}
}



//MISE A JOUR DES COORDONNEES (apres drag and drop jquery : voir emplacement.js) ET DE L'ID OEUVRE APRES DROP DE LIMAGE (voir listeoeuvre.js)
if (isset($_GET['idEmplacement'])) {

	$idEmplacement = htmlentities($_GET['idEmplacement']);
	$emplacement = $manager->getEmplacement($idEmplacement);

	if (isset($_GET['coordTop'])) {
		$coordTop = htmlentities($_GET['coordTop']);
		$emplacement->setCoordTop($coordTop);
		
	}
	if (isset($_GET['coordLeft'])) {
		$coordLeft = htmlentities($_GET['coordLeft']);
		$emplacement->setCoordLeft($coordLeft);
		
	}

	if (isset($_GET['idOeuvreExposee'])) {
		$idOeuvreExposee = htmlentities($_GET['idOeuvreExposee']);
		$emplacement->setIdOeuvreExposee($idOeuvreExposee);
		
	}

	$manager->updateEmplacement($emplacement);

}

//SUPPRESSION EMPLACEMENT
if (isset($_GET['delete'])) {
	$idEmplacement = htmlentities($_GET['delete']);
	$emplacement = $manager->getEmplacement($idEmplacement);
	$manager->deleteEmplacement($emplacement);

}



//CREATION DUN NOUVEL EMPLACEMENT A LOUVERTURE DE PAGE EXPO SI AUCUN EMPLACEMENT NEXISTE (inclus dans listeGEstion.php)

if (isset($_SESSION['idExpo'])) {
	$idExpo = $_SESSION['idExpo'];
}
if (isset($_GET['idExpo'])) {
	$idExpo = htmlentities($_GET['idExpo']);
}
if (isset($idExpo) && $idExpo != 'undefined') {

	//verification si existence d'un emplacement par defaut (coordonnées 50/50)
	$defaultPlace = $manager->getdefaultPlace($idExpo);
	//pas d'emplacement vide
	if (!$defaultPlace) {
		//on creer donc un nouvel objet emplacement
		$emplacement = new Emplacement(['idExpo'=>$idExpo, 'idOeuvreExposee'=>0]);
		//on l'ajoute en base : il a desormais un id
		$manager->addEmplacement($emplacement);
		//on recupere l'id du dernier enregistrement
		$idEmplacement = $manager->getLast($emplacement);
		
		//on recupere le tableau des coordonnées de cet emplacement
		//$coord = $manager->getCoord($idEmplacement);
		//on affiche maintenan la div aux coordonnées presente en base:
		// foreach ($coord as $axe) {
		// 	echo '<div class="emplacement" data-id="place'.$idEmplacement.'" style="top:'.$axe->getCoordTop().'%; left:'.$axe->getCoordLeft().'%;"></div>';
		// }
	//header("Refresh:0");
		//retour pour ajax
		echo $idEmplacement;
	}
	//dans les autres cas on ne fait rien

	
}




 ?>