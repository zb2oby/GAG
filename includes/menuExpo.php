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
					$listDate[$key] = $value;
				}
				ksort($listDate);
				foreach ($listDate as $dateExpo => $titreExpo) {
					// class = '';
					// $managerExpo = new managerExpo
					// $expoOuverte = managerexposition-getexpo(idexpo)
					// if expoouverte-gettitre = titreExpo
					// 	class = active;
					echo '<li><a href="#"><div>'.$titreExpo;
					echo '<br/>'.$dateExpo.'</div></a></li>';
				}	
				?><!-- </a></li> -->
				<!-- <li><a href="#">EXPO 10/08/17</a></li>
				<li><a class="active-expo" href="#">EXPO 21/08/18</a></li>
				<li><a href="#">EXPO 25/12/17</a></li> -->
			</div>		
			<div class="next"><i class="flecheVert ion-ios-arrow-down"></i></div>
			<div class="addLogo">
				<a class="add" href="#"><i class="ion-ios-plus-outline"></i></a>
			</div>
		</div>
		<div class="next"><i class="flecheHor ion-ios-arrow-right"></i></div>
	</aside>