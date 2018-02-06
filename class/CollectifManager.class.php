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
    	$q=$this->_db->prepare("INSERT INTO Collectif(libelleCollectif, descriptifFR, email, tel) VALUES (:libelleCollectif, :descriptifFR, :email, :tel)");
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
    	$q=$this->_db->prepare("UPDATE Collectif SET libelleCollectif = :libelleCollectif, descriptifFR = :descriptifFR, email = :email, tel = :tel WHERE idCollectif = :idCollectif");
    	$q->bindValue(':idCollectif', $collectif->getIdCollectif());
    	$q->bindValue(':libelleCollectif', $collectif->getLibelleCollectif());
    	$q->bindValue(':descriptifFR', $collectif->getDescriptifFR());
    	$q->bindValue(':email', $collectif->getEmail());
    	$q->bindValue(':tel', $collectif->getTel());

    	$q->execute();

    }

    public function listCollectif() {
        $list = [];
        $q=$this->_db->query("SELECT * FROM Collectif");
        while ($data = $q->fetch()) {
           $list[] = new Collectif($data);
        }
        return $list;
    }

    public function infoCollectif($idCollectif) {
        $q = $this->_db->prepare("SELECT * FROM Collectif WHERE idCollectif = :idCollectif");
        $q->bindValue(':idCollectif', $idCollectif);
        $q->execute();
        $count = $q->rowCount();
        $expo = false;
        if ($count != 0) {
            $data = $q->fetch();
            $expo = new Collectif($data);
            
        }
        return $expo;
    }

    //retourne l'id du dernier collectif cree
    public function getLastIdCollectif() {
        $q = $this->_db->query("SELECT MAX(idCollectif) AS idCollectif FROM Collectif");
        $data = $q->fetch();
        return $data['idCollectif'];
    }

    //retourne une liste de resultat en fonction d'une recherche demandée
    public function getSearch($saisie) {
        $list = [];
        $q = $this->_db->query("SELECT * FROM Collectif WHERE libelleCollectif LIKE '%".$saisie."%' OR email LIKE '%".$saisie."%' OR tel LIKE '%".$saisie."%'");
        while ($data = $q->fetch()) {
            $list[] = $data;
        }

        return $list;
    }

}