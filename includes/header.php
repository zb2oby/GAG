<?php 

/*=====>POUR LES TESTS */ $_SESSION['idExpo'] = 2; 

require('../class/exposition.class.php');
require('../class/exposition.manager.php');
require('../class/collectif.class.php');
require('../class/collectif.manager.php');
require('../class/collectifExpose.class.php');
require('../class/collectifExpose.manager.php');
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
	    			<li><span>Aujourd'hui : </span><a href="" class="button date">25/12/2017</a></li>
	    			<li><span>Date Expo : </span>21/08/2018</li>
	    			<li><span>Inauguration dans : </span> 10 Jours</li>
	    		</ul>
	    	</div>
	    </header>

		
		

        
        
   