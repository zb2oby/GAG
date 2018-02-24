<?php 
require_once('../class/OeuvreManager.class.php');
include('bdd/connectbdd.php');
 ?>
<div class="context-menu context-type">
	<div class="closeButton closeButton-oeuvre"><i class="ion-android-close"></i></div>
	<div class="context-overlay"></div>


	<span class="title">GESTION DES TYPES D'OEUVRES</span>


	<div class="confirmPopup-type">
        <span>Souhaitez vous réellement supprimer l'élément ?</span>
        <button class="deleteType">Supprimer</button>
        <button class="cancelButton-type">Oula tout cela va bien trop vite</button>
    </div>
	<div class="afficheType">
		<h3>Liste des types</h3>
		<ul>
			<?php 
			$managerOeuvre = new OeuvreManager($bdd);
			$listType = $managerOeuvre->listTypeOeuvre();
			foreach ($listType as $idType => $libelle) {
				?>
				<li><a class="typeItem" data-libelle="<?php echo $libelle; ?>" data-id="<?php echo $idType; ?>" href="#">LIBELLE : <?php echo $libelle; ?></a></li>
			<?php }?>
		</ul>
	</div>


	<form class="typeForm" action="#" id="submit-type" method="GET">
		<div>
			<label for="libelle">Libelle(*)</label>
			<input type="text" name="libelle" id="libelle"><br>
		</div>

		
		
		
		<div class="submit">
			<input type="hidden" name="idType" id="idType">
			<button type="submit">Enregistrer</button>
			<button class="button" id="emptyType">Annuler / Vider</button>
			<input type="hidden" id="req" name="req">
			<div class="supprType">
			
			<button id="delType"><i class="ion-ios-trash-outline"></i><span>Supprimer le type</span></button>
			</div>

		</div>
	</form>
	
</div>