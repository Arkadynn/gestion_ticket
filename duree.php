<?php
	class Duree {
		public function Duree ($idTicket = 0, $debut = "", $fin = "") {
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
				   		FOREIGN KEY (`idTicket`) REFERENCES `Ticket`(`id`)
				   );";
			return GestionTicket::exec ($sql);
		}
		
		public function insert () {
			$debut = $this->attr__debut;
			$fin = $this->attr__fin;
			$idTicket = $this->attr__idTicket;

			$sql = "INSERT INTO `Ticket` (`debut`, `fin`, `idTicket`) VALUES ('$debut', '$fin', '$idTicket')";
			return GestionTicket::exec ($sql)
		}
		
		public function update () {
			$debut = $this->attr__debut;
			$fin = $this->attr__fin;
			$idTicket = $this->attr__idTicket;

			$sql = "UPDATE `Ticket` SET `fin`='$fin'";
			return GestionTicket::exec ($sql)

		}
		
		public function delete () {
			$debut = $this->attr__debut;
			$idTicket = $this->attr__idTicket;

			$sql = "DELETE FROM `Duree` WHERE `debut` = '$debut' AND `idTicket` = '$idTicket';";
			return GestionTicket::exec ($sql);
		}
		
		public static function listAll () {
			$sql = "SELECT * FROM `Duree`;";
			return GestionTicket::fetcAll ($sql);
		}
		
		public static function getWhere ($debut = null, $idTicket = null) {
			if (isset($debut) && isset($idTicket)) {
				$sql = "SELECT * FROM `Duree` WHERE `debut` = $debut AND `idTicket` = $idTicket;";
				$rows = GestionTicket::fetchAll ($sql);
				$row = $rows[0];
				return new Duree ($row["debut"], $row["fin"], $row["idTicket"]);
			}
		}
		
		public static function searchWhere ($debut = null, $fin = null, $idTicket = null) {
			// TODO	
		}

		public function debut ($val = null) {
			if (isset($val))
				if (is_string($val)) {
					$this->attr__debut = $val;
				}
			return $this->attr__debut;
		}

		public function fin ($val = null) {
			if (isset($val))
				if (is_string($val)) {
					$this->attr__fin = $val;
				}
			return $this->attr__fin;
		}

		public function id ($val = null) {
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