<div class="onglet <?php if (isset($_GET['onglet']) && $_GET['onglet'] == 'search') {
        	echo 'onglet-actif';
        } ?>" id="search">
	<div class="onglet-title">
		<i class="ion-android-search"></i>Recherche	
	</div>
	<div class="onglet-content">
		<span class="title">Panneau de Recherche</span>
		<div class="searchType">
			
		</div>
		<div class="searchForm">
			<form class="search-form" action="#" method="GET">
				<div class="selectType">
				<label for="type">Type de recherche</label>
				<select name="type" id="type">
					<option value="" selected></option>
					<option value="artiste">Artiste (nom/prenom/tel/email)</option>
					<option value="oeuvre">Oeuvre (titre/long/haut/etat)</option>
					<option value="collectif">Collectif (libelle/email/tel)</option>
					<option value="exposition">Exposition (titre/theme/date)</option>
				</select>
				</div>
				<div class="inputSaisie">
					<label for="req">Votre recherche</label>
					<input class="saisie" name="req" id="req" type="text"><button type="submit"><i class="submit ion-android-search" title="Valider"></i></button>
				</div>
			</form>
		</div>
		<div class="searchResult">
			
		</div>
	</div>
</div>