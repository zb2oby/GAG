<?php 

class EmplacementManager {

	private $_db;

    public function __construct($db) {
        $this->setDb($db);
    }

    private function setDb($db) {
        $this->_db = $db;
    }

    public function addEmplacement(Emplacement $emplacement) {
    	$q = $this->_db->prepare('INSERT INTO Emplacement(coordLeft, coordTop, idExpo, idOeuvreExposee) VALUES (:coordLeft, :coordTop, :idExpo, :idOeuvreExposee)');
    	$q->bindValue(':coordLeft', $emplacement->getCoordLeft());
        $q->bindValue(':coordTop', $emplacement->getCoordTop());
        $q->bindValue(':idExpo', $emplacement->getIdExpo());
        $q->bindValue(':idOeuvreExposee', $emplacement->getIdOeuvreExposee());

        $q->execute();
    }

    public function deleteEmplacement(Emplacement $emplacement) {
    	$q = $this->_db->exec('DELETE FROM Emplacement WHERE idEmplacement ='.$emplacement->getIdEmplacement());
    }

    public function updateEmplacement(Emplacement $emplacement) {
        $q = $this->_db->prepare('UPDATE Emplacement SET coordLeft = :coordLeft, coordTop = :coordTop, idOeuvreExposee = :idOeuvreExposee WHERE idEmplacement = :idEmplacement');
        $q->bindValue(':idEmplacement', $emplacement->getIdEmplacement());
        $q->bindValue(':coordLeft', $emplacement->getCoordLeft(), PDO::PARAM_INT);
        $q->bindValue(':coordTop', $emplacement->getCoordTop(), PDO::PARAM_INT);
        $q->bindValue(':idOeuvreExposee', $emplacement->getIdOeuvreExposee(), PDO::PARAM_INT);

        $q->execute();
    }

    //retourne un true ou false en fonction de l'existence de l'emplacement dans la base
    public function existPlace($idEmplacement) {
        $q = $this->_db->query("SELECT * FROM Emplacement WHERE idEmplacement = '".$idEmplacement."'");
        $count = $q->rowCount();
        if ($count != 0 ) {
            return true;
        }else {
            return false;
        }
    }
    //retourne un tableau des coordonnées top et left de l'emplacement voulu
    public function getCoord($idEmplacement) {
    	$coord = [];
    	$q = $this->_db->query("SELECT coordLeft, coordTop FROM Emplacement WHERE idEmplacement ='".$idEmplacement."'");
    	while ($data = $q->fetch()) {
            $coord[] = new Emplacement($data);
        }
        
        return $coord;
    }
    //retourne la clé primaire du dernier emplacement cree
    public function getLast() {
    	
    	$q = $this->_db->query("SELECT MAX(idEmplacement) as idEmplacement FROM Emplacement");
    	while ($data = $q->fetch()) {
            $idEmplacement = $data['idEmplacement'];
        }
        
        return $idEmplacement;
    }
    //retourne la liste des objets emplacement disponibles pour une exposition
    public function getListEmplacement($idExpo) {
    	$list = [];
        $q = $this->_db->query('SELECT * FROM Emplacement WHERE idExpo ='.$idExpo);
        while ($data = $q->fetch()) {
            $list[] = new Emplacement($data);
        }
        
        return $list;
    }
    //Retourne un nouvel objet avec comme idEmplacement l'id de l'item draggé fournit par le script jquery
    public function getEmplacement($idEmplacement) {
    	$q = $this->_db->query("SELECT * FROM Emplacement WHERE idEmplacement ='".$idEmplacement."'");
    	$data = $q->fetch();
    	$emplacement = new Emplacement($data);
    	return $emplacement;
    }
    //verification de l'existence d'un emplacement vide
    public function getEmptyPlace($idExpo) {
        $list = [];
        $q = $this->_db->query('SELECT * FROM Emplacement WHERE idOeuvreExposee = 0 AND idExpo ='.$idExpo);
        $count = $q->rowCount();
        if ($count == 0 ) {
            return false;
        }else {
            return true;
        }
    }
    //verification si existence d'un emplacement par defaut 
    public function getdefaultPlace($idExpo) {
        $list = [];
        $q = $this->_db->query('SELECT * FROM Emplacement WHERE coordTop = 50 AND coordLeft = 50 AND idExpo ='.$idExpo);
        $count = $q->rowCount();
        if ($count == 0 ) {
            return false;
        }else {
            return true;
        }
    }

    //renvoie un objet emplacement avec l'iOeuvre concerné pour l'expo concerné
    public function getEmplacementOeuvre($idOeuvre, $idExpo) {
        $q = $this->_db->query("SELECT * FROM Emplacement WHERE idExpo=".$idExpo." AND idOeuvreExposee=".$idOeuvre);
        $data = $q->fetch();
        $count = $q->rowCount();
        if ($count> 0) {
            $emplacement = new Emplacement($data);
            return $emplacement;
        }
        else{
            return false;
        }
        
    }


}