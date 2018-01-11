</div>	




<script src="../js/lib/slick/slick.js"></script>
	<aside class="sideBar">
		
		<a href=""><i class="flecheHor ion-ios-arrow-left"></i></a>
		<div class="sideMenu">
			<div class="searchLogo"><a class="search" href="#"><i class="ion-ios-search"></i><!-- <img src="../search.png" alt=""> --></a></div>
			<a href=""><i class="flecheVert ion-ios-arrow-up"></i></a>

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
					echo '<br/>'.$dateExpo.'</a></li></div>';
				}	
				?><!-- </a></li> -->
				<!-- <li><a href="#">EXPO 10/08/17</a></li>
				<li><a class="active-expo" href="#">EXPO 21/08/18</a></li>
				<li><a href="#">EXPO 25/12/17</a></li> -->
			</div>		
			<a href=""><i class="flecheVert ion-ios-arrow-down"></i></a>
			<div class="addLogo">
				<a class="add" href="#"><i class="ion-ios-plus-outline"></i></a>
			</div>
		</div>
		<a href=""><i class="flecheHor ion-ios-arrow-right"></i></a>
	</aside>