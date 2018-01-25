<?php 

require '../includes/bdd/connectbdd.php';
require '../class/OeuvreExposee.class.php';
require '../class/OeuvreExposeeManager.class.php';
require '../class/Oeuvre.class.php';
require '../class/OeuvreManager.class.php';
require '../class/ArtisteExpose.class.php';
require '../class/ArtisteExposeManager.class.php';
require '../class/Artiste.class.php';
require '../class/ArtisteManager.class.php';

$managerArtiste = new ArtisteManager($bdd);
//CREATION A LA VOLEE d'un nouvel artiste et retour pour affichage ajax
if (isset($_GET['idExpo'], $_GET['createArtiste']) && $_GET['createArtiste'] == "create") {
	$idExpo = htmlentities($_GET['idExpo']);
	$artiste = new Artiste();
	$managerArtiste->addArtiste($artiste);
	$lastIdArtiste = $managerArtiste->getLastIdArtiste();

	$managerArtisteExpose = new ArtisteExposeManager($bdd);
	$artisteExpose = new ArtisteExpose(['idArtiste'=>$lastIdArtiste, 'idExpo'=>$idExpo]);
	$managerArtisteExpose->addArtisteExpose($artisteExpose);

	header('location: ../content/gestionPanel.php');
}



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
		

		//CREATION A LA VOLEE d'une nouvelle oeuvre prevue ou recue et retour pour affichage ajax
		if (isset($_GET['idArtisteExpo'])) {
			$idArtiste = htmlentities($_GET['idArtisteExpo']);
			//creation d'une nouvelle oeuvre vide'
			$managerOeuvre = new OeuvreManager($bdd);
			$oeuvre = new Oeuvre(['idArtiste'=>$idArtiste]);
			$managerOeuvre->addOeuvre($oeuvre);
			//recuperation de son id en base
			$idLastOeuvre = $managerOeuvre->getLastIdOeuvre();
			$lastOeuvre = $managerOeuvre->infoOeuvre($idLastOeuvre);
			$idOeuvre = $lastOeuvre->getIdOeuvre();

			// //AFFICHAGES
			// $Affichages = [];
			// //preparation de l'affichage de la nouelle oeuvre dans la liste des oeuvre d'une carte artiste.
			// $affichageLast = 
			
			// '<li class="li-oeuvre-artiste">&nbsp;'.	$lastOeuvre->getTitre()
			// 	.'<div class="oeuvreArtiste" data-idOeuvre="'.$idLastOeuvre.'">
			// 		<i class="delOeuvreArtiste ion-ios-trash-outline" title="Supprimer"></i>
			// 	</div>
			// 	<img style="width:20px; height: 20px;" src="../img/oeuvres/'.$lastOeuvre->getImage().'">
			// 	<div class="card-form pop-delOeuvre popGestionCard">
			// 		<div class="closeButton-context"><i class="ion-android-close"></i></div>
			// 		<form action="../modules/traitementOeuvre.php" data-idOeuvre="'.$lastOeuvre->getIdOeuvre().'" method="GET">
			// 			<div>
			// 				<span>Voulez vous supprimer definitvement cette oeuvre ?</span><br>
			// 				<input type="hidden" id="idOeuvre" name="idOeuvre" value="'.$lastOeuvre->getIdOeuvre().'">
			// 				<input type="hidden" id="delOeuvre" name="req" value="delete">
			// 			</div>
			// 			<div class="submit">
			// 				<button type="submit">Supprimer</button>
			// 				<button class="cancelButton">Annuler</button>
			// 			</div>
						
			// 		</form>
			// 	</div>
			// </li>';
			
			
			//L'oeuvre est maintenant creer : on l'ajoute en oeuvre prevue ou recue selon la demande.
			if (isset($_GET['idExpo'])) {
				$idExpo = htmlentities($_GET['idExpo']);
				if (isset($_GET['status'])) {
					$managerOeuvreExpo = new OeuvreExposeeManager($bdd);
					//si prevue on l'ajoute en base comme tel
					if ($_GET['status'] == 'prevue') {
						//preparation du tableau d'oeuvre attendu par la fonction d'affichage
						//$oeuvres[] = $lastOeuvre;
						//remplissage du tableau d'oeuvre avec une nouvelle oeuvreExposee
						$oeuvreExposee = new OeuvreExposee(['idOeuvre'=>$idOeuvre, 'idExpo'=>$idExpo, 'dateEntree'=>'0000-00-00']);
						//on produit l'affichage du portlet oeuvrePrevue sans classe particuliere
						//$affichagePortlet = $managerOeuvreExpo->affichageOeuvre($oeuvres, '', $idExpo);
					}
					if ($_GET['status'] == 'recue') {
						//si recue on l'ajoute en base comme tel
						if (isset($_GET['dateEntree'])) {
							$dateEntree = htmlentities($_GET['dateEntree']);
							//preparation du tableau d'oeuvre attendu par la fonction d'affichage
							//$oeuvres[] = $lastOeuvre;
							//remplissage du tableau d'oeuvre avec une nouvelle oeuvreExposee
							$oeuvreExposee = new OeuvreExposee(['idOeuvre'=>$idOeuvre, 'idExpo'=>$idExpo, 'dateEntree'=> $dateEntree]);
							//on produit l'affichage du portlet oeuvreRecue avec la classe item pour le drag and drop (fonction contenue dans oeuvreExposeeManager)
							//$affichagePortlet = $managerOeuvreExpo->affichageOeuvre($oeuvres, 'item', $idExpo);
						}
						
					}
					//ajout en base de l'objet cree
					$managerOeuvreExpo->addOeuvreExposee($oeuvreExposee);
				}
				//remplissage des affichages (liste oeuvre artiste et portlet (prevue ou recue))
				//$Affichages = ['li'=>$affichageLast, 'portlet'=>$affichagePortlet];
			}
			//on envoie le tableau d'affichage en retour à ajax pour injection dans le code
			//echo json_encode($Affichages);
			// $last = explode('*', $affichage);
			// echo $last[0];
		}	
		header('location: ../content/gestionPanel.php');
	}
	
}

?>
