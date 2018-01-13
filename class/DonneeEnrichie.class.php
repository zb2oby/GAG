<?php 
	class DonneeEnrichie {
		private $_idDonneeEnrichie;
		private $_urlFichier;
		private $_libelleDonneeEnrichie;
		private $_idTypeDonneEnrichie;
		private $_idOeuvre;

		public function hydrate($dataEnrichie) {
			foreach ($dataEnrichie as $key => $value) {
				$method = 'set'.ucfirst($key);
				if (method_exists($this, $method)) {
					$this->$method($value);
				}
			}
		}

		public function __construct($dataEnrichie) {
			$this->hydrate($dataEnrichie);
		}


		public function setIdDonneeEnrichie($idDonnee) {
			$this->_idDonneeEnrichie = $idDonnee;
		}
		public function setUrlFichier($urlFichier) {
			$this->_urlFichier = $urlFichier;
		}
		public function setLibelleDonneeEnrichie($libelleDonnee) {
			$this->_libelleDonneeEnrichie = $libelleDonnee;
		}
		public function setIdTypeDonneEnrichie($idTypeDonnee){
			$this->_idTypeDonneEnrichie = $idTypeDonnee;
		}
		public function setIdOeuvre($idOeuvre) {
			$this->_idOeuvre = $idOeuvre;
		}


		public function getIdDonneeEnrichie(){ 
			return $this->_idDonneeEnrichie;
		}
		public function getUrlFichier(){ 
			return $this->_urlFichier;
		}
		public function getLibelleDonneeEnrichie(){ 
			return $this->_libelleDonneeEnrichie;
		}
		public function getIdTypeDonneEnrichie(){ 
			return $this->_idTypeDonneEnrichie;	
		}
		public function getIdOeuvre(){ 
			return $this->_idOeuvre;
		}




	}
?>