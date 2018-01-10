<?php 

class Oeuvre {
	
	private $_titre;
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
		$this->_titre = $titre;
	}
	public function setLongueur($longueur) {
		$this->_longueur = $longueur;
	}
	public function setHauteur($hauteur) {
		$this->_hauteur = $hauteur;
	}
	public function setEtat($etat) {
		$this->_etat = $etat;
	}
	public function setImage($image) {
		$this->_image = $image;
	}
	public function setQrcode($qrcode) {
		$this->_qrcode = $qrcode;
	}
	public function setDescriptifFR($descriptifFR) {
		$this->_descriptifFR = $descriptifFR;
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