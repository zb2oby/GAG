<?php include('header.php'); 


?>
<div class="main">

	<div class="bienvenue">
		Bienvenue à l'exposition <?php echo ucfirst($titre)?> sur le theme <?php echo ucfirst($theme) ?> ouvert du <?php echo $dateDeb ?> au <?php echo $dateFin ?> de <?php echo $horaireO ?> a <?php echo $horaireF ?>

	</div>
	<div class="descriptif">
		<?php echo "<img src='../img/expositions/expo".$idExpo."/".$affiche."' alt='affiche'>" ?>
		<div class="blockaffiche">
			Descriptif :
			<?php echo ucfirst($descriptif); ?>
		</div>
	</div>
</div>
<div class="footer">
	<div class="left">
		<a href="artiste.php"><i class="ion-android-color-palette"></i>Artistes</a>
	</div>
	<div class="right">
		<a href="oeuvre.php"><i class="ion-android-image"></i>Œuvres</a>
	</div>
</div>


</body>
</html>