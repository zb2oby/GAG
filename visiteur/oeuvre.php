<?php include('header.php');

$managerOeuvreExpo = new OeuvreExposeeManager($bdd);
$listOeuvreExpo = $managerOeuvreExpo->listOeuvresRecues($idExpo);

?>
<div class="main">
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

	<div class="footer">
		<div class="left">
			<a href="index.php"><i class="ion-android-home"></i></a>
		</div>
		<div class="right">
			<a href="artiste.php"><i class="ion-android-color-palette"></i>Artistes</a>
		</div>
	</div>
</div>
</body>
</html>