<div>
	<!-- <div class="overlay"></div> -->

	<form id="newExpo" action="../modules/traitementExpo.php" method="POST" enctype="multipart/form-data">
		<span class="title">AJOUTER UNE NOUVELLE EXPOSITION</span>
		<div id="CloseNewExpo" class="closeButton"><i class="ion-android-close"></i></div>
		<fieldset class="expoField">
		<div>
			<label for="dateDebut">Date de début</label>
			<input type="date" name="dateDebut" id="dateDebut">
		</div>	
		<div>	
			<label for="dateFin">Date de fin</label>
			<input type="date" name="dateFin" id="dateFin">
		</div>	
		<div>
			<label for="couleur">Couleur</label>
			<input type="color" name="couleurExpo" id="couleurExpo">
		</div>	
		<div>
			<label for="titre">Titre</label>
			<input type="text" name="titre" id="titre">
		</div>	
		<div>
			<label for="theme">Theme</label>
			<input type="text" name="theme" id="theme">
		</div>
		<div>
			<label for="descriptif">descriptif</label>
			<textarea name="descriptif" id="descriptif" cols="30" rows="5"></textarea>
		</div>
		</fieldset>	
		<fieldset class="expo-cpl expoField">
		<div>
			<label for="teaser">Teaser (JPG GIF JPEG PNG| max. 500Ko)</label>
			<input type="file" name="teaser[]" id="teaser" accept=".jpg, .jpeg, .gif, .png">
				
		</div>	
		<div>
			<label for="affiche">Affiche (JPG GIF JPEG PNG| max. 500Ko)</label>
			<input type="file" name="affiche[]" id="affiche" accept=".jpg, .jpeg, .gif, .png">
			<input type="hidden" id="maxSize" name="MAX_FILE_SIZE" value="500000">
				
		</div>	
		<div>
			<label for="horaireO">Horaire d'ouverture</label>
			<input type="time" name="horaireO" id="horaireO">
		</div>	
		<div>
			<label for="horaireF">Horaire de fermeture</label>
			<input type="time" name="horaireF" id="horaireF">
		</div>
		<div class="langues">
				<label>Langues disponibles</label>
                <label class="labelLn" for="fr">Fr</label>
                <input type="checkbox" name="idLangue[]" id="fr" value="1">
                <label class="labelLn" for="en">En</label>
                <input type="checkbox" name="idLangue[]" id="en" value="2">
                <label class="labelLn" for="de">De</label>
                <input type="checkbox" name="idLangue[]" id="de" value="4">
                <label class="labelLn" for="cn">Cn</label>
                <input type="checkbox" name="idLangue[]" id="cn" value="5">
                <label class="labelLn" for="ru">Ru</label>
                <input type="checkbox" name="idLangue[]" id="ru" value="3">
        </div>
		</fieldset>
		<div class="submit">
			<button type="submit">Enregistrer</button>
		</div>
	</form>
</div>