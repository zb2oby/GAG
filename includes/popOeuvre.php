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
<div class="closeButton"><i class="ion-android-close"></i></div>
<div class="context-overlay"></div>
	
	<div class="deleteCard"><i class="ion-ios-trash-outline" title="Enlever l'oeuvre de l'exposition"></i><span>Retirer de l'expo</span></div>

	
		
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
						$dateEntree = $oeuvreExposee->getDateEntree();
						if ($dateEntree != '0000-00-00') {
							echo 'Date d\'entrée : '.date('d/m/Y', strtotime($dateEntree));
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
						$artiste = $managerArtiste->infoArtiste($idArtiste);

						$nomArtiste = $artiste->getNom();
						$prenomArtiste = $artiste->getPrenom();
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
					<?php 
							if (isset($_GET['idUser'])) {
								$idUser = $_SESSION['idUser'];
								$managerUser = new UtilisateurManager($bdd);
								$user = $managerUser->infoUtilisateur($idUser);
								$nomUser = $user->getNom();
							}
							
					 ?>
					 <div class="newMsg">
						 <form action="action="../modules/traitementOeuvre.php" data-idOeuvre="<?php echo $oeuvre->getIdOeuvre() ?>" method="GET">
						 	<div>
						 		<label for="newMsg">Nouveau message</label><br>
						 		<textarea name="newMsg" id="newMsg" cols="40" rows="4" placeholder="Ici votre message"></textarea>
						 	</div>
						 	
						 	<input type="hidden" name="idUser" id="idUser" value="<?php if(isset($_SESSION['idUser'])){echo $_SESSION['idUser'];} ?>">
							<input type="hidden" name="dateMsg" id="dateMsg" value="<?php date('d/m/Y'); ?>">
							<input type="hidden" name="nomUser" id="nomUser" value="<?php $nomUser; ?>">
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
		<div class="closeButton"><i class="ion-android-close"></i></div>
		<form id="dateEntree-form" action="../modules/traitementOeuvre.php" data-idOeuvreExposee="<?php echo $idOeuvreExposee ?>" method="GET">
			<div>
				<label for="dateEntree">Date d'entrée dans l'expo</label>
				<input type="date" id="dateEntree" name="dateEntree" value="<?php echo $dateEntree; ?>">
			</div>
			<div class="submit">
				<button type="submit">Modifier</button>
			</div>
			
		</form>
	</div>
	<div class="card-form pop-modifImageOeuvre popGestionCard">
		<div class="closeButton"><i class="ion-android-close"></i></div>
		<form action="../modules/traitementOeuvre.php" data-idOeuvre="<?php echo $oeuvre->getIdOeuvre() ?>" method="GET">
			<div>
				<label for="type">Choisir image</label>
				<input type="file" id="type" name="type" value="<?php echo $oeuvre->getImage(); ?>">
			</div>
			<div class="submit">
				<button type="submit">Enregistrer</button>
			</div>
		</form>
	</div>
	<div class="card-form pop-modifTypeOeuvre popGestionCard">
		<div class="closeButton"><i class="ion-android-close"></i></div>
		<form action="../modules/traitementOeuvre.php" data-idOeuvre="<?php echo $oeuvre->getIdOeuvre() ?>" method="GET">
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
		<div class="closeButton"><i class="ion-android-close"></i></div>
		<form action="../modules/traitementOeuvre.php" data-idOeuvre="<?php echo $oeuvre->getIdOeuvre() ?>" method="GET">
			<div>
				<label for="idArtiste">Artiste</label>
				<select name="idArtiste" id="idArtiste">
					<?php 
						$listArtiste = $managerArtiste->listArtiste();
						foreach ($listArtiste as $artiste) {
							if ($artiste->getIdArtiste() == $idArtiste) {
								$selected = 'selected';
							}else{
								$selected = "";
							}
							echo '<option '.$selected.' value="'.$artiste->getIdArtiste().'"><span data-nomArtiste="'.$artiste->getNom().'" data-prenomArtiste="'.$artiste->getPrenom().'">'.$artiste->getPrenom().' '.$artiste->getNom().'</span></option>';
						}

					 ?>
				</select>
			</div>
			<div>
				<label for="idCollectif">Collectif</label>
				<select name="idCollectif" id="idCollectif">
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
		<div class="closeButton"><i class="ion-android-close"></i></div>
		<form action="../modules/traitementOeuvre.php" data-idOeuvre="<?php echo $oeuvre->getIdOeuvre() ?>" method="GET">
			<div>
				<label for="idOeuvre">Voulez vous supprimer definitvement cette oeuvre ?</label>
				<input type="hidden" id="idOeuvre" name="idOeuvre" value="<?php echo $idOeuvre; ?>">
			</div>
			<div class="submit">
				<button type="submit">Supprimer</button>
				<button>Annuler</button>
			</div>
			
		</form>
	</div>
</div>