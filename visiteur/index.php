<?php include('header.php'); 


?>
<div class="main">

	<div class="bienvenue">
		Bienvenue à l'exposition <?php echo ucfirst($titre)?> sur le theme <?php echo ucfirst($theme) ?> 
		

	</div>
	<div class="descriptif">
		<?php echo "<img src='../img/expositions/expo".$idExpo."/".$affiche."' alt='affiche'>" ?>
		<div class="blockaffiche">
			Descriptif :
			<?php echo ucfirst($descriptif); ?>
		</div>
	</div>

<?php include 'footer.php'; ?>