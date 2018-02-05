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
		$_SESSION['idUser'] = $user->getIdUtilisateur();
		require('../config.php');
		$redirect = "../content/accueil.php?onglet=calendar";
		echo $redirect;
		//header('location: ../content/accueil.php?onglet=calendar');
	}
}
