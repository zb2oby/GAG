<?php  
require_once('../class/MessageManager.class.php');
require_once('../class/Message.class.php');

require_once('../class/CollectifManager.class.php');
require_once('../class/Collectif.class.php');

require_once('../class/UtilisateurManager.class.php');
require_once('../class/Utilisateur.class.php');

require_once('../includes/bdd/connectbdd.php');

$managerColl = new CollectifManager($bdd);

//traitement de la creation a la volée d'un collectif depuis le bouton + du menu de nav
if (isset($_GET['createColl']) && $_GET['createColl'] == 'create') {
	$collectif = new Collectif(['libelleCollectif' => '']);
	$managerColl->addCollectif($collectif);
	$lastIdColl = $managerColl->getLastIdCollectif();
	echo $lastIdColl;
}



//traitement des enregistrement d'info collectif sur le popCollectif
if (isset($_GET['idCollectif'])) {
	$idCollectif = $_GET['idCollectif'];
	$collectif = $managerColl->infoCollectif($idCollectif);

	if (isset($_GET['libelle'])) {
		$libelle = htmlentities($_GET['libelle']);
		$collectif->setLibelleCollectif($libelle);
	}
	if (isset($_GET['email'])) {
		$email = htmlentities($_GET['email']);
		$collectif->setEmail($email);
	}
	if (isset($_GET['tel'])) {
		$tel = htmlentities($_GET['tel']);
		$collectif->setTel($tel);
	}
	if (isset($_GET['descriptif'])) {
		$descriptif = htmlentities($_GET['descriptif']);
		$collectif->setDescriptifFR($descriptif);
	}

	//GESTION DES MESSAGES
	if (isset($_GET['message'], $_GET['dateMsg'], $_GET['idUser'])) {
		$contenu = htmlentities($_GET['message']);
		$dateMsg = htmlentities($_GET['dateMsg']);
		$idUser = htmlentities($_GET['idUser']);
		$manager = new MessageManager($bdd);
		$message = new Message(['dateMessage'=>$dateMsg, 'message'=>$contenu, 'idUtilisateur'=>$idUser, 'idCollectif'=>$idCollectif]);
		$manager->addMessageCollectif($message);
	}
	//SUPRESSION COLLECTIF
	if (isset($_GET['req']) && $_GET['req'] == 'delete') {
			$managerColl->deleteCollectif($collectif);
			echo 'supression ok';
	}

	$managerColl->updateCollectif($collectif);
	
}


//TRAITEMENT SUPPRESSION MESSAGE 
if (isset($_GET['idMessage'])) {
	$idMessage = htmlentities($_GET['idMessage']);
	$managerMsg = new MessageManager($bdd);
	$message = new Message(['idMessage'=>$idMessage]);
	$managerMsg->deleteMessage($message);	
}
?>