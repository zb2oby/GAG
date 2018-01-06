<?php 
//SCRIPT D'AJOUT OU DE MISE A JOUR D'EMPLACEMENT SUR LE PLAN
require '../includes/bdd/connectbdd.php';
require '../class/emplacement.class.php';
require '../class/emplacement.manager.php';


$manager = new EmplacementManager($bdd);





//MISE A JOUR DES COORDONNEES (apres drag and drop jquery : voir emplacement.js) ET DE L'ID OEUVRE APRES DROP DE LIMAGE (voir listeoeuvre.js)
if (isset($_GET['idEmplacement'])) {

	$idEmplacement = htmlentities($_GET['idEmplacement']);
	$emplacement = $manager->getEmplacement($idEmplacement);

	if (isset($_GET['coordTop'])) {
		$coordTop = htmlentities($_GET['coordTop']);
		$emplacement->modifCoordTop($coordTop);
		
	}
	if (isset($_GET['coordLeft'])) {
		$coordLeft = htmlentities($_GET['coordLeft']);
		$emplacement->modifCoordLeft($coordLeft);
		
	}

	if (isset($_GET['idOeuvreExposee'])) {
		$idOeuvreExposee = htmlentities($_GET['idOeuvreExposee']);
		$emplacement->modifIdOeuvreExposee($idOeuvreExposee);
		
	}

	$manager->updateEmplacement($emplacement);
}

//SUPPRESSION EMPLACEMENT
if (isset($_GET['delete'])) {
	$idEmplacement = htmlentities($_GET['delete']);
	$emplacement = $manager->getEmplacement($idEmplacement);
	$manager->deleteEmplacement($emplacement);

}

//CREATION DUN NOUVEL EMPLACEMENT
if (isset($_GET['idExpo'])) {
//au clic sur + on envoie la variable idExpo : 
//=>creation d'une div avec data-id= idEmplacement de la base lié a l'expo ouverte
	$idExpo = $_GET['idExpo'];
	//on creer donc un nouvel objet emplacement
	$emplacement = new Emplacement(['idExpo'=>$idExpo]);

	

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





 ?>