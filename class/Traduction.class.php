<?php 


class Traduction {

	private $_idTraduction;
	private $_texteTraduit;
	private $_idArtiste;
	private $_idCollectif;
	private $_idOeuvre;
	private $_idExpo;
	private $_idLangue;

/*	public function hydrate($datatraduction) {
		foreach ($datatraduction as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}*/

	/*	public function __construct() {
			
		}*/

	//SETTERS 

	public function setIdTraduction($idTraduction) {
		$this->_idTraduction = $idTraduction;
	}
	public function setTexteTraduit($texteTraduit) {
		$this->_texteTraduit = $texteTraduit;
		
	}
	public function setIdArtiste($idArtiste) {
		$this->_idArtiste = $idArtiste;
		
	}
		public function setIdCollectif($idCollectif) {
		$this->_idCollectif = $idCollectif;	
	}
	
		public function setIdOeuvre($idOeuvre) {
		$this->_idOeuvre = $idOeuvre;
		
	}
		public function setIdExpo($idExpo) {
		$this->_idExpo = $idExpo;
		
	}	public function setIdLangue($_idLangue) {
		$this->_idLangue = $idLangue;
		
	}

	//GETTERS

	public function getIdTraduction() {
		return $this->_idTraduction;
	}
	public function getTexteTraduit() {
		return $this->_texteTraduit;
	}
	public function getIdArtiste() {
		return $this->_idArtiste;
	}
	public function getIdCollectif() {
		return $this->_idCollectif;
	}
	public function getidOeuvre() {
		return $this->_image;
	}
	public function getIdExpo() {
		return $this->_idExpo;
	}
	public function getIdLangue() {
		return $this->_idLangue;
	}

	public function getTraduction($langue,$element,$typeElement){
		global $bdd;	
		$q=$bdd->query("SELECT texteTraduit from Traduction where idLangue=".$langue." and ".$typeElement."=".$element);
		$data=$q->fetch();
		return $data["texteTraduit"];
	}
}