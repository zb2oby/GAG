<?php 
// require_once('functions.php');

//spl_autoload_register('loader');
// include('bdd/connectbdd.php');
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
  	<table>

	 	<thead>
	 		<tr>
	 			<th>Nom Oeuvre</th>
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
					$nomOeuvre = $oeuvre->getTitre();
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
					$status = 'Entrée : '.$dateEntree;
					if ($dateEntree == '0000-00-00' || $dateEntree == NULL) {
						$status = 'Non-reçue';
						if (($dateDebut - date('Y-m-d')) < 9 ) {
							$status = 'RETARD';
						}
					}

					$qr = $oeuvre->getQrcode();
					$nomArtiste = $artiste->getNom();

					echo '<tr>'
							.'<td>'.$nomOeuvre.'</td>'
							.'<td>'.$nomArtiste.'</td>'
							.'<td>'.$status.'</td>'
							.'<td>'.$idEmplacement.'</td>'
							.'<td><img src="../img/oeuvres/qrCode/'.$qr.'"></td>'
							.'<td>'.$commentaire.'</td>'
						.'</tr>';

				}


			 ?>

	 	</tbody>
	 </table>
 </div>
