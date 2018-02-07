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

    //retourne un objet exposition par rapport à l'expo en cours.
    public function currentExpo() {
        $today = date('Y-m-d');
        $q = $this->_db->query("SELECT * FROM Exposition WHERE dateDeb <=".$today." AND dateFin >=".$today);
        $data = $q->fetch();
        $expo = new Exposition($data);
        return $expo;
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
        $q = $this->_db->query("SELECT idExpo, titre, horaireO, horaireF, theme, descriptifFR, frequentation, dateDeb, dateFin, teaser, affiche, couleurExpo FROM Exposition where dateDeb < now() ORDER BY datedeb desc limit 5");
        while ( $data = $q->fetch()) {
            $expo = new Exposition($data);
            $list[] = $expo;
        }
        return $list;


    }
    //renvoie les dates d'expo a venir
    public function nextExpo(){
    $list = [];
    $q = $this->_db->query("SELECT idExpo, titre, horaireO, horaireF, theme, descriptifFR, frequentation, dateDeb, dateFin, teaser, affiche, couleurExpo FROM Exposition where dateDeb > now() ORDER BY datedeb asc limit 5");
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

    //liste les langues dispo pour une expo
    public function getIdLangueExpo($idExpo) {
        $list = [];
        $q = $this->_db->query("SELECT idLangue FROM Langue_expo WHERE idExpo = ".$idExpo);
        while ($data = $q->fetch()) {
            $list[] = $data['idLangue'];
        }
        return $list;
    }

    public function getLibelleLangue($idLangue) {
        $q = $this->_db->query("SELECT nomLangue FROM Langue WHERE idLangue =".$idLangue);
        $data = $q->fetch();
        return $data['nomLangue'];
    }

    public function resetLnExpo($idExpo) {
        $q = $this->_db->exec("DELETE FROM Langue_expo WHERE idExpo =".$idExpo);
    }

    //enregistre les langues pour l'expo
    public function addLnExpo($idExpo, Array $langues) {
        //on vide la base des enregistrement de langues existant
        $this->resetLnExpo($idExpo);
        //on rerempli avec les nouvelle valeurs
        foreach ($langues as $idLangue) {
            $q = $this->_db->prepare("INSERT INTO Langue_expo (idExpo, idLangue) VALUES (:idExpo, :idLangue)");
            $q->bindValue(':idExpo', $idExpo);
            $q->bindValue(':idLangue', $idLangue);
            $q->execute();
        }
        
    }

    
     //retourne une liste de resultat en fonction d'une recherche demandée
    public function getSearch($saisie) {
        $list = [];
        $q = $this->_db->query("SELECT * FROM Exposition WHERE titre LIKE '%".$saisie."%' OR theme LIKE '%".$saisie."%' OR MONTH(dateDeb) LIKE '%".$saisie."%' OR YEAR(dateDeb) LIKE '%".$saisie."%'");
        while ($data = $q->fetch()) {
            $list[] = $data;
        }

        return $list;
    }




    

}