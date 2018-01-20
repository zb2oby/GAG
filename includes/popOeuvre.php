
<?php

//autoloader ne peut pas foncitonner ici car fichier inclus en ajax
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

include('bdd/connectbdd.php');



//variable idOeuvre recuperée en ajax via l'ajout d'une nouvelle oeuvre sur la carte artiste
if (isset($_GET['idOeuvre'])) {
	$idOeuvre = $_GET['idOeuvre'];
}
if (isset($_GET['idExpo'])) {
	$idOeuvre = $_GET['idExpo'];
}
if (isset($_SESSION['idExpo'])) {
	$idExpo = $_SESSION['idExpo'];
}
//si on a lid oeuvre (si on a cliqué depuis la carte oeuvre ailleur) alors : 
$managerOeuvre = new OeuvreManager($bdd);
$oeuvre = $managerOeuvre->infoOeuvre($idOeuvre);

//verifier si l'oeuvre est exposée : 
$managerOeuvreExpo = new OeuvreExposeeManager($bdd);
if (isset($idExpo)) {
	$idOeuvreExposee = $managerOeuvreExpo->idExposee($idOeuvre, $idExpo);
}

//si on a l'idoeuvre exposee (si ona  cliqué depuis une expo en fait) alors : 
if (isset($idOeuvreExposee)) {

	$oeuvreExposee = $managerOeuvreExpo->oeuvreExposee($idOeuvreExposee);
}

 ?>

<div class="context-menu context-oeuvre" data-idOeuvreExposee="<?php if(isset($oeuvreExposee)){ echo $oeuvreExposee->getIdOeuvreExposee(); } ?>">
	<div class="closeButton closeButton-oeuvre"><i class="ion-android-close"></i></div>
	<div class="context-overlay"></div>
	<?php if(isset($oeuvreExposee)){ ?>
	<div class="deleteCard deleteCardOeuvreExpo"><i class="ion-ios-trash-outline" title="Enlever l'oeuvre de l'exposition"></i><span>Retirer de l'expo</span></div>
	<?php } ?>

	
		
		<div class="card-header">
			<div class="col-item card-image">
				<img src="../img/oeuvres/<?php echo $oeuvre->getImage(); ?>" alt="">
			</div>
			<div class="col-item card-title">
				<h3>OEUVRE</h3>
				<h4><?php echo '" '.ucfirst($oeuvre->getTitre()).' "' ?></h4>
				<span id="afficheType">
					<?php 
						$idTypeOeuvre = $oeuvre->getIdTypeOeuvre();
						$typeOeuvre = $managerOeuvre->typeOeuvre($idTypeOeuvre);
						echo 'Type : '.$typeOeuvre;
					?>
				</span>
				<span id="afficheDateEntree">
					<?php 
					if (isset($idOeuvreExposee)) {
						$dateEntree = $oeuvreExposee->getDateEntree();
						if ($dateEntree != '0000-00-00') {
							echo 'Date d\'entrée : '.date('d/m/Y', strtotime($dateEntree));
						}else{
							$dateEntree = '';
						}
					}
						
						 
					?>
						
					
				</span>
			</div>
			<div class="col-item qr-zone">
				<img src="../img/oeuvres/qrCode/<?php echo $oeuvre->getQrcode(); ?>" alt="">
			</div>
			<div class="cardHeader-bottom">
				<span id="afficheArtiste">
					<?php 
						$idArtiste = $oeuvre->getIdArtiste();
						$managerArtiste = new ArtisteManager($bdd);
						$artisteO = $managerArtiste->infoArtiste($idArtiste);

						$nomArtiste = $artisteO->getNom();
						$prenomArtiste = $artisteO->getPrenom();
						echo 'Artiste : '.ucfirst($nomArtiste).' '.ucfirst($prenomArtiste);
						
						 
					?>
				</span>	
				
				<span id="afficheCollectif">
					<?php 
						$idCollectif = $oeuvre->getIdCollectif();
						$managerCollectif = new CollectifManager($bdd);
						$collectif = $managerCollectif->infoCollectif($idCollectif);
						if ($collectif != false) {
							$nomCollectif = $collectif->getLibelleCollectif();
							echo ' / Collectif : '.$nomCollectif;
						}
						
						 
					?>
				</span>	
				
			</div>
		</div>
		<div class="card-content">

			<div class="card-col card-form">
				<div class="col-item card-form">
					<form class="form-oeuvre" data-idOeuvre="<?php echo $oeuvre->getIdOeuvre() ?>" action="../modules/traitementOeuvre.php" method="GET">
						
						<div>
							<label for="titre">Titre</label>
							<input type="text" name="titre" id="titre" value="<?php echo ucfirst($oeuvre->getTitre()) ?>">
						</div>
						<div>
							<label for="longueur">Longueur</label>
							<input type="text" name="longueur" id="longueur" value="<?php echo $oeuvre->getLongueur() ?>">
						</div>
						<div>
							<label for="hauteur">Hauteur</label>
							<input type="text" name="hauteur" id="hauteur" value="<?php echo $oeuvre->getHauteur() ?>">
						</div>
						<div>
							<label for="etat">Etat</label>
							<input type="text" name="etat" id="etat" value="<?php echo $oeuvre->getEtat() ?>">
						</div>
						<div>
							<label for="descriptif">Descriptif</label><br>
							<textarea name="descriptif" id="descriptif" cols="40" rows="10" value="<?php echo $oeuvre->getDescriptifFR() ?>"><?php echo $oeuvre->getDescriptifFR() ?></textarea>
						</div>
						
						<div class="submit">
							<button class="submit-oeuvre" type="submit">Enregistrer les informations</button>
							
						</div>
						
					</form>
				</div>

			</div>

			<div class="card-col card-action">
				
				<div class="col-item">
					<h4>APPARITIONS</h4>
					<ul id="list-info">

						<?php 
							$listExpo = $managerOeuvreExpo->listExpoOeuvreExposee($idOeuvre);
							foreach ($listExpo as $exposition) {
								echo '<li>'.$exposition->getDateDeb().'<br>Exposition : '.$exposition->getTitre().'</li>';
							}
						 ?>
					</ul>
					
				</div>
				<div class="pop-messagerieOeuvre popGestionCard">
					<div class="closeButton-context"><i class="ion-android-close"></i></div>
					<div class="card-msg">
						<?php 
//POUR LES TEST
$champ = 'idOeuvre';
//dans le cas d'une oeuvre : dans les autres cas $artisteO->getIdArtiste etc...
$id = $oeuvre->getIdOeuvre();

						//recuperation d'un objet exposition avec l'idExpo de l'oeuvre exposée ici ouverte si on est dans le cas d'une carte "oeuvre exposée"
						if (isset($oeuvreExposee)) {
							$managerExpo = new ExpositionManager($bdd);
							$expo = $managerExpo->infoExpo($oeuvreExposee->getIdExpo());
						}
						
						//recuperation de la liste des messages pour cette oeuvre
						$managerMsgOeuvre = new MessageManager($bdd);
						$listMessage = $managerMsgOeuvre->infoMessage($champ, $id);
						$nbMsg = count($listMessage);
						foreach ($listMessage as $message) {
							$idUser = $message->getIdUtilisateur();
							$managerUser = new UtilisateurManager($bdd);
							$user = $managerUser->infoUtilisateur($idUser);
							echo '<div class="message"><div class="message-header"> Message de '.$user->getNom().' Le '.date('d/m/Y', strtotime($message->getDateMessage())).'</div>';
							echo '<div class="message-content">'.$message->getMessage().'</div></div>';
						}
						 ?>
					</div>
					<?php 
							if (isset($_SESSION['idUser'])) {
								$idUser = $_SESSION['idUser'];
								$managerUser = new UtilisateurManager($bdd);
								$user = $managerUser->infoUtilisateur($idUser);
								$nomUser = $user->getNom();
							}
							
					 ?>
					 <div class="newMsg">
						 <form class="form-oeuvre" action="../modules/traitementOeuvre.php" data-idOeuvre="<?php echo $oeuvre->getIdOeuvre() ?>" method="GET">
						 	<div>
						 		<label for="newMsg">Nouveau message</label><br>
						 		<textarea name="newMsg" id="newMsg" cols="40" rows="4" placeholder="Ici votre message"></textarea>
						 	</div>
						 	
						 	<input type="hidden" name="idUser" id="idUser" value="<?php if(isset($_SESSION['idUser'])){echo $_SESSION['idUser'];} ?>">
							<input type="hidden" name="dateMsg" id="dateMsg" value="<?php echo date('Y-m-d'); ?>">
							<input type="hidden" name="nomUser" id="nomUser" value="<?php echo $nomUser; ?>">
							<div class="submit">
								<button type="submit">Envoyer</button>
							</div>
						 	
						 </form>
					</div>
					
				</div>
				<div class="col-item">
					<h4>ACTIONS</h4>
					<ul id="list-button">
						<li><button class="action-button" id="metaData">Gérer le Contenu +</button></li>
						<?php if(isset($_SESSION['idExpo'])){ echo '<li><button class="action-button" id="modifDateEntree">Modifier date d\'entrée</button></li>'; }?>
						<li><button class="action-button" id="modifImageOeuvre">Enregistrer l'image</button></li>
						<li><button class="action-button" id="modifTypeOeuvre">Info type Oeuvre</button></li>
						<li><button class="action-button" id="modifArtColl">Infos Artiste/Collectif</button></li>
						<li><button class="action-button" id="delOeuvre">Supprimer l'oeuvre</button></li>
						<li><button class="action-button button-msg" id="messagerieOeuvre">Messagerie<div class="nbMsg"><?php echo $nbMsg; ?></div></button></li>
					</ul>
				</div>
			</div>
			
		</div>
		
	<div class="card-form pop-modifDateEntree popGestionCard">
		<div class="closeButton-context"><i class="ion-android-close"></i></div>
		<form class="form-oeuvre" id="dateEntree-form" action="../modules/traitementOeuvre.php" data-idOeuvreExposee="<?php if(isset($oeuvreExposee)){ echo $idOeuvreExposee;} ?>" method="GET">
			<div>
				<label for="dateEntree">Date d'entrée dans l'expo</label>
				<input type="date" id="dateEntree" name="dateEntree" value="<?php if(isset($dateEntree)){echo $dateEntree;} ?>">
			</div>
			<div class="submit">
				<button type="submit">Modifier</button>
			</div>
			
		</form>
	</div>
	<div class="card-form pop-modifImageOeuvre popGestionCard">
		<div class="closeButton-context"><i class="ion-android-close"></i></div>
		<form class="form-oeuvre" action="../modules/traitementOeuvre.php" data-idOeuvre="<?php echo $oeuvre->getIdOeuvre() ?>" method="POST" enctype="multipart/form-data">
			<div>
				<span for="imageOeuvre">Image (JPG GIF JPEG PNG| max. 300Ko) </span><br>
				<input type="file" id="imageOeuvre" name="imageOeuvre[]" accept=".jpg, .jpeg, .gif, .png"><br>
				<input type="hidden" id="maxSize" name="MAX_FILE_SIZE" value="500000">
				<input type="hidden" id="existImage" name="existImage" value="<?php echo $oeuvre->getImage(); ?>">
				<input type="hidden" id="idOeuvre" name="idOeuvre" value="<?php echo $oeuvre->getIdOeuvre(); ?>">
			</div>
			<div class="submit">
				<button type="submit">Enregistrer</button>
			</div>
		</form>
	</div>
	<div class="card-form pop-modifTypeOeuvre popGestionCard">
		<div class="closeButton-context"><i class="ion-android-close"></i></div>
		<form class="form-oeuvre" action="../modules/traitementOeuvre.php" data-idOeuvre="<?php echo $oeuvre->getIdOeuvre() ?>" method="GET">
			<div>
				<label for="idType">Type d'oeuvre</label>
				<select name="idType" id="idType">
					<?php 
						$listType = $managerOeuvre->listTypeOeuvre();
						foreach ($listType as $id => $libelle) {
							if ($libelle == $typeOeuvre) {
								$selected = 'selected';
							}else{
								$selected = "";
							}
							echo '<option '.$selected.' value="'.$id.'"><span data-libelleType="'.$libelle.'">'.$libelle.'</span></option>';
						}

					 ?>
				</select>
			</div>
			<div class="submit">
				<button type="submit">Modifier</button>
			</div>
		</form>
	</div>
	<div class="card-form pop-modifArtColl popGestionCard">
		<div class="closeButton-context"><i class="ion-android-close"></i></div>
		<form class="form-oeuvre" action="../modules/traitementOeuvre.php" data-idOeuvre="<?php echo $oeuvre->getIdOeuvre() ?>" method="GET">
			<div>
				<label for="idArtiste">Artiste</label>
				<select name="idArtiste" id="idArtiste">
					<?php 
						$listArtiste = $managerArtiste->listArtiste();
						foreach ($listArtiste as $artisteO) {
							if ($artisteO->getIdArtiste() == $idArtiste) {
								$selected = 'selected';
							}else{
								$selected = "";
							}
							echo '<option '.$selected.' value="'.$artisteO->getIdArtiste().'"><span data-nomArtiste="'.$artisteO->getNom().'" data-prenomArtiste="'.$artisteO->getPrenom().'">'.$artisteO->getPrenom().' '.$artisteO->getNom().'</span></option>';
						}

					 ?>
				</select>
			</div>
			<div>
				<label for="idCollectif">Collectif</label>
				<select name="idCollectif" id="idCollectif">
					<option value="" hidden selected></option>
					<?php 
						$listCollectif = $managerCollectif->listCollectif();
						foreach ($listCollectif as $collectif) {
							if ($collectif->getIdCollectif() == $idCollectif) {
								$selected = 'selected';
							}else{
								$selected = "";
							}
							echo '<option '.$selected.' value="'.$collectif->getIdCollectif().'"><span data-libelleCollectif="'.$collectif->getLibelleCollectif().'">'.$collectif->getLibelleCollectif().'</span></option>';
						}

					 ?>
				</select>
			</div>
			<div class="submit">
				<button type="submit">Modifier</button>
			</div>
		</form>
	</div>
	<div class="card-form pop-delOeuvre popGestionCard">
		<div class="closeButton-context"><i class="ion-android-close"></i></div>
		<form class="form-oeuvre" action="../modules/traitementOeuvre.php" data-idOeuvre="<?php echo $oeuvre->getIdOeuvre() ?>" method="GET">
			<div>
				<span>Voulez vous supprimer definitvement cette oeuvre ?</span><br>
				<input type="hidden" id="idOeuvre" name="idOeuvre" value="<?php echo $idOeuvre; ?>">
				<input type="hidden" id="delOeuvre" name="req" value="delete">
			</div>
			<div class="submit">
				<button type="submit">Supprimer</button>
			</div>
			
		</form>
	</div>

	<div class="card-form pop-metaData popGestionCard">

		<div class="closeButton-context"><i class="ion-android-close"></i></div>

		<div class="card-data">
			<ul>
			<?php
				$managerMeta = new DonneeEnrichieManager($bdd);
				// $listType = $managerMeta->typeDonnee();
				$listDonnee = $managerMeta->listDonneeOeuvre($idOeuvre);
				foreach ($listDonnee as $donnee) {
					$idType = $donnee->getIdTypeDonneEnrichie();
					$libelleType = $managerMeta->libelleTypeDonnee($idType);
					$idDonneeDeleted = $donnee->getIdDonneeEnrichie();

					echo '<li class="metaData">Type de donnée : '.$libelleType.' <br>Libellé : '.$donnee->getLibelleDonneeEnrichie().'<br><form class="form-oeuvre" data-idOeuvre="'.$oeuvre->getIdOeuvre().'" action="../modules/traitementOeuvre.php" method="GET"><input type="hidden" id="req" name="req" value="deleteMeta"><input type="hidden" id="idDonnee" name="idDonnee" value="'.$idDonneeDeleted.'"><button type="submit" class="delData"><i class="ion-ios-trash-outline" title="Supprimer"></i></button></form></li>';
				}


			 ?>
			 </ul>
		</div>
		
			
		<div class="newData">
		 	<form class="form-oeuvre" action="../modules/traitementOeuvre.php" data-idOeuvre="<?php echo $oeuvre->getIdOeuvre() ?>" method="POST" enctype="multipart/form-data">
			 	<span>Ajouter un contenu supplémentaire</span>
			 	<div>
					 <label for="typeDonnee">Type de donnée</label>
					 <select name="typeDonnee" id="typeDonnee">
					 	<option hidden selected value=""></option>
					 	<?php 
					 		$listType = $managerMeta->listTypeDonnee();
					 		foreach ($listType as $id => $libelle) {
					 			echo '<option value="'.$id.'">'.$libelle.'</option>';
					 		}

					 	 ?>
					 </select>
				 </div>
				 <div>
					 <label for="libelleDonnnee">Libélle Donnée</label>
					 <input type="text" name="libelleDonnee" id="libelleDonnee">
				 </div>
				 <div>
					 <span for="fichierDonnee">Fichier (JPG GIF JPEG PNG MP3 MP4 WAV MPEG| max. 500Ko) </span><br>
					<input type="file" id="fichierDonnee" name="fichierDonnee[]" accept=".jpg, .jpeg, .gif, .png, .mp3, .mp4, .wav, .mpeg"><br>
					<input type="hidden" id="maxSize" name="MAX_FILE_SIZE" value="500000">
					<input type="hidden" id="idOeuvre" name="idOeuvre" value="<?php echo $oeuvre->getIdOeuvre(); ?>">
				 </div>
				 <div class="submit">
				 	<button type="submit">Ajouter</button>
				 </div>
			</form> 
		</div>
		
	</div>
</div>