<?php

//FONCTION PRINCIPALE DU CALENDRIER
function calendrier($m_donne,$a_donne){
	include('../includes/bdd/connectbdd.php');
	require('../class/ExpositionManager.class.php');
	require('../class/Exposition.class.php');

	include("config.php");
	// $m = 02;
	// $a = 2018;
	// On récupère le mois et l'année dans la barre de navigation

	if (isset($_GET['m'], $_GET['a'])) {
		$m = intval($_GET['m']);
		$a = intval($_GET['a']);
	}else {
		$m = $m_donne; 
		$a = $a_donne;
	}
	

	// Si rien n'est spécifié, cela veut dire qu'il faut afficher le mois et l'année donnés par la fonction
	

	// Calcul du nombre de jours dans chaque mois en prenant compte des années bisextiles. les tableaux PHP commençant à 0 et non à 1, le premier mois est un mois "factice"
	if (($a % 4) == 0){
		$nbrjour = array(0, 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	}else{
		$nbrjour = array(0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	}
	$CAL_FRENCH = 0;
	// On cherche grâce à cette fonction à quel jour de la semaine correspond le 1er du mois 
	$premierdumois = jddayofweek(cal_to_jd($CAL_FRENCH, $m, 1, $a), 0);
	if($premierdumois == 0){
		$premierdumois = 7;
	}

	//Préparation du tableau avec le nom du mois et la liste des jours de la semaine
	echo "<table border=1 bordercolor=\"#FFFFFF\"><tr><td class=\"fleches\">"
		.mois_precedent($m,$mois[$m],$a)
		."</td><td class=\"nom_mois\" colspan=\"5\">$mois[$m] $a</td><td class=\"fleches\">"
		.mois_suivant($m,$a)
		."</td></tr><tr class=\"noms_jours\">"
		."<td>$jours[1]</td><td>$jours[2]</td><td>$jours[3]</td><td>$jours[4]</td><td>$jours[5]</td><td>$jours[6]</td><td>$jours[7]</td></tr><tr>";

	$timeStamp = mktime(0,0,0,date('n'), date('d'), date('Y'));
	$jour=1;	//Cette variable est celle qui va afficher les jours de la semaine
	$joursmoisavant = $nbrjour[$m-1] - $premierdumois+2;		//Celle-ci sert à afficher les jours du mois précédent qui apparaissent
	$jourmoissuivant = 1; //Et celle-ci les jours du mois suivant
	if($m == 1){
		$joursmoisavant = $nbrjour[$m+11] - $premierdumois+2; //Si c'est janvier, le mois d'avant n'est pas à 0 mais 31 jours!
	}


//=====> ici on va pouvoir creer une classe expo et un lien


	//Et c'est parti pour la boucle for qui va créer l'affichage de notre calendrier !
	for($i=1;$i<40;$i++){		
		if($i < $premierdumois){	// Tant que la variable i ne correspond pas au premier jour du mois, on fait des cellules de tableau avec les derniers jours du mois précédent
		echo "<td class=\"cases_vides\">$joursmoisavant</td>";
		$joursmoisavant++;
		}else{
			$today = '';
			$tsBoucle = mktime(0,0,0,$m,$jour,$a);
			// var_dump($tsBoucle);
			// var_dump($timeStamp);
			// exit;
			if($tsBoucle == $timeStamp){ 	//Si la variable $jour correspond à la date d'aujourd'hui, la case est d'une couleur différente
				echo "<td class=\"aujourdhui\">$jour</td>";
				$today = 'yes';
			}
			//si la variable corrspond a un jour d'expo on colore avec la classe jourExpo
			$managerExpo = new ExpositionManager($bdd);
			$listExpo = $managerExpo->listExpo();
			foreach ($listExpo as $exposition) {
				$dateDeb = strtotime($exposition->getDateDeb());
				$dateFin = strtotime($exposition->getDateFin());
				$titre = $exposition->getTitre();
				$lienExpo = '../content/gestionPanel.php?idExpo='.$exposition->getIdExpo();
				
					
				//si le jour testé est compris dans la plage de jour de l'expo on ajoute la classe expo
				if ($tsBoucle >= $dateDeb && $tsBoucle <= $dateFin) {
					echo "<td class=\"jourExpo\"><a href=\"$lienExpo\">$jour<br>$titre</a></td>";
					$today = 'expo';
					
				}
				
			}

			//si la variable n'est ni aujourdhui ni un jjour dexpo on colore avec la classe par defaut
			if ($today != 'expo' && $today != 'yes') {
				echo '<td class="jours">'.$jour.'</td>';
			}



			// else{
			// 	echo '<td class="jours">'.$jour.'</td>';
			// }	

			$jour++;	//On passe au lendemain ^^
		
			/*Si la variable $jour est plus élevée que le nombre de jours du mois,  c'est que c'est la fin du mois! 
			    On remplit les cases vides avec les premiers jours des mois suivants
			    Hop on ferme le tableau, 
			    et on met la variable $i à 41 pour sortir de la boucle */
			if($jour > ($nbrjour[$m])){
				while($i % 7 != 0){
					echo "<td class=\"cases_vides\">$jourmoissuivant</td>";
					$i++;
					$jourmoissuivant++;
				}
			echo "</tr></table>";
			$i=41;
			}
		}
	
		// Si la variable i correspond à un dimanche (multiple de 7), on passe à la ligne suivante dans le tableau
		if($i % 7 == 0){
			echo "</tr><tr>";
		}

	}

}

//FONCTION POUR AFFICHER LE MOINS SUIVANT
function mois_suivant($m,$a){
	$m++;	//mois suivant, donc on incrémente de 1
	if($m==13){	//si le mois et 13 ça joue pas! cela veut dire qu'il faut augmenter l'année de 1 et repasser le mois à 1
		$a++;
		$m=1;
	}
	return '<a href="'.$_SERVER['PHP_SELF']."?m=$m&a=$a\"> &raquo; </a>";
}

//FONCTION POUR AFFICHER LE MOINS PRECEDENT
function mois_precedent($m,$mois,$a){
	$m--;
	if($m==0){
		$a--;
		$m=12;
	}
	return '<a href="'.$_SERVER['PHP_SELF']."?m=$m&a=$a\"> &laquo; </a>";
}
?>