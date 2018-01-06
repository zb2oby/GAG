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

}