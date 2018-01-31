<?php 

class UtilisateurManager {

	private $_db;

    public function __construct($db) {
        $this->setDb($db);
    }

    private function setDb($db) {
        $this->_db = $db;
    }

     public function addUtilisateur(Utilisateur $utilisateur) {
    	$q = $this->_db->prepare('INSERT INTO Utilisateur(idUtilisateur, nom, mot_de_passe, identifiant, prenom, idTypeUtilisateur) VALUES (:idUtilisateur, :nom, :mot_de_passe, :identifiant, :prenom, :idTypeUtilisateur)');
    	$q->bindValue(':idUtilisateur', $utilisateur->getIdUtilisateur());
        $q->bindValue(':nom', $utilisateur->getNom());
        $q->bindValue(':mot_de_passe', $utilisateur->getMot_de_passe());
        $q->bindValue(':identifiant', $utilisateur->getIdentifiant());
        $q->bindValue(':prenom', $utilisateur->getPrenom());
        $q->bindValue(':idTypeUtilisateur', $utilisateur->getIdTypeUtilisateur());

        $q->execute();
    }

    public function deleteUtilisateur(Utilisateur $utilisateur) {
    	$q = $this->_db->exec('DELETE FROM Utilisateur WHERE idEmplacement ='.$utilisateur->getIdEmplacement());
    }

    public function updateUtilisateur(Utilisateur $utilisateur) {
        $q = $this->_db->prepare('UPDATE Utilisateur SET nom = :nom, mot_de_passe = :mot_de_passe, identifiant = :identifiant, prenom = :prenom, idTypeUtilisateur = :idTypeUtilisateur WHERE idUtilisateur = :idUtilisateur');
        $q->bindValue(':idUtilisateur', $utilisateur->getIdUtilisateur());
        $q->bindValue(':nom', $utilisateur->getNom());
        $q->bindValue(':mot_de_passe', $utilisateur->getMot_de_passe());
        $q->bindValue(':identifiant', $utilisateur->getIdentifiant());
        $q->bindValue(':prenom', $utilisateur->getPrenom());
        $q->bindValue(':idTypeUtilisateur', $utilisateur->getIdTypeUtilisateur());

        $q->execute();
    }

    public function infoUtilisateur($idUser) {
    	$q= $this->_db->query("SELECT * FROM Utilisateur WHERE idUtilisateur = '".$idUser."'");
    	$data = $q->fetch();
    	$user = new Utilisateur($data);
        return $user;
    }

    //verification user
    public function checkLogin($login, $passwd) {
        $q = $this->_db->query("SELECT * FROM Utilisateur WHERE identifiant ='".$login."' AND mot_de_passe ='".$passwd."'");
        $data = $q->fetch();
        $count = $q->rowCount();
        if ($count != 0) {
            $user = new Utilisateur($data);
            return $user;
        }else{
            return false;
        }
        
    }

    //retourne la liste des type utilisateur
    public function listTypeUser() {
        $listType = [];
        $q = $this->_db->query("SELECT idTypeUtilisateur, libelleTypeUtilisateur FROM Type_utilisateur");
        while ($data = $q->fetch()) {
            $listType[] = [$data['idTypeUtilisateur'] => $data['libelleTypeUtilisateur']] ;
        }
        return $listType;
    }

    //donne le role a l'utilisateur
    public function giveRole(Utilisateur $user) {
        $idTypeUtilisateur = $user->getIdUtilisateur();
        $listType = $this->listTypeUser();
        foreach ($listType as $type) {
            foreach ($type as $idType => $libelle) {
                if ($idType == $idTypeUtilisateur) {
                    return $libelle;
                }
            }
            
        }
    }


}