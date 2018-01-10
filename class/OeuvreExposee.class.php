<?php 

class OeuvreExposee {

	private $_idOeuvreExposee;
	private $_dateEntree;
	private $_dateSortie;
	private $_nbClic;
	private $_nbFlash;
	// private $_idEmplacement;
	private $_idOeuvre;
	private $_idExpo;

	public function hydrate($dataOeuvreExposee) {
		foreach ($dataOeuvreExposee as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function __construct($dataOeuvreExposee) {
		$this->hydrate($dataOeuvreExposee);
	}

	//SETTERS

	private function setIdOeuvreExposee ($idOeuvreExposee) {
		$this->_idOeuvreExposee = $idOeuvreExposee;
	}
	private function setDateEntree ($dateEntree) {
		$this->_dateEntree = $dateEntree;
	}
	private function setDateSortie ($dateSortie) {
		$this->_dateSortie = $dateSortie;
	}
	private function setNbClic ($nbClic) {
		$this->_nbClic = $nbClic;
	}
	private function setNbFlash ($nbFlash) {
		$this->_nbFlash = $nbFlash;
	}
	// private function setIdEmplacement ($idEmplacement) {
	// 	$this->_idEmplacement = $idEmplacement;
	// }
	private function setIdExpo ($idExpo) {
		$this->_idExpo = $idExpo;
	}
	private function setIdOeuvre ($idOeuvre) {
		$this->_idOeuvre = $idOeuvre;
	}

	//GETTERS

	public function getIdOeuvreExposee () {
		return $this->_idOeuvreExposee;
	}
	public function getDateEntree () {
		return $this->_dateEntree;
	}
	public function getDateSortie () {
		return $this->_dateSortie;
	}
	public function getNbClic () {
		return $this->_nbClic;
	}
	public function getNbFlash () {
		return $this->_nbFlash;
	}
	// public function getIdEmplacement () {
	// 	return $this->_idEmplacement;
	// }
	public function getIdExpo () {
		return $this->_idExpo;
	}
	public function getIdOeuvre () {
		return $this->_idOeuvre;
	}

	//METHODES
	public function modifDateEntree($today) {
		$this->setDateEntree($today);
	}
}