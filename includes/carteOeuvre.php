<?php //test pour les oeuvre d'abord ?>
<?php 
// include('functions.php');

// spl_autoload_register('loader');

include('bdd/connectbdd.php');

$manager = new OeuvreExposeeManager($bdd);

//si on a l'idoeuvre exposee (si ona  cliqué depuis une expo en fait) alors : 
//$idOeuvreExposee = 53; //data-id du conteneur de ce fichier
$oeuvreExposee = $manager->oeuvreExposee($idOeuvreExposee);
// $idOeuvre = $oeuvreExposee->getIdOeuvre();
// $oeuvre = $manager->oeuvre($idOeuvreExposee);
//si on a lid oeuvre (si on a cliqué depuis la carte oeuvre ailleur) alors : 
$managerOeuvre = new OeuvreManager($bdd);
//$idOeuvre = 5; //data-idOeuvre 
$oeuvre = $managerOeuvre->infoOeuvre($idOeuvre);


// $idExpo = 2;
// $managerExpo = new ExpositionManager($bdd);
// $exposition = $managerExpo->infoExpo($idExpo);
 ?>

<div class="context-menu">
<div class="context-overlay"></div>
	<i class="closeButton ion-android-close"></i>
	<div class="deleteCard"><i class="ion-ios-trash-outline" title="Enlever l'oeuvre de l'exposition"></i><span>Retirer de l'expo</span></div>

	
		
		<div class="card-header">
			<div class="col-item card-image">
				<img src="../img/oeuvres/<?php echo $oeuvre->getImage(); ?>" alt="">
			</div>
			<div class="col-item card-title">
				<h3>OEUVRE</h3>
				<h4><?php echo '" '.ucfirst($oeuvre->getTitre()).' "' ?></h4>
				<span>
					<?php 
						$idTypeOeuvre = $oeuvre->getIdTypeOeuvre();
						$typeOeuvre = $managerOeuvre->typeOeuvre($idTypeOeuvre);
						echo 'Type : '.$typeOeuvre;
					?>
				</span>
				<span> 
					<?php 
						$dateEntree = $oeuvreExposee->getDateEntree();
						if ($dateEntree != '0000-00-00') {
							echo 'Date d\'entrée : '.$dateEntree;
						}
						 
					?>
					
				</span>
			</div>
			<div class="col-item qr-zone">
				<img src="../img/oeuvres/qrCode/<?php echo $oeuvre->getQrcode(); ?>" alt="">
			</div>
			<div class="cardHeader-bottom">
				
					<?php 
						$idArtiste = $oeuvre->getIdArtiste();
						$managerArtiste = new ArtisteManager($bdd);
						$artiste = $managerArtiste->infoArtiste($idArtiste);

						$nomArtiste = $artiste->getNom();
						$prenomArtiste = $artiste->getPrenom();
						echo 'Artiste : '.ucfirst($nomArtiste).' '.ucfirst($prenomArtiste);
						
						 
					?>
					
				
				 
					<?php 
						$idCollectif = $oeuvre->getIdCollectif();
						$managerCollectif = new CollectifManager($bdd);
						$collectif = $managerCollectif->infoCollectif($idCollectif);
						if ($collectif != false) {
							$nomCollectif = $collectif->getLibelleCollectif();
							echo ' / Collectif : '.$nomCollectif;
						}
						
						 
					?>
					
				
			</div>
		</div>
		<div class="card-content">

			<div class="card-col card-form">
				<div class="col-item card-form">
					<form class="form-oeuvre" id="form-oeuvre<?php echo $oeuvre->getIdOeuvre() ?>" data-idOeuvre="<?php echo $oeuvre->getIdOeuvre() ?>" action="../modules/traitementOeuvre.php" method="GET">
						
						<div>
							<label for="titre">Titre</label>
							<input type="text" name="titre" id="titre<?php echo $oeuvre->getIdOeuvre() ?>" value="<?php echo $oeuvre->getTitre() ?>">
						</div>
						<div>
							<label for="longueur">Longueur</label>
							<input type="text" name="longueur" id="longueur<?php echo $oeuvre->getIdOeuvre() ?>" value="<?php echo $oeuvre->getLongueur() ?>">
						</div>
						<div>
							<label for="hauteur">Hauteur</label>
							<input type="text" name="hauteur" id="hauteur<?php echo $oeuvre->getIdOeuvre() ?>" value="<?php echo $oeuvre->getHauteur() ?>">
						</div>
						<div>
							<label for="etat">Etat</label>
							<input type="text" name="etat" id="etat<?php echo $oeuvre->getIdOeuvre() ?>" value="<?php echo $oeuvre->getEtat() ?>">
						</div>
						<div>
							<label for="descriptif">Descriptif</label><br>
							<textarea name="descriptif" id="descriptif<?php echo $oeuvre->getIdOeuvre() ?>" cols="40" rows="10" value="<?php echo $oeuvre->getDescriptifFR() ?>"><?php echo $oeuvre->getDescriptifFR() ?></textarea>
						</div>
						
						<div class="submit">
							<button class="submit-oeuvre" type="submit">Enregistrer les modifications</button>
							
						</div>
						
					</form>
				</div>

			</div>

			<div class="card-col card-action">
				
				<div class="col-item">
					<h4>APPARITIONS</h4>
					<ul id="list-info">

						<?php 
							$listExpo = $manager->listExpoOeuvreExposee($idOeuvre);
							foreach ($listExpo as $exposition) {
								echo '<li>'.$exposition->getDateDeb().'<br>Exposition '.$exposition->getTitre().'</li>';
							}
						 ?>
					</ul>
					
				</div>
				<div class="pop-messagerieOeuvre popGestionCard">
					<i class="closeButton-context ion-android-close"></i>
					<div class="card-msg">
						<?php 
		//POUR LES TEST
		$champ = 'idOeuvre';
		//dans le cas d'une oeuvre : dans les autres cas $artiste->getIdArtiste etc...
		$id = $oeuvre->getIdOeuvre();

						//recuperation d'un objet exposition avec l'idExpo de l'oeuvre exposée ici ouverte si on est dans le cas d'une carte "oeuvre exposée"
						$managerExpo = new ExpositionManager($bdd);
						$expo = $managerExpo->infoExpo($oeuvreExposee->getIdExpo());
						//recuperation de la liste des messages pour cette oeuvre
						$manager = new MessageManager($bdd);
						$listMessage = $manager->infoMessage($champ, $id);
						$nbMsg = count($listMessage);
						foreach ($listMessage as $message) {
							$idUser = $message->getIdUtilisateur();
							$managerUser = new UtilisateurManager($bdd);
							$user = $managerUser->infoUtilisateur($idUser);
							echo '<div class="message"><div class="message-header"> Message de '.$user->getNom().' Le '.$message->getDateMessage().'</div>';
							echo '<div class="message-content">'.$message->getMessage().'</div></div>';
						}
						 ?>
					</div>
					 <div class="newMsg">
						 <form action="#" method="GET">
						 	<div>
						 		<label for="newMsg">Nouveau message</label><br>
						 		<textarea name="newMsg" id="newMsg" cols="40" rows="4" placeholder="Ici votre message"></textarea>
						 	</div>
						 	
						 	<input type="hidden" name="idOeuvre" value="<?php echo $oeuvre->getIdOeuvre(); ?>">
							
							<div>
								<button type="submit">Envoyer</button>
							</div>
						 	
						 </form>
					</div>
					
				</div>
				<div class="col-item">
					<h4>ACTIONS</h4>
					<ul id="list-button">
						<li><button class="action-button">Gérer le Contenu +</button></li>
						<li><button class="action-button" id="modifDateEntree">Modifier date d'entrée</button></li>
						<li><button class="action-button" id="modifImageOeuvre">Modifier l'image</button></li>
						<li><button class="action-button" id="modifTypeOeuvre">Modifier le type</button></li>
						<li><button class="action-button" id="modifArtColl">Modifier Artiste/Collectif</button></li>
						<li><button class="action-button" id="delOeuvre">Supprimer l'oeuvre</button></li>
						<li><button class="action-button button-msg" id="messagerieOeuvre">Messagerie<div class="nbMsg"><?php echo $nbMsg; ?></div></button></li>
					</ul>
				</div>
			</div>
			
		</div>
		
	<div class="card-form pop-modifDateEntree popGestionCard">
		<i class="closeButton-context ion-android-close"></i>
		<form action="../modules/traitementOeuvre.php" method="GET">
			<label for="dateEntree">Date d'entrée dans l'expo</label>
			<input type="date" id="dateEntree" name="dateEntree" value="<?php echo $dateEntree; ?>">
			<button type="submit">Modifier</button>
		</form>
	</div>
	<div class="card-form pop-modifImageOeuvre popGestionCard">
		<i class="closeButton-context ion-android-close"></i>
		<form action="../modules/traitementOeuvre.php" method="GET">
			<label for="type">Choisir image</label>
			<input type="file" id="type" name="type" value="<?php echo $oeuvre->getImage(); ?>">
			<button type="submit">Enregistrer</button>
		</form>
	</div>
	<div class="card-form pop-modifTypeOeuvre popGestionCard">
		<i class="closeButton-context ion-android-close"></i>
		<form action="../modules/traitementOeuvre.php" method="GET">
			<label for="type">Type d'oeuvre</label>
			<input type="text" id="type" name="type" value="<?php echo $typeOeuvre; ?>">
			<button type="submit">Modifier</button>
		</form>
	</div>
	<div class="card-form pop-modifArtColl popGestionCard">
		<i class="closeButton-context ion-android-close"></i>
		<form action="../modules/traitementOeuvre.php" method="GET">
			<label for="nom">nom</label>
			<input type="text" id="nom" name="nom" value="<?php echo $nomArtiste; ?>">
			<label for="prenom">Prenom</label>
			<input type="text" id="prenom" name="prenom" value="<?php echo $prenomArtiste; ?>">
			<label for="collectif">Nom Collectif</label>
			<input type="text" id="collectif" name="collectif" value="<?php if(isset($nomCollectif)){echo $nomCollectif;} ?>">
			<button type="submit">Modifier</button>
		</form>
	</div>
	<div class="card-form pop-delOeuvre popGestionCard">
		<i class="closeButton-context ion-android-close"></i>
		<form action="../modules/traitementOeuvre.php" method="GET">
			<label for="idOeuvre">Voulez vous supprimer definitvement cette oeuvre ?</label>
			<input type="hidden" id="idOeuvre" name="idOeuvre" value="<?php echo $idOeuvre; ?>">
			<button type="submit">Supprimer</button>
			<button>Annuler</button>
		</form>
	</div>
</div>