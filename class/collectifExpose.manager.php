<?php 

class CollectifExposeManager {
	
	private $_db;

	 public function __construct($db) {
        $this->setDb($db);
    }

    private function setDb($db) {
        $this->_db = $db;
    }

    function addCollectifExpose(CollectifExpose $collectifExpose) {

    	$q=$this->_db->prepare("INSERT INTO CollectifExpose (idExpo, idCollectif) VALUES (:idExpo, :idCollectif)");
    	$q->bindValue(':idExpo', $collectifExpose->getIdExpo());
    	$q->bindValue(':idCollectifExpose', $collectifExpose->getIdCollectifExpose());
    	$q->execute();
    }

    function deleteCollectifExpose(CollectifExpose $collectifExpose) {
    	$q=$this->_db->exec("DELETE FROM CollectifExpose WHERE idCollectifExpose ='".$collectifExpose->getIdCollectifExpose()."'");
    }

    function updateCollectifExpose(CollectifExpose $collectifExpose) {
    	$q=$this->_db->prepare("UPDATE CollectifExpose SET idExpo = :idExpo WHERE idCollectif = :idCollectif");
    	$q->bindValue(':idExpo', $collectifExpose->getIdExpo());
    	$q->bindValue(':idCollectifExpose', $collectifExpose->getIdCollectifExpose());
    	$q->execute();
    }

    function collectifExpose_exist($idExpo) {
    	$q=$this->_db->query("SELECT idCollectif FROM CollectifExpose WHERE idExpo ='".$idExpo."'");
    	$count = $q->rowCount();
    	if ( $count != 0 ) {
            $data = $q->fetch();
    		$idCollectif = $data['idCollectif'];
    		return $idCollectif;
    	}else {
    		return false;
    	}
    }

}