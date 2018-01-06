<?php

class ArtisteExpose {
	private $_idArtiste;
	private $_idExpo;

	public function hydrate($dataArtisteExpose) {
		foreach ($dataArtisteExpose as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function __construct($dataArtisteExpose) {
		$this->hydrate($dataArtisteExpose);
	}

	//SETTERS

	private function setIdArtiste($idArtiste) {
		$this->_idArtiste = $idArtiste;
	}
	private function setIdExpo($idExpo) {
		$this->_idExpo = $idExpo;
	}

	//GETTERS
	
	public function getIdArtiste() {
		return $this->_idArtiste;
	}
	public function getIdExpo() {
		return $this->_idExpo;
	}

}