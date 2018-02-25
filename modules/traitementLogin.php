<?php 
session_start();
include('../includes/functions.php');

spl_autoload_register('loader');

include('../includes/bdd/connectbdd.php');

$managerUser = new UtilisateurManager($bdd);

if (isset($_POST['login'], $_POST['passwd'])) {
	$login = htmlentities($_POST['login']);
	$passwd = sha1(htmlentities($_POST['passwd']));
	$user = $managerUser->checkLogin($login, $passwd);
	if (empty($_POST['passwd']) && empty($_POST['login'])) {
		echo 'empty';
	}
	elseif (empty($_POST['login'])) {
		echo 'login';
	}elseif (empty($_POST['passwd'])) {
		echo 'passwd';
	}elseif (!$user) {
		$message = 'error';
		echo $message;
	}
	else {
		if ($user->getUserState() == 0) {
			$idUser = $user->getIdUtilisateur();
			$redirect = "../content/newMdp.php?idUser=".$idUser;
		}else{
			$_SESSION['idUser'] = $user->getIdUtilisateur();
			require('../config.php');
			$redirect = "../content/accueil.php?onglet=calendar";
		}
		echo $redirect;
		//header('location: ../content/accueil.php?onglet=calendar');
	}
}

if (isset($_GET['email'])) {
	$managerUser = new UtilisateurManager($bdd);
	$email = htmlentities($_GET['email']);
	//generation d'un nouveau mot de passe
	$mdp = uniqid();
	//hashage du nouveau mot de passe : 
	$mdpHash = sha1($mdp);
	//recuperation du user correspondant a l'email et enregistrement nouveau mot de passe en base
	$user = $managerUser->getUserByMail($email);
	if (!$user) {
		exit();
	}else {
		$user->setMot_de_passe($mdpHash);
		$user->setUserState(0);
		$managerUser->updateUtilisateur($user);
		//envoie du nouveau mot de passe par mail a l'utilisateur
		$identifiant = $user->getIdentifiant();
		sendMdpMail($email, $identifiant, $mdp);
	}
	
}
