<?php include('header.php');
include ('../class/Traduction.class.php');

if (isset($_SESSION['langue'])) {
	$idLangue = $_SESSION['langue'];

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
				Description :
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
</div>
<div class="footer" >
	<div class="center">
		<a href="artiste.php"><i class="ion-reply"></i></a>
	</div>
</div>

</body>
</html>
?>
