<?php include('header.php');

$managerOeuvreExpo = new OeuvreExposeeManager($bdd);
$listOeuvreExpo = $managerOeuvreExpo->listOeuvresRecues($idExpo);

?>
<div class="main">
	<?php
	foreach ($listOeuvreExpo as $oeuvre) {
		$bgcolor = ($i++ % 2) ? '#fff':'#d0e1f2';
		$idoeuvre=$oeuvre->getIdOeuvre();
		
		?>
		<a href='oeuvreselectionner.php?oeuvre=<?php echo $idoeuvre?>' class='selection'>
			<div class="presentation" style="background-color:<?php echo $bgcolor ;?>">
				<div class="oeuvre">
					
					<img src="../img/oeuvres/<?php echo $oeuvre->getImage();?>" alt="image oeuvre">
					<div class="block">
						Titre : 
						<?php 
						echo $oeuvre->getTitre();
						?>
					</div>
					<div class="description">
						Description :
						<?php echo $oeuvre->getDescriptifFR(); ?>
					</div>
				</div>
			</div>
		
	</a>
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