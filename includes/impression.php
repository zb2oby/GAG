<?php 
$managerExpo = new ExpositionManager($bdd);
$managerOeuvreExpo = new OeuvreExposeeManager($bdd);
$managerOeuvre = new OeuvreManager($bdd);
$managerArtiste = new ArtisteManager($bdd);
$managerArtisteExpo = new ArtisteExposeManager($bdd);
$managerPlace = new EmplacementManager($bdd);

//AFFICHAGE DUN TABLEAU CONTENANT LA LISTE DES OEUVRES
//ENTETE : NOM EXPO DATEDEBUT DATEFIN
//CHAMPS : NOMOEUVRE/NOMARTISTE/ETAT(PREVUE/RECUE/RETARD)/EMPLACEMENT/QRCODE
//PLAN : ??



 ?>
 <div class="impression">
 	<span class="titresImpression">Liste des oeuvres</span>
  	<table>

	 	<thead>
	 		<tr>
	 			<th>Oeuvre</th>
	 			<th>Artiste</th>
	 			<th>Status</th>
	 			<th>Emplacement</th>
	 			<th>QrCode</th>
	 			<th>Commentaire</th>
	 		</tr>
	 	</thead>
	 	<tbody>
			<?php 
				$listOeuvreExposee = $managerOeuvreExpo->ListOeuvresExposees($idExpo);
				foreach ($listOeuvreExposee as $oeuvre) {
					$nomOeuvre = ucfirst($oeuvre->getTitre());
					$image = $oeuvre->getImage();
					$idArtiste = $oeuvre->getIdArtiste();
					$artiste = $managerArtiste->infoArtiste($idArtiste);
					$idOeuvre = $oeuvre->getIdOeuvre();
					$idOeuvreExposee = $managerOeuvreExpo->idExposee($idOeuvre, $idExpo);
					$oeuvreExposee = $managerOeuvreExpo->oeuvreexposee($idOeuvreExposee);

					$emplacement = $managerPlace->getEmplacementOeuvre($idOeuvreExposee, $idExpo);
					if ($emplacement) {
						$idEmplacement = $emplacement->getIdEmplacement();
					}else {
						$idEmplacement = 'non placée';
					}
					

					$dateEntree = $oeuvreExposee->getDateEntree();

					$exposition = $managerExpo->infoExpo($idExpo);
					$dateDebut = $exposition->getDateDeb();

					$commentaire = '';
					//(SI DATE ENTREE EST NULLE ALORS STATUS = PREVU SINON RECU PREVOIR RETARD)
					$status = 'Entrée : <br>'.date('d-m-Y', strtotime($dateEntree));
					if ($dateEntree == '0000-00-00' || $dateEntree == NULL) {
						$status = 'Non-reçue';
						if (($dateDebut - date('Y-m-d')) < 9 ) {
							$status = 'RETARD';
						}
					}

					$qr = $oeuvre->getQrcode();
					$nomArtiste = $artiste->getNom();

					echo '<tr class="page-break">'
							.'<td>'.$nomOeuvre.'<br><img style="width:50px; height:50px;" src="../img/oeuvres/'.$image.'"></td>'
							.'<td>'.$nomArtiste.'</td>'
							.'<td>'.$status.'</td>'
							.'<td>'.$idEmplacement.'</td>'
							.'<td><img style="width:100px; height:100px;" src="../img/oeuvres/qrCode/'.$qr.'"></td>'
							.'<td>'.$commentaire.'</td>'
						.'</tr>';

				}


			 ?>

	 	</tbody>
	 </table>
	 <div class="imprPlan">
	 <span class="titresImpression">PLAN DE L'EXPO</span>
	 
	 <?php include('../includes/plan.php') ?>
	 </div>
 </div>
