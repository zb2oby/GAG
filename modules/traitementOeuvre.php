<?php 
include('../class/OeuvreManager.class.php');
include('../class/Oeuvre.class.php');
include('../class/OeuvreExposeeManager.class.php');
include('../class/OeuvreExposee.class.php');
include('../class/MessageManager.class.php');
include('../class/Message.class.php');
include('../includes/bdd/connectbdd.php');
if (isset($_GET['idOeuvre'])) {
	$idOeuvre = $_GET['idOeuvre'];
	$managerOeuvre = new OeuvreManager($bdd);
	$oeuvre = $managerOeuvre->infoOeuvre($idOeuvre);

	if (isset($_GET['etat'],$_GET['titre'],$_GET['longueur'],$_GET['hauteur'],$_GET['descriptif'])) {
		$titre = $_GET['titre'];
		$longueur = $_GET['longueur'];
		$hauteur = $_GET['hauteur'];
		$etat = $_GET['etat'];
		$descriptif = $_GET['descriptif'];

		$oeuvre->setTitre($titre);
		$oeuvre->setLongueur($longueur);
		$oeuvre->setHauteur($hauteur);
		$oeuvre->setEtat($etat);
		$oeuvre->setDescriptifFR($descriptif);
	}
	if (isset($_GET['idTypeOeuvre'])) {
		$idTypeOeuvre = htmlentities($_GET['idTypeOeuvre']);
		$oeuvre->setIdTypeOeuvre($idTypeOeuvre);
	}
	if (isset($_GET['idArtiste'], $_GET['idCollectif'])) {
		$idArtiste = htmlentities($_GET['idArtiste']);
		$idCollectif = htmlentities($_GET['idCollectif']);
		$oeuvre->setIdArtiste($idArtiste);
		$oeuvre->setIdCollectif($idCollectif);
	}

	if (isset($_GET['message'], $_GET['dateMsg'], $_GET['idUser'])) {
		$contenu = htmlentities($_GET['message']);
		$dateMsg = htmlentities($_GET['dateMsg']);
		$idUser = htmlentities($_GET['idUser']);
		$manager = new MessageManager($bdd);
		$message = new Message(['dateMessage'=>$dateMsg, 'message'=>$contenu, 'idUtilisateur'=>$idUser, 'idOeuvre'=>$idOeuvre]);
		$manager->addMessageOeuvre($message);
	}
	
	$managerOeuvre->updateOeuvre($oeuvre);
}





if (isset($_GET['idOeuvreExposee'])) {
	$idOeuvreExposee = htmlentities($_GET['idOeuvreExposee']);
	$manager = new OeuvreExposeeManager($bdd);
	$oeuvreExposee = $manager->oeuvreexposee($idOeuvreExposee);

	if (isset($_GET['dateEntree'])) {
		$dateEntree = htmlentities($_GET['dateEntree']);
		$oeuvreExposee->setDateEntree($dateEntree);
		$manager->updateOeuvreExposee($oeuvreExposee);
	}
}




 ?>