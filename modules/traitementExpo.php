<?php
require('../class/Exposition.class.php');
require('../class/ExpositionManager.class.php');
require('../includes/bdd/connectbdd.php');

$managerExpo = new ExpositionManager($bdd);
$redirect = false;


function enregistrementTeaser(Exposition $expo, $idExpo, $POST) {
	if (isset($POST['existTeaser']) && !empty($POST['existTeaser'])) {
		$nomFichier = $POST['existTeaser'];
		$expo->setTeaser($nomFichier);

	}

	if (isset($_FILES['teaser']) && ($_FILES['teaser']['name'][0] != NULL)) {
		$name = $_FILES['teaser']['name'][0];
		$nomFichier = 'teaser';
		if (htmlentities(isset($_POST['MAX_FILE_SIZE'])) && $_POST['MAX_FILE_SIZE'] == '500000') {
			$maxsize = (int)$_POST['MAX_FILE_SIZE'];
			$erreur = false;
			if ($_FILES['teaser']['error'][0] > 0) $erreur = "Erreur lors du transfert";
			if ($_FILES['teaser']['size'][0] > $maxsize) {$erreur = "Le fichier est trop gros";}
			
			$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png');
			$extension_upload = strtolower(  substr(  strrchr($name, '.')  ,1)  );
			if ( in_array($extension_upload,$extensions_valides) && !$erreur) {
				$cheminFichier = "../img/expositions/expo{$idExpo}/{$nomFichier}.{$extension_upload}";
				//suppression des eventuels fichiers existants portant le meme nom
				$file = "../img/expositions/expo{$idExpo}/{$nomFichier}.{$extension_upload}";
				$existFiles = glob("../img/expositions/expo".$idExpo."/".$nomFichier."*");
				foreach ($existFiles as $file) {
					if (file_exists($file)) {
						unlink($file);
					}
				}
				
				$resultat = move_uploaded_file($_FILES['teaser']['tmp_name'][0],$cheminFichier);
				// if ($resultat) echo "Transfert réussi";
				$nomFichier = $nomFichier.'.'.$extension_upload;
			
				
				//mise a jour de l'objet
				$expo->setTeaser($nomFichier);
			}	
	 	}
		
	}else {
		//enregistrement teaser par defaut
		copy('../img/expositions/default/defaultTeaser.jpg', '../img/expositions/expo'.$idExpo.'/teaser.jpg');
		$expo->setTeaser('teaser.jpg');
	}
}

function enregistrementAffiche(Exposition $expo, $idExpo, $POST) {
	if (isset($POST['existAffiche']) && !empty($POST['existAffiche'])) {
		$nomFichier = $POST['existAffiche'];
		$expo->setAffiche($nomFichier);
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
			if ( in_array($extension_upload,$extensions_valides) ) {
				$cheminFichier = "../img/expositions/expo{$idExpo}/{$nomFichier}.{$extension_upload}";
				//suppression des fichiers existants
				$file = "../img/expositions/expo{$idExpo}/{$nomFichier}.{$extension_upload}";
				$existFiles = glob("../img/expositions/expo".$idExpo."/".$nomFichier."*");
				foreach ($existFiles as $file) {
					if (file_exists($file)) {
						unlink($file);
					}
				}
				$resultat = move_uploaded_file($_FILES['affiche']['tmp_name'][0],$cheminFichier);
				// if ($resultat) echo "Transfert réussi";

				$nomFichier = $nomFichier.'.'.$extension_upload;
					
				
				//mise a jour de l'objet
				$expo->setAffiche($nomFichier);
			}
	 	}
		
	}else{
		//enregistrement affiche paer defaut
		copy('../img/expositions/default/defaultAffiche.jpg', '../img/expositions/expo'.$idExpo.'/affiche.jpg');
		$expo->setAffiche('affiche.jpg');
	}
}

function makeExpoDir (Exposition $expo, $idExpo) {
	//test si dossier meta de l'expo existe sinon creation du dossier
	if (isset($_FILES['teaser']) || isset($_FILES['affiche'])) {
		$dossier = '../img/expositions/expo'.$idExpo;
		if(!is_dir($dossier)){
		   mkdir($dossier);
		}
	}
}


function setLangueExpo ($managerExpo, $idExpo) {

		if (isset($_POST['idLangue'])) {
			$managerExpo->addLnExpo($idExpo, $_POST['idLangue']);
		}else {
			$managerExpo->resetLnExpo($idExpo);
		}
}
//SUPPRESSION DE LEXPO
if (isset($_GET['req'], $_GET['idExpo']) && $_GET['req'] == 'deleteExpo') {
	$idExpo = htmlentities($_GET['idExpo']);
	$expo = $managerExpo->infoExpo($idExpo);
	$managerExpo->deleteExposition($expo);
	$dossier = '../img/expositions/expo'.$idExpo;
	if(is_dir($dossier)){
		if (is_file($dossier.'/teaser.jpg')) {
			unlink($dossier.'/teaser.jpg');
		}
		if (is_file($dossier.'/affiche.jpg')) {
			unlink($dossier.'/affiche.jpg');
		}
	   rmdir($dossier);
	}
	header('location: ../content/accueil.php?onglet=calendar');
}

//MISE A JOUR DU TEASER DEPUIS LONGLET EXPO
if (isset($_POST['req'], $_POST['idExpo']) && $_POST['req'] == 'updateTeaser') {
	$idExpo = htmlentities($_POST['idExpo']);
	$expo = $managerExpo->infoExpo($idExpo);

	makeExpoDir($expo, $idExpo);
		
	enregistrementTeaser($expo, $idExpo, $_POST);
	 //update de l'entrée en base
	$managerExpo->updateExposition($expo);
	header('location: ../content/gestionPanel.php?onglet=expo&idExpo='.$idExpo);
}

//MISE A JOUR AFFICHE DEPUIS ONGLET EXPO
if (isset($_POST['req'], $_POST['idExpo']) && $_POST['req'] == 'updateAffiche') {
	$idExpo = htmlentities($_POST['idExpo']);
	$expo = $managerExpo->infoExpo($idExpo);

	makeExpoDir($expo, $idExpo);

	enregistrementAffiche($expo, $idExpo, $_POST);
	 //update de l'entrée en base
	$managerExpo->updateExposition($expo);
	header('location: ../content/gestionPanel.php?onglet=expo&idExpo='.$idExpo);
}


//CREATION ET MISE AJOUR DES INFOS GENERALES
if (isset($_POST['dateDebut'], $_POST['dateFin'], $_POST['titre'], $_POST['couleurExpo'])) {
	$dateDebut = htmlentities($_POST['dateDebut']);
	$dateFin = htmlentities($_POST['dateFin']);
	$titre = htmlentities($_POST['titre']);
	$couleur = htmlentities($_POST['couleurExpo']);

	$managerExpo = new ExpositionManager($bdd);
	$exposition = new Exposition(['dateDebut' => $dateDebut, 'dateFin' => $dateFin, 'titre' => $titre, 'couleurExpo' => $couleur]);
	
	$msg = [];
	$msg['dateDebut'] = $exposition->setDateDeb($dateDebut);
	$msg['dateFin'] = $exposition->setDateFin($dateFin);
	$msg['titre'] = $exposition->setTitre($titre);
	$msg['couleur'] = $exposition->setCouleurExpo($couleur);


	if (isset($_POST['theme'])) {
		$theme = htmlentities($_POST['theme']);
		$msg['theme'] = $exposition->setTheme($theme);
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
		$msg['descriptif'] = $exposition->setDescriptifFR($descriptif);
	}

	//on verifie les valeur nulles et on creer un nouveau tablzau avec seulement les valeurs retour des methode qui ne nsont pas nulles.
	foreach ($msg as $key => $value) {
		if ($value != null) {
			$message[$key] = $value;
		}
	}
	//on reteste la validité de ce nouveau tableau et on l'envoie en json pour traitement ajax
	if (!empty($message) && $message != null) {
			//comme le talbeau est plein c'est qu'il y a erreur
			//on renvoie donc le tableau pour ajax et on stop le script
				$message['error'] = 'error';
				echo json_encode($message);
				exit();
			
			
	}







	if (!isset($_POST['req'])) {
		//creation du dossier expo si existe pas
		//creation des fichier affiche et teaser par defaut
		// $dossier = '../img/expositions/expo'.$idExpo;
		// if(!is_dir($dossier)){
		//    mkdir($dossier);
		// }
		
		//ajout en base de la nouvelle expo et recuperation du dernier Id
		$managerExpo->addExposition($exposition);
		$lastIdExpo = $managerExpo->lastIdExpo();
		$expo = $managerExpo->infoExpo($lastIdExpo);
		$idExpo = $expo->getIdExpo();
		setLangueExpo($managerExpo, $idExpo);
	}elseif (isset($_POST['req'], $_POST['idExpo']) && $_POST['req'] == 'updateExpo') {
		$idExpo = htmlentities($_POST['idExpo']);
		$exposition->setAffiche($_POST['existAffiche']);
		$exposition->setTeaser($_POST['existTeaser']);
		setLangueExpo($managerExpo, $idExpo);

		$exposition->setIdExpo($idExpo);
		$expo = $exposition;
		// //update de l'entrée en base
		$managerExpo->updateExposition($expo);
		//	$redirect = true;
	}
	

	if (!isset($_POST['req']) || $_POST['req'] != 'updateExpo') {
					
		//mise a jour de la base et enregistrement des fichiers image de l'expo basé sur le dernier id d'expo recuperé
		if (isset($expo, $idExpo)) {

			//test si dossier meta de l'expo existe sinon creation du dossier
			makeExpoDir($expo, $idExpo);
			

			//enregistrement du fichier affiche et teaser
			enregistrementTeaser($expo, $idExpo, $_POST);

			enregistrementAffiche($expo, $idExpo, $_POST);

		 		
		 	//update de l'entrée en base
			$managerExpo->updateExposition($expo);

			
		}
	
	}	

	//retour pour le callback ajax du calendrier(besoin dateDebut dateFin couleur et idExpo titre)
	$listAjax = ['idExpo' => $idExpo, 'dateDebut' => strtotime($dateDebut), 'dateFin' => strtotime($dateFin), 'couleur' => $couleur, 'titre' => $titre, 'today'=>strtotime(date('Y-m-d'))];
	echo json_encode($listAjax);


	//si on vient d'ailleur que de l'accueil on se fait rediriger
	// $url = explode('/', $_SERVER['HTTP_REFERER']);
	// $urlParam = $url[count($url)-1];
	// $urlFinal = explode('?', $urlParam);
	// if ($urlFinal[0] != 'accueil.php') {
	// 	header('location: ../content/gestionPanel.php?onglet=expo&expo='.$idExpo);
	// }
	// //redirection pour l'updateexpo depuis la page de gestion
	// if ($redirect == true) {
	// 	header('location: ../content/gestionPanel.php?onglet=expo&idExpo='.$idExpo);
	// }


	

}



?>