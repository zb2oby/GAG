<?php 
include('header.php');
include ('../class/Traduction.class.php');
if (isset($_SERVER['HTTP_REFERER'])) {
	if (!isset($_SESSION['precedent'])) {
		$previous = $_SERVER['HTTP_REFERER'];
		$_SESSION['precedent'] = $previous;		
	}	
}


$idartiste=$_GET['artiste'];
$managerartiste = new artisteManager($bdd);
$artiste = $managerartiste->infoArtiste($idartiste);

?>
<div class="main">
	<div class="artiste">
		<div class="artisteimage">
			<img src="../img/artistes/<?php echo $artiste->getImage();?>" alt="image artiste">
		</div>
		<div class="description">
			<div class="block">
				Nom :
				<?php 
				echo ucfirst($artiste->getNom());
				?>
				<?php
				echo ucfirst($artiste->getPrenom());
				?>
			</div>
			<div class="block">
				Description :<br>
				<?php 
					if ($idLangue != 1) {
						$traduction = new Traduction();
						$texte = $traduction->getTraduction($idLangue, $idartiste, 'idArtiste');
						echo $texte;
					}else{
						echo ucfirst($artiste->getDescriptifFR());
					}
				 ?>

			</div>
		</div>
	</div>

<?php include 'footer.php'; ?>
?>
