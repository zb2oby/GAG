<?php 

class Message {

	 private $_idMessage;
	 private $_dateMessage;
	 private $_message;
	 private $_idUtilisateur;
	 private $_idOeuvre;
	 private $_idArtiste;
	 private $_idExpo;
	 private $_idCollectif;	

	 public function hydrate($dataMessage) {
		foreach ($dataMessage as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function __construct($dataMessage) {
		$this->hydrate($dataMessage);
	}

	//SETTERS

	public function setIdMessage($idMessage) {
		$this->_idMessage = $idMessage;
	}
	public function setDateMessage($dateMessage) {
		$this->_dateMessage = $dateMessage;
	}
	public function setMessage($message) {
		$this->_message = $message;
	}
	public function setIdUtilisateur($idUtilisateur) {
		$this->_idUtilisateur = $idUtilisateur;
	}
	public function setIdOeuvre($idOeuvre) {
		$this->_idOeuvre = $idOeuvre;
	}
	public function setIdArtiste($idArtiste) {
		$this->_idArtiste = $idArtiste;
	}
	public function setIdExpo($idExpo) {
		$this->_idExpo = $idExpo;
	}
	public function setIdCollectif($idCollectif) {
		$this->_idCollectif = $idCollectif;
	}

	//GETTERS
	public function getIdMessage() {
		return $this->_idMessage;
	}
	public function getDateMessage() {
		return $this->_dateMessage;
	}
	public function getMessage() {
		return $this->_message;
	}
	public function getIdUtilisateur () {
		return $this->_idUtilisateur;
	}
	public function getIdOeuvre($idOeuvre) {
		return $this->_idOeuvre;
	}
	public function getIdArtiste($idArtiste) {
		return $this->_idArtiste;
	}
	public function getIdExpo($idExpo) {
		return $this->_idExpo;
	}
	public function getIdCollectif($idCollectif) {
		return $this->_idCollectif;
	}
}