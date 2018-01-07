<?php 

class ExpositionManager {

	private $_db;

	 public function __construct($db) {
        $this->setDb($db);
    }

    private function setDb($db) {
        $this->_db = $db;
    }

    public function addExposition(Exposition $exposition) {
    	$q = $this->_db->prepare('INSERT INTO Exposition(idExpo, titre, horaireO, horaireF, theme, descriptifFR, frequentation, dateDeb, dateFin, teaser, affiche) VALUES (:titre, :longueur, :hauteur, :etat, :image, :qrcode, :descriptifFR, :idTypeOeuvre, :idArtiste, :idCollectif)');
        $q->bindValue(':idExpo', $exposition->getIdExpo());
        $q->bindValue(':titre', $exposition->getTitre());
    	$q->bindValue(':horaireO', $exposition->getLongueur());
        $q->bindValue(':horaireF', $exposition->getHauteur());
        $q->bindValue(':theme', $exposition->getEtat());
        $q->bindValue(':descriptifFR', $exposition->getDescriptifFR());
        $q->bindValue(':frequentation', $exposition->getFrequentation());
        $q->bindValue(':dateDeb', $exposition->getDateDeb());
        $q->bindValue(':dateFin', $exposition->getdateFin());
        $q->bindValue(':teaser', $exposition->getTeaser());
        $q->bindValue(':affiche', $exposition->getAffiche());

        $q->execute();
    }

    public function deleteExposition(Exposition $exposition) {
    	$q = $this->_db->exec('DELETE FROM Exposition WHERE idExpo ='.$exposition->getIdExpo());
    }

    public function updateExposition(Exposition $exposition) {
        $q = $this->_db->prepare('UPDATE Exposition SET idExpo = :idExpo, titre = :titre, horaireO = :horaireO, horaireF = :horaireF, theme = :theme, descriptifFR = :descriptifFR, frequentation = :frequentation, dateDeb = :dateDeb, dateFin = :dateFin, teaser = :teaser, affiche = :affiche WHERE idExpo = :idExpo');
        $q->bindValue(':idExpo', $exposition->getIdExpo());
        $q->bindValue(':titre', $exposition->getTitre());
        $q->bindValue(':horaireO', $exposition->getLongueur());
        $q->bindValue(':horaireF', $exposition->getHauteur());
        $q->bindValue(':theme', $exposition->getEtat());
        $q->bindValue(':descriptifFR', $exposition->getDescriptifFR());
        $q->bindValue(':frequentation', $exposition->getFrequentation());
        $q->bindValue(':dateDeb', $exposition->getDateDeb());
        $q->bindValue(':dateFin', $exposition->getdateFin());
        $q->bindValue(':teaser', $exposition->getTeaser());
        $q->bindValue(':affiche', $exposition->getAffiche());

        $q->execute();
    }

    //renvoie la liste des objets Exposition
    public function listExpo() {
        $list = [];
        $q = $this->_db->query("SELECT * FROM Exposition");
        while ($data = $q->fetch()) {
            $list[] = new Exposition($data);
        }
        return $list;
    }

    //renvoie les info expo d'un expo 
    public function infoExpo($idExpo) {
        $q = $this->_db->query("SELECT * FROM Exposition WHERE idExpo ='".$idExpo."'");
       $data = $q->fetch();
        $expo = new Exposition($data);
        return $expo;
    }


   
    

}