<?php 

class Utilisateur {

	private $_idUtilisateur;
	private $_nom;
	private $_mot_de_passe;
	private $_identifiant;
	private $_prenom;
	private $_idTypeUtilisateur;

	public function hydrate($dataUser) {
		foreach ($dataUser as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function __construct($dataUser) {
		$this->hydrate($dataUser);
	}

	public function setIdUtilisateur($idUtilisateur) {
		$this->_idUtilisateur = $idUtilisateur;
	}
	public function setNom($nom) {
		$this->_nom = $nom;
	}
	public function setPrenom($prenom) {
		$this->_prenom = $prenom;
	}
	public function setMot_de_passe($password) {
		$this->_mot_de_passe = $password;
	}
	public function setIdentifiant($identifiant) {
		$this->_identifiant = $identifiant;
	}
	public function setIdTypeUtilisateur($idTypeUtilisateur) {
		$this->_idTypeUtilisateur = $idTypeUtilisateur;
	}


	public function getIdUtilisateur() {
		return $this->_idUtilisateur;
	}
	public function getNom() {
		return $this->_nom;
	}
	public function getPrenom() {
		return $this->_prenom;
	}
	public function getMot_de_passe() {
		return $this->_mot_de_passe;
	}
	public function getIdentifiant() {
		return $this->_identifiant;
	}
	public function getIdTypeUtilisateur() {
		return $this->_idTypeUtilisateur;
	}


	

}