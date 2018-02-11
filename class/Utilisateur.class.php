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
		$message = [];
		if (strlen($nom)>5) {
			$message[] = 'Le nom est trop long : 50 caratères Max';
			return $message;
		}elseif (strlen($nom) < 2) {
			$message[] = 'Le nom est trop court : 2 caractères Min';
			return $message;
		}else{
			$this->_nom = $nom;	
		}
	}
	public function setPrenom($prenom) {
		$message = [];
		if (strlen($prenom)>5) {
			$message[] = 'Le prénom est trop long : 50 caratères Max';
			return $message;
		}elseif (strlen($prenom) < 2) {
			$message[] = 'Le prénom est trop court : 2 caractères Min';
			return $message;
		}else{
			$this->_prenom = $prenom;
		}
	}
	public function setMot_de_passe($password) {
		$this->_mot_de_passe = $password;
	}
	public function setIdentifiant($identifiant) {
		$message = [];
		if (strlen($identifiant)>50) {
			$message[] = 'L\'identifiant est trop long : 50 caratères Max';
			return $message;
		}elseif (strlen($identifiant) < 2) {
			$message[] = 'L\'identifiant est trop court : 2 caractères Min';
			return $message;
		}else{
			$this->_identifiant = $identifiant;
		}
	}
	public function setIdTypeUtilisateur($idTypeUtilisateur) {
		$message = [];
		if (strlen($idTypeUtilisateur)<1) {
			$message[] = 'Le rôle est obligatoire';
			return $message;
		}else{
			$this->_idTypeUtilisateur = $idTypeUtilisateur;
		}
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