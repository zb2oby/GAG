<?php 

class OeuvreManager {

	private $_db;

	 public function __construct($db) {
        $this->setDb($db);
    }

    private function setDb($db) {
        $this->_db = $db;
    }

    public function addOeuvre(Oeuvre $oeuvre) {
    	$q = $this->_db->prepare('INSERT INTO Oeuvre(titre, longueur, hauteur, etat, image, qrcode, descriptifFR, idTypeOeuvre, idArtiste, idCollectif) VALUES (:titre, :longueur, :hauteur, :etat, :image, :qrcode, :descriptifFR, :idTypeOeuvre, :idArtiste, :idCollectif)');
        $q->bindValue(':titre', $oeuvre->getTitre());
    	$q->bindValue(':longueur', $oeuvre->getLongueur());
        $q->bindValue(':hauteur', $oeuvre->getHauteur());
        $q->bindValue(':etat', $oeuvre->getEtat());
        $q->bindValue(':image', $oeuvre->getImage());
        $q->bindValue(':qrcode', $oeuvre->getQrcode());
        $q->bindValue(':descriptifFR', $oeuvre->getDescriptifFR());
        $q->bindValue(':idTypeOeuvre', $oeuvre->getIdTypeOeuvre());
        $q->bindValue(':idArtiste', $oeuvre->getIdArtiste());
        $q->bindValue(':idCollectif', $oeuvre->getIdCollectif());

        $q->execute();
    }

    public function deleteOeuvre(Oeuvre $oeuvre) {
    	$q = $this->_db->exec('DELETE FROM Oeuvre WHERE idOeuvre ='.$oeuvre->getIdOeuvre());
    }

    public function updateOeuvre(Oeuvre $oeuvre) {
        $q = $this->_db->prepare('UPDATE Oeuvre SET titre = :titre, longueur = :longueur, hauteur = :hauteur, etat = :etat, image = :image, qrcode = :qrcode, descriptifFR = :descriptifFR, idTypeOeuvre = :idTypeOeuvre, idArtiste = :idArtiste, idCollectif = :idCollectif WHERE idOeuvre = :idOeuvre');
        $q->bindValue(':titre', $oeuvre->getTitre());
        $q->bindValue(':idOeuvre', $oeuvre->getIdOeuvre());
        $q->bindValue(':longueur', $oeuvre->getLongueur());
        $q->bindValue(':hauteur', $oeuvre->getHauteur());
        $q->bindValue(':etat', $oeuvre->getEtat());
        $q->bindValue(':image', $oeuvre->getImage());
        $q->bindValue(':qrcode', $oeuvre->getQrcode());
        $q->bindValue(':descriptifFR', $oeuvre->getDescriptifFR());
        $q->bindValue(':idTypeOeuvre', $oeuvre->getIdTypeOeuvre());
        $q->bindValue(':idArtiste', $oeuvre->getIdArtiste());
        $q->bindValue(':idCollectif', $oeuvre->getIdCollectif());

        $q->execute();
    }

    //renvoie la liste des objets Oeuvre disponibles pour une expo en fonction des artistes presents pour cette expo.
    public function listOeuvreExpo($idExpo) {
        $list = [];
        $q = $this->_db->query("SELECT O.idOeuvre, titre, longueur, hauteur, etat, image, qrcode, descriptifFR, idTypeOeuvre, O.idArtiste, idCollectif FROM Oeuvre O, ArtisteExpose A WHERE O.idArtiste = A.idArtiste AND idExpo ='".$idExpo."'");
        while ($data = $q->fetch()) {
            $list[] = new Oeuvre($data);
        }
        return $list;
    }

    //renvoi un objet oeuvre en fonction de l'idoeuvre fournit
    public function infoOeuvre($idOeuvre) {
        $q = $this->_db->query("SELECT idOeuvre, titre, longueur, hauteur, etat, image, qrcode, descriptifFR, idTypeOeuvre, idArtiste, idCollectif FROM Oeuvre WHERE idOeuvre ='".$idOeuvre."'");
        $data = $q->fetch();
            $oeuvre = new Oeuvre($data);
            return $oeuvre;
    }

   
    //recupere le libelle du type d'oeuvre demandé
    public function typeOeuvre($idTypeOeuvre) {
        $q = $this->_db->query("SELECT libelleTypeOeuvre FROM Type_oeuvre WHERE idTypeOeuvre = '".$idTypeOeuvre."'");
        $data = $q->fetch();
        return $data['libelleTypeOeuvre'];
    }

    //recupere la liste des types d'oeuvre existants
    public function listTypeOeuvre() {
       $list = [];
        $q= $this->_db->query("SELECT idTypeOeuvre, libelleTypeOeuvre FROM Type_oeuvre");
        while ($data = $q->fetch()) {
            $id = $data['idTypeOeuvre'];
            $libelle = $data['libelleTypeOeuvre'];
            $list[$id] = $libelle;
        }
        return $list;
      
    }


}