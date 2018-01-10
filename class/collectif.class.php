<?php 

class Collectif {

	private $_idCollectif;
	private $_libelleCollectif;
	private $_descriptifFR;
	private $_email;
	private $_tel;

	public function hydrate($dataCollectif) {
		foreach ($dataCollectif as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function __construct($dataCollectif) {
		$this->hydrate($dataCollectif);
	}

	//SETTERS

	private function setIdCollectif ($idCollectif) {
		$this->_idCollectif = $idCollectif;
	}
	private function setLibelleCollectif ($libelleCollectif) {
		$this->_libelleCollectif = $libelleCollectif;
	}
	private function setDescriptifFR ($descriptifFR) {
		$this->_descriptifFR = $descriptifFR;
	}
	private function setEmail ($email) {
		$this->_email = $email;
	}
	private function setTel ($tel) {
		$this->_tel = $tel;
	}

	//GETTERS

	public function getIdCollectif () {
		return $this->_idCollectif;
	}
	public function getLibelleCollectif () {
		return $this->_libelleCollectif;
	}
	public function getDescriptifFR () {
		return $this->_descriptifFR;
	}
	public function getEmail () {
		return $this->_email;
	}
	public function getTel () {
		return $this->_tel;
	}

	
}