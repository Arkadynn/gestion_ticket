<?php
	class Duree {
		public function Duree ($idTicket = 0, $debut = "", $fin = "") 
		{
			$this->attr__debut = "";
			$this->attr__fin = "";
			$this->attr__idTicket = 0;

			$this->debut ($debut);
			$this->fin ($fin);
			$this->id ($idTicket);
		}
		
		public static function create () {
			$sql = "CREATE TABLE IF NOT EXISTS `Duree` 
				   (
				   		`debut` DATETIME,
				   		`fin` DATETIME,
				   		`idTicket` INT(11),
				   		PRIMARY KEY (`debut`, `idTicket`),
				   		FOREIGN KEY (`idTicket`) REFERENCES `Ticket`(`idTicket`)
				   );";
			return $sql;
		}
		
		public static function update () {}
		
		public static function insert () {}
		
		public static function delete () {
			$sql = "DROP TABLE `Duree`;";
		}
		
		public static function listAll () {
			$sql = "SELECT * FROM `Duree`;";
			// TODO
		}
		
		public static function getWhere ($debut = null, $fin = null, $id = null) {
			// TODO	
		}
		
		public static function searchWhere ($debut = null, $fin = null, $id = null) {
			// TODO	
		}

		public function debut ($val = null)
		{
			if (isset($val))
				if (is_string($val)) {
					$this->attr__debut = $val;
				}
			return $this->attr__debut;
		}

		public function fin ($val = null)
		{
			if (isset($val))
				if (is_string($val)) {
					$this->attr__fin = $val;
				}
			return $this->attr__fin;
		}

		public function id ($val = null)
		{
			if (isset($val))
				if (is_int($val)) {
					if ($val >= 0) {
						$this->attr__idTicket = $val;
					}
				}
			return $this->attr__idTicket;
		}

		private $attr__debut;
		private $attr__fin;
		private $attr__idTicket;
	}
?>