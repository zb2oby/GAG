<?php 
include('header.php');

//VARIABLE DE SESSION POUR LA NAV
if (isset($_SERVER['HTTP_REFERER'])) {
	if (!isset($_SESSION['precedent'])) {
		$previous = $_SERVER['HTTP_REFERER'];
		$_SESSION['precedent'] = $previous;		
	}	
}

if (isset($_GET['oeuvre'])) {
	$idOeuvre = $_GET['oeuvre'];

}

if (isset($_SESSION['langue'])) {
	$idLangue = $_SESSION['langue'];

}

$managerOeuvre = new OeuvreManager($bdd);
$oeuvre = $managerOeuvre->infoOeuvre($idOeuvre);

$managerDonneeEnrichie = new DonneeEnrichieManager($bdd);
$oeuvreEnrichie = $managerDonneeEnrichie->listDonneeOeuvre($idOeuvre);

//COMPTEUR DE VUES
//recuperation des information "oeuvreExposee"
$managerOeuvreExposee = new OeuvreExposeeManager($bdd);
$idExposee = $managerOeuvreExposee->idExposee($idOeuvre, $idExpo);
$oeuvreExposee = $managerOeuvreExposee->oeuvreExposee($idExposee);
//recuperation du nombre de vues actuel
$vues = $oeuvreExposee->getNbVue();
if ($vues == NULL) {
	$vues = 0;
}
//incrementation
$vues++;
//mise a jour du compte
$oeuvreExposee->setNbVue($vues);
$managerOeuvreExposee->updateOeuvreExposee($oeuvreExposee);
	


// echo "idoeuvre = ";
// echo $idOeuvre;
// echo " idartiste = ";
// echo $oeuvre->getIdArtiste();
$idartiste = $oeuvre->getIdArtiste();

// echo " idcollectif = ";
// echo $oeuvre->getIdCollectif();

$managerArtiste = new artisteManager($bdd);
$infoArtiste = $managerArtiste->infoartiste($idartiste);


foreach ($oeuvreEnrichie as $enrichie) {
	
	$typeDonnee=$enrichie->getIdTypeDonneEnrichie();
	$url=$enrichie->getUrlFichier();
}	

// $managerTypeDonneeEnrichie = new DonneeEnrichieManager($bdd);
// $libelle= $managerDonneeEnrichie->libelleTypeDonnee($typeDonnee);

// echo " libelle = ";
// echo $libelle;
// echo " url du fichier :";
// echo $url;
?>
<div class="main">
	<div class="oeuvre">
		<div class="oeuvreimage">
			<img src="../img/oeuvres/<?php echo $oeuvre->getImage();?>" alt="image">
		</div>
		<div class="description">
			<div class="block first">
				<?php
				echo "Titre : ";
				echo ucfirst($oeuvre->getTitre());
				?>
			</div>
			<div class="block">
				<?php
				echo "Artiste : ";
				echo ucfirst($infoArtiste->getNom());
				echo " ";	
				echo ucfirst($infoArtiste->getPrenom());
				?>
			</div>
				<!-- <div class="block"> -->
				<!-- <?php 
				// echo "Support : ";
				// $typeOeuvre=$oeuvre->getIdTypeOeuvre();
				// echo $typeOeuvre;
				// echo $typeOeuvre->typeOeuvre($typeOeuvre);
				?> -->
				<!-- </div> -->
			<div class="block">
				<?php
				echo "Dimension : ";
				echo $oeuvre->getLongueur();
				echo "x";
				echo $oeuvre->getHauteur();?>
			</div>
			<div class="block">
			<?php 
					if ($idLangue != 1) {
						$traduction = new Traduction();
						$texte = $traduction->getTraduction($idLangue, $idOeuvre, 'idOeuvre');
						echo $texte;
					}else{
						echo ucfirst($oeuvre->getDescriptifFR());
					}
				 ?>
			</div>
		</div>
	</div>
<?php include 'footer.php'; ?>