<?php

class CollectifManager {

	private $_db;

	 public function __construct($db) {
        $this->setDb($db);
    }

    private function setDb($db) {
        $this->_db = $db;
    }

    function addCollectif(Collectif $collectif) {
    	$q=$this->_db->prepare("INSERT INTO Collectif(idCollectif, libelleCollectif, descriptifFR, email, tel) VALUES (:idCollectif, :libelleCollectif, :descriptifFR, :email, :tel)");
    	$q->bindValue(':idCollectif', $collectif->getIdCollectif());
    	$q->bindValue(':libelleCollectif', $collectif->getLibelleCollectif());
    	$q->bindValue(':descriptifFR', $collectif->getDescriptifFR());
    	$q->bindValue(':email', $collectif->getEmail());
    	$q->bindValue(':tel', $collectif->getTel());

    	$q->execute();
    }

    function deleteCollectif(Collectif $collectif) {
    	$q=$this->_db->exec("DELETE FROM Collectif WHERE idCollectif ='".$collectif->getIdCollectif()."'");
    }

    function updateCollectif(Collectif $collectif) {
    	$q=$this->_db->prepare("UPDATE Collectif SET idCollectif = :IdCollectif, libelleCollectif = :libelleCollectif, descriptifFR = :descriptifFR, email = :email, tel = :tel WHERE idCollectif = :idCollectif");
    	$q->bindValue(':idCollectif', $collectif->getIdCollectif());
    	$q->bindValue(':libelleCollectif', $collectif->getLibelleCollectif());
    	$q->bindValue(':descriptifFR', $collectif->getDescriptifFR());
    	$q->bindValue(':email', $collectif->getEmail());
    	$q->bindValue(':tel', $collectif->getTel());

    	$q->execute();

    }

    public function infoCollectif($idCollectif) {
        $q = $this->_db->prepare("SELECT * FROM Collectif WHERE idCollectif = :idCollectif");
        $q->bindValue(':idCollectif', $idCollectif);
        $q->execute();
        $data = $q->fetch();
        $expo = new Collectif($data);
        return $expo;
    }


}