<?php include('header.php');

$managerArtisteExpo = new ArtisteExposeManager($bdd);
$listArtisteExpo = $managerArtisteExpo->listArtisteExpo($idExpo);
?>
<div class="main">
	<?php 
	foreach ($listArtisteExpo as $artiste) {
		$nomartiste=$artiste->getNom();
		$idartiste=$artiste->getIdArtiste();
		?>
		<div class="presentation">
			<div class="artisteimage">

				<a href='artisteselectionner.php?artiste=<?php echo $idartiste?>'>
					<img src="../img/artistes/<?php echo $artiste->getImage();?>" alt="image artiste"></a>
				</div>
				<div class="blockArtiste">
					<?php 
					echo ucfirst($artiste->getNom());
					?>
					<?php
					echo ucfirst($artiste->getPrenom());
					?>
				</div>
			</div>
			<?php 	}	?> 
		</div>
		<div class="footer" >
			<div class="left">
				<a href="index.php"><i class="ion-android-home"></i></a>
			</div>
			<div class="right">
				<a href="oeuvre.php"><i class="ion-android-image"></i>Œuvres</a>
			</div>
		</div>
	</div>
</body>
</html>