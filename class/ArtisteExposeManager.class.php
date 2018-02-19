<?php 

class ArtisteExposeManager {

	private $_db;

    public function __construct($db) {
        $this->setDb($db);
    }

    private function setDb($db) {
        $this->_db = $db;
    }

    public function addArtisteExpose(ArtisteExpose $artisteExpose) {
    	$q = $this->_db->prepare('INSERT INTO ArtisteExpose(idArtiste, idExpo) VALUES (:idArtiste, :idExpo)');
    	$q->bindValue(':idArtiste', $artisteExpose->getIdArtiste());
        $q->bindValue(':idExpo', $artisteExpose->getIdExpo());
       
        $q->execute();
    }

    public function deleteArtisteExpose(ArtisteExpose $artisteExpose) {
    	$q = $this->_db->exec('DELETE FROM ArtisteExpose WHERE idArtiste ='.$artisteExpose->getIdArtiste().' AND idExpo ='.$artisteExpose->getIdExpo());
    }

    public function updateArtisteExpose(ArtisteExpose $artisteExpose) {
        $q = $this->_db->prepare('UPDATE ArtisteExpose SET idArtiste = :idArtiste, idExpo = :idExpo WHERE idArtiste = :idArtiste AND idExpo = :idExpo');
        $q->bindValue(':idArtiste', $artisteExpose->getIdArtiste());
        $q->bindValue(':idExpo', $artisteExpose->getIsExpo());
       
        $q->execute();
    }

    public function listArtisteExpo($idExpo) {
        $list = [];
        $q = $this->_db->query("SELECT A.idArtiste, nom, prenom, tel, image, descriptifFR, email FROM Artiste A, ArtisteExpose E WHERE A.idArtiste = E.idArtiste AND idExpo ='".$idExpo."'");
        while ($data = $q->fetch()) {
            $list[] = new Artiste($data);
        }
        
        return $list;
    }

    public function artisteExpose($idArtisteExpose) {
        $q = $this->_db->query("SELECT * FROM ArtisteExpose WHERE idArtiste ='".$idArtisteExpose."'");
        $data = $q->fetch(); 
        $artisteExposee = new ArtisteExpose($data);
        return $artisteExposee;
    }

    

    

}