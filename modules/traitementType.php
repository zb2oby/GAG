<?php 
require('../includes/bdd/connectbdd.php');
require_once('../class/OeuvreManager.class.php');
require('../includes/functions.php');

$managerOeuvre = new OeuvreManager($bdd);
$msg = [];
// $user = new Utilisateur(['idUser' => '', 'nom'=>'', 'prenom' =>'', 'identifiant' => '', 'mot_de_passe' => '', 'idTypeUtilisateur' => 2, 'email' => '', 'userState' => 0 ]);

	if (isset($_GET['libelle'])) {
		$libelle = htmlentities($_GET['libelle']);
		if (strlen($_GET['libelle']) > 50) {
			$msg['libelle'] = 'libelle trop long';
		}	
	}

	//on verifie les valeur nulles de msg et on creer un nouveau tableau avec seulement les valeurs retour des methode qui ne nsont pas nulles.
	foreach ($msg as $key => $value) {
		if ($value != null) {
			$message[$key] = $value;
		}
	}
	//on reteste la validité de ce nouveau tableau et on l'envoie en json pour traitement ajax
	if (!empty($message) && $message != null) {
			$message['error'] = 'error';
			echo json_encode($message);
			//comme le tableau est plein c'est qu'il y a erreur donc on ne continue pas le script de mise à jour
			exit();
	//si pas d'erreur on traite la suite
	}else{
		//si on a liduser on est soit dans un delete soit dans un update
		if (isset($_GET['idType']) && !empty($_GET['idType'])) {
			$idType = htmlentities($_GET['idType']);
			
			if (isset($_GET['req']) && $_GET['req'] == 'delType') {
				$managerOeuvre->delType($idType);
				$message['del'] = 'del';
				echo json_encode($message);
				exit();
			}else{
				$managerOeuvre->updateType($libelle, $idType);
			}
		//si on a pas liduser on est dans un create. et comme ya pas derreur on procede a la creation
		}else{
			
			$managerOeuvre->addType($libelle);
			$idType = $managerOeuvre->lastIdType();
			
		}
		//puis in renvoie l'idUser pour le traitement de l'affihage dans le DOM via jquery
		$message['idType'] = $idType;
		echo json_encode($message);
	}

	
			
//}





