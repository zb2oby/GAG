<h3>GESTION DES UTILISATEURS</h3>

<div class="containerAdmin">
	<div class="afficheUser">
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
				<li><a class="userAdmin" data-prenom="<?php echo $prenom; ?>" data-role="<?php echo $idTypeRole; ?>" data-identifiant="<?php echo $identifiant; ?>" data-id="<?php echo $idUser; ?>" data-nom="<?php echo $nom ?>" href="#"><?php echo $nom.' '.$prenom.' '.$role; ?></a></li>
			<?php }?>
		</ul>
	</div>


	<form class="adminForm" action="#" id="submit-admin" method="GET">
		<div>
		<label for="nom">Nom</label>
		<input type="text" name="nom" id="nom"><br>
		</div>
		<div>
		<label for="prenom">Prénom</label>
		<input type="text" name="prenom" id="prenom">
		</div>
		<div>
			
			<label for="role">Role</label>
			<select name="role" id="role">
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
		<input type="hidden" name="idUser" id="idUser">
		<input type="hidden" name="onglet" value="admin">
		<button type="submit">Enregistrer</button>
		<input type="hidden" id="req" name="req">
		<button id="delUser">Supprimer</button>
	</form>
		
</div>