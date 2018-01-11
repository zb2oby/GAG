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
    	return new Utilisateur($data);
    }

}