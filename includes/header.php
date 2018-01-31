<?php 
if (!isset($_SESSION['idUser'])) {
	header('location: ../content/login.php');
}
                        

include('functions.php');

spl_autoload_register('loader');

include('bdd/connectbdd.php');

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Grand Angle Gestion</title>
        <link rel="stylesheet" href="../css/ionicons.min.css">
		<link rel="stylesheet" type="text/css" href="../css/lib/slick/slick.css"/>
		<link rel="stylesheet" type="text/css" href="../css/impression.css" media="print"/>
		<link rel="stylesheet" type="text/css" href="../css/lib/slick/slick-theme.css"/>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/accueil.css">
        <link rel="author" href="humans.txt">
    </head>

 <body>
 
<?php 
if (isset($_SESSION['idExpo'])) {
	$idExpo = $_SESSION['idExpo'];
	include('../includes/impression.php'); 
}




?>
	 <div class="container">
		<header>
			<?php 
				$managerUser = new UtilisateurManager($bdd);
				if (isset($_SESSION['idUser'])) {
					$idUser = $_SESSION['idUser'];
					$user = $managerUser->infoUtilisateur($idUser);
					$identifiant = $user->getIdentifiant();
					$role = $managerUser->giveRole($user);
					$_SESSION['role'] = $role;
					
				}
			 ?>
	    	<a class="avatar deco" href="../modules/traitementLogout.php?req=logout" title="Se déconnecter"><?php echo ucfirst($identifiant[0]); ?><div class="logo-out"><i class="ion-log-out"></i></div></a>

	    	<div class="expoInfo">
	    		<?php 
	    			if (isset($_SESSION['idExpo']) && !empty($_SESSION['idExpo'])) {
	    				$idExpo = htmlentities($_SESSION['idExpo']);
	    				$manager = new ExpositionManager($bdd);
	    				$expo = $manager->infoExpo($idExpo);
	    				echo '<h2>Exposition : '.$expo->getTitre().'<div class="printer">
		    		<button onclick="javascript:window.print()" title="Imprimer Listes"><i class="ion-android-print"></i></button>
		    	</div></h2>';

	    				$manager = new CollectifExposeManager($bdd);
	    				$idCollectifExpose = $manager->collectifExpose_exist($idExpo);
	    				if ($idCollectifExpose != false ) {
	    					$manager = new CollectifManager($bdd);
	    					$dataCollectif = $manager->infoCollectif($idCollectifExpose);
	    					echo '<span>Collectif : '.$dataCollectif->getLibelleCollectif().'</span>';
	    				}
	    					//verification du nombre d'oeuvres en retard
			    			$now = time(); 
			    			$dateExpo = strtotime($expo->getDateDeb());
			    			$time = $dateExpo - $now;
			    			$remain = (floor(($dateExpo - $now)/86400)+1);
				    		if ($remain < 10) {
		    					$managerOeuvreExpo = new OeuvreExposeeManager($bdd);
		    					$listNonRecue = $managerOeuvreExpo->ListOeuvresPrevues($idExpo);
		    					if (count($listNonRecue) > 0) {
		    						# code...
		    					
		    			?>
		    					<span class="retard" style="position: relative; color:red; margin-left: 80px;"><i class="ion-alert-circled" style="color:red; font-size:2em; position:absolute; left:-30px; top:-10px;"></i>Il y a <?php echo count($listNonRecue); ?> Oeuvre(s) En retard ! </span>
						
			    	
			    	<?php 
			    				}
			    			} 
	    			}else{
	    				echo '<h2 class="accueil-titre">GAG GESTION</h2>';
	    			}
	    			
	    		?>
	    	</div>
	    	<div class="timeLine">
	    		<ul>
	    			<li><span>Aujourd'hui : </span><a href="../content/accueil.php?a=<?php echo date('Y') ?>&m=<?php echo date('m') ?>&onglet=calendar" class="button date" title="Retour Accueil"><i class="ion-android-arrow-back"></i><?php 
						echo $date = ' '.date("d/m/Y");
						?></a>
					</li>
					<?php if (isset($_SESSION['idExpo'])) { ?>
						
					
	    			<li>
	    				<span>Date Expo : </span>
	    				<?php 
	    					$dateExpo = strtotime($expo->getDateDeb());
	    					$dateFin = strtotime($expo->getDateFin());
	    					echo date('d/m/Y', $dateExpo);
	    				?>
	    			</li>
	    			<li>
	    				<span>Inauguration dans : </span> 
	    				<?php
			    			$now = time(); 
			    			$time = $dateExpo - $now;
			    			$end = $dateFin -$now;
			    			if ($time < 0 && $end > 0 ) {
			    				echo 'Expo en cours';
			    			}elseif($end < 0) {
			    				echo 'Expo terminée';
			    			}
			    			else {
			    				echo (floor(($dateExpo - $now)/86400)+1).' Jours';
			    			}
			    		}
			    			
			    		?> 
			    	</li>
			    	
	    		</ul>
	    	</div>
	    
	    </header>

		<?php if (isset($_SESSION['idUser'])) {
			$idUser = $_SESSION['idUser'];
		?>
		<div class="addArt" data-iduser="<?php echo $idUser; ?>">
			
		</div>

		<?php
			include('../includes/addOeuvre-modal.php');
		 }
		  ?>
		
		

        
        
   