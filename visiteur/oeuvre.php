<?php include('header.php');

$managerOeuvreExpo = new OeuvreExposeeManager($bdd);
$listOeuvreExpo = $managerOeuvreExpo->listOeuvresRecues($idExpo);

?>
<div class="main">
	<div class="flex-container">
	<?php
	foreach ($listOeuvreExpo as $oeuvre) {
		$idoeuvre=$oeuvre->getIdOeuvre();
		?>
		<div class="presentation">
			<div class="oeuvreimage">
				<a href='oeuvreselectionner.php?oeuvre=<?php echo $idoeuvre?>' >
				<img src="../img/oeuvres/<?php echo $oeuvre->getImage();?>" alt="image oeuvre"></a>
			</div>
			<div class="blockOeuvre">
				<?php 
				echo ucfirst($oeuvre->getTitre());
				?>
			</div>
		</div>
			<?php 
		}
		?> 
	</div>

	<?php include 'footer.php'; ?>