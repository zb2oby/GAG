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
		$this->_nom = $nom;
	}
	public function setPrenom($prenom) {
		$this->_prenom = $prenom;
	}
	public function setTel($tel) {
		$this->_tel = $tel;
	}
	public function setImage($image) {
		$this->_image = $image;
	}
	public function setDescriptifFR($descriptifFR) {
		$this->_descriptifFR = $descriptifFR;
	}
	public function setEmail($email) {
		$this->_email = $email;
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