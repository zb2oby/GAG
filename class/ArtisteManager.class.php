<?php 

class ArtisteManager {

	private $_db;

    public function __construct($db) {
        $this->setDb($db);
    }

    private function setDb($db) {
        $this->_db = $db;
    }

    public function addArtiste(Artiste $artiste) {
    	$q = $this->_db->prepare('INSERT INTO Artiste(nom, prenom, tel, image, descriptifFR, email) VALUES (:nom, :prenom, :tel, :image, :descriptifFR, :email)');
    	$q->bindValue(':nom', $artiste->getNom());
        $q->bindValue(':prenom', $artiste->getPrenom());
        $q->bindValue(':tel', $artiste->getTel());
        $q->bindValue(':image', $artiste->getImage());
        $q->bindValue(':descriptifFR', $artiste->getDescriptifFR());
        $q->bindValue(':email', $artiste->getEmail());

        $q->execute();
    }

    public function deleteArtiste(Artiste $artiste) {
    	$q = $this->_db->exec('DELETE FROM Artiste WHERE idArtiste ='.$artiste->getIdArtiste());
    }

    public function updateArtiste(Artiste $artiste) {
        $q = $this->_db->prepare('UPDATE Artiste SET nom = :nom, prenom = :prenom, tel = :tel, image = :image, descriptifFR = :descriptifFR, email = :email WHERE idArtiste = :idArtiste');
        $q->bindValue(':nom', $artiste->getNom());
        $q->bindValue(':prenom', $artiste->getPrenom());
        $q->bindValue(':tel', $artiste->getTel());
        $q->bindValue(':image', $artiste->getImage());
        $q->bindValue(':descriptifFR', $artiste->getDescriptifFR());
        $q->bindValue(':email', $artiste->getEmail());
        $q->bindValue(':idArtiste', $artiste->getIdArtiste());

        $q->execute();
    }

    public function listArtiste() {
        $list = [];
        $q=$this->_db->query("SELECT * FROM Artiste");
        while ($data = $q->fetch()) {
           $list[] = new Artiste($data);
        }
        return $list;
    }

    public function listArtisteCollectif($idExpo) {
        $list = [];
        $q = $this->_db->query("SELECT A.idArtiste, nom, prenom, A.tel, image, A.descriptifFR, A.email FROM Artiste A, Communaute C, Collectif CO, CollectifExpose E WHERE C.idArtiste = A.idArtiste AND C.idCollectif = CO.idCollectif AND CO.idCollectif = E.idCollectif AND E.idExpo = '".$idExpo."'");
        $count = $q->rowCount();
        if ($count != 0) {
            while ($data = $q->fetch()) {
            $list[] = new Artiste($data);
            }
            
            return $list;
        }else {
            return false;
        }
        
    }

    public function infoArtiste($idArtiste) {
        $q = $this->_db->query("SELECT idArtiste, nom, prenom, tel, image, descriptifFR, email FROM Artiste WHERE idArtiste = '".$idArtiste."'");
        $data = $q->fetch();
        $artiste = new Artiste($data);
        return $artiste;
    }

    public function getIdsCollectifs($idArtiste) {
        $list = [];
        $q=$this->_db->query("SELECT idCollectif FROM Communaute WHERE idArtiste =".$idArtiste);
        while ($data = $q->fetch()) {
            $list[] = $data['idCollectif'];
        }
        return $list;
    }

    public function deleteCollectifArtiste($idArtiste, $idCollectif) {
        $q=$this->_db->exec("DELETE FROM Communaute WHERE idCollectif = ".$idCollectif." AND idArtiste =".$idArtiste);
    }

    public function setCollectifArtiste($idArtiste, $idCollectif) {
        $q=$this->_db->exec("INSERT INTO Communaute(idArtiste, idCollectif) VALUES (".$idArtiste.", ".$idCollectif.")");
    }

    public function listOeuvresArtiste($idArtiste) {
        $list = [];
        $q=$this->_db->query("SELECT * FROM Oeuvre WHERE idArtiste =".$idArtiste);
        while ($data = $q->fetch()) {
            $list[] = new Oeuvre($data);
        }
        return $list;
    }

}