<?php
	class Service {

		public function Service ($idService = 0, $nom = "", $idAgence = 0)
		{
			$this->attr__idService = 0;
			$this->attr__nom = "";
			$this->attr__idAgence = 0;

			idService ($idService);
			nom ($nom);
			idAgence ($idAgence);
		}
		
		public function create () {
			$sql = "CREATE TABLE IF NOT EXISTS `Service` (
						`idService` INT(11) PRIMARY KEY AUTO_INCREMENT,
						`nom` VARCHAR(50) NOT NULL,
						`idAgence` INT(11) NOT NULL,
						FOREIGN KEY `idAgence` REFERENCES `Agence`(`idAgence`)
					);";
		}
		
		public static function update () {}
		
		public static function insert () {}
		
		public static function delete () {}
		
		public static function listAll () {
			$sql = "SELECT * FROM `Service`;";
			// TODO
		}
		
		public static function getWhere ($idService = null, $nom = null, $idAgence = null) {
			// TODO	
		}
		
		public static function searchWhere ($idService = null, $nom = null, $idAgence = null) {

			// TODO	
		}

		public function getUsersFromService()
		{
			$sql = "SELECT * FROM `Appartenir` WHERE `idService` = $this->attr__idService";
			/* TODO fetchAll */

		}

		public function idService ($val = null)
		{
			if (isset($val))
				if (is_int($val)) {
					if (val >= 0)
						$this->attr__idService = $val;
				}
			return $this->attr__idService;
		}

		public function nom ($val = null)
		{
			if (isset($val))
				if (is_string($val)) {
					$this->attr__nom = $val;
				}
			return $this->attr__nom;
		}

		public function idAgence ($val = null)
		{
			if (isset($val))
				if (is_int($val)) {
					if ($val >= 0) {
						$this->attr__idAgence = $val;
					}
				}
			return $this->attr__idAgence;
		}

		private $attr__idService;
		private $attr__nom;
		private $attr__idAgence;
	}
?>