<?php 
require('../includes/bdd/connectbdd.php');
require('../class/Utilisateur.class.php');
require('../class/UtilisateurManager.class.php');
require('../includes/functions.php');

$managerUser = new UtilisateurManager($bdd);
$msg = [];
$user = new Utilisateur(['idUser' => '', 'nom'=>'', 'prenom' =>'', 'identifiant' => '', 'mot_de_passe' => '', 'idTypeUtilisateur' => 2, 'email' => '', 'userState' => 0 ]);

	if (isset($_GET['nom'])) {
		$nom = htmlentities($_GET['nom']);
		$msg['nom'] = $user->setNom($nom);
	}
	if (isset($_GET['prenom'])) {
		$prenom = htmlentities($_GET['prenom']);
		$msg['prenom'] = $user->setPrenom($prenom);
	}
	if (isset($_GET['role'])) {
		$role = htmlentities($_GET['role']);
		$msg['role'] = $user->setIdTypeUtilisateur($role);
	}
	if (isset($_GET['identifiant'])) {
		$identifiant = htmlentities($_GET['identifiant']);
		$msg['identifiant'] = $user->setIdentifiant($identifiant);
	}
	if (isset($_GET['email'])) {
		$email = htmlentities($_GET['email']);
		$msg['email'] = $user->setEmail($email);
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
		if (isset($_GET['idUser']) && !empty($_GET['idUser'])) {
			$idUser = htmlentities($_GET['idUser']);
			$user->setIdUtilisateur($idUser);
			
			if (isset($_GET['req']) && $_GET['req'] == 'delUser') {
				$managerUser->deleteUtilisateur($user);
				$message['del'] = 'del';
				echo json_encode($message);
				exit();
			}else{
				$baseInfo = $managerUser->infoUtilisateur($idUser);
				$mdp = $baseInfo->getMot_de_passe();
				$user->setMot_de_passe($mdp);
				$managerUser->updateUtilisateur($user);
			}
		//si on a pas liduser on est dans un create. et comme ya pas derreur on procede a la creation
		}else{
			$mdp = uniqid();
			//hashage du mot de passe : 
			$mdpHash = sha1($mdp);
			$user->setMot_de_passe($mdpHash);
			$managerUser->addUtilisateur($user);
			$idUser = $managerUser->lastIdUser();
			//on envoir le mot de passe par mail au nouvel utilisateur cree
			$lastUser = $managerUser->infoUtilisateur($idUser);
			$email = $lastUser->getEmail();
			$identifiant = $lastUser->getIdentifiant();
			sendMdpMail($email, $identifiant, $mdp);

		}
		//puis in renvoie l'idUser pour le traitement de l'affihage dans le DOM via jquery
		$message['idUser'] = $idUser;
		echo json_encode($message);
	}

	
			
//}





