<?php 
require('../class/Exposition.class.php');
require('../class/ExpositionManager.class.php');
require('../includes/bdd/connectbdd.php');

$managerExpo = new ExpositionManager($bdd);
$redirect = false;
if (isset($_GET['req'], $_GET['idExpo']) && $_GET['req'] == 'deleteExpo') {
	$idExpo = htmlentities($_GET['idExpo']);
	$expo = $managerExpo->infoExpo($idExpo);
	$managerExpo->deleteExposition($expo);
	header('location: ../content/accueil.php?onglet=calendar');
}


if (isset($_POST['dateDebut'], $_POST['dateFin'], $_POST['titre'], $_POST['couleurExpo'])) {
	$dateDebut = htmlentities($_POST['dateDebut']);
	$dateFin = htmlentities($_POST['dateFin']);
	$titre = htmlentities($_POST['titre']);
	$couleur = htmlentities($_POST['couleurExpo']);

	$managerExpo = new ExpositionManager($bdd);
	$exposition = new Exposition(['dateDebut' => $dateDebut, 'dateFin' => $dateFin, 'titre' => $titre, 'couleurExpo' => $couleur]);
	
	$exposition->setDateDeb($dateDebut);
	$exposition->setDateFin($dateFin);
	$exposition->setTitre($titre);
	$exposition->setCouleurExpo($couleur);

	if (isset($_POST['theme'])) {
		$theme = htmlentities($_POST['theme']);
		$exposition->setTheme($theme);
	}

	if (isset($_POST['horaireO'])) {
		$horaireO = htmlentities($_POST['horaireO']);
		$exposition->setHoraireO($horaireO);
	}

	if (isset($_POST['horaireF'])) {
		$horaireF = htmlentities($_POST['horaireF']);
		$exposition->setHoraireF($horaireF);
	}

	if (isset($_POST['frequentation'])) {
		$frequentation = htmlentities($_POST['frequentation']);
		$exposition->setFrequentation();
	}

	if (isset($_POST['descriptif'])) {
		$descriptif = htmlentities($_POST['descriptif']);
		$exposition->setDescriptifFR($descriptif);
	}

	if (!isset($_POST['req'])) {
		//ajout en base de la nouvelle expo et recuperation du dernier Id
		$managerExpo->addExposition($exposition);
		$lastIdExpo = $managerExpo->lastIdExpo();
		$expo = $managerExpo->infoExpo($lastIdExpo);
		$idExpo = $expo->getIdExpo();
	}elseif (isset($_POST['req'], $_POST['idExpo']) && $_POST['req'] == 'updateExpo') {
		$idExpo = htmlentities($_POST['idExpo']);
		$exposition->setIdExpo($idExpo);
		$expo = $exposition;
		$redirect = true;
	}
	

	
	//mise a jour de la base et enregistrement des fichiers image de l'expo basé sur le dernier id d'expo recuperé
	if (isset($expo, $idExpo)) {

		//test si dossier meta de l'expo existe sinon creation du dossier
		if (isset($_FILES['teaser']) || isset($_FILES['affiche'])) {
			$dossier = '../img/expositions/expo'.$idExpo;
			if(!is_dir($dossier)){
			   mkdir($dossier);
			}
		}
		

		if (isset($_FILES['teaser']) && ($_FILES['teaser']['name'][0] != NULL)) {
			$name = $_FILES['teaser']['name'][0];
			$nomFichier = 'teaser';
			if (htmlentities(isset($_POST['MAX_FILE_SIZE'])) && $_POST['MAX_FILE_SIZE'] == '500000') {
				$maxsize = (int)$_POST['MAX_FILE_SIZE'];
				if ($_FILES['teaser']['error'][0] > 0) $erreur = "Erreur lors du transfert";
				if ($_FILES['teaser']['size'][0] > $maxsize) {$erreur = "Le fichier est trop gros";}
				
				$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png');
				$extension_upload = strtolower(  substr(  strrchr($name, '.')  ,1)  );
				// if ( in_array($extension_upload,$extensions_valides) ) echo "Extension correcte";
				$cheminFichier = "../img/expositions/expo{$idExpo}/{$nomFichier}.{$extension_upload}";
				//suppression des eventuels fichiers existants portant le meme nom
				$file = "../img/expositions/expo{$idExpo}/{$nomFichier}.{$extension_upload}";
				if (file_exists($file)) {
					unlink($file);
				}
				$resultat = move_uploaded_file($_FILES['teaser']['tmp_name'][0],$cheminFichier);
				// if ($resultat) echo "Transfert réussi";
				$nomFichier = $nomFichier.'.'.$extension_upload;
				//mise a jour de l'objet
				$expo->setTeaser($nomFichier);
				
		 	}
		
	 	}

		if (isset($_FILES['affiche']) && ($_FILES['affiche']['name'][0] != NULL)) {
			$name = $_FILES['affiche']['name'][0];
			$nomFichier = 'affiche';
			if (htmlentities(isset($_POST['MAX_FILE_SIZE'])) && $_POST['MAX_FILE_SIZE'] == '500000') {
				$maxsize = (int)$_POST['MAX_FILE_SIZE'];
				if ($_FILES['affiche']['error'][0] > 0) $erreur = "Erreur lors du transfert";
				if ($_FILES['affiche']['size'][0] > $maxsize) {$erreur = "Le fichier est trop gros";}
				
				$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png');
				$extension_upload = strtolower(  substr(  strrchr($name, '.')  ,1)  );
				// if ( in_array($extension_upload,$extensions_valides) ) echo "Extension correcte";
				$cheminFichier = "../img/expositions/expo{$idExpo}/{$nomFichier}.{$extension_upload}";
				//suppression des fichiers existants
				$file = "../img/expositions/expo{$idExpo}/{$nomFichier}.{$extension_upload}";
				if (file_exists($file)) {
					unlink($file);
				}
				$resultat = move_uploaded_file($_FILES['affiche']['tmp_name'][0],$cheminFichier);
				// if ($resultat) echo "Transfert réussi";
				$nomFichier = $nomFichier.'.'.$extension_upload;
				//mise a jour de l'objet
				$expo->setAffiche($nomFichier);
				
		 	}
		
	 	}

	 		
	 	//update de l'entrée en base
		$managerExpo->updateExposition($expo);

		
	}
	


	//retour pour le callback ajax du calendrier(besoin dateDebut dateFin couleur et idExpo titre)
	$listAjax = ['idExpo' => $idExpo, 'dateDebut' => strtotime($dateDebut), 'dateFin' => strtotime($dateFin), 'couleur' => $couleur, 'titre' => $titre, 'today'=>strtotime(date('Y-m-d'))];
	echo json_encode($listAjax);

	//redirection pour l'updateexpo depuis la page de gestion
	if ($redirect == true) {
		header('location: ../content/gestionPanel.php?onglet=expo&idExpo='.$idExpo);
	}
	

}



?>