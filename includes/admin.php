<span class="title">GESTION DES UTILISATEURS</span>

<div class="containerAdmin">
	<div class="confirmPopup">
        <span>Souhaitez vous réellement supprimer l'élément ?</span>
        <button class="deleteUser">Supprimer</button>
        <button class="cancelButton-global">Oula tout cela va bien trop vite</button>
    </div>
	<div class=" adminItem afficheUser">
		<h3>Liste des utilisateurs</h3>
		<ul>
			<?php 
			$managerUser = new UtilisateurManager($bdd);
			$listUser = $managerUser->listUser();
			foreach ($listUser as $user) {
				$idUser = $user->getIdUtilisateur();
				$nom = $user->getNom();
				$prenom = $user->getPrenom();
				$idTypeRole = $user->getIdTypeUtilisateur();
				$role = $managerUser->getRole($idTypeRole);
				$identifiant = $user->getIdentifiant();
				$dataUser = [];	
				$dataUser = ['nom' => $nom, 'prenom' => $prenom, 'idRole' => $idTypeRole, 'identifiant' => $identifiant];
				?>
				<li><a class="userAdmin" data-prenom="<?php echo $prenom; ?>" data-role="<?php echo $idTypeRole; ?>" data-identifiant="<?php echo $identifiant; ?>" data-id="<?php echo $idUser; ?>" data-nom="<?php echo $nom ?>" href="#">NOM : <?php echo $nom.' PRENOM : '.$prenom.' ROLE : '.$role; ?></a></li>
			<?php }?>
		</ul>
	</div>


	<form class="adminItem adminForm" action="#" id="submit-admin" method="GET">
		<div>
			<label for="nom">Nom</label>
			<input type="text" name="nom" id="nom"><br>
		</div>
		<div>
			<label for="prenom">Prénom</label>
			<input type="text" name="prenom" id="prenom">
		</div>
		
			<div class="selectInput">
			<label for="role">Role</label>
			<select name="role" id="role">
				<option hidden selected value=""></option>
				<?php 
					$listType = $managerUser->listTypeUser();
			
					foreach ($listType as $couple) {
						foreach ($couple as $idType => $libelleType) {
							echo '<option value="'.$idType.'">'.$libelleType.'</option>';
						}
						
					}

				 ?>
			</select>
			</div>
		
		<div>
			<label for="identifiant">Identifiant</label>
			<input type="text" name="identifiant" id="identifiant">
		</div>
		<div class="submit">
			<input type="hidden" name="idUser" id="idUser">
			<input type="hidden" name="onglet" value="admin">
			<button type="submit">Enregistrer</button>
			<button class="button" id="emptyUser">Annuler</button>
			<input type="hidden" id="req" name="req">
			<div class="supprUser">
			
			<button id="delUser"><i class="ion-ios-trash-outline"></i><span>Supprimer l'utilisateur</span></button>
			</div>

		</div>
	</form>
		
</div>