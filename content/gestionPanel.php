<?php 
session_start();
if (isset($_GET['expo'])) {
$idExpo = htmlentities($_GET['expo']);
$_SESSION['idExpo'] = $idExpo;
}

 ?>

<?php require('../includes/bdd/connectbdd.php'); ?>
<?php include('../includes/header.php') ?>

<div class="overlay"></div>
	<div class="content">

		<div class="onglet <?php if (isset($_GET['onglet']) && $_GET['onglet'] == 'gestion') {
	        	echo 'onglet-actif';
	        } ?>" id="gestion">
        	<div class="onglet-title">
        		<i class="ion-gear-b"></i>Gestion
        	</div>
			<div class="onglet-content">
				<?php include('../includes/listesGestion.php') ?>
				<div class="gestionPlan">
					<?php include('../includes/plan.php') ?>

				</div>
			</div>
		</div>
		
		<div class="onglet <?php if (isset($_GET['onglet']) && $_GET['onglet'] == 'expo') {
	        	echo 'onglet-actif';
	        } ?>" id="expo">
        	<div class="onglet-title">
        		<i class="ion-information-circled"></i>Expo
        	</div>
        	<div class="onglet-content">
                <?php include('../includes/formExpo.php') ?>
        	</div>
        </div>
		
		<?php include('../includes/recherche.php'); ?>

        <div class="onglet <?php if (isset($_GET['onglet']) && $_GET['onglet'] == 'stat') {
        	echo 'onglet-actif';
        } ?>" id="stat">
        	<div class="onglet-title">
        		<i class="ion-stats-bars"></i>Stats
        	</div>
        	<div class="onglet-content">
        		<div class="stat-content">
        		<?php include '../includes/statistiques.php'; ?>
	        	</div>
        	</div>
        </div>
	</div>

<?php include('../includes/menuExpo.php'); ?>
<?php include('../includes/footer.php'); ?>