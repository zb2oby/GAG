<?php include('header.php');

$managerArtisteExpo = new ArtisteExposeManager($bdd);
$listArtisteExpo = $managerArtisteExpo->listArtisteExpo($idExpo);
?>
<div class="main">
	<div class="flex-container">
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
	
		<?php include 'footer.php'; ?>