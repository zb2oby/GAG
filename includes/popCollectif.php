<?php 
//autoloader ne peut pas foncitonner ici car fichier inclus en ajax
require_once('../class/ArtisteManager.class.php');
require_once('../class/Artiste.class.php');



require_once('../class/MessageManager.class.php');
require_once('../class/Message.class.php');
require_once('../class/CollectifManager.class.php');
require_once('../class/Collectif.class.php');

require_once('../class/UtilisateurManager.class.php');
require_once('../class/Utilisateur.class.php');

if (isset($_GET['idSession'])) {
	$_SESSION['idUser'] = htmlentities($_GET['idSession']);
}

if (isset($_GET['idCollectif'])) {
	$idCollectif = $_GET['idCollectif'];
}
if (isset($_GET['idUser'])) {
	$idUser = htmlentities($_GET['idUser']);
}
include('bdd/connectbdd.php');

$managerCollectif = new CollectifManager($bdd);

$collectif = $managerCollectif->infoCollectif($idCollectif);


 ?>

<div class="context-menu context-collectif">
	<div class="closeButton closeButton-collectif"><i class="ion-android-close"></i></div>
	<div class="context-overlay"></div>
		
		<div class="card-header">
			<div class="col-item card-title">
				<h3>COLLECTIF</h3>
				<h4><?php echo '" '.ucfirst($collectif->getLibelleCollectif()).' "' ?></h4>
			</div> 
			<div class="cardHeader-bottom">
				
				
			</div>
		</div>
		<div class="card-content">


			<div class="card-col card-form">
				<div class="col-item card-form">
					<form class="form-collectif" id="form-collectif<?php echo $collectif->getIdCollectif() ?>" data-idcollectif="<?php echo $collectif->getIdCollectif() ?>" action="../modules/traitementCollectif.php" method="GET">
						
						<div>
							<label for="libelle"> Libelle(*)</label>
							<input type="text" name="libelle" id="libelle" value="<?php echo ucfirst($collectif->getLibelleCollectif()) ?>">
						</div>
						<div>
							<label for="tel">Téléphone(*)</label>
							<input type="text" name="tel" id="tel" value="<?php echo $collectif->getTel() ?>">
						</div>
						<div>
							<label for="email">E-mail</label>
							<input type="email" name="email" id="email" value="<?php echo $collectif->getEmail() ?>">
						</div>
						<div>
							<label for="descriptif">Descriptif(*)</label><br>
							<textarea name="descriptif" id="descriptif" cols="40" rows="10" value="<?php echo $collectif->getDescriptifFR() ?>"><?php echo $collectif->getDescriptifFR() ?></textarea>
						</div>
						
						<div class="submit">
							<button class="submit-collectif" type="submit">Enregistrer les Informations</button>
							
						</div>
						
					</form>
				</div>

			</div>

			<div class="card-col card-action">
			
				<div class="pop-messagerieCollectif popGestionCard-collectif">
					<div class="closeButton-context"><i class="ion-android-close"></i></div>
					<div class="card-msg">
						<?php 
						
						$champ = 'idCollectif';
						
						$id = $collectif->getIdCollectif();

						
						//recuperation de la liste des messages pour cette oeuvre
						$managerMsgColl = new MessageManager($bdd);
						$listMessage = $managerMsgColl->infoMessage($champ, $id);
						$nbMsg = count($listMessage);
						foreach ($listMessage as $message) {
							$idUser = $message->getIdUtilisateur();
							$idMessage = $message->getIdMessage();
							$managerUser = new UtilisateurManager($bdd);
							$user = $managerUser->infoUtilisateur($idUser);
							$delMsg = '';
							if ($idUser == $_SESSION['idUser']) {
								$delMsg = '<span class="delMsgColl delMsg"><a>supprimer le message</a></span>';
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
						 <form class="form-collectif" action="../modules/traitementCollectif.php" data-idcollectif="<?php echo $collectif->getIdCollectif() ?>" method="GET">
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
						<li><button class="action-button" id="delColl">Supprimer le collectif</button></li>
						<li><button class="action-button button-msg" id="messagerieCollectif">Messagerie<div class="nbMsg"><?php echo $nbMsg; ?></div></button></li>
					</ul>
				</div>

				<div class="col-item">
					<h4>ARTISTES PRESENTS</h4>
					<ul id="list-info" class="list-artiste-collectif">

						<?php 
							$listArtiste = $managerCollectif->listArtisteCollectif($idCollectif);
							foreach ($listArtiste as $artiste) {
								?>

								<li class="li-artiste-collectif"><span class="titreArtisteCollectif">&nbsp;<?php echo $artiste->getNom(); ?></span>
									<div class="ArtisteColl" data-idArtiste="<?php echo $artiste->getIdArtiste() ?>">
										<!-- <i class="delOeuvreArtiste ion-ios-trash-outline" title="Supprimer"></i> -->
									</div>
									<img class="imgArtiste" style="width:20px; height: 20px;" src="../img/artistes/<?php echo $artiste->getImage() ?>">
								</li>

							<?php
							}
						 ?>
						
					</ul>
				</div>
			</div>
			
		</div>
		

	<div class="card-form pop-delColl popGestionCard-collectif">
		<div class="closeButton-context"><i class="ion-android-close"></i></div>
		<form class="form-collectif" action="../modules/traitementCollectif.php" data-idcollectif="<?php echo $collectif->getIdCollectif() ?>" method="GET">
			<div>
				<span>Voulez vous supprimer definitvement ce collectif ?</span><br>
				<input type="hidden" id="idCollectif" name="idCollectif" value="<?php echo $idCollectif; ?>">
				<input type="hidden" id="delColl" name="req" value="delete">
			</div>
			<div class="submit">
				<button class="submit-collectif" type="submit">Supprimer</button>
				<button class="cancelButton">Annuler</button>
			</div>
			
		</form>
	</div>


</div>