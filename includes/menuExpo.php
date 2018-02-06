</div>
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
				$listPrevExpo = $manager->prevExpo();	
				$listDate = [];
				//affichage des expo précédent la date du jour
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
				$listNextExpo = $manager->nextExpo(); 
				$listDate = [];
				//affichage des expo suivant la date du jour
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
				</div>
			</div>
		</div>
		<div class="next"><i class="flecheHor ion-ios-arrow-right"></i></div>
		
	</aside>