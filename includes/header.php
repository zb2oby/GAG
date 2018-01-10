<?php 

/*=====>POUR LES TESTS */ $_SESSION['idExpo'] = 2; 

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
        <link rel="stylesheet" href="../css/style.css">
        <link rel="author" href="humans.txt">
    </head>

 <body>

	 <div class="container">
		<header>
	    	<a class="avatar deco" href="">F<i class="ion-log-out"></i></a>

	    	<div class="expoInfo">
	    		<?php 
	    			if (isset($_SESSION['idExpo'])) {
	    				$idExpo = htmlentities($_SESSION['idExpo']);
	    				$manager = new ExpositionManager($bdd);
	    				$expo = $manager->infoExpo($idExpo);
	    				echo '<h2>Exposition : '.$expo->getTitre().'</h2>';

	    				$manager = new CollectifExposeManager($bdd);
	    				$idCollectifExpose = $manager->collectifExpose_exist($idExpo);
	    				if ($idCollectifExpose != false ) {
	    					$manager = new CollectifManager($bdd);
	    					$dataCollectif = $manager->infoCollectif($idCollectifExpose);
	    					echo '<span>Collectif : '.$dataCollectif->getLibelleCollectif().'</span>';
	    				}
	    			}
	    			
	    		?>
	    	</div>
	    	<div class="timeLine">
	    		<ul>
	    			<li><span>Aujourd'hui : </span><a href="" class="button date"><?php 
	    				// date du jour
						echo $date = date("d/m/Y");
						// tableau des jours de la semaine
						$joursem = array('dim', 'lun', 'mar', 'mer', 'jeu', 'ven', 'sam');
						// extraction des jour, mois, an de la date
						list($jour, $mois, $annee) = explode('/', $date);
						// calcul du timestamp
						$timestamp = mktime (0, 0, 0, $mois, $jour, $annee);
						?></a></li>
	    			<li>
	    				<span>Date Expo : </span><?php echo $dateExpo = $expo->getDateDeb(); ?>
	    			</li>
	    			<li>
	    				<span>Inauguration dans : </span> 
	    				<?php
			    			$now = time(); 
			    			$dateExpo = strtotime($dateExpo); 
			    			$time = $dateExpo - strtotime(date('Y-m-d'));
			    			echo date( 'd', $time).' Jours';
			    		?> 
			    	</li>
	    		</ul>
	    	</div>
	    </header>

		
		

        
        
   