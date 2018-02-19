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

	public function setIdCollectif ($idCollectif) {
		$this->_idCollectif = $idCollectif;
	}
	public function setLibelleCollectif ($libelleCollectif) {
		$message = [];
		if (strlen($libelleCollectif) > 50 ) {
			$message[] = 'Le Libellé est trop long : max 50';
			return $message;
		}elseif (strlen($libelleCollectif) < 2 ) {
			$message[] = 'Le Libellé est trop court : min 2';
			return $message;
		}
		else{
			$this->_libelleCollectif = $libelleCollectif;
			
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
	public function setEmail ($email) {
		$message = [];
		$atom = '[-a-z0-9!#$%&\'*+\\/=?^_`{|}~]';
		$domain = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)';
		$regexmail = '/^' . $atom . '+' . '(\.' . $atom . '+)*' . '@' . '(' . $domain . '{1,63}\.)+' .$domain . '{2,63}$/i';
		if (strlen($email) != 0 && !preg_match($regexmail, $email)) {
			$message[] = 'Pas le bon format d\'email';
			return $message;
		}elseif (strlen($email) > 100 ) {
			$message[] = 'Email trop long !';
			return $message;
		}
		else{
			$this->_email = $email;
		}
	}
	public function setTel ($tel) {
		$message = [];
		if (!preg_match('#^[0-9]+$#', $tel)) {
			$message[] = 'Le telephone ne doit comporter que des chiffres';
			return $message;
		}
		elseif (strlen($tel) > 12 || strlen($tel) < 10 ) {
			$message[] = 'Pas le bon nombre de chiffre : entre 10 et 12';
			return $message;
		}
		else{
			$this->_tel = $tel;
		}
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