<?php 

class Artiste {

	private $_idArtiste;
	private $_nom = 'sans nom';
	private $_prenom;
	private $_tel;
	private $_image;
	private $_descriptifFR;
	private $_email;

	public function hydrate($dataArtiste) {
		foreach ($dataArtiste as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function __construct($dataArtiste) {
		$this->hydrate($dataArtiste);
	}

	//SETTERS 

	public function setIdArtiste($idArtiste) {
		$this->_idArtiste = $idArtiste;
	}
	public function setNom($nom) {
		$message = [];
		if (strlen($nom) > 50 ) {
			$message[] = 'Le nom est trop long : Max 50car';
			return $message;
		}elseif (strlen($nom) < 2) {
			$message[] = 'Le nom est trop court : Min 2car';
			return $message;
		}
		else{
			$this->_nom = $nom;
		}
		
	}
	public function setPrenom($prenom) {
		$message = [];
		if (strlen($prenom) > 50 ) {
			$message[] = 'Le prénom est trop long : Max 50car';
			return $message;
		}elseif (strlen($prenom)<2) {
			$message[] = 'Le nom est trop court : Min 2car';
			return $message;
		}
		else{
			$this->_prenom = $prenom;
			
		}
		
	}
	public function setTel($tel) {
		$message = [];
		if (!preg_match('#^[0-9]+$#', $tel)) {
			$message[] = 'Le telephone ne doit comporter que des chiffres';
			return $message;
		}
		elseif (strlen($tel) > 12 || strlen($tel) < 10 ) {
			$message[] = 'Pas le bon nombre de chiffre : entre 10 et 12';
			return $message;
		}
		else{
			$this->_tel = $tel;
		}
		
	}
	public function setImage($image) {
		$message = [];
		if (strlen($image) > 100 ) {
			$message[] = 'Url trop longue';
			return $message;
		}
		$this->_image = $image;
	}
	public function setDescriptifFR($descriptifFR) {
		$message = [];
		if (strlen($descriptifFR) > 2000) {
			$message[] = 'Votre texte est trop long : 2000 caracteres Max';
			return $message;
		}elseif (strlen($descriptifFR) < 5 ) {
			$message[] = 'Votre texte est trop court : 5 caracteres Min';
			return $message;
		}
		else{
			$this->_descriptifFR = $descriptifFR;
		}
	}
	public function setEmail($email) {
		$message = [];
		$atom = '[-a-z0-9!#$%&\'*+\\/=?^_`{|}~]';
		$domain = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)';
		$regexmail = '/^' . $atom . '+' . '(\.' . $atom . '+)*' . '@' . '(' . $domain . '{1,63}\.)+' .$domain . '{2,63}$/i';
		if (strlen($email) != 0 && !preg_match($regexmail, $email)) {
			$message[] = 'Pas le bon format d\'email';
			return $message;
		}elseif (strlen($email) > 100 ) {
			$message[] = 'Email trop long !';
			return $message;
		}
		else{
			$this->_email = $email;
		}
	}

	//GETTERS

	public function getIdArtiste() {
		return $this->_idArtiste;
	}
	public function getNom() {
		return $this->_nom;
	}
	public function getPrenom() {
		return $this->_prenom;
	}
	public function getTel() {
		return $this->_tel;
	}
	public function getImage() {
		return $this->_image;
	}
	public function getDescriptifFR() {
		return $this->_descriptifFR;
	}
	public function getEmail() {
		return $this->_email;
	}


	
}