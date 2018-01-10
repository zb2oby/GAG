<?php

class CollectifExpose {

	private $_idExpo;
	private $_idCollectif;

	public function hydrate($dataCollectifExpose) {
		foreach ($dataCollectifExpose as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function __construct($dataCollectifExpose) {
		$this->hydrate($dataCollectifExpose);
	}



	private function setIdExpo($idExpo) {
		$this->_idExpo = $idExpo;
	}
	private function setIdCollectif($idCollectif) {
		$this->_idCollectif = $idCollectif;
	}

	

	public function getIdExpo() {
		return $this->_idExpo;
	}
	public function getIdCollectif() {
		return $this->_idCollectif;
	}

}