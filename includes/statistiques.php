<?php 
// require ('../class/Exposition.class.php');
// require ('../class/ExpositionManager.class.php');
// require ('../includes/bdd/connectbdd.php')
if (isset($_SESSION['idExpo'])) {
    $idExpo = $_SESSION['idExpo'];
    $managerExpo = new ExpositionManager($bdd);
    $expo = $managerExpo->infoExpo($idExpo);


    $managerOeuvreExposee = new OeuvreExposeeManager($bdd);
    $listOeuvreExpo = $managerOeuvreExposee->ListOeuvresExposees($idExpo);

}



 ?>

 <h2 class="nbVisite">Exposition : <span><?php echo $expo->getFrequentation(); ?> visites</span></h2>
<div class="list-stat">
	 <?php 
	foreach ($listOeuvreExpo as $oeuvre) {
		$idOeuvre = $oeuvre->getIdOeuvre();
		$idOeuvreExposee = $managerOeuvreExposee->idExposee($idOeuvre, $idExpo);
		$oeuvreExposee = $managerOeuvreExposee->oeuvreExposee($idOeuvreExposee);
		$nbVue = $oeuvreExposee->getNbVue();
		$nomOeuvre = $oeuvre->getTitre();
		?>
		
			
		<div class="stat-oeuvre">
			<h4><?php if($nomOeuvre != '' || $nomOeuvre != NULL){echo $nomOeuvre;}else{echo 'Sans Nom';}  ?></h4>
			<img class="imgStat" src="../img/oeuvres/<?php echo $oeuvre->getImage(); ?>" style="width:100px; height:100px;" alt="">
			<span class="nbVue"><?php if($nbVue != '' || $nbVue != NULL) {echo $nbVue.' Vues';}else{echo 'Aucune Vue';} ?></span>
		</div>
	<?php
	}

	  ?>

</div>