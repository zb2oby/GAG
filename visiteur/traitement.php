<?php 

$venue=$_SERVER['HTTP_REFERER'];

session_start();
if (isset($_GET['langue'])) {
	$_SESSION['langue']=$_GET['langue'];
/*var_dump($_SESSION['langue']);
exit;*/


	if (isset($_GET['artiste']) && !empty($_GET['artiste'])) {
		//$_SESSION['artiste']=$_GET['artiste'];
		$artiste=$_GET['artiste'];
		 header("Location: artisteselectionner.php?artiste=".$artiste);
	}
	elseif (isset($_GET['oeuvre'])  && !empty($_GET['oeuvre'])) {
		//$_SESSION['oeuvre']=$_GET['oeuvre'];
		$oeuvre=$_GET['oeuvre'];
		 header("Location: oeuvreselectionner.php?oeuvre=".$oeuvre);
	}

	else{
		header("location: ".$venue);
	}
}
?>