<?php

class OeuvreExposeeManager {

	private $_db;

    public function __construct($db) {
        $this->setDb($db);
    }

    private function setDb($db) {
        $this->_db = $db;
    }

    public function addOeuvreExposee(OeuvreExposee $oeuvreExposee) {
    	$q = $this->_db->prepare('INSERT INTO OeuvreExposee(dateEntree, dateSortie, nbClic, nbFlash, idOeuvre, idExpo) VALUES (:dateEntree, :dateSortie, :nbClic, :nbFlash, :idOeuvre, :idExpo)');
    	$q->bindValue(':dateEntree', $oeuvreExposee->getDateEntree());
        $q->bindValue(':dateSortie', $oeuvreExposee->getDateSortie());
        $q->bindValue(':nbClic', $oeuvreExposee->getNbClic());
        $q->bindValue(':nbFlash', $oeuvreExposee->getNbFlash());
        $q->bindValue(':idOeuvre', $oeuvreExposee->getIdOeuvre());
        $q->bindValue(':idExpo', $oeuvreExposee->getIdExpo());

        $q->execute();
    }

    public function deleteOeuvreExposee(OeuvreExposee $oeuvreExposee) {
    	$q = $this->_db->exec('DELETE FROM OeuvreExposee WHERE idOeuvreExposee ='.$oeuvreExposee->getIdOeuvreExposee());
    }

    public function updateOeuvreExposee(OeuvreExposee $oeuvreExposee) {
        $q = $this->_db->prepare('UPDATE OeuvreExposee SET dateEntree = :dateEntree, dateSortie = :dateSortie, nbClic = :nbClic, nbFlash = :nbFlash, idOeuvre = :idOeuvre, idExpo = :idExpo WHERE idOeuvreExposee = :idOeuvreExposee');
        $q->bindValue(':idOeuvreExposee', $oeuvreExposee->getIdOeuvreExposee());
        $q->bindValue(':dateEntree', $oeuvreExposee->getDateEntree());
        $q->bindValue(':dateSortie', $oeuvreExposee->getDateSortie());
        $q->bindValue(':nbClic', $oeuvreExposee->getNbClic());
        $q->bindValue(':nbFlash', $oeuvreExposee->getNbFlash());
        $q->bindValue(':idOeuvre', $oeuvreExposee->getIdOeuvre());
        $q->bindValue(':idExpo', $oeuvreExposee->getIdExpo());


        $q->execute();
    }

    //retourne un objet oeuvre exposé en fonction de son id fournit en argument
    public function oeuvreExposee($idOeuvreExposee) {
        $q = $this->_db->query("SELECT * FROM OeuvreExposee WHERE idOeuvreExposee ='".$idOeuvreExposee."'");
        $data = $q->fetch(); 
        $oeuvreExposee = new OeuvreExposee($data);
        return $oeuvreExposee;
    }

    //retourne la liste des objets Oeuvre prevue et NON RECUE pour une exposition

    public function ListOeuvresPrevues($idExpo) {
        $list = [];
        $q = $this->_db->query("SELECT O.idOeuvre, titre, longueur, hauteur, etat, image, qrcode, descriptifFR, idTypeOeuvre, idArtiste, idCollectif FROM Oeuvre O, OeuvreExposee E WHERE O.idOeuvre = E.idOeuvre AND dateEntree = '0000-00-00' AND idExpo ='".$idExpo."'");
        while ($data = $q->fetch()) {
            $list[] = new Oeuvre($data);
        }
        
        return $list;
    }

    //retourne la liste des objets Oeuvre prevue et RECUE pour une exposition
    public function ListOeuvresRecues($idExpo) {
        $list = [];
        $q = $this->_db->query("SELECT O.idOeuvre, titre, longueur, hauteur, etat, image, qrcode, descriptifFR, idTypeOeuvre, idArtiste, idCollectif FROM Oeuvre O, OeuvreExposee E WHERE O.idOeuvre = E.idOeuvre AND dateEntree <> '0000-00-00' AND idExpo ='".$idExpo."'");
        while ($data = $q->fetch()) {
            $list[] = new Oeuvre($data);
        }
        
        return $list;
    }

    //retourne un objet oeuvre en fonction de l'idOeuvreExposee fournit en argument
    public function oeuvre($idOeuvreExposee) {
        $q = $this->_db->query("SELECT O.idOeuvre, titre, longueur, hauteur, etat, image, qrcode, descriptifFR, idTypeOeuvre, idArtiste, idCollectif FROM Oeuvre O, OeuvreExposee E WHERE O.idOeuvre=E.idOeuvre AND idOeuvreExposee='".$idOeuvreExposee."'");
        $data = $q->fetch(); 
        $oeuvre = new Oeuvre($data);
        return $oeuvre;
    }

    public function affichageOeuvre ($tabOeuvres, $class) {
        foreach ($tabOeuvres as $oeuvre) {
            $q = $this->_db->query("SELECT idOeuvreExposee FROM OeuvreExposee WHERE idExpo='".$_SESSION['idExpo']."' AND idOeuvre='".$oeuvre->getIdOeuvre()."'");
            $idOeuvreExposee = $q->fetch();
            echo '<li class="portlet" data-id="'.$idOeuvreExposee['idOeuvreExposee'].'">'
                    .'<div class="portlet-content">'
                        .'<div class="titre">'.$oeuvre->getTitre().'</div>'
                        .'<div data-idoeuvreexposee="'.$idOeuvreExposee['idOeuvreExposee'].'" data-id="'.$oeuvre->getIdOeuvre().'" class="img '.$class.'" data-src="'.$oeuvre->getImage().'">'  
                            .'<img src="../img/oeuvres/'.$oeuvre->getImage().'" alt="'.$oeuvre->getImage().'">'
                        .'</div>'
                    .'</div>'
                    .'<div class="context-menu">'
                        .'<i class="closeButton ion-android-close"></i>'
                        .'<i class="deleteCard ion-ios-trash-outline"></i>'
                        .'<input type="text"></input>'
                    .'</div>'
                .'</li>';

        }
    }

}

