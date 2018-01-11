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
	<i class="closeButton ion-android-close"></i>
	<i class="deleteCard ion-ios-trash-outline"></i>

	
		
		<div class="card-header">
			<div class="col-item card-image">
				<img src="../img/oeuvres/<?php echo $oeuvre->getImage(); ?>" alt="">
			</div>
			<div class="col-item card-title">
				<h3>OEUVRE</h3>
				<h4><?php echo '" '.ucfirst($oeuvre->getTitre()).' "' ?></h4>
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
				<div class="card-footer">
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
							echo '<div class="message"><div class="message-header"> Message de '.$message->getIdUtilisateur().' Le '.$message->getDateMessage().'</div>';
							echo '<div class="message-content">'.$message->getMessage().'</div></div>';
						}
						 ?>
						 <div class="newMsg">
							 <form action="#" method="GET">
							 	<div>
							 		<label for="newMsg">Nouveau message</label><br>
							 		<textarea name="newMsg" id="newMsg" cols="50" rows="4" placeholder="Ici votre message"></textarea>
							 	</div>
							 	
							 	<input type="hidden" name="idOeuvre" value="<?php echo $oeuvre->getIdOeuvre(); ?>">
								
								<div>
									<input type="submit" value="Envoyer">
								</div>
							 	
							 </form>
						</div>
					</div>
				</div>
				<div class="col-item">
					<h4>ACTIONS</h4>
					<ul id="list-button">
						<li><button>Visualiser Contenu +</button></li>
						<li><button>Ajouter Contenu +</button></li>
						<li><button>Modifier date d'entrée</button></li>
						<li><button class="button-msg">Messagerie<div class="nbMsg"><?php echo $nbMsg; ?></div></button></li>
					</ul>
				</div>
			</div>
			
		</div>
		
	
</div>