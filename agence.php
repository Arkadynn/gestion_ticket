<?php
	class Agence {

		public function Agence($id = 0, $nom = "", $adresse = "")
		{
			$this->attr__id = 0;
			$this->attr__nom = "";
			$this->attr__adresse = "";

			$this->id ($id);
			$this->nom ($nom);
			$this->adresse ($adresse);
		}
		
		public static function create () {
			$sql = "CREATE TABLE IF NOT EXISTS `Agence` (
						`idAgence` INT(11) PRIMARY KEY AUTO_INCREMENT,
						`nom` VARCHAR(50) NOT NULL,
						`adresse` VARCHAR(100) NOT NULL
					);";
			return GestionTicket::exec ($sql);
		}
		
		public static function update () {}
		
		public static function insert () {}
		
		public static function delete () {}
		
		public static function listAll () {
			$sql = "SELECT * FROM `Service`;";
			// TODO
		}
		
		public static function getWhere ($id = null, $nom = null, $adresse = null) {
			// TODO	
		}
		
		public static function searchWhere ($id = null, $nom = null, $adresse = null) {
			// TODO	
		}

		public function id($val = null)
		{
			if (isset($val)) {
				if (is_int($val)) {
					if ($val >= 0) {
						$this->attr__id = $val;
					}
				}
			}
			return $this->attr__id;
		}

		public function nom ($val = null)
		{
			if (isset($val)) {
				if (is_string($val)) {
					$this->attr__nom = $val;
				}
			}
			return $this->attr__nom;
		}

		public function adresse ($val = null)
		{
			if (isset($val)) {
				if (is_string($val)) {
					$this->attr__adresse = $val;
				}
			}
			return $this->attr__adresse;
		}

		private $attr__id;
		private $attr__nom;
		private $attr__adresse;
	}
?>