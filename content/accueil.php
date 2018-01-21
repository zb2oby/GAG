<?php $page = 'acceuil' ?>
<?php 
require('../includes/bdd/connectbdd.php'); 

?>



<div class="header-accueil-calendar">
<?php include('../includes/header.php'); ?>



<div class="onglet <?php if (isset($_GET['onglet']) && $_GET['onglet'] == 'calendar') {
        	echo 'onglet-actif';
        } ?>" id="calendar">
	<div class="onglet-title">
		Calendrier	
	</div>
	<div class="onglet-content">
		<?php 
			include('../includes/calendar/calendrier.php');
			calendrier(date("n"),date("Y"));
		 ?>
	</div>
</div>


<div class="onglet <?php if (isset($_GET['onglet']) && $_GET['onglet'] == 'admin') {
        	echo 'onglet-actif';
        } ?>" id="admin">
	<div class="onglet-title">
		Admin	
	</div>
	<div class="onglet-content">
		<form class="adminForm" action="#" id="submit-admin" method="GET">
			<label for="nom">Nom Collaborateur</label>
			<input type="text" name="nom" id="nom"><br>
			<label for="date">Date Naissance</label>
			<input type="text" name="dateExpo" id="dateExpo">
			<input type="hidden" name="onglet" value="admin">
			<input type="submit" value="Enregistrer">
			<input type="submit" value="Modifier">
			<input type="submit" value="Supprimer">
		</form>
	</div>
</div>









</div>

<?php include('../includes/menuExpo.php'); ?>
<?php include('../includes/footer.php'); ?>
