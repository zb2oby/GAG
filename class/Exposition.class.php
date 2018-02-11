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
	private $_couleurExpo;

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
		$message = [];
		if (strlen($titre) > 100) {
			$message[] = 'Le titre est trop long : Max 100 caracteres';
			return $message;
		}elseif (strlen($titre) < 2) {
			$message[] = 'Le titre est trop court : Min 2 caracteres';
			return $message;
		}
		else{
			$this->_titre = $titre;	
		}
	}
	public function setHoraireO ($horaireO) {
		$this->_horaireO = $horaireO;
	}
	public function setHoraireF ($horaireF) {
		$this->_horaireF = $horaireF;
	}
	public function setTheme ($theme) {
		$message = [];
		if (strlen($theme) > 50) {
			$message[] = 'Le thème est trop long : Max 50 caracteres';
			return $message;
		}elseif (strlen($theme) < 2) {
			$message[] = 'Le thème est trop court : Min 2 caracteres';
			return $message;
		}else{
			$this->_theme = $theme;	
		}
	}
	public function setDescriptifFR ($descriptifFR) {
		$message = [];
		if (strlen($descriptifFR) > 2000) {
			$message[] = 'Votre texte est trop long : 2000 caracteres Max';
			return $message;
		}elseif (strlen($descriptifFR) < 5 ) {
			$message[] = 'Votre texte est trop court : 5 caracteres Min';
			return $message;
		}
		else{
			$this->_descriptifFR = $descriptifFR;
		}
	}
	public function setFrequentation ($frequentation) {
		$this->_frequentation = $frequentation;
	}
	public function setDateDeb ($dateDeb) {
		$message = [];
		$regexdate = '#^((?:19|20)\d{2})-(0?\d|1[012])-(0?\d|[12]\d|3[01])$#';
		if (!preg_match($regexdate, $dateDeb)) {
			$message[] = 'La date doit être au format jj/mm/aaaa';
			return $message;
		}elseif (strlen($dateDeb) < 1) {
			$message[] = 'la date de début est obligatoire';
			return $message;
		}else{
			$this->_dateDeb = $dateDeb;
		}
	}
	public function setDateFin ($dateFin) {
		$message = [];
		$regexdate = '#^((?:19|20)\d{2})-(0?\d|1[012])-(0?\d|[12]\d|3[01])$#';
		if (!preg_match($regexdate, $dateFin)) {
			$message[] = 'La date doit être au format jj/mm/aaaa';
			return $message;
		}elseif (strlen($dateFin) < 1) {
			$message[] = 'la date de fin est obligatoire';
			return $message;
		}else{
			$this->_dateFin = $dateFin;
		}
	}
	public function setTeaser ($teaser) {
		$this->_teaser = $teaser;
	}
	public function setAffiche ($affiche) {
		$this->_affiche = $affiche;
	}
	public function setCouleurExpo ($couleurExpo) {
		if (strlen($couleurExpo) < 7) {
			$message[] = 'La couleur est obligatoire';
			return $message;
		}
		if (preg_match('#^\#[A-Za-z0-9]{6}$#', $couleurExpo)) {
			$message[] = 'Le format doit être du type #de5588';
		}
		$this->_couleurExpo = $couleurExpo;
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
	public function getCouleurExpo () {
		return $this->_couleurExpo;
	}

	//METHODES
}