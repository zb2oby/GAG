
<div class="afficheUser">
	<table>
		<tr>
			<th>Nom</th>
			<th>Prenom</th>
			<th>Identifiant</th>
			<th>Mot de passe</th>
			<th>Role</th>
		</tr>
	<?php 
	$managerUser = new UtilisateurManager($bdd);
	$listUser = $managerUser->listUser();

	foreach ($listUser as $user) {
		?>
	<tr>
		<td><?php echo $user->getNom(); ?></td>
		<td><?php echo $user->getPrenom(); ?></td>
		<td><?php echo $user->getIdentifiant(); ?></td>
		<td><?php echo $user->getMot_de_passe(); ?></td>
		<td><?php echo $managerUser->getRole($user->getIdTypeUtilisateur()); ?></td>
	</tr>

	<?php }


	?>

	</table>
</div>


<form class="adminForm" action="#" id="submit-admin" method="GET">
	<div>
	<label for="nom">Nom Collaborateur</label>
	<input type="text" name="nom" id="nom"><br>
	</div>
	<div>
	<label for="date">Date Naissance</label>
	<input type="text" name="dateExpo" id="dateExpo">
	</div>
	<input type="hidden" name="onglet" value="admin">
	<input type="submit" value="Enregistrer">
	<input type="submit" value="Modifier">
	<input type="submit" value="Supprimer">
</form>