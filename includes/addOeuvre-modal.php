<div class="modalAddOeuvre">
	<form class="form-add" action="../modules/traitementOeuvre.php" method="GET">
		<select name="idArtiste" id="idArtiste">
			<?php 
					$manager = new ArtisteManager($bdd);

					$listArtiste = $manager->listArtiste();
					foreach ($listArtiste as $artiste) {
						echo '<option value="'.$artiste->getIdArtiste().'">'.$artiste->getNom().' '.$artiste->getPrenom().'</option>';
					}
				
			?>
		</select>
		<input type="hidden" name="req" id="req" value="add">
		<div class="submit">
			<button type="submit">Creer Oeuvre</button>
		</div>
	</form>
</div>