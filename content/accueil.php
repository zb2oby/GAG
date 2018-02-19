<?php session_start(); ?>

<?php $page = 'acceuil' ?>
<?php 
require('../includes/bdd/connectbdd.php'); 
if (isset($_SESSION['idExpo'])) {
	unset($_SESSION['idExpo']);
}
?>
<?php include('../includes/header.php'); ?>

<div class="overlay"></div>
	<div class="onglet <?php if (isset($_GET['onglet']) && $_GET['onglet'] == 'calendar') {
	        	echo 'onglet-actif';
	        } ?>" id="calendar">
		<div class="onglet-title">
			<i class="ion-android-calendar"></i>Calendrier	
		</div>
		<div class="onglet-content">
			<?php 
				require_once('../includes/calendar/calendrier.php');
				date_default_timezone_set('Europe/Paris');
				calendrier(date("n"),date("Y"));
			 ?>
		</div>
	</div>
	<?php include('../includes/recherche.php'); ?>
<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
	

	<div class="onglet <?php if (isset($_GET['onglet']) && $_GET['onglet'] == 'admin') {
	        	echo 'onglet-actif';
	        } ?>" id="admin">
		<div class="onglet-title">
			<i class="ion-gear-b"></i>Admin	
		</div>
		<div class="onglet-content">
			<?php include('../includes/admin.php'); ?>
		</div>
	</div>

	<div class="onglet <?php if (isset($_GET['onglet']) && $_GET['onglet'] == 'doc') {
	        	echo 'onglet-actif';
	        } ?>" id="doc">
		<div class="onglet-title">
			<i class="ion-android-list"></i>Doc	
		</div>
		<div class="onglet-content">
			<div class="docUtils responsive-object">
			<iframe id="MyIFRAME" name="MyIFRAME" 
			    src="../doc_util/doc_utils.pdf"
			    scrolling="auto" width="100%" height="100%" frameborder="0">
			    no iframes supported...
			</iframe>
			</div>
		</div>
	</div>

<?php } ?>

<!-- </div> -->

<?php include('../includes/menuExpo.php'); ?>
<?php include('../includes/footer.php'); ?>
