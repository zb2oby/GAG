<?php 
session_start();
include('../includes/functions.php');

spl_autoload_register('loader');

include('../includes/bdd/connectbdd.php');

$managerUser = new UtilisateurManager($bdd);

if (isset($_POST['login'], $_POST['passwd'])) {
	$login = htmlentities($_POST['login']);
	$passwd = htmlentities($_POST['passwd']);

	$user = $managerUser->checkLogin($login, $passwd);
	if (!$user) {
		$message = 'Votre login ou votre mot de passe est incorrect';
		header('location: ../content/login.php?message='.$message);
	}else {
		$_SESSION['idUser'] = $user->getIdUtilisateur();
		header('location: ../content/accueil.php?onglet=calendar');
	}

}