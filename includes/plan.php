
<div class="plan">
	<img src="../img/plan.png" alt="plan">
	<form action="../modules/traitementEmplacement.php" method="GET">
		<input type="text" hidden name="idExpo" value="<?php echo $_SESSION['idExpo'] ?>">
		<input type="hidden" name="req" value="addPlace">
		<div class="addPlace">
			<button type="submit" title="Ajouter un Nouvel Emplacement"><i class="ion-plus-circled"></i></button>
		</div>
			
	</form>
		<div class="trash"><i class="ion-trash-a"></i></div>

	<?php 
function affichage($oeuvre) {
		$content = '<div data-id="'.$oeuvre->getIdOeuvre().'" class="img item" data-src="'.$oeuvre->getImage().'">'	
				.'<img src="../img/oeuvres/'.$oeuvre->getImage().'" alt="'.$oeuvre->getImage().'">'
			.'</div>';
		return $content;
	
}

	if (isset($_SESSION['idExpo'])) {
		$idExpo = htmlentities($_SESSION['idExpo']);

		//AFFICHAGE DES EMPLACEMENTS CREES SUR LE PLAN EN FONCTION DE LEXPO OUVERTE
		// require '../class/emplacement.class.php';
		// require '../class/emplacement.manager.php';

		$manager = new EmplacementManager($bdd);

		//on liste les emplacements disponibles pour l'expo ouverte
		$placesDispo = $manager->getListEmplacement($idExpo);

		//pour chaque emplacement on l'affiche aux coordonnée
		foreach ($placesDispo as $data) {
			$idOeuvreExposee = $data->getIdOeuvreExposee();
			//on cree un objet oeuvre avec l'idOeuvreExposee
			$manager = new OeuvreExposeeManager($bdd);
			$content = '';
			if ($idOeuvreExposee != NULL && $idOeuvreExposee != 0) {
				$oeuvre = $manager->oeuvre($idOeuvreExposee);
				$content = affichage($oeuvre);
			}
			
			// $image = $oeuvre->getImage();
			$id = '';
			if (($data->getCoordTop() == 50 || $data->getCoordLeft() == 50) && $data->getIdOeuvreExposee() == 0 ) {
				$id = 'default-place';
			}
			echo '<div id="'.$id.'" class="emplacement" data-id="'.$data->getIdEmplacement().'" style="top:'.$data->getCoordTop().'%; left:'.$data->getCoordLeft().'%;"><div class="emplacement-handle ion-arrow-move" title="Déplacer"></div><div class="deletePlace ion-android-close" title="Supprimer"></div><div title="Cliquez pour plus d\'options" class="oeuvre-place" data-idemplacement="'.$data->getIdEmplacement().'">'.$content.'</div></div>';
		}
	}
 ?>
	<!-- <div class="confirmPopup">
		<span>Souhaitez vous supprimer l'Emplacement ?</span>
		<button class="deleteButton">Supprimer</button>
		<button class="cancelButton">Annuler</button>

	</div> -->
 </div>	
 