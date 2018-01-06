<?php 

class Artiste {

	private $_idArtiste;
	private $_nom;
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

	private function setIdArtiste($idArtiste) {
		$this->_idArtiste = $idArtiste;
	}
	private function setNom($nom) {
		$this->_nom = $nom;
	}
	private function setPrenom($prenom) {
		$this->_prenom = $prenom;
	}
	private function setTel($tel) {
		$this->_tel = $tel;
	}
	private function setImage($image) {
		$this->_image = $image;
	}
	private function setDescriptifFR($descriptifFR) {
		$this->_descriptifFR = $descriptifFR;
	}
	private function setEmail($email) {
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