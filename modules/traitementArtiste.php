<?php 
require_once('../class/ArtisteManager.class.php');
require_once('../class/Artiste.class.php');
require_once('../class/ArtisteExposeManager.class.php');
require_once('../class/ArtisteExpose.class.php');
require_once('../class/OeuvreManager.class.php');
require_once('../class/Oeuvre.class.php');
require_once('../class/OeuvreExposeeManager.class.php');
require_once('../class/OeuvreExposee.class.php');
require_once('../class/MessageManager.class.php');
require_once('../class/Message.class.php');
require_once('../class/CollectifManager.class.php');
require_once('../class/Collectif.class.php');
require_once('../class/DonneeEnrichieManager.class.php');
require_once('../class/DonneeEnrichie.class.php');
require_once('../includes/bdd/connectbdd.php');
include('../includes/phpqrcode/qrlib.php');

if (isset($_GET['idArtiste'])) {
	$idArtiste = $_GET['idArtiste'];
	$managerArtiste = new ArtisteManager($bdd);
	$artiste = $managerArtiste->infoArtiste($idArtiste);

	if (isset($_GET['nom'],$_GET['prenom'],$_GET['tel'],$_GET['email'],$_GET['descriptif'])) {
		$prenom = htmlentities($_GET['prenom']);
		$tel = htmlentities($_GET['tel']);
		$email = htmlentities($_GET['email']);
		$nom = htmlentities($_GET['nom']);
		$descriptif = htmlentities($_GET['descriptif']);


		//pour chaque variable on creer une entrée de tableaux avec la valeur retour(message d'erreur) de la methode set de l'objet
		$msg = [];
		$msg['nom'] = $artiste->setNom($nom);
		$msg['prenom'] = $artiste->setPrenom($prenom);
		$msg['tel'] = $artiste->setTel($tel);
		$msg['email'] = $artiste->setEmail($email);
		$msg['descriptif'] = $artiste->setDescriptifFR($descriptif);
		//on verifie les valeur nulles et on creer un nouveau tablzau avec seulement les valeurs retour des methode qui ne nsont pas nulles.
		foreach ($msg as $key => $value) {
			if ($value != null) {
				$message[$key] = $value;
			}
		}
		//on reteste la validité de ce nouveau tableau et on l'envoie en json pour traitement ajax
		if (!empty($message) && $message != null) {
				echo json_encode($message);
				//comme le tableau est plein c'est qu'il y a erreur donc on ne continue pas le script de mise à jour
				exit();
		}
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
		$lastId = $manager->lastIdMsg();
		echo $lastId;
	}
	//SUPRESSION ARTISTE
	if (isset($_GET['req'])) {
		if ($_GET['req'] == 'delete') {
			$managerArtiste->deleteArtiste($artiste);
			$image = $artiste->getImage();
			$chemin = '../img/artistes/'.$image;
			if(is_file($chemin)){
			   unlink($chemin);
			}
			//AJOUT DOEUVRE SUR LA CARTE ARTISTE
		}elseif ($_GET['req'] == 'add') {

			$managerOeuvre = new OeuvreManager($bdd);
			$oeuvre = new Oeuvre(['idArtiste'=>$idArtiste]);
			$managerOeuvre->addOeuvre($oeuvre);
			$idLastOeuvre = $managerOeuvre->getLastIdOeuvre();
			$lastOeuvre = $managerOeuvre->infoOeuvre($idLastOeuvre);
			$idOeuvre = $lastOeuvre->getIdOeuvre();
			//ajout du qrCode(attention present aussi dans traitement oeuvre)
			$nomFichierQr = 'oeuvre'.$idOeuvre.'.png';
			$lienQr = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER['HTTP_HOST'].realpath(dirname(__FILE__).'/..')."/content/vueOeuvreVisiteur.php?oeuvre=".$idOeuvre;
			QRcode::png($lienQr, '../img/oeuvres/qrCode/'.$nomFichierQr);
			$lastOeuvre->setQrcode($nomFichierQr);
			$managerOeuvre->updateOeuvre($lastOeuvre);


			$affichageLast = 
			
			'<li class="li-oeuvre-artiste">&nbsp;'.	$lastOeuvre->getTitre()
				.'<div class="oeuvreArtiste" data-idOeuvre="'.$idLastOeuvre.'">
					<i class="delOeuvreArtiste ion-ios-trash-outline" title="Supprimer"></i>
				</div>
				<img style="width:20px; height: 20px;" src="../img/oeuvres/'.$lastOeuvre->getImage().'">
				<div class="card-form pop-delOeuvre popGestionCard">
					<div class="closeButton-context"><i class="ion-android-close"></i></div>
					<form action="../modules/traitementOeuvre.php" data-idOeuvre="'.$lastOeuvre->getIdOeuvre().'" method="GET">
						<div>
							<span>Voulez vous supprimer definitvement cette oeuvre ?</span><br>
							<input type="hidden" id="idOeuvre" name="idOeuvre" value="'.$lastOeuvre->getIdOeuvre().'">
							<input type="hidden" id="delOeuvre" name="req" value="delete">
						</div>
						<div class="submit">
							<button type="submit">Supprimer</button>
							<button class="cancelButton">Annuler</button>
						</div>
						
					</form>
				</div>
			</li>';
			
			
			echo $affichageLast;
			
		}
	
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
			//if ( in_array($extension_upload,$extensions_valides) ) echo "Extension correcte";
			$cheminFichier = "../img/artistes/artiste{$idArtiste}.{$extension_upload}";
			//suppression des fichiers existants
			$files = glob("../img/artistes/artiste{$idArtiste}.*");
			foreach ($files as $file) {
			  unlink($file);
			}
			$resultat = move_uploaded_file($_FILES['imageArtiste']['tmp_name'][0],$cheminFichier);
			//if ($resultat) echo "Transfert réussi";
			$nomFichier = 'artiste'.$idArtiste.'.'.$extension_upload;
			//mie a jour de la base
			$artiste->setImage($nomFichier);
			$managerArtiste->updateArtiste($artiste);
			
			echo $nomFichier;
			//header('location: ../content/gestionPanel.php');
			
	 	}
		
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