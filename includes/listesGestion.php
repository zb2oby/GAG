<?php 
//inclus pour la creation d'un emplacement vide au chargement de page (a voir en ajax si possible ?)
include('../modules/traitementEmplacement.php');
include('../includes/newExpo.php');
?>

<div class="confirmPopup">
	<span>Souhaitez vous réellement supprimer l'élément ?</span>
	<button class="deleteButton">Supprimer</button>
	<button class="cancelButton">Oula tout cela va bien trop vite</button>
</div>


<div class="popAddCard">
	<div class="closeButton"><i class="ion-android-close"></i></div>
	<form class="addCardForm" action="../modules/traitementListes.php" method="GET">
		<label for="oeuvre">Oeuvres disponibles pour les artistes choisis</label>
		<select name="idOeuvre" id="oeuvre">
			<?php 
				if (isset($_SESSION['idExpo'])) {
					$idExpo = htmlentities($_SESSION['idExpo']);
					$manager = new OeuvreManager($bdd);
					$listOeuvre = $manager->listOeuvreExpo($idExpo);
					foreach ($listOeuvre as $oeuvre) {
						if ($oeuvre->getTitre() == '') {
							$titreOeuvre = 'Oeuvre sans titre';
						}else{
							$titreOeuvre = $oeuvre->getTitre();
						}

						echo '<option value="'.$oeuvre->getIdOeuvre().'">'.$titreOeuvre.'</option>';
					}
				}
			 ?>
		</select><br>
		<input type="hidden" name="req" value="add">
		<input type="hidden" name="idExpo" value="<?php echo $_SESSION['idExpo']; ?>">
		<input type="submit" value="Creer Carte">
	</form>
		<span>L'oeuvre n'existe pas encore ?<a class="creerOeuvre" href="#">Creer une nouvelle oeuvre</a></span>
</div>


<div class="popAddOeuvrePrevue">
	<form class="form-liste" action="../modules/traitementListes.php" method="GET">
		<select name="idArtisteExpo" id="idArtisteExpo">
			<?php 
				if (isset($_SESSION['idExpo'])) {
					$idExpo = htmlentities($_SESSION['idExpo']);

					$manager = new ArtisteExposeManager($bdd);

					$artisteExpose = $manager->listArtisteExpo($idExpo);
					foreach ($artisteExpose as $artiste) {
						echo '<option value="'.$artiste->getIdArtiste().'">'.$artiste->getNom().' '.$artiste->getPrenom().'</option>';
					}
				}
			?>
		</select>
		<input type="hidden" name="req" id="req" value="add">
		<input type="hidden" name="status" id="status" value="prevue">
		<input type="hidden" name="idExpo" id="idExpo" value="<?php if (isset($_SESSION['idExpo'])){echo $_SESSION['idExpo'];} ?>">
		<div class="submit">
			<button type="submit">Creer Oeuvre</button>
		</div>
	</form>
</div>

<div class="popAddOeuvreRecue">
	<form class="form-liste" action="../modules/traitementListes.php" method="GET">
		<select name="idArtisteExpo" id="idArtisteExpo">
			<?php 
				if (isset($_SESSION['idExpo'])) {
					$idExpo = htmlentities($_SESSION['idExpo']);

					$manager = new ArtisteExposeManager($bdd);

					$artisteExpose = $manager->listArtisteExpo($idExpo);
					foreach ($artisteExpose as $artiste) {
						echo '<option value="'.$artiste->getIdArtiste().'">'.$artiste->getNom().' '.$artiste->getPrenom().'</option>';
					}
				}
			?>
		</select>
		<input type="date" name="dateEntree" id="dateEntree">
		<input type="hidden" name="req" id="req" value="add">
		<input type="hidden" name="status" id="status" value="recue">
		<input type="hidden" name="idExpo" id="idExpo" value="<?php if (isset($_SESSION['idExpo'])){echo $_SESSION['idExpo'];} ?>">
		<div class="submit">
			<button type="submit">Creer Oeuvre</button>
		</div>
	</form>
</div>

<div class="popAddRecue">
	<div class="closeButton"><i class="ion-android-close"></i></div>
	<form class="addCardForm" action="../modules/traitementListes.php" method="GET">
		<label for="oeuvre">Oeuvres disponibles pour les artistes choisis</label>
		<select name="idOeuvre" id="oeuvre">
			<?php 
				if (isset($_SESSION['idExpo'])) {
					$idExpo = htmlentities($_SESSION['idExpo']);
					$manager = new OeuvreManager($bdd);
					$listOeuvre = $manager->listOeuvreExpo($idExpo);
					foreach ($listOeuvre as $oeuvre) {
						if ($oeuvre->getTitre() == '') {
							$titreOeuvre = 'Oeuvre sans titre';
						}else{
							$titreOeuvre = $oeuvre->getTitre();
						}

						echo '<option value="'.$oeuvre->getIdOeuvre().'">'.$titreOeuvre.'</option>';
					}
				}
			 ?>
		</select><br>
		<label for="dateEntree">Saisir le date d'entrée de l'oeuvre</label>
		<input type="date" name="dateEntree" id="dateEntree" required><br>
		<input type="hidden" name="req" value="add">
		<input type="hidden" name="idExpo" value="<?php echo $_SESSION['idExpo']; ?>">
		<input type="submit" value="Creer Carte">
	</form>
		<span>L'oeuvre n'existe pas encore ?<a class="creerOeuvreRecue" href="#">Creer une nouvelle oeuvre</a></span>
</div>



<div class="popAddArtiste">
	<div class="closeButton"><i class="ion-android-close"></i></div>
	<form class="addCardForm" action="../modules/traitementListes.php" method="GET">
		<label for="artiste">Artiste présents dans notre base</label>
		<select name="idArtiste" id="artiste">
			<?php 
				$manager = new ArtisteManager($bdd);
				//on prend la liste des artiste qui compose le collectif enregistre
				if (isset($_SESSION['idExpo'])) {
					$idExpo = htmlentities($_SESSION['idExpo']);
					$listArtiste = $manager->listArtisteCollectif($idExpo);
				}
				//s'il ny en a pas ou qu'aucun collectif n'est renseigné on prend la liste de tout les artistes
				if ($listArtiste == false ) {
					$listArtiste = $manager->listArtiste();
				}
				//on boucle dans la liste pour l'affichage des donnée dans le select
				foreach ($listArtiste as $artiste) {
					echo '<option value="'.$artiste->getIdArtiste().'">'.$artiste->getNom().'-'.$artiste->getPrenom().'</option>';
				}
			
			 ?>
		</select><br>
		<input type="hidden" name="req" value="add">
		<input type="hidden" name="idExpo" value="<?php echo $_SESSION['idExpo']; ?>">
		<input type="submit" value="Creer Carte">
	</form>
		<div class="create">L'artiste n'existe pas encore ?
			<form class="createArtisteExpo" method="GET" action="../modules/traitementListes.php">
				<input type="hidden" name="createArtiste" id="createArtiste" value="create">
				<input type="hidden" name="idExpo" id="idExpo" value="<?php if (isset($_SESSION['idExpo'])){ echo $_SESSION['idExpo'];} ?>">
				<button type="submit">Creer nouvel Artiste</button>
			
			</form>
		</div>
</div>


<section class="list artistes">
	<div class="cards">
		<h4>Artistes exposé(e)s</h4>
		<div class="iconCard"><i class="addCardArtiste ion-android-add"></i></div>
		<div class="contain-cards">
			<ul>
				<?php 
					if (isset($_SESSION['idExpo'])) {
						$idExpo = htmlentities($_SESSION['idExpo']);

						$manager = new ArtisteExposeManager($bdd);

						$artisteExpose = $manager->listArtisteExpo($idExpo);
						foreach ($artisteExpose as $artiste) {
							$idArtiste = $artiste->getIdArtiste();
							echo '<li class="portlet portlet-artiste" data-id="'.$idArtiste.'">'
									.'<div class="portlet-content">
										<div class="titre">'.ucfirst($artiste->getNom()).' '.ucfirst($artiste->getPrenom())
										.'</div>'
										.'<div class="img">
											<img src="../img/artistes/'.$artiste->getImage().'" alt="">'
										.'</div>'
									.'</div>';
							include('../includes/popArtiste.php');
				?>
							<!-- <div class="context-menu">
								<i class="closeButton ion-android-close"></i>
								<i class="deleteCard ion-ios-trash-outline"></i>
								<input type="text"></input>
							</div> -->
				<?php
							echo '</li>';
						}
					}

				?>
			</ul>
		</div>
	</div>
</section>

<section class="list oeuvres">
	<div class="cards">
		<h4>Oeuvres prévues</h4>
		<div class="iconCard"><i class="addCard ion-android-add"></i></div>
		<div class="contain-cards">
			<ul class="prevue column">
				<?php 
					if (isset($_SESSION['idExpo'])) {
						$idExpo = htmlentities($_SESSION['idExpo']);
						$managerExpo = new ExpositionManager($bdd);
						$exposition = $managerExpo->infoExpo($idExpo);
						$dateDeb = $exposition->getDateDeb();

						$manager = new OeuvreExposeeManager($bdd);
						
						$oeuvresPrevues = $manager->ListOeuvresPrevues($idExpo);
						$classe_item = '';
						$manager->affichageOeuvre($oeuvresPrevues, $classe_item, $idExpo);
					}
				?>	
			</ul>
		</div>
	</div>
</section>

<section class="list recues">
	<div class="cards">
		<h4>Oeuvres reçues</h4>
		<div class="iconCard"><i class="addCardRecue ion-android-add"></i></div>
		<div class="contain-cards" id="items">
			<ul class="recue column">
				<?php
					if (isset($_SESSION['idExpo'])) {
						$idExpo = htmlentities($_SESSION['idExpo']);

						$manager = new OeuvreExposeeManager($bdd);

						$oeuvresRecues = $manager->ListOeuvresRecues($idExpo);
						$classe_item = 'item';
						$manager->affichageOeuvre($oeuvresRecues, $classe_item, $idExpo);
					}
				?>
			</ul>
		</div>
	</div>
</section>

<script>var idExpoSession = '<?php echo $_SESSION['idExpo']; ?>';</script>