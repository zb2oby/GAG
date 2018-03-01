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
	


$idartiste = $oeuvre->getIdArtiste();


$managerArtiste = new artisteManager($bdd);
$infoArtiste = $managerArtiste->infoartiste($idartiste);


foreach ($oeuvreEnrichie as $enrichie) {
	
	$typeDonnee=$enrichie->getIdTypeDonneEnrichie();
	$url=$enrichie->getUrlFichier();
}	

?>
<div class="main">
	<div class="oeuvre">
		<div class="oeuvreimage">
			<h2 class="oeuvre-title"><?php echo ucfirst($oeuvre->getTitre());?></h2>
				
			<img src="../img/oeuvres/<?php echo $oeuvre->getImage();?>" alt="image">
		</div>
		<div class="description">
			<div class="block">
				<h3 class="meta-intro">Informations générales</h3>
			</div>
			<div class="block">
				<h4>Artiste : </h4>
				<?php
				echo ucfirst($infoArtiste->getNom()).' '.ucfirst($infoArtiste->getPrenom());
				?>
			</div>
			<div class="block">
				<h4>Dimensions : </h4>
				Longueur X Hauteur<br>
				<?php
				echo intval($oeuvre->getLongueur()).' Cm X '.intval($oeuvre->getHauteur()).' Cm';
				 ?>
			</div>
			<div class="block oeuvre-descriptif">
				<h4>Description : </h4>
			<?php 
					if ($idLangue != 1) {
						$traduction = new Traduction();
						$desc = $traduction->getTraduction($idLangue, $idOeuvre, 'idOeuvre');
						if (strlen($desc)>300) 
						{
						  $more = substr($desc, 306);
						  $desc=substr($desc, 0, 310);

						  $dernier_mot=strrpos($desc," ");
						  $desc=substr($desc,0,$dernier_mot);
						  $desc.='<a class="readmore" href="#" > Lire la suite <i class="ion-arrow-right-c"></i></a>';
						}
						echo $desc;
						?>
						<p class="more"><?php if(isset($more)){ echo $more; } ?></p>
						<?php
					}else{
						$desc = ucfirst($oeuvre->getDescriptifFR());
						if (strlen($desc)>300) 
						{
						  $more = substr($desc, 306);
						  $desc=substr($desc, 0, 310);

						  $dernier_mot=strrpos($desc," ");
						  $desc=substr($desc,0,$dernier_mot);
						  $desc.='<a class="readmore" href="#" > Lire la suite <i class="ion-arrow-right-c"></i></a>';
						}
						echo $desc;
						?>
						<p class="more"><?php if(isset($more)){ echo $more; } ?></p>
						<?php
					}
				 ?>
			</div>
		</div>
		<div class="description">
			<div class="block">
				<h3 class="meta-intro">Visualisez du contenu supplémentaire !</h3>
			</div>
			<?php 
				$managerDonnee = new DonneeEnrichieManager($bdd);
				$listDonnee = $managerDonnee->listDonneeOeuvre($idOeuvre);
				foreach ($listDonnee as $donnee) {
					$typeDonnee = $donnee->getIdTypeDonneEnrichie();
					$meta = $donnee->getUrlFichier();
					$url = '../meta/oeuvre'.$idOeuvre.'/'.$meta;
					$title = $donnee->getLibelleDonneeEnrichie();
					$libelleType = $managerDonnee->libelleTypeDonnee($typeDonnee);
					switch ($typeDonnee) {
						case 1:
							//données video
							?>
							<div class="meta block">
								<h4 class="meta-title"><?php echo $libelleType.' : '.$title; ?></h4>
								<video src="<?php echo $url; ?>" controls width="100%">Veuillez mettre à jour votre navigateur !</video>
							</div>
							<?php
							break;
						case 2:
							//données sonore
							?>
							<div class="meta block">
								<h4 class="meta-title"><?php echo $libelleType.' : '.$title; ?></h4>
								<audio src="<?php echo $url; ?>" controls style="width:100%;">Veuillez mettre à jour votre navigateur !</audio>
							</div>
							<?php
							break;
						case 3:
							//données image
							?>
							<div class="meta block">
								<h4 class="meta-title"><?php echo $libelleType.' : '.$title; ?></h4>
								<img src="<?php echo $url; ?>" alt="" width="100%" height="auto">
							</div>
							<?php
							break;
						case 4:
							//données lien externe
							$url = $donnee->getUrlFichier();
							?>
							<div class="meta block">
								<h4 class="meta-title"><?php echo $libelleType.' : '.$title; ?></h4>
								<iframe width="100%" src="<?php echo $url; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
							</div>
							<?php
							break;
						
						default:
							
							break;
					}
				}
			 ?>
			
		</div>
	</div>
<?php include 'footer.php'; ?>