</div>	
	<aside class="sideBar">
		<div class="prev"><i class="flecheHor ion-ios-arrow-left"></i></div>
		<div class="sideMenu">
			<div class="searchLogo"><a class="search" href="#"><i class="ion-ios-search"></i><!-- <img src="../search.png" alt=""> --></a></div>
			<div class="prev"><i class="flecheVert ion-ios-arrow-up"></i></div>
			<div class="multiple-items">
				<!-- <li><a href="#">EXPO  --><?php 
				$manager = new ExpositionManager($bdd);
				$listPrevExpo = $manager->prevExpo();  
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
					echo '<li><a href="../content/gestionPanel.php?expo='.$dataExpo['id'].'"><div>'.$dataExpo['titre'];
					echo '<br/>'.$dateExpo.'<br><span style="display:inline-block; width:100px; height:5px; font-size:16px; background-color:'.$dataExpo['couleur'].';"></span></div></a></li>';
					
				}	
				?>
			</div>		
			<div class="next"><i class="flecheVert ion-ios-arrow-down"></i></div>
			<div class="addLogo">
				<a class="add" href="#"><i class="ion-ios-plus-outline"></i></a>
			</div>
		</div>
		<div class="next"><i class="flecheHor ion-ios-arrow-right"></i></div>
	</aside>