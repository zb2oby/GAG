<?php 

class Exposition {

	private $_idExpo;
	private $_titre;
	private $_horaireO;
	private $_horaireF;
	private $_theme;
	private $_descriptifFR;
	private $_frequentation;
	private $_dateDeb;
	private $_dateFin;
	private $_teaser;
	private $_affiche;

	public function hydrate($dataExposition) {
		foreach ($dataExposition as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function __construct($dataExposition) {
		$this->hydrate($dataExposition);
	}

	//SETTERS

	public function setIdExpo ($idExpo) {
		$this->_idExpo = $idExpo;
	}
	public function setTitre ($titre) {
		$this->_titre = $titre;
	}
	public function setHoraireO ($horaireO) {
		$this->_horaireO = $horaireO;
	}
	public function setHoraireF ($horaireF) {
		$this->_horaireF = $horaireF;
	}
	public function setTheme ($theme) {
		$this->_theme = $theme;
	}
	public function setDescriptifFR ($descriptifFR) {
		$this->_descriptifFR = $descriptifFR;
	}
	public function setFrequentation ($frequentation) {
		$this->_frequentation = $frequentation;
	}
	public function setDateDeb ($dateDeb) {
		$this->_dateDeb = $dateDeb;
	}
	public function setDateFin ($dateFin) {
		$this->_dateFin = $dateFin;
	}
	public function setTeaser ($teaser) {
		$this->_teaser = $teaser;
	}
	public function setAffiche ($affiche) {
		$this->_affiche = $affiche;
	}

	// GETTERS

	public function getIdExpo () {
		return $this->_idExpo;
	}
	public function getTitre () {
		return $this->_titre;
	}
	public function getHoraireO () {
		return $this->_horaireO;
	}
	public function getHoraireF () {
		return $this->_horaireF;
	}
	public function getTheme () {
		return $this->_theme;
	}
	public function getDescriptifFR () {
		return $this->_descriptifFR;
	}
	public function getFrequentation () {
		return $this->_frequentation;
	}
	public function getDateDeb () {
		return $this->_dateDeb;
	}
	public function getDateFin () {
		return $this->_dateFin;
	}
	public function getTeaser () {
		return $this->_teaser;
	}
	public function getAffiche () {
		return $this->_affiche;
	}

	//METHODES
}