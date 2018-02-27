<?php 
session_start();
var_dump($_SESSION);

if (isset($_GET['langue'])) {
	$_SESSION['langue']=$_GET['langue'];

	if (isset($_GET['artiste']) && !empty($_GET['artiste'])) {
		//$_SESSION['artiste']=$_GET['artiste'];
		$artiste=$_GET['artiste'];
		 header("location: artisteselectionner.php?artiste=".$artiste);
	}
	elseif (isset($_GET['oeuvre'])  && !empty($_GET['oeuvre'])) {
		//$_SESSION['oeuvre']=$_GET['oeuvre'];
		$oeuvre=$_GET['oeuvre'];
		 header("location: oeuvreselectionner.php?oeuvre=".$oeuvre);
	}

	else{
		$venue=$_SERVER['HTTP_REFERER'];
		header("location: ".$venue);
	}
}
?>