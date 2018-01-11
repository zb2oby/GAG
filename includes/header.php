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
		<link rel="stylesheet" type="text/css" href="../css/lib/slick/slick.css"/>
		<link rel="stylesheet" type="text/css" href="../css/lib/slick/slick-theme.css"/>
        <link rel="stylesheet" href="../css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
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
						echo $date = date("d/m/Y");
						?></a></li>
	    			<li>
	    				<span>Date Expo : </span>
	    				<?php 
	    					$dateExpo = strtotime($expo->getDateDeb());
	    					echo date('d/m/Y', $dateExpo);
	    				?>
	    			</li>
	    			<li>
	    				<span>Inauguration dans : </span> 
	    				<?php
			    			$now = time(); 
			    			$time = $dateExpo - $now;
			    			echo (floor(($dateExpo - $now)/86400)+1).' Jours';
			    		?> 
			    	</li>
	    		</ul>
	    	</div>
	    </header>

		
		

        
        
   