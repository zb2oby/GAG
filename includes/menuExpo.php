</div>
<!-- fin de container / début sideBar -->
	<?php  include('../includes/newExpo.php');  ?>	
	<aside class="sideBar">
		<div class="prev"><i class="flecheHor ion-ios-arrow-left"></i></div>
		<div class="sideMenu">
			<div class="homeLogo"><a href="../content/accueil.php?a=<?php echo date('Y') ?>&m=<?php echo date('m') ?>&onglet=calendar"><i class="ion-home"></i></a></div>
			<!-- <div class="searchLogo"><a class="search" href="#"><i class="ion-ios-search"></i></a></div> -->
			<div class="prev"><i class="flecheVert ion-ios-arrow-up"></i></div>
			<div class="multiple-items">
				<?php 
				$manager = new ExpositionManager($bdd);

				//recuperation de l'expositin la plus proche de la date du jour
				$closest = $manager->closestExpo();
				if ($closest != false) {
					$idClosest = $closest->getIdExpo();


					//affichage des expo précédent la date du jour
					$listPrevExpo = $manager->prevExpo($idClosest);	
					$listDate = [];
					
					foreach ($listPrevExpo as $exposition ) {
						$key = $exposition->getDateDeb();
						$value = $exposition->getTitre();
						$couleurExpo = $exposition->getCouleurExpo();
						$idExpoParam = $exposition->getIdExpo();
						$listDate[$key] = ['titre' => $value, 'couleur' => $couleurExpo, 'id' => $idExpoParam];

					}
				
					ksort($listDate);
					foreach ($listDate as $dateExpo => $dataExpo ) {
						$class = '';
						if (isset($_SESSION['idExpo'])) {
							if ($_SESSION['idExpo'] == $dataExpo['id']) {
								$class = "link-active";
							}
						}
						echo '<li class="'.$class.'"><a href="../content/gestionPanel.php?expo='.$dataExpo['id'].'"><div>'.$dataExpo['titre'];
						echo '<br/>'.$dateExpo.'<br><span style="display:inline-block; width:100px; height:5px; font-size:16px; background-color:'.$dataExpo['couleur'].';"></span></div></a></li>';
						
					}



					//affichage de l'exposition la plus proche de la date du jour
					$class = '';
					if (isset($_SESSION['idExpo'])) {
						if ($_SESSION['idExpo'] == $closest->getidExpo()) {
							$class = "link-active";
						}
					}
					echo '<li class="closest '.$class.'"><a href="../content/gestionPanel.php?expo='.$idClosest.'"><div>'.$closest->getTitre();
					echo '<br/>'.$closest->getDateDeb().'<br><span style="display:inline-block; width:100px; height:5px; font-size:16px; background-color:'.$closest->getCouleurExpo().';"></span></div></a></li>';


					//affichage des expo suivant la date du jour
					$listNextExpo = $manager->nextExpo($idClosest); 
					$listDate = [];
					
					foreach ($listNextExpo as $exposition ) {
						$key = $exposition->getDateDeb();
						$value = $exposition->getTitre();
						$couleurExpo = $exposition->getCouleurExpo();
						$idExpoParam = $exposition->getIdExpo();
						$listDate[$key] = ['titre' => $value, 'couleur' => $couleurExpo, 'id' => $idExpoParam];

					}
				
					ksort($listDate);
					foreach ($listDate as $dateExpo => $dataExpo ) {
						$class = '';
						if (isset($_SESSION['idExpo'])) {
							if ($_SESSION['idExpo'] == $dataExpo['id']) {
								$class = "link-active";
							}
						}
						echo '<li class="'.$class.'"><a href="../content/gestionPanel.php?expo='.$dataExpo['id'].'"><div>'.$dataExpo['titre'];
						echo '<br/>'.$dateExpo.'<br><span style="display:inline-block; width:100px; height:5px; font-size:16px; background-color:'.$dataExpo['couleur'].';"></span></div></a></li>';
						
					}	





				}
				

				
				?>
			</div>		
			<div class="next"><i class="flecheVert ion-ios-arrow-down"></i></div>
			<div class="addLogo">
				<a class="add" href="#"><i class="ion-ios-plus-outline"></i></a>
				<div class="context-add">
					<span class="context-addExpo">+ Ajouter une Exposition</span>
					<span class="context-addArtiste">+ Ajouter un Artiste</span>
					<span class="context-addOeuvre">+ Ajouter une Oeuvre</span>
					<span class="context-addCollectif">+ Ajouter un Collectif</span>
					<span class="context-addType">Gérer les Types d'oeuvres</span>
				</div>
			</div>
		</div>
		<div class="next"><i class="flecheHor ion-ios-arrow-right"></i></div>
		
	</aside>