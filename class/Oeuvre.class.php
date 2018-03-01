<?php 

class Oeuvre {
	
	private $_titre = '01 Sans titre';
	private $_longueur;
	private $_hauteur;
	private $_etat;
	private $_image;
	private $_qrcode;
	private $_descriptifFR;
	private $_idOeuvre;
	private $_idTypeOeuvre;
	private $_idArtiste;
	private $_idCollectif;

	public function hydrate($dataOeuvre) {
		foreach ($dataOeuvre as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function __construct($dataOeuvre) {
		$this->hydrate($dataOeuvre);
	}

	//SETTERS

	public function setTitre($titre) {
		$message = [];
		if (strlen($titre) > 100) {
			$message[] = 'Le Titre est trop long (100 caracteres Max';
			return $message;
		}elseif (strlen($titre) < 1) {
			$message[] = 'Le Titre est trop court (1 caracteres Min';
			return $message;
		}
		else{
			$this->_titre = $titre;
		}
	}
	public function setLongueur($longueur) {
		$message = [];
		if (!is_numeric($longueur)) {
			$message[] = 'La longueur doit être un nombre à virgule';
			return $message;
		}
		elseif (strlen($longueur) > 10) {
			$message[] = 'Le nombre est trop grand';
			return $message;
		}else{
			$this->_longueur = $longueur;	
		}
	}
	public function setHauteur($hauteur) {
		$message = [];
		if (!is_numeric($hauteur)) {
			$message[] = 'La hauteur doit être un nombre à virgule';
			return $message;
		}
		elseif (strlen($hauteur) > 10) {
			$message[] = 'Le nombre est trop grand';
			return $message;
		}else{
			$this->_hauteur = $hauteur;	
		}
	}
	public function setEtat($etat) {
		$message = [];
		if (strlen($etat) > 50 ) {
			$message[] = 'le descriptif est trop grand';
			return $message;
		}else{
			$this->_etat = $etat;
		}
		
	}
	public function setImage($image) {
		$message = [];
		if (strlen($image) > 25 ) {
			$message[] = 'Url trop longue';
			return $message;
		}
		$this->_image = $image;
	}
	public function setQrcode($qrcode) {
		$message = [];
		if (strlen($qrcode) > 25 ) {
			$message[] = 'Url trop longue';
			return $message;
		}
		$this->_qrcode = $qrcode;
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
	public function setIdOeuvre($idOeuvre) {
		$this->_idOeuvre = $idOeuvre;
	}
	public function setIdTypeOeuvre($idTypeOeuvre) {
		$this->_idTypeOeuvre = $idTypeOeuvre;
	}
	public function setIdArtiste($idArtiste) {
		$this->_idArtiste = $idArtiste;
	}
	public function setIdCollectif($idCollectif) {
		$this->_idCollectif = $idCollectif;
	}

	//GETTERS

	public function getTitre() {
		return $this->_titre;
	}
	public function getLongueur() {
		return $this->_longueur;
	}
	public function getHauteur() {
		return $this->_hauteur;
	}
	public function getEtat() {
		return $this->_etat;
	}
	public function getImage() {
		return $this->_image;
	}
	public function getQrcode() {
		return $this->_qrcode;
	}
	public function getDescriptifFR() {
		return $this->_descriptifFR;
	}
	public function getIdOeuvre() {
		return $this->_idOeuvre;
	}
	public function getIdTypeOeuvre() {
		return $this->_idTypeOeuvre;
	}
	public function getIdArtiste() {
		return $this->_idArtiste;
	}
	public function getIdCollectif() {
		return $this->_idCollectif;
	}

	//METHODES
	
}