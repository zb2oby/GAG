<?php 

class Emplacement {

	private $_coordLeft = 50;
	private $_coordTop = 50;
	private $_idExpo;
	private $_idOeuvreExposee;
	private $_idEmplacement;


	public function hydrate($dataEmplacement) {
		foreach ($dataEmplacement as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function __construct($dataEmplacement) {
		$this->hydrate($dataEmplacement);
	}

	//SETTERS

	private function setCoordLeft ($coordLeft) {
		$this->_coordLeft = $coordLeft;
	}
	private function setCoordTop ($coordTop) {
		$this->_coordTop = $coordTop;
	}
	private function setIdExpo ($idExpo) {
		$this->_idExpo = $idExpo;
	}
	private function setIdOeuvreExposee ($idOeuvreExposee) {
		$this->_idOeuvreExposee = $idOeuvreExposee;
	}
	private function setIdEmplacement ($idEmplacement) {
		$this->_idEmplacement = $idEmplacement;
	}

	//GETTERS

	public function getCoordLeft () {
		return $this->_coordLeft;
	}
	public function getCoordTop () {
		return $this->_coordTop;
	}
	public function getIdOeuvreExposee () {
		return $this->_idOeuvreExposee;
	}
	public function getIdExpo () {
		return $this->_idExpo;
	}
	public function getIdEmplacement () {
		return $this->_idEmplacement;
	}

	//METHODES

	public function modifCoordLeft($coordLeft) {
		$this->setCoordLeft($coordLeft);
	}
	public function modifCoordTop($coordTop) {
		$this->setCoordTop($coordTop);
	}
	public function modifIdOeuvreExposee($idOeuvreExposee) {
		$this->setIdOeuvreExposee($idOeuvreExposee);
	}
	

}