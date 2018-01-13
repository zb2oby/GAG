<?php 

class DonneeEnrichieManager {
	private $_db;

	 public function __construct($db) {
        $this->setDb($db);
    }

    private function setDb($db) {
        $this->_db = $db;
    }

    public function addDonnee(DonneeEnrichie $donnee) {
    	$q = $this->_db->prepare('INSERT INTO Donnee_enrichie(urlFichier, libelleDonneeEnrichie, idTypeDonneeEnrichie, idOeuvre) VALUES (:urlFichier, :libelleDonneeEnrichie, :idTypeDonneEnrichie, :idOeuvre)');
    	$q->bindValue(':urlFichier', $donnee->getUrlFichier());
        $q->bindValue(':libelleDonneeEnrichie', $donnee->getLibelleDonnee());
        $q->bindValue(':idTypeDonneEnrichie', $donnee->getIdTypeDonnee());
        $q->bindValue(':idOeuvre', $donnee->getIdOeuvre());
       
        $q->execute();
    }

    public function deleteDonnee(DonneeEnrichie $donnee) {
    	$q = $this->_db->exec('DELETE FROM Donnee_enrichie WHERE idDonneeEnrichie ='.$donnee->getIdDonnee());
    }

    public function updateDonnee(DonneeEnrichie $donnee) {
        $q = $this->_db->prepare('UPDATE Donnee_enrichie SET urlFichier = :urlFichier, libelleDonneeEnrichie = :libelleDonneeEnrichie, idTypeDonneEnrichie = :idTypeDonneEnrichie, idOeuvre = :idOeuvre WHERE idDonneeEnrichie = :idDonneeEnrichie');
        $q->bindValue(':urlFichier', $donnee->getUrlFichier());
        $q->bindValue(':libelleDonneeEnrichie', $donnee->getLibelleDonnee());
        $q->bindValue(':idTypeDonneEnrichie', $donnee->getIdTypeDonnee());
        $q->bindValue(':idOeuvre', $donnee->getIdOeuvre());
        $q->bindValue(':idDonneeEnrichie', $donnee->getIdDonnee());

       
        $q->execute();
    }

    public function listDonnee($idOeuvre) {
        $list = [];
        $q = $this->_db->query("SELECT idDonneeEnrichie, urlFichier, libelleDonneeEnrichie, idTypeDonneEnrichie, idOeuvre FROM Donnee_enrichie WHERE idOeuvre ='".$idOeuvre."'");
        while ($data = $q->fetch()) {
            $list[] = new DonneeEnrichie($data);
        }
        
        return $list;
    }

    public function listTypeDonnee() {
    	$list = [];
    	$q = $this->_db->query("SELECT * FROM Type_donnee_enrichie");
    	while ($data = $q->fetch()) {
    		$list[] = new DonneeEnrichie($data);
    	}
    }

    public function libelleTypeDonnee($idTypeDonnee) {
    	$q = $this->_db->query("SELECT libelleTypeDonneEnrichie FROM Type_donnee_enrichie WHERE idTypeDonneEnrichie = '".$idTypeDonnee."'");
    	$data = $q->fetch();
    	return $data['libelleTypeDonneEnrichie'];
    }

}