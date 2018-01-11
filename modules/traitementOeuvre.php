<?php 
include('../class/OeuvreManager.class.php');
include('../class/Oeuvre.class.php');
include('../includes/bdd/connectbdd.php');
if (isset($_GET['idOeuvre'])) {
	$idOeuvre = $_GET['idOeuvre'];
	$titre = $_GET['titre'];
	$longueur = $_GET['longueur'];
	$hauteur = $_GET['hauteur'];
	$etat = $_GET['etat'];
	$descriptif = $_GET['descriptif'];

	// $oeuvre = new Oeuvre(['idOeuvre'=>$idOeuvre, 'titre'=>$titre, 'longueur'=>$longueur, 'hauteur'=>$hauteur, 'etat'=>$etat, 'descriptif' => $descriptif]);
	$managerOeuvre = new OeuvreManager($bdd);
	$oeuvre = $managerOeuvre->infoOeuvre($idOeuvre);
	$oeuvre->setTitre($titre);
	$oeuvre->setLongueur($longueur);
	$oeuvre->setHauteur($hauteur);
	$oeuvre->setEtat($etat);
	$oeuvre->setDescriptifFR($descriptif);
	$managerOeuvre->updateOeuvre($oeuvre);
}



 ?>