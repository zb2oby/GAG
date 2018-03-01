<?php include('header.php'); 

?>
<div class="main">

	<div class="bienvenue">
		Bienvenue à l'exposition <?php echo ucfirst($titre)?>
		<h4>Thème : </h4><?php echo ucfirst($theme) ?> 
		

	</div>
	<div class="descriptif">
		<?php echo "<img src='../img/expositions/expo".$idExpo."/".$affiche."' alt='affiche'>" ?>
		<div class="blockaffiche">
				<?php 
					if ($idLangue != 1) {
						$traduction = new Traduction();
						$texte = $traduction->getTraduction($idLangue, $idExpo, 'idExpo');
						echo $texte;
					}else{
						echo ucfirst($exposition->getDescriptifFR());
					}
				 ?>
		</div>
	</div>

<?php include 'footer.php'; ?>