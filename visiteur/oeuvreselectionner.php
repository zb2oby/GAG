<?php include('header.php');
$idOeuvre=$_GET['oeuvre'];

if (isset($_SESSION['langue'])) {
	$idLangue = $_SESSION['langue'];

}

if ($idVisiteur){
	$nbVue++;
	$q=$bdd->query("UPDATE oeuvreexposee set nbVue=".$nbVue." where idOeuvreExposee=".$idOeuvre" ");
		$data=$q->fetch();
}

$managerOeuvre = new OeuvreManager($bdd);
$oeuvre = $managerOeuvre->infoOeuvre($idOeuvre);

$managerDonneeEnrichie = new DonneeEnrichieManager($bdd);
$oeuvreEnrichie = $managerDonneeEnrichie->listDonneeOeuvre(3);


// $typeOeuvre = $managerOeuvre->typeOeuvre($idTypeOeuvre);


echo "idoeuvre = ";
echo $idOeuvre;
echo " idartiste = ";
echo $oeuvre->getIdArtiste();
$idartiste = $oeuvre->getIdArtiste();

echo " idcollectif = ";
echo $oeuvre->getIdCollectif();

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
						$texte = $traduction->getTraduction($idLangue, $idartiste, 'idOeuvre');
						echo $texte;
					}else{
						echo ucfirst($artiste->getDescriptifFR());
					}
				 ?>
			</div>
		</div>
	</div>
<?php include 'footer.php'; ?>