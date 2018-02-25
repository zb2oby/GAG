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
    	$q = $this->_db->prepare('INSERT INTO OeuvreExposee(dateEntree, dateSortie, nbVue, idOeuvre, idExpo) VALUES (:dateEntree, :dateSortie, :nbVue, :idOeuvre, :idExpo)');
    	$q->bindValue(':dateEntree', $oeuvreExposee->getDateEntree());
        $q->bindValue(':dateSortie', $oeuvreExposee->getDateSortie());
        $q->bindValue(':nbVue', $oeuvreExposee->getNbVue());
        $q->bindValue(':idOeuvre', $oeuvreExposee->getIdOeuvre());
        $q->bindValue(':idExpo', $oeuvreExposee->getIdExpo());

        $q->execute();
    }

    public function deleteOeuvreExposee(OeuvreExposee $oeuvreExposee) {
    	$q = $this->_db->exec('DELETE FROM OeuvreExposee WHERE idOeuvreExposee ='.$oeuvreExposee->getIdOeuvreExposee());
    }

    public function updateOeuvreExposee(OeuvreExposee $oeuvreExposee) {
        $q = $this->_db->prepare('UPDATE OeuvreExposee SET dateEntree = :dateEntree, dateSortie = :dateSortie, nbVue = :nbVue, idOeuvre = :idOeuvre, idExpo = :idExpo WHERE idOeuvreExposee = :idOeuvreExposee');
        $q->bindValue(':idOeuvreExposee', $oeuvreExposee->getIdOeuvreExposee());
        $q->bindValue(':dateEntree', $oeuvreExposee->getDateEntree());
        $q->bindValue(':dateSortie', $oeuvreExposee->getDateSortie());
        $q->bindValue(':nbVue', $oeuvreExposee->getNbVue());
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

    //renvoi une liste d'objet exposition en fonction de l'idoeuvre recuperer d'une oeuvreexposee
    public function listExpoOeuvreExposee($idOeuvre) {
        require_once('../class/Exposition.class.php');
        $list = [];
        $q = $this->_db->query("SELECT E.idExpo, titre, horaireO, horaireF, theme, descriptifFR, frequentation, dateDeb, dateFin, teaser, affiche FROM Exposition E, OeuvreExposee O WHERE E.idExpo = O.idExpo AND idOeuvre ='".$idOeuvre."' ORDER BY dateDeb ASC");
        while ($data = $q->fetch()) {
            $list[] = new Exposition($data);
        }
        
        return $list;
    }
    //retourne la liste des objets Oeuvre prevue et NON RECUE pour une exposition

    public function ListOeuvresExposees($idExpo) {
        $list=[];
        $q = $this->_db->query("SELECT O.idOeuvre, titre, longueur, hauteur, etat, image, qrcode, descriptifFR, idTypeOeuvre, idArtiste, idCollectif FROM Oeuvre O, OeuvreExposee E WHERE O.idOeuvre = E.idOeuvre AND idExpo ='".$idExpo."'");
        while ($data = $q->fetch()) {
            $list[] = new Oeuvre($data);
        }
        
        return $list;
    }

    public function ListOeuvresPrevues($idExpo) {
        $list = [];
        $q = $this->_db->query("SELECT O.idOeuvre, titre, longueur, hauteur, etat, image, qrcode, descriptifFR, idTypeOeuvre, idArtiste, idCollectif FROM Oeuvre O, OeuvreExposee E WHERE O.idOeuvre = E.idOeuvre AND dateEntree = '1970-01-01' AND idExpo ='".$idExpo."' ORDER BY O.idOeuvre DESC");
        while ($data = $q->fetch()) {
            $list[] = new Oeuvre($data);
        }
        
        return $list;
    }

    //retourne la liste des objets Oeuvre prevue et RECUE pour une exposition
    public function ListOeuvresRecues($idExpo) {
        $list = [];
        $q = $this->_db->query("SELECT O.idOeuvre, titre, longueur, hauteur, etat, image, qrcode, descriptifFR, idTypeOeuvre, idArtiste, idCollectif FROM Oeuvre O, OeuvreExposee E WHERE O.idOeuvre = E.idOeuvre AND dateEntree <> '1970-01-01' AND idExpo ='".$idExpo."' ORDER BY O.idOeuvre DESC");
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

    public function ListOeuvresRetard($idExpo, $dateDeb) {
        $listRetard = [];
        $now = time(); 
        $dateExpo = strtotime($dateDeb);
        $time = $dateExpo - $now;
        $remain = (floor(($dateExpo - $now)/86400)+1);
        if ($remain > 0 && $remain < 10) {
            $q = $this->_db->query("SELECT O.idOeuvre, titre, longueur, hauteur, etat, image, qrcode, descriptifFR, idTypeOeuvre, idArtiste, idCollectif FROM Oeuvre O, OeuvreExposee E WHERE O.idOeuvre = E.idOeuvre AND dateEntree = '1970-01-01' AND idExpo ='".$idExpo."'");
                $count = $q->rowCount();
                if ($count > 0 ) {
                    while ($data = $q->fetch()) {
                    $listRetard[] = new Oeuvre($data);
                    }
                    
                    return $listRetard;
                }else {
                    return false;
                }
                
            
            

        }else{
            return false;
        }

    }



    //affichage des info d'une oeuvre a partir du tableau d'oeuvre generé en fonction des oeuvreExposee presente
    public function affichageOeuvre ($tabOeuvres, $class, $idExpo, $dateDeb = '') {
        foreach ($tabOeuvres as $oeuvre) {
            $q = $this->_db->query("SELECT idOeuvreExposee FROM OeuvreExposee WHERE idExpo='".$idExpo."' AND idOeuvre='".$oeuvre->getIdOeuvre()."'");
            $idOeuvreExposee = $q->fetch();
            $idOeuvreExposee = $idOeuvreExposee['idOeuvreExposee'];
            $idOeuvre = $oeuvre->getIdOeuvre();
            echo '<li class="portlet portlet-oeuvre" data-id="'.$idOeuvreExposee.'">'
                    .'<div class="portlet-content">'
                        .'<div class="titre">'.ucfirst($oeuvre->getTitre());
                            $listRetard = $this->ListOeuvresRetard($idExpo, $dateDeb);
                            if ($listRetard != false) {
                                foreach ($listRetard as $oeuvreRetard) {
                                    if ($oeuvre->getIdOeuvre() == $oeuvreRetard->getIdOeuvre()) {
                                        echo '<span class="retard" style="font-size:12px; position:absolute; right:0px; top:40px;"><i class="ion-alert-circled" style="color:red; font-size:1em; position:absolute; left:-15px; top:0px;"></i>RETARD</span>';
                                    }
                                }
                            }
                echo    '</div>'
                        .'<div data-idoeuvreexposee="'.$idOeuvreExposee.'" data-id="'.$idOeuvre.'" class="img '.$class.'" data-src="'.$oeuvre->getImage().'">'  
                            .'<img src="../img/oeuvres/'.$oeuvre->getImage().'" alt="'.$oeuvre->getImage().'">'
                        .'</div>'

                    .'</div>'
                .'</li>';

        }
    }

    //retourne un objet oeuvre exposé en fonction de son idoeuvre fournit en argument
    public function idExposee($idOeuvre, $idExpo) {
        $q = $this->_db->query("SELECT idOeuvreExposee FROM OeuvreExposee WHERE idOeuvre ='".$idOeuvre."' AND idExpo = '".$idExpo."'");
        $data = $q->fetch();
            $idOeuvreExposee = $data['idOeuvreExposee'];
            return $idOeuvreExposee;
        
        
    }





}

