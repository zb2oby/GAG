<?php 
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=testplan;charset=utf8', 'root', 'zbooby*dev', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}




//si occupé on supprime l'entree
//if ($row != 0) {
//	$sup = $bdd->query("DELETE FROM placement WHERE idEmplacement ='".$_GET['idEmplacement']."'");
//}
//verification si oeuvre deja presente
//$ver = $bdd->query("SELECT * FROM placement WHERE idOeuvre = '".$_GET['idOeuvre']."'");
//$row = $ver->rowCount();


//par defaut a la fin du drop on tente de spprimer l'entree existante pour l'oeuvre en cours de mise a jour.
$sup = $bdd->query("DELETE FROM placement WHERE idOeuvre ='".$_GET['idOeuvre']."'");
//verification si emplacement deja occupé
$ver = $bdd->query("SELECT * FROM placement WHERE idEmplacement = '".$_GET['idEmplacement']."'");
$row = $ver->rowCount();
//si occupé on l'update
if ($row != 0) {
	$upd = $bdd->query("UPDATE placement SET idOeuvre = '".$_GET['idOeuvre']."' WHERE idEmplacement ='".$_GET['idEmplacement']."'");
//sinon on l'insert
}else {
	$ins = $bdd->query("INSERT INTO placement (idOeuvre,idEmplacement) VALUES ('".$_GET['idOeuvre']."','".$_GET['idEmplacement']."')");
}



 ?>