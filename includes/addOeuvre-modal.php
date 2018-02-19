<div class="modalAddOeuvre">
	<div class="closeButton"><i class="ion-android-close"></i></div>
	<form class="form-add" action="../modules/traitementOeuvre.php" method="GET">
		<div class="selectInput">
			<label for="idArtiste">Selectionner un artiste</label>
			<select name="idArtiste" id="idArtiste">
					<option hidden selected value=""></option>
				<?php 
						$manager = new ArtisteManager($bdd);

						$listArtiste = $manager->listArtiste();
						foreach ($listArtiste as $artiste) {
							echo '<option value="'.$artiste->getIdArtiste().'">'.$artiste->getNom().' '.$artiste->getPrenom().'</option>';
						}
					
				?>
			</select>
		</div>
		
		<div class="submit">
			<input type="hidden" name="req" id="req" value="add">
			<button type="submit">Creer Oeuvre</button>
		</div>
	</form>
</div>