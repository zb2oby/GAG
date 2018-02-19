<?php 
session_start();
require('../includes/bdd/connectbdd.php');
require('../class/Utilisateur.class.php');
require('../class/UtilisateurManager.class.php');


if (isset($_POST['idUser'])) {
	$idUser = $_POST['idUser'];
	$managerUser = new UtilisateurManager($bdd);
	$user = $managerUser->infoUtilisateur($idUser);
}
//verification du password
if (isset($_POST['mdp1'])) {
	$passwd = $_POST['mdp1'];
	if (strlen($passwd) >= 8) {
		if (isset($_POST['mdp2'])) {
			$passwd2 = $_POST['mdp2'];
			if ($passwd == $passwd2) {
				$passwd = sha1($passwd);
				
				$user->setMot_de_passe($passwd);
				$user->setUserState(1);
				$managerUser->updateUtilisateur($user);
				$_SESSION['idUser'] = $user->getIdUtilisateur();
				require('../config.php');
				$redirect = "../content/accueil.php?onglet=calendar";
				echo $redirect;
			}else{
				echo 'noMatch';
			}
		}else{
			echo 'mdp2';
		}
	}else {
		echo 'short';
	}
}else{
	echo 'mdp1';
}
?>
