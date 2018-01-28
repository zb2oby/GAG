<?php 
include('../class/OeuvreManager.class.php');
include('../class/Oeuvre.class.php');
include('../class/OeuvreExposeeManager.class.php');
include('../class/OeuvreExposee.class.php');
include('../class/MessageManager.class.php');
include('../class/Message.class.php');
include('../class/DonneeEnrichieManager.class.php');
include('../class/DonneeEnrichie.class.php');
include('../includes/bdd/connectbdd.php');
if (isset($_GET['idOeuvre'])) {
	$idOeuvre = $_GET['idOeuvre'];
	$managerOeuvre = new OeuvreManager($bdd);
	$oeuvre = $managerOeuvre->infoOeuvre($idOeuvre);

	if (isset($_GET['etat'],$_GET['titre'],$_GET['longueur'],$_GET['hauteur'],$_GET['descriptif'])) {
		$titre = $_GET['titre'];
		$longueur = $_GET['longueur'];
		$hauteur = $_GET['hauteur'];
		$etat = $_GET['etat'];
		$descriptif = $_GET['descriptif'];

		$oeuvre->setTitre($titre);
		$oeuvre->setLongueur($longueur);
		$oeuvre->setHauteur($hauteur);
		$oeuvre->setEtat($etat);
		$oeuvre->setDescriptifFR($descriptif);
	}
	if (isset($_GET['idTypeOeuvre'])) {
		$idTypeOeuvre = htmlentities($_GET['idTypeOeuvre']);
		$oeuvre->setIdTypeOeuvre($idTypeOeuvre);
	}
	if (isset($_GET['idArtiste'], $_GET['idCollectif'])) {
		$idArtiste = htmlentities($_GET['idArtiste']);
		$idCollectif = htmlentities($_GET['idCollectif']);
		$oeuvre->setIdArtiste($idArtiste);
		$oeuvre->setIdCollectif($idCollectif);
	}

	if (isset($_GET['message'], $_GET['dateMsg'], $_GET['idUser'])) {
		$contenu = htmlentities($_GET['message']);
		$dateMsg = htmlentities($_GET['dateMsg']);
		$idUser = htmlentities($_GET['idUser']);
		$manager = new MessageManager($bdd);
		$message = new Message(['dateMessage'=>$dateMsg, 'message'=>$contenu, 'idUtilisateur'=>$idUser, 'idOeuvre'=>$idOeuvre]);
		$manager->addMessageOeuvre($message);
	}
	//SUPPRESSION OEUVRE
	if (isset($_GET['req']) && $_GET['req'] == 'delete') {
		$managerOeuvre->deleteOeuvre($oeuvre);
		$image = $oeuvre->getImage();
		$chemin = '../img/oeuvres/'.$image;
		$qr = $oeuvre->getQrcode();
		$cheminQr = '../img/oeuvres/qrCode/'.$qr;
		if(is_file($chemin)){
		   unlink($chemin);
		}
		if(is_file($cheminQr)){
		   unlink($cheminQr);
		}
	}	


	$managerOeuvre->updateOeuvre($oeuvre);
	
}


if (isset($_GET['idOeuvreExposee'])) {
	$idOeuvreExposee = htmlentities($_GET['idOeuvreExposee']);
	$manager = new OeuvreExposeeManager($bdd);
	$oeuvreExposee = $manager->oeuvreexposee($idOeuvreExposee);

	if (isset($_GET['dateEntree'])) {
		$dateEntree = htmlentities($_GET['dateEntree']);
		$oeuvreExposee->setDateEntree($dateEntree);
		$manager->updateOeuvreExposee($oeuvreExposee);
	}
}







//TRAITEMENT IMAGE OEUVRE ET CONTENU +

		
if (isset($_POST['idOeuvre'])) {
	$idOeuvre = htmlentities($_POST['idOeuvre']);
	$managerOeuvre = new OeuvreManager($bdd);
	$oeuvre = $managerOeuvre->infoOeuvre($idOeuvre);

	//traitement image
	if (isset($_POST['existImage'])) {
	$nomFichier = $_POST['existImage'];
	}
	
	if (isset($_FILES['imageOeuvre']) && ($_FILES['imageOeuvre']['name'][0] != NULL)) {
		$name = $_FILES['imageOeuvre']['name'][0];
		
		if (htmlentities(isset($_POST['MAX_FILE_SIZE'])) && $_POST['MAX_FILE_SIZE'] == '500000') {
			$maxsize = (int)$_POST['MAX_FILE_SIZE'];
			if ($_FILES['imageOeuvre']['error'][0] > 0) $erreur = "Erreur lors du transfert";
			if ($_FILES['imageOeuvre']['size'][0] > $maxsize) {$erreur = "Le fichier est trop gros";}
			
			$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
			$extension_upload = strtolower(  substr(  strrchr($name, '.')  ,1)  );
			//if ( in_array($extension_upload,$extensions_valides) ) echo "Extension correcte";
			$cheminFichier = "../img/oeuvres/oeuvre{$idOeuvre}.{$extension_upload}";
			//suppression des fichiers existants
			$files = glob("../img/oeuvres/oeuvre{$idOeuvre}.*");
			foreach ($files as $file) {
			  unlink($file);
			}
			$resultat = move_uploaded_file($_FILES['imageOeuvre']['tmp_name'][0],$cheminFichier);
			//if ($resultat) echo "Transfert réussi";
			$nomFichier = 'oeuvre'.$idOeuvre.'.'.$extension_upload;
			//mie a jour de la base
			$oeuvre->setImage($nomFichier);
			$managerOeuvre->updateOeuvre($oeuvre);
			
			echo $nomFichier;
			//header('location: ../content/gestionPanel.php');
			
	 	}
		
	 }

//traitement contenu +
	 
	
	
	//test si dossier meta de l'oeuvre existe sinon creation du dossier
	$dossier = '../meta/oeuvre'.$idOeuvre;
	if(!is_dir($dossier)){
	   mkdir($dossier);
	}

	if (isset($_POST['typeDonnee'])) {
		$idType = htmlentities($_POST['typeDonnee']);
	}
	if (isset($_POST['libelleDonnee'])) {
		$libelleDonnee = htmlentities($_POST['libelleDonnee']);
		//on enleve les espace pour le nom de fichier
		$space = explode(" ", $libelleDonnee);
		$nomFichier = '';
		foreach ($space as $key => $value) {
			$nomFichier .= $value;
		}
	}

	if (isset($_FILES['fichierDonnee']) && ($_FILES['fichierDonnee']['name'][0] != NULL)) {
		$name = $_FILES['fichierDonnee']['name'][0];
		
		if (htmlentities(isset($_POST['MAX_FILE_SIZE'])) && $_POST['MAX_FILE_SIZE'] == '500000') {
			$maxsize = (int)$_POST['MAX_FILE_SIZE'];
			if ($_FILES['fichierDonnee']['error'][0] > 0) $erreur = "Erreur lors du transfert";
			if ($_FILES['fichierDonnee']['size'][0] > $maxsize) {$erreur = "Le fichier est trop gros";}
			
			$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'mp3', 'mp4', 'wav', 'mpeg');
			$extension_upload = strtolower(  substr(  strrchr($name, '.')  ,1)  );
			// if ( in_array($extension_upload,$extensions_valides) ) echo "Extension correcte";
			$cheminFichier = "../meta/oeuvre{$idOeuvre}/{$nomFichier}.{$extension_upload}";
			//suppression des fichiers existants
			$file = "../meta/oeuvre{$idOeuvre}/{$nomFichier}.{$extension_upload}";
			if (file_exists($file)) {
				unlink($file);
			}
			$resultat = move_uploaded_file($_FILES['fichierDonnee']['tmp_name'][0],$cheminFichier);
			// if ($resultat) echo "Transfert réussi";
			$nomFichier = $nomFichier.'.'.$extension_upload;
			//mise a jour de la base
			$donnee = new DonneeEnrichie(['urlFichier'=>$nomFichier, 'libelleDonneeEnrichie'=>$libelleDonnee, 'idTypeDonneEnrichie'=>$idType, 'idOeuvre'=>$idOeuvre]);
			$managerMeta = new DonneeEnrichieManager($bdd);
			$managerMeta->addDonnee($donnee);
			
			//recuperation de l'id du dernier ajout en base pour l'affichage ajax
			$lastId = $managerMeta->getLastDonnee();
			echo $lastId;
			// header('location: ../content/gestionPanel.php');
			
	 	}
		
	 }


}


//suppression contenu +
if (isset($_GET['req'], $_GET['idOeuvre']) && $_GET['req'] == 'deleteMeta') {
	$idOeuvre = $_GET['idOeuvre'];
 	$managerMeta = new DonneeEnrichieManager($bdd);
 	if (isset($_GET['idDonnee'])) {
 		$idDonnee = $_GET['idDonnee'];
 		$donnee = $managerMeta->infoDonnee($idDonnee);
 		$nomFichier = $donnee->getUrlFichier();
 		$file = "../meta/oeuvre".$idOeuvre."/".$nomFichier;
 		if (file_exists($file)) {
			unlink($file);
		}
		$managerMeta->deleteDonnee($donnee);
 	}
	
}	



//TRZAITEMENT SUPPRESSION MESSAGE 
if (isset($_GET['idMessage'])) {
	$idMessage = htmlentities($_GET['idMessage']);
	$managerMsg = new MessageManager($bdd);
	$message = new Message(['idMessage'=>$idMessage]);
	$managerMsg->deleteMessage($message);	
}


 ?>