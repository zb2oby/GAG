<?php 
require('../includes/bdd/connectbdd.php');
require('../class/Utilisateur.class.php');
require('../class/UtilisateurManager.class.php');

$managerUser = new UtilisateurManager($bdd);

if (isset($_GET['idUser']) && !empty($_GET['idUser'])) {
	$idUser = htmlentities($_GET['idUser']);
}else{
	$mdp = uniqid();
	$user = new Utilisateur(['nom'=>'', 'prenom' =>'', 'identifiant' => '', 'mot_de_passe' => $mdp, 'idTypeUtilisateur' => 2 ]);
	$managerUser->addUtilisateur($user);
	$idUser = $managerUser->lastIdUser();
	echo $idUser;
}


if (isset($idUser)) {

	$user = $managerUser->infoUtilisateur($idUser);

	if (isset($_GET['nom'])) {
		$nom = htmlentities($_GET['nom']);
		$user->setNom($nom);
	}
	if (isset($_GET['prenom'])) {
		$prenom = htmlentities($_GET['prenom']);
		$user->setPrenom($prenom);
	}
	if (isset($_GET['role'])) {
		$role = htmlentities($_GET['role']);
		$user->setIdTypeUtilisateur($role);
	}
	if (isset($_GET['identifiant'])) {
		$identifiant = htmlentities($_GET['identifiant']);
		$user->setIdentifiant($identifiant);
	}


	if (isset($_GET['req']) && $_GET['req'] == 'delUser') {
		$managerUser->deleteUtilisateur($user);
	}else{
		$managerUser->updateUtilisateur($user);
	}
			
}





