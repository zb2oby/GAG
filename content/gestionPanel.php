<?php 
session_start();
if (isset($_GET['expo'])) {
$idExpo = htmlentities($_GET['expo']);
$_SESSION['idExpo'] = $idExpo;
}
/*=====>POUR LES TESTS */ //$_SESSION['idExpo'] = 2; 
                        $_SESSION['idUser'] = 1;
 ?>

<?php require('../includes/bdd/connectbdd.php'); ?>

<?php include('../includes/header.php') ?>
<div class="overlay"></div>
	<div class="content">

		<div class="onglet <?php if (isset($_GET['onglet']) && $_GET['onglet'] == 'gestion') {
	        	echo 'onglet-actif';
	        } ?>" id="gestion">
        	<div class="onglet-title">
        		Gestion
        	</div>
			<div class="onglet-content">
				<?php include('../includes/listesGestion.php') ?>

				<?php include('../includes/plan.php') ?>
			</div>
		</div>
		
		<div class="onglet <?php if (isset($_GET['onglet']) && $_GET['onglet'] == 'expo') {
	        	echo 'onglet-actif';
	        } ?>" id="expo">
        	<div class="onglet-title">
        		Expo
        	</div>
        	<div class="onglet-content">
                        <?php 
                                if (isset($_SESSION['idExpo'])) {
                                        $idExpo = $_SESSION['idExpo'];
                                        $managerExpo = new ExpositionManager($bdd);
                                        $expo = $managerExpo->infoExpo($idExpo);

                                }

                         ?>
        		<form class="expoForm" action="../modules/traitementExpo.php" method="POST" enctype="multipart/form-data">
                                
        			<fieldset>
                                <legend>Infos générales</legend>
                                        <label for="titre">Titre</label>
                                        <input type="text" name="titre" id="titre" value="<?php echo $expo->getTitre() ?>"><br>
                                        <label for="theme">Theme</label>
                                        <input type="text" name="theme" id="theme" value="<?php echo $expo->getTheme() ?>"><br>
                                        <label for="dateDebut">Date de début</label>
                                        <input type="date" name="dateDebut" id="dateDebut" value="<?php echo $expo->getDateDeb() ?>"><br>
                                        <label for="dateFin">Date de fin</label>
                                        <input type="date" name="dateFin" id="dateFin" value="<?php echo $expo->getDateFin() ?>"><br> 
                                        
                                        <label for="descriptif">descriptif</label>
                                        <textarea name="descriptif" id="descriptif" cols="30" rows="7" value="<?php echo $expo->getDescriptifFR() ?>"><?php echo $expo->getDescriptifFR() ?></textarea>
                              
                                </fieldset>
                                <fieldset>
                                <legend>Info Complémentaires</legend>
                                        <label for="couleurExpo">Couleur de l'expo</label>
                                        <input type="color" name="couleurExpo" id="couleurExpo" value="<?php echo $expo->getCouleurExpo() ?>"><br>
                                        
                                        <label for="horaireO">Horaire d'ouverture</label>
                                        <input type="time" name="horaireO" id="horaireO" value="<?php echo $expo->getHoraireO() ?>"><br>
                                        <label for="horaireO">Horaire de fermeture</label>
                                        <input type="time" name="horaireF" id="horaireF" value="<?php echo $expo->getHoraireF() ?>"><br>
                                        <div>
                                                <label for="teaser">Teaser (JPG GIF JPEG PNG| max. 500Ko)</label>
                                                <input type="file" name="teaser[]" id="teaser" accept=".jpg, .jpeg, .gif, .png" value="<?php echo $expo->getTeaser() ?>">
                                                        
                                        </div>  
                                        <div>
                                                <label for="affiche">Affiche (JPG GIF JPEG PNG| max. 500Ko)</label>
                                                <input type="file" name="affiche[]" id="affiche" accept=".jpg, .jpeg, .gif, .png" value="<?php echo $expo->getAffiche() ?>">
                                                <input type="hidden" id="maxSize" name="MAX_FILE_SIZE" value="500000">
                                                        
                                        </div>
                               </fieldset>
                                <div class="submit">
                                        <input type="hidden" name="req" value="updateExpo">
                                        <input type="hidden" name="idExpo" value="<?php echo $idExpo ?>">
                			<!-- <input type="hidden" name="onglet" value="expo"> -->
                			<button type="submit">Enregistrer les modifications</button>
                			<button><a href="../modules/traitementExpo.php?req=deleteExpo&idExpo=<?php echo $idExpo ?>">Supprimer Expo</a></button>
                                </div>
        		</form>
        	</div>
        </div>

        <div class="onglet <?php if (isset($_GET['onglet']) && $_GET['onglet'] == 'stat') {
        	echo 'onglet-actif';
        } ?>" id="stat">
        	<div class="onglet-title">
        		Stats
        	</div>
        	<div class="onglet-content">
        		<div class="stat-content">
	        		<div class="stat">
	        			<div class="imgStat">
	        				<img src="" alt="stat1">
	        			</div>
	        			<div class="explain">
	        				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem iure voluptates, exercitationem mollitia placeat quod aliquam nesciunt quasi culpa illum, nulla reiciendis neque consectetur debitis ratione ducimus voluptatem minima error sequi sit! Non dicta, sapiente facere modi voluptates possimus id laborum eius cum rem tempore in sed voluptatum et ducimus magni iusto mollitia fuga suscipit quam alias reprehenderit earum. Excepturi dolorem, nihil perferendis. Accusantium consectetur sequi recusandae, consequatur modi nemo maxime aliquid ratione odit sapiente id, deleniti, at perferendis autem sit distinctio quam placeat! Magni blanditiis nisi, voluptates hic accusamus sit id incidunt cumque rem, eius suscipit saepe mollitia! Suscipit.
	        			</div>
	        		</div>
	        		<div class="stat">
	        			<div class="imgStat">
	        				<img src="" alt="stat1">
	        			</div>
	        			<div class="explain">
	        				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat fuga perspiciatis ex ea. Cum laborum consequuntur suscipit eligendi omnis saepe commodi itaque repellendus aperiam iste nam earum, repellat ea, laboriosam est animi soluta sint tempore minima a? Excepturi nesciunt sapiente molestiae, consectetur sequi maxime sit adipisci nulla iste, vitae vero sint hic ipsa magni voluptatum rerum temporibus incidunt vel soluta non quisquam nobis dignissimos. Suscipit dicta veritatis velit quos consequuntur accusantium quaerat? Repellendus sint neque eius enim voluptatem quisquam soluta omnis iusto reiciendis debitis facere necessitatibus excepturi porro consectetur hic modi ullam id minus, perspiciatis consequuntur voluptatibus illo deserunt?
	        			</div>
	        		</div>
	        	</div>
        	</div>
        </div>

        <!-- <div class="onglet <?php //if (isset($_GET['onglet']) && $_GET['onglet'] == 'admin') {
        	//echo 'onglet-actif';
        //} ?>" id="admin">
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
        </div> -->

	</div>

<?php include('../includes/menuExpo.php'); ?>
<?php include('../includes/footer.php'); ?>