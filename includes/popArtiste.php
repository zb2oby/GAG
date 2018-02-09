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
require_once('../class/UtilisateurManager.class.php');
require_once('../class/Utilisateur.class.php');

if (isset($_GET['idSession'])) {
	$_SESSION['idUser'] = htmlentities($_GET['idSession']);
}

if (isset($_GET['idArtiste'])) {
	$idArtiste = $_GET['idArtiste'];
}
if (isset($_GET['idUser'])) {
	$idUser = htmlentities($_GET['idUser']);
}
include('bdd/connectbdd.php');

$managerArtiste = new ArtisteManager($bdd);
//idArtiste issue de la carte artiste dans laquelle est inclus cette page
$artiste = $managerArtiste->infoArtiste($idArtiste);


// $idExpo = 2;
// $managerExpo = new ExpositionManager($bdd);
// $exposition = $managerExpo->infoExpo($idExpo);
 ?>

<div class="context-menu context-artiste">
	<div class="closeButton closeButton-artiste"><i class="ion-android-close"></i></div>
	<div class="context-overlay"></div>
<?php if (isset($_SESSION['idExpo'])) { ?>
	

	<div class="deleteCard deleteCardArtiste"><i class="ion-ios-trash-outline" title="Enlever l'artiste de l'exposition"></i><span>Retirer de l'expo</span></div>
<?php } ?>
	
		
		<div class="card-header">
			<div class="col-item card-image">
				<img src="../img/artistes/<?php echo $artiste->getImage(); ?>" alt="">
			</div>
			<div class="col-item card-title">
				<h3>ARTISTE</h3>
				<h4><?php echo '" '.ucfirst($artiste->getNom()).' "' ?></h4>
			</div> 
			<div class="coll-artiste">
				
				<span id="afficheCollectifArtiste">
					
					<h4>Communauté</h4>
					<?php 
						$listIdCollectif = $managerArtiste->getIdsCollectifs($idArtiste);
						$managerCollectif = new CollectifManager($bdd);
						
						foreach ($listIdCollectif as $idCollectif => $value) {
							$collectif = $managerCollectif->infoCollectif($value);
							if ($collectif != false) {
								$nomCollectif = $collectif->getLibelleCollectif();
								echo '<div id="coll-'.$value.'">- Collectif '.$nomCollectif.'</div>';
							}
						}
						 
					?>
					
				</span>	
				
			</div>
		</div>
		<div class="card-content">


			<div class="card-col card-form">
				<div class="col-item card-form">
					<form class="form-artiste" id="form-artiste<?php echo $artiste->getIdArtiste() ?>" data-idArtiste="<?php echo $artiste->getIdArtiste() ?>" action="../modules/traitementArtiste.php" method="GET">
						
						<div>
							<label for="nom"> Nom</label>
							<input type="text" name="nom" id="nom" value="<?php echo ucfirst($artiste->getNom()) ?>">
						</div>
						<div>
							<label for="prenom">Prenom</label>
							<input type="text" name="prenom" id="prenom" value="<?php echo ucfirst($artiste->getPrenom()) ?>">
						</div>
						<div>
							<label for="tel">Téléphone</label>
							<input type="text" name="tel" id="tel" value="<?php echo $artiste->getTel() ?>">
						</div>
						<div>
							<label for="email">E-mail</label>
							<input type="email" name="email" id="email" value="<?php echo $artiste->getEmail() ?>">
						</div>
						<div>
							<label for="descriptif">Descriptif</label><br>
							<textarea name="descriptif" id="descriptif" cols="40" rows="10" value="<?php echo $artiste->getDescriptifFR() ?>"><?php echo $artiste->getDescriptifFR() ?></textarea>
						</div>
						
						<div class="submit">
							<button class="submit-artiste" type="submit">Enregistrer les Informations</button>
							
						</div>
						
					</form>
				</div>

			</div>

			<div class="card-col card-action">
				
				<div class="col-item">
					<h4>OEUVRES</h4>
					<ul id="list-info" class="list-oeuvre-artiste">

						<?php 
							$listOeuvre = $managerArtiste->listOeuvresArtiste($idArtiste);
							foreach ($listOeuvre as $oeuvre) {
								?>

								<li class="li-oeuvre-artiste"><span class="titreOeuvreArtiste">&nbsp;<?php echo $oeuvre->getTitre(); ?></span>
									<div class="oeuvreArtiste" data-idOeuvre="<?php echo $oeuvre->getIdOeuvre() ?>">
										<!-- <i class="delOeuvreArtiste ion-ios-trash-outline" title="Supprimer"></i> -->
									</div>
									<img class="imgOeuvreArtiste" style="width:20px; height: 20px;" src="../img/oeuvres/<?php echo $oeuvre->getImage() ?>">
									<div class="card-form pop-delOeuvreArtiste popGestionCard">
										<div class="closeButton-context"><i class="ion-android-close"></i></div>
										<form class="form-oeuvre" action="../modules/traitementOeuvre.php" data-idOeuvre="<?php echo $oeuvre->getIdOeuvre() ?>" method="GET">
											<div>
												<span>Voulez vous supprimer definitvement cette oeuvre ?</span><br>
												<input type="hidden" id="idOeuvre" name="idOeuvre" value="<?php echo $oeuvre->getIdOeuvre(); ?>">
												<input type="hidden" id="delOeuvre" name="req" value="delete">
											</div>
											<div class="submit">
												<button type="submit">Supprimer</button>
											</div>
											
										</form>
									</div>
									<?php if (isset($_GET['idLastOeuvre'])) {
										$class = 'addOeuv';
										$idOeuvre = htmlentities($_GET['idLastOeuvre']);
									}else{
										$class='';
										$idOeuvre = $oeuvre->getIdOeuvre();
									} ?>
									<div class="addOeuv">
									<?php 
									

									include('popOeuvre.php'); 

									?>
									</div>
								</li>

							<?php
							}
						 ?>
						
					</ul>
					<button class="action-button" id="addOeuvre">Ajouter Oeuvre</button>					
				</div>
				<div class="pop-messagerieArtiste popGestionCard-artiste">
					<div class="closeButton-context"><i class="ion-android-close"></i></div>
					<div class="card-msg">
						<?php 
						
						$champ = 'idArtiste';
						
						$id = $artiste->getIdArtiste();

						
						//recuperation de la liste des messages pour cette oeuvre
						$managerMsgArtiste = new MessageManager($bdd);
						$listMessage = $managerMsgArtiste->infoMessage($champ, $id);
						$nbMsg = count($listMessage);
						foreach ($listMessage as $message) {
							$idUser = $message->getIdUtilisateur();
							$idMessage = $message->getIdMessage();
							$managerUser = new UtilisateurManager($bdd);
							$user = $managerUser->infoUtilisateur($idUser);
							$delMsg = '';
							if ($idUser == $_SESSION['idUser']) {
								$delMsg = '<span class="delMsgArt delMsg"><a>supprimer le message</a></span>';
							}
							echo '<div class="message" data-idMessage="'.$idMessage.'"><div class="message-header"> Message de '.$user->getNom().' Le '.date('d/m/Y', strtotime($message->getDateMessage())).$delMsg.'</div>';
							echo '<div class="message-content">'.$message->getMessage().'</div></div>';
						}
						 ?>
					</div>
					<?php 
							if (isset($_SESSION['idUser'])) {
								$idUser = $_SESSION['idUser'];
							}
							if (isset($idUser)) {
								$managerUser = new UtilisateurManager($bdd);
								$user = $managerUser->infoUtilisateur($idUser);
								$nomUser = $user->getNom();
							}
							
					 ?>
					 <div class="newMsg">
						 <form class="form-artiste" action="../modules/traitementArtiste.php" data-idArtiste="<?php echo $artiste->getIdArtiste() ?>" method="GET">
						 	<div>
						 		<label for="newMsg">Nouveau message</label><br>
						 		<textarea name="newMsg" id="newMsg" cols="40" rows="4" placeholder="Ici votre message"></textarea>
							 	</div>
							 	
						 	<input type="hidden" name="idUser" id="idUser" value="<?php if(isset($idUser)){echo $idUser;} ?>">
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
						<li><button class="action-button" id="modifImageArtiste">Enregistrer l'image</button></li>
						<li><button class="action-button" id="modifColl">infos Comunauté</button></li>
						<li><button class="action-button" id="delArtiste">Supprimer l'artiste</button></li>
						<li><button class="action-button button-msg" id="messagerieArtiste">Messagerie<div class="nbMsg"><?php echo $nbMsg; ?></div></button></li>
					</ul>
				</div>
			</div>
			
		</div>
		
	<div class="card-form pop-modifImageArtiste popGestionCard-artiste">
		<div class="closeButton-context"><i class="ion-android-close"></i></div>
		<form class="form-artiste" action="../modules/traitementArtiste.php" data-idArtiste="<?php echo $artiste->getIdArtiste() ?>" method="POST" enctype="multipart/form-data">
			<div>
				<span for="imageArtiste">Image (JPG GIF JPEG PNG| max. 300Ko) </span><br>
				<input type="file" id="imageArtiste" name="imageArtiste[]" accept=".jpg, .jpeg, .gif, .png"><br>
				<input type="hidden" id="maxSize" name="MAX_FILE_SIZE" value="500000">
				<input type="hidden" id="existImage" name="existImage" value="<?php echo $artiste->getImage(); ?>">
				<input type="hidden" id="idArtiste" name="idArtiste" value="<?php echo $artiste->getIdArtiste(); ?>">
			</div>
			<div class="submit">
				<button type="submit">Enregistrer</button>
			</div>
		</form>
	</div>
	<div class="card-form pop-modifColl popGestionCard-artiste">
		<div class="closeButton-context"><i class="ion-android-close"></i></div>
		<div class="card-communaute">
			<ul>
				<?php 
					$listIdCollectif = $managerArtiste->getIdsCollectifs($artiste->getIdArtiste());
					$managerCollectif = new CollectifManager($bdd);
					
					foreach ($listIdCollectif as $idCollectif => $value) {
						$collectif = $managerCollectif->infoCollectif($value);
						if ($collectif != false) {
							$nomCollectif = $collectif->getLibelleCollectif();
							echo '<li class="comInfo">Collectif '.$nomCollectif.'<form class="form-artiste" data-idArtiste="'.$artiste->getIdArtiste().'" action="../modules/traitementArtiste.php" method="GET"><input type="hidden" id="req" name="req" value="deleteColl"><input type="hidden" id="idColl" name="idColl" value="'.$collectif->getIdCollectif().'"><button type="submit" class="delColl"><i class="ion-ios-trash-outline" title="Supprimer"></i></button></form></li>';
						}
					}
				 ?>
			</ul>
		</div>
		<div class="newCommunaute">
			<form class="form-artiste" action="../modules/traitementArtiste.php" data-idArtiste="<?php echo $artiste->getIdArtiste() ?>" method="GET">
				<div class="selectInput">
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
					<button type="submit">Enregistrer</button>
				</div>
				</form>
		</div>
			
		
	</div>
	<div class="card-form pop-delArtiste popGestionCard-artiste">
		<div class="closeButton-context"><i class="ion-android-close"></i></div>
		<form class="form-artiste" action="../modules/traitementArtiste.php" data-idArtiste="<?php echo $artiste->getIdArtiste() ?>" method="GET">
			<div>
				<span>Voulez vous supprimer definitvement cet Artiste ?</span><br>
				<input type="hidden" id="idArtiste" name="idArtiste" value="<?php echo $idArtiste; ?>">
				<input type="hidden" id="delArtiste" name="req" value="delete">
			</div>
			<div class="submit">
				<button type="submit">Supprimer</button>
				<button class="cancelButton">Annuler</button>
			</div>
			
		</form>
	</div>
	<div class="card-form pop-addOeuvre popGestionCard-artiste">
		<div class="closeButton-context"><i class="ion-android-close"></i></div>
		<form class="form-artiste" action="../modules/traitementArtiste.php" data-idArtiste="<?php echo $artiste->getIdArtiste() ?>" method="GET">
			<input type="hidden" id="addArtiste" name="reqAdd" value="add">
			<div class="submit">
				<button type="submit">Ajouter</button>
				<button class="cancelButton">Annuler</button>
			</div>
		</form>
	</div>


</div>