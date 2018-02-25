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
    	$q = $this->_db->prepare('INSERT INTO Utilisateur(nom, mot_de_passe, identifiant, prenom, idTypeUtilisateur, email, userState) VALUES (:nom, :mot_de_passe, :identifiant, :prenom, :idTypeUtilisateur, :email, :userState)');
        $q->bindValue(':nom', $utilisateur->getNom());
        $q->bindValue(':mot_de_passe', $utilisateur->getMot_de_passe());
        $q->bindValue(':identifiant', $utilisateur->getIdentifiant());
        $q->bindValue(':prenom', $utilisateur->getPrenom());
        $q->bindValue(':idTypeUtilisateur', $utilisateur->getIdTypeUtilisateur());
        $q->bindValue(':email', $utilisateur->getEmail());
        $q->bindValue(':userState', $utilisateur->getUserState());

        $q->execute();
    }

    public function deleteUtilisateur(Utilisateur $utilisateur) {
    	$q = $this->_db->exec('DELETE FROM Utilisateur WHERE idUtilisateur ='.$utilisateur->getIdUtilisateur());
    }

    public function updateUtilisateur(Utilisateur $utilisateur) {
        $q = $this->_db->prepare('UPDATE Utilisateur SET nom = :nom, mot_de_passe = :mot_de_passe, identifiant = :identifiant, prenom = :prenom, idTypeUtilisateur = :idTypeUtilisateur, email = :email, userState = :userState WHERE idUtilisateur = :idUtilisateur');
        $q->bindValue(':idUtilisateur', $utilisateur->getIdUtilisateur());
        $q->bindValue(':nom', $utilisateur->getNom());
        $q->bindValue(':mot_de_passe', $utilisateur->getMot_de_passe());
        $q->bindValue(':identifiant', $utilisateur->getIdentifiant());
        $q->bindValue(':prenom', $utilisateur->getPrenom());
        $q->bindValue(':idTypeUtilisateur', $utilisateur->getIdTypeUtilisateur());
        $q->bindValue(':email', $utilisateur->getEmail());
        $q->bindValue(':userState', $utilisateur->getUserState());

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
        $count = $q->rowCount();
        $data = $q->fetch();
        if ($count != 0) {
            $user = new Utilisateur($data);
            return $user;
        }else{
            return false;
        }
        
    }

    //retourn =e la liste des utilisateurs
    public function listUser() {
        $list = [];
        $q = $this->_db->query("SELECT idUtilisateur, nom, mot_de_passe, identifiant, prenom, idTypeUtilisateur, email, userState FROM Utilisateur ORDER BY nom");
        while ($data = $q->fetch()) {
            $list[] = new Utilisateur($data);
        }
        return $list;
    }


    //retounr le dernier utilisateur creer
    public function lastIdUser() {
        $q = $this->_db->query("SELECT MAX(idUtilisateur) AS idUtilisateur FROM Utilisateur");
        $data = $q->fetch();
        return $data['idUtilisateur'];
    }

    //retourn ele libelle du type en fonction de son id
    public function getRole($idType) {
        $q = $this->_db->query("SELECT libelleTypeUtilisateur FROM Type_utilisateur WHERE idTypeUtilisateur =".$idType);
        $data = $q->fetch();
        return $data['libelleTypeUtilisateur'];
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

    //retourne un objet user a partie de l'email fourni
    public function getUserByMail($email) {
        $q = $this->_db->query('SELECT * FROM Utilisateur WHERE email = "'.$email.'"');
        $count = $q->rowCount();
        if ($count != 0) {
            $data = $q->fetch();
            $user = new Utilisateur($data);
            return $user;   
        }else {
            return false;
        }
        
    }


}