<!-- 
			<?php 

			$idExpo = ;

			$managerlangue = new ExpositionManager($bdd);
			$listlangueExpo = $managerlangue->getIdLangueExpo($idExpo);
			foreach ($listlangueExpo as $idLangue): 
		?><div class="reponse"><?php
				echo '<a href="accueil.php?langue='.$idLangue.'"><img src="drapeau/drapeau'.$idLangue.'.jpg">';
				?>
		
	</div>
		<?php endforeach ?>

			$managerOeuvreExpo = new OeuvreExposeeManager($bdd);
			$listOeuvreExpo = $managerOeuvreExpo->ListOeuvresPrevues($exposition);
			?>  -->