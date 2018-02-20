<?php include('header.php');



$idartiste=$_GET['artiste'];
$managerartiste = new artisteManager($bdd);
$artiste = $managerartiste->infoArtiste($idartiste);




?>
<div class="main">
	<div class="artiste">
		
			<img src="../img/artistes/<?php echo $artiste->getImage();?>" alt="image artiste">
			<div class="block">
			<?php 
			echo $artiste->getNom();
			?>
			<?php
			echo $artiste->getPrenom();
			?>
		</div>
		<div class="description">
			Description :
			<?php echo $artiste->getDescriptifFR(); ?>
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
