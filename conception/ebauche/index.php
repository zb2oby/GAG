<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Untitled</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/ionicons.min.css">
        <!-- <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    </head>
    <body>

    <div class="container">	
	
		<header>
        	<a class="avatar deco" href="">F<i class="ion-log-out"></i></a>

        	<div class="expoInfo">
        		<h2>Exposition : Blanc de Blanc</h2>
        		<span>Collectif : Bamako</span>
        	</div>
        	<div class="timeLine">
        		<ul>
        			<li><span>Aujourd'hui : </span><a href="" class="button date">25/12/2017</a></li>
        			<li><span>Date Expo : </span>21/08/2018</li>
        			<li><span>Inauguration dans : </span> 10 Jours</li>
        		</ul>
        	</div>
    	</header>
		
    	<div class="content">
			<div class="onglet <?php if (isset($_GET['onglet']) && $_GET['onglet'] == 'gestion') {
	        	echo 'onglet-actif';
	        } ?>" id="gestion">
	        	<div class="onglet-title">
	        		Gestion
	        	</div>
	        	<div class="onglet-content">
	        		<section class="list artistes">
	        			<div class="cards">
	        				<h4>Artistes présents</h4>
	        				<a href=""><div class="addCard">+</div></a>
	        				<div class="contain-cards">
		        				<ul>
		        					<li><img src="http://via.placeholder.com/40X40" alt=""><span>Mbala</span><span>Sculpteur</span></li>
		        					<li><img src="http://via.placeholder.com/40X40" alt=""><span>Toto</span><span>Peintre</span></li>
		        				</ul>
		        			</div>
	        			</div>
	        		</section>
	        		<section class="list oeuvres">
	        			<div class="cards">
	        				<h4>Oeuvres prévues</h4>
	        				<a href=""><div class="addCard">+</div></a>
	        				<div class="contain-cards">
		        				<ul>
		        					<li></li>
		        					<li></li>
		        					<li></li>
		        					<li></li>
		        					<li></li>
		        					<li></li>
		        					<li></li>
		        				</ul>
		        			</div>
	        			</div>
	        		</section>
	        		<section class="list recues">
	        			<div class="cards">
	        				<h4>Oeuvres reçues</h4>
	        				<a href=""><div class="addCard">+</div></a>
	        				<div class="contain-cards">
		        				<ul>
		        					<li></li>
		        					<li></li>
		        					<li></li>
		        					<li></li>
		        					<li></li>
		        					<li></li>
		        					<li></li>
		        				</ul>
		        			</div>
	        			</div>
	        		</section>
	        		
					<div class="plan">
						<img src="img/plan.png" alt="plan">
					</div>
					
	        	</div>
	        </div>
	        <div class="onglet <?php if (isset($_GET['onglet']) && $_GET['onglet'] == 'expo') {
	        	echo 'onglet-actif';
	        } ?>" id="expo">
	        	<div class="onglet-title">
	        		Expo
	        	</div>
	        	<div class="onglet-content">
	        		<form action="#" method="GET">
	        			<label for="nom">Nom expo</label>
	        			<input type="text" name="nom" id="nom"><br>
	        			<label for="date">Date expo</label>
	        			<input type="text" name="dateExpo" id="dateExpo"><br>
	        			<input type="hidden" name="onglet" value="expo">
	        			<input type="submit" value="enregistrer">
	        			<input type="submit" value="Modifier">
	        			<input type="submit" value="Supprimer">
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
		        				<img src="img/stat.jpg" alt="stat1">
		        			</div>
		        			<div class="explain">
		        				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem iure voluptates, exercitationem mollitia placeat quod aliquam nesciunt quasi culpa illum, nulla reiciendis neque consectetur debitis ratione ducimus voluptatem minima error sequi sit! Non dicta, sapiente facere modi voluptates possimus id laborum eius cum rem tempore in sed voluptatum et ducimus magni iusto mollitia fuga suscipit quam alias reprehenderit earum. Excepturi dolorem, nihil perferendis. Accusantium consectetur sequi recusandae, consequatur modi nemo maxime aliquid ratione odit sapiente id, deleniti, at perferendis autem sit distinctio quam placeat! Magni blanditiis nisi, voluptates hic accusamus sit id incidunt cumque rem, eius suscipit saepe mollitia! Suscipit.
		        			</div>
		        		</div>
		        		<div class="stat">
		        			<div class="imgStat">
		        				<img src="img/stat2.jpg" alt="stat1">
		        			</div>
		        			<div class="explain">
		        				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat fuga perspiciatis ex ea. Cum laborum consequuntur suscipit eligendi omnis saepe commodi itaque repellendus aperiam iste nam earum, repellat ea, laboriosam est animi soluta sint tempore minima a? Excepturi nesciunt sapiente molestiae, consectetur sequi maxime sit adipisci nulla iste, vitae vero sint hic ipsa magni voluptatum rerum temporibus incidunt vel soluta non quisquam nobis dignissimos. Suscipit dicta veritatis velit quos consequuntur accusantium quaerat? Repellendus sint neque eius enim voluptatem quisquam soluta omnis iusto reiciendis debitis facere necessitatibus excepturi porro consectetur hic modi ullam id minus, perspiciatis consequuntur voluptatibus illo deserunt?
		        			</div>
		        		</div>
		        	</div>
	        	</div>
	        </div>
	        <div class="onglet <?php if (isset($_GET['onglet']) && $_GET['onglet'] == 'admin') {
	        	echo 'onglet-actif';
	        } ?>" id="admin">
	        	<div class="onglet-title">
	        		Admin	
	        	</div>
	        	<div class="onglet-content">
	        		<form action="#" id="submit-admin" method="GET">
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
	        </div>
	    </div>

		<!-- <div class="down-content">
			<div class="plan">
				<img src="http://via.placeholder.com/700X250" alt="plan">
			</div>
		</div> -->

	</div>
	<aside class="sideBar">
		
		<a href=""><i class="flecheHor ion-ios-arrow-left"></i></a>
		<div class="sideMenu">
			<div class="searchLogo"><a class="search" href="#"><i class="ion-ios-search"></i><!-- <img src="../search.png" alt=""> --></a></div>
			<a href=""><i class="flecheVert ion-ios-arrow-up"></i></a>
			
			<ul>
				<li><a href="#">EXPO 01/07/17</a></li>
				<li><a href="#">EXPO 10/08/17</a></li>
				<li><a class="active-expo" href="#">EXPO 21/08/18</a></li>
				<li><a href="#">EXPO 25/12/17</a></li>
			</ul>		
			<a href=""><i class="flecheVert ion-ios-arrow-down"></i></a>
			<div class="addLogo">
				<a class="add" href="#"><i class="ion-ios-plus-outline"></i></a>
			</div>
		</div>
		
		<a href=""><i class="flecheHor ion-ios-arrow-right"></i></a>
	</aside>

	<div class="menu-portrait">
		<div class="searchMenu"><a class="search" href="#"><i class="ion-ios-search"></i></a></div>
		<div class="addMenu"><a class="add" href="#"><i class="ion-ios-plus-outline"></i></a></div>
	</div>

		
		<script src="js/jquery-min-3.2.1.js"></script>
  		<script src="js/script.js"></script>
    </body>
</html>