<?php 

require '../includes/bdd/connectbdd.php';
require '../class/oeuvreExposee.class.php';
require '../class/oeuvreExposee.manager.php';
require '../class/artisteExpose.class.php';
require '../class/artisteExpose.manager.php';


$manager = new OeuvreExposeeManager($bdd);
//update de la liste recue : enregistrement de la date du jour en date
if (isset($_GET['update'], $_GET['idOeuvreExposee'])) {
	$idOeuvreExposee = htmlentities($_GET['idOeuvreExposee']);
	$update = htmlentities($_GET['update']);

	$oeuvreExposee = $manager->oeuvreExposee($idOeuvreExposee);
	if ($update == 'annuler') {
		$today = '0000-00-00';
	}elseif ($update == 'enregistrer') {
		$today = date('Y-m-d');
	}
	
	$oeuvreExposee->modifDateEntree($today);	
	$manager->updateOeuvreExposee($oeuvreExposee);
}
//SUPPRESSION ou AJOUT D'UNE OEUVRE PREVUE ou RECUE
if (isset($_GET['req'])) {
	//SUPPRESSION
	if ($_GET['req'] == 'delete') {
		if (isset($_GET['idOeuvreExposee'])) {
			$idOeuvreExposee = htmlentities($_GET['idOeuvreExposee']);
			$oeuvreExposee = $manager->oeuvreExposee($idOeuvreExposee);
			$manager->deleteOeuvreExposee($oeuvreExposee);
		}
		if (isset($_GET['idExpo'], $_GET['idArtiste'])) {
			$idExpo = htmlentities($_GET['idExpo']);
			$idArtiste = htmlentities($_GET['idArtiste']);
			$manager = new ArtisteExposeManager($bdd);
			$artisteExpose = new ArtisteExpose(['idArtiste'=>$idArtiste, 'idExpo'=>$idExpo]);
			$manager->deleteArtisteExpose($artisteExpose);
		}
		
	//AJOUT
	}elseif ($_GET['req'] == 'add' && isset($_GET['idExpo'])) {
		$idExpo = htmlentities($_GET['idExpo']);
		if (isset($_GET['idOeuvre'])) {
			$idOeuvre = htmlentities($_GET['idOeuvre']);
			$dateEntree = '0000-00-00';
			//cas d'une nouvelle carte recue
			if (isset($_GET['dateEntree'])) {
				$dateEntree = htmlentities($_GET['dateEntree']);
			}
			# code...ici on receptionne les variable du formulaire popup
			$newOeuvreExposee = new OeuvreExposee(['idExpo'=>$idExpo, 'idOeuvre'=>$idOeuvre, 'dateEntree'=>$dateEntree, 'dateSortie'=>'0000-00-00', 'nbCLic'=>0, 'nbFlash'=>0]);
			//creation de la nouvel oeuvreExposee
			$manager->addOeuvreExposee($newOeuvreExposee);
			
			//recuperation du necessaire pour l'afficher
			//affichage
		}
		if (isset($_GET['idArtiste'])) {
			$idArtiste = htmlentities($_GET['idArtiste']);
			$manager = new ArtisteExposeManager($bdd);
			$newArtisteExpose = new ArtisteExpose(['idArtiste'=>$idArtiste, 'idExpo'=>$idExpo]);
			$manager->addArtisteExpose($newArtisteExpose);
		}
		header('location: ../content/gestionPanel.php');
	}
	
}

?>
