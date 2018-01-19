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
	if (isset($_GET['req'])) {
		if ($_GET['req'] == 'delete') {
			$managerArtiste->deleteArtiste($artiste);
		}elseif ($_GET['req'] == 'add') {
			$managerOeuvre = new OeuvreManager($bdd);
			$oeuvre = new Oeuvre(['idArtiste'=>$idArtiste]);
			$managerOeuvre->addOeuvre($oeuvre);
			$idLastOeuvre = $managerOeuvre->getLastIdOeuvre();
			$lastOeuvre = $managerOeuvre->infoOeuvre($idLastOeuvre);
			$idOeuvre = $lastOeuvre->getIdOeuvre();
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


 ?>