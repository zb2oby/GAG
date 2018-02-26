<?php include('header.php'); 

if (isset($_SESSION['langue'])) {
	$idLangue = $_SESSION['langue'];

}else {
	$idLangue=1;
}

?>
<div class="main">

	<div class="bienvenue">
		Bienvenue à l'exposition <?php echo ucfirst($titre)?> sur le theme <?php echo ucfirst($theme) ?> 
		

	</div>
	<div class="descriptif">
		<?php echo "<img src='../img/expositions/expo".$idExpo."/".$affiche."' alt='affiche'>" ?>
		<div class="blockaffiche">
			Descriptif :
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