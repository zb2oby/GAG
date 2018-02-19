<?php 
session_start();
if (isset($_GET['req']) && $_GET['req'] == 'logout') {
	if (isset($_SESSION['idUser'])) {
		unset($_SESSION['idUser']);
	}
	if (isset($_SESSION['role'])) {
		unset($_SESSION['role']);
	}
	
	session_destroy();
	header('location: ../content/login.php');
}

 ?>