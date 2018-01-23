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
    	$q = $this->_db->prepare('INSERT INTO Exposition(titre, horaireO, horaireF, theme, descriptifFR, frequentation, dateDeb, dateFin, teaser, affiche, couleurExpo) VALUES (:titre, :horaireO, :horaireF, :theme, :descriptifFR, :frequentation, :dateDeb, :dateFin, :teaser, :affiche, :couleurExpo)');
        $q->bindValue(':titre', $exposition->getTitre());
    	$q->bindValue(':horaireO', $exposition->getHoraireO());
        $q->bindValue(':horaireF', $exposition->getHoraireF());
        $q->bindValue(':theme', $exposition->getTheme());
        $q->bindValue(':descriptifFR', $exposition->getDescriptifFR());
        $q->bindValue(':frequentation', $exposition->getFrequentation());
        $q->bindValue(':dateDeb', $exposition->getDateDeb());
        $q->bindValue(':dateFin', $exposition->getdateFin());
        $q->bindValue(':teaser', $exposition->getTeaser());
        $q->bindValue(':affiche', $exposition->getAffiche());
        $q->bindValue(':couleurExpo', $exposition->getCouleurExpo());

        $q->execute();
    }

    public function deleteExposition(Exposition $exposition) {
    	$q = $this->_db->exec('DELETE FROM Exposition WHERE idExpo ='.$exposition->getIdExpo());
    }

    public function updateExposition(Exposition $exposition) {
        $q = $this->_db->prepare('UPDATE Exposition SET titre = :titre, horaireO = :horaireO, horaireF = :horaireF, theme = :theme, descriptifFR = :descriptifFR, frequentation = :frequentation, dateDeb = :dateDeb, dateFin = :dateFin, teaser = :teaser, affiche = :affiche, couleurExpo = :couleurExpo WHERE idExpo = :idExpo');
        $q->bindValue(':titre', $exposition->getTitre());
        $q->bindValue(':horaireO', $exposition->getHoraireO());
        $q->bindValue(':horaireF', $exposition->getHoraireF());
        $q->bindValue(':theme', $exposition->getTheme());
        $q->bindValue(':descriptifFR', $exposition->getDescriptifFR());
        $q->bindValue(':frequentation', $exposition->getFrequentation());
        $q->bindValue(':dateDeb', $exposition->getDateDeb());
        $q->bindValue(':dateFin', $exposition->getdateFin());
        $q->bindValue(':teaser', $exposition->getTeaser());
        $q->bindValue(':affiche', $exposition->getAffiche());
        $q->bindValue(':couleurExpo', $exposition->getCouleurExpo());
        $q->bindValue(':idExpo', $exposition->getIdExpo());

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

    public function listExpoMois($mois, $annee) {
        $list = [];
        $q = $this->_db->query("SELECT * FROM Exposition WHERE MONTH(dateDeb) = ".$mois." AND YEAR(dateDeb) = ".$annee);
        while ($data = $q->fetch()) {
            $list[] = new Exposition($data);
        }
        return $list;
    }

    //renvoie les info expo d'une expo 
    public function infoExpo($idExpo) {
        $q = $this->_db->query("SELECT * FROM Exposition WHERE idExpo ='".$idExpo."'");
        $data = $q->fetch();
        $expo = new Exposition($data);
        return $expo;
    }

    //renvoie les dates d'expo passer
    public function prevExpo(){
        $list = [];
        $q = $this->_db->query("SELECT idExpo, titre, horaireO, horaireF, theme, descriptifFR, frequentation, dateDeb, dateFin, teaser, affiche, couleurExpo FROM Exposition where dateDeb < now() ORDER BY datedeb desc");
        while ( $data = $q->fetch()) {
            $expo = new Exposition($data);
            $list[] = $expo;
        }
        return $list;


    }
    //renvoie les dates d'expo a venir
    public function nextExpo(){
    $list = [];
    $q = $this->_db->query("SELECT idExpo, titre, horaireO, horaireF, theme, descriptifFR, frequentation, dateDeb, dateFin, teaser, affiche, couleurExpo FROM Exposition where dateDeb > now() ORDER BY datedeb desc");
    while ( $data = $q->fetch()) {
        $expo = new Exposition($data);
        $list[] = $expo;
    }
    return $list;


    }

    //renvoie la derniere exposition creer
    public function lastIdExpo() {
        $q = $this->_db->query("SELECT MAX(idExpo) AS idExpo FROM Exposition");
        $data = $q->fetch();
        $idExpo = $data['idExpo'];
        return $idExpo;

    }

   
    

}