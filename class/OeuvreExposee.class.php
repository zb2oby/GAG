<?php 

class OeuvreExposee {

	private $_idOeuvreExposee;
	private $_dateEntree;
	private $_dateSortie;
	private $_nbVue;
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

	public function setIdOeuvreExposee ($idOeuvreExposee) {
		$this->_idOeuvreExposee = $idOeuvreExposee;
	}
	public function setDateEntree ($dateEntree) {
		$this->_dateEntree = $dateEntree;
	}
	public function setDateSortie ($dateSortie) {
		$this->_dateSortie = $dateSortie;
	}
	public function setNbVue ($nbVue) {
		$this->_nbVue = $nbVue;
	}
	public function setIdExpo ($idExpo) {
		$this->_idExpo = $idExpo;
	}
	public function setIdOeuvre ($idOeuvre) {
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
	public function getNbVue () {
		return $this->_nbVue;
	}
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