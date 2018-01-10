<?php 


// require '../class/oeuvreExposee.class.php';
// require '../class/oeuvreExposee.manager.php';
// require '../class/oeuvre.class.php';
// require '../class/oeuvre.manager.php';
// require '../class/artisteExpose.class.php';
// require '../class/artisteExpose.manager.php';
// require '../class/artiste.class.php';
// require '../class/artiste.manager.php';

//test emplacement
include('../modules/traitementEmplacement.php');
?>

<div class="confirmPopup">
	<span>Souhaitez vous réellement supprimer l'élément ?</span>
	<button class="deleteButton">Supprimer</button>
	<button class="cancelButton">Oula tout cela va bien trop vite</button>
</div>
<div class="popAddCard">
	<i class="closeButton ion-android-close"></i>
	<form class="addCardForm" action="../modules/traitementListes.php" method="GET">
		<label for="oeuvre">Oeuvres disponibles pour les artistes choisis</label>
		<select name="idOeuvre" id="oeuvre">
			<?php 
				if (isset($_SESSION['idExpo'])) {
					$idExpo = htmlentities($_SESSION['idExpo']);
					$manager = new OeuvreManager($bdd);
					$listOeuvre = $manager->listOeuvreExpo($idExpo);
					foreach ($listOeuvre as $oeuvre) {
						echo '<option value="'.$oeuvre->getIdOeuvre().'">'.$oeuvre->getTitre().'</option>';
					}
				}
			 ?>
		</select><br>
		<input type="hidden" name="req" value="add">
		<input type="hidden" name="idExpo" value="<?php echo $_SESSION['idExpo']; ?>">
		<input type="submit" value="Creer Carte">
	</form>
		<span>L'oeuvre n'existe pas encore ? <a class="creerOeuvre" href="#">Creer une nouvelle oeuvre</a></span>
</div>
<div class="popAddRecue">
	<i class="closeButton ion-android-close"></i>
	<form class="addCardForm" action="../modules/traitementListes.php" method="GET">
		<label for="oeuvre">Oeuvres disponibles pour les artistes choisis</label>
		<select name="idOeuvre" id="oeuvre">
			<?php 
				if (isset($_SESSION['idExpo'])) {
					$idExpo = htmlentities($_SESSION['idExpo']);
					$manager = new OeuvreManager($bdd);
					$listOeuvre = $manager->listOeuvreExpo($idExpo);
					foreach ($listOeuvre as $oeuvre) {
						echo '<option value="'.$oeuvre->getIdOeuvre().'">'.$oeuvre->getTitre().'</option>';
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
		<span>L'oeuvre n'existe pas encore ? <a class="creerOeuvre" href="#">Creer une nouvelle oeuvre</a></span>
</div>
<div class="popAddArtiste">
	<i class="closeButton ion-android-close"></i>
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
		<span>L'artiste n'existe pas encore ? <a class="creerOeuvre" href="#">Creer un nouvel artiste</a></span>
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
							echo '<li class="portlet portlet-artiste" data-id="'.$artiste->getIdArtiste().'"><div class="portlet-content"><span>'.$artiste->getNom().'</span><span>'.$artiste->getPrenom().'</span><img src="../img/artistes/'.$artiste->getImage().'" alt=""></div>';
				?>
							<div class="context-menu">
								<i class="closeButton ion-android-close"></i>
								<i class="deleteCard ion-ios-trash-outline"></i>
								<input type="text"></input>
							</div>
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

						$manager = new OeuvreExposeeManager($bdd);

						$oeuvresPrevues = $manager->ListOeuvresPrevues($idExpo);
						$classe_item = '';
						$manager->affichageOeuvre($oeuvresPrevues, $classe_item);
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
						$manager->affichageOeuvre($oeuvresRecues, $classe_item);
					}
				?>
			</ul>
		</div>
	</div>
</section>

<script>var idExpoSession = '<?php echo $_SESSION['idExpo']; ?>';</script>