<?php 
include('../class/ArtisteManager.class.php');
include('../class/Artiste.class.php');
include('../class/ArtisteExposeManager.class.php');
include('../class/ArtisteExpose.class.php');
include('../class/OeuvreManager.class.php');
include('../class/Oeuvre.class.php');
include('../class/MessageManager.class.php');
include('../class/Message.class.php');
include('../includes/bdd/connectbdd.php');

if (isset($_GET['idArtiste'])) {
	$idArtiste = $_GET['idArtiste'];
	$managerArtiste = new ArtisteManager($bdd);
	$artiste = $managerArtiste->infoArtiste($idArtiste);

	if (isset($_GET['nom'],$_GET['prenom'],$_GET['tel'],$_GET['email'],$_GET['descriptif'])) {
		$prenom = $_GET['prenom'];
		$tel = $_GET['tel'];
		$email = $_GET['email'];
		$nom = $_GET['nom'];
		$descriptif = $_GET['descriptif'];

		$artiste->setNom($nom);
		$artiste->setPrenom($prenom);
		$artiste->setTel($tel);
		$artiste->setEmail($email);
		$artiste->setDescriptifFR($descriptif);
	}
	
	if (isset($_GET['idCollectif'])) {
		$idCollectif = htmlentities($_GET['idCollectif']);
		if (isset($_GET['req']) && $_GET['req'] == 'deleteColl') {
			$managerArtiste->deleteCollectifArtiste($idArtiste, $idCollectif);
		}else{
			$managerArtiste->setCollectifArtiste($idArtiste, $idCollectif);
		}
		
	}

	if (isset($_GET['message'], $_GET['dateMsg'], $_GET['idUser'])) {
		$contenu = htmlentities($_GET['message']);
		$dateMsg = htmlentities($_GET['dateMsg']);
		$idUser = htmlentities($_GET['idUser']);
		$manager = new MessageManager($bdd);
		$message = new Message(['dateMessage'=>$dateMsg, 'message'=>$contenu, 'idUtilisateur'=>$idUser, 'idArtiste'=>$idArtiste]);
		$manager->addMessageArtiste($message);
	}
	if (isset($_GET['req']) && $_GET['req'] == 'delete') {
	$managerArtiste->deleteArtiste($artiste);
	}	


	$managerArtiste->updateArtiste($artiste);
	
}


//TRAITEMENT IMAGE ARTISTE

		
if (isset($_POST['idArtiste'])) {
	$idArtiste = htmlentities($_POST['idArtiste']);
	$managerArtiste = new ArtisteManager($bdd);
	$artiste = $managerArtiste->infoArtiste($idArtiste);

	//traitement image
	if (isset($_POST['existImage'])) {
	$nomFichier = $_POST['existImage'];
	}
	
	if (isset($_FILES['imageArtiste']) && ($_FILES['imageArtiste']['name'][0] != NULL)) {
		$name = $_FILES['imageArtiste']['name'][0];
		
		if (htmlentities(isset($_POST['MAX_FILE_SIZE'])) && $_POST['MAX_FILE_SIZE'] == '500000') {
			$maxsize = (int)$_POST['MAX_FILE_SIZE'];
			if ($_FILES['imageArtiste']['error'][0] > 0) $erreur = "Erreur lors du transfert";
			if ($_FILES['imageArtiste']['size'][0] > $maxsize) {$erreur = "Le fichier est trop gros";}
			
			$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
			$extension_upload = strtolower(  substr(  strrchr($name, '.')  ,1)  );
			if ( in_array($extension_upload,$extensions_valides) ) echo "Extension correcte";
			$cheminFichier = "../img/artistes/artiste{$idArtiste}.{$extension_upload}";
			//suppression des fichiers existants
			$files = glob("../img/artistes/artiste{$idArtiste}.*");
			foreach ($files as $file) {
			  unlink($file);
			}
			$resultat = move_uploaded_file($_FILES['imageArtiste']['tmp_name'][0],$cheminFichier);
			if ($resultat) echo "Transfert réussi";
			$nomFichier = 'artiste'.$idArtiste.'.'.$extension_upload;
			//mie a jour de la base
			$artiste->setImage($nomFichier);
			$managerArtiste->updateArtiste($artiste);
			
			header('location: ../content/gestionPanel.php');
			
	 	}
		
	 }


}


 ?>