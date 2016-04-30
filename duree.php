<?php
	// @author=Quentin aka Arkadynn Deputier
	class Duree {
		public function Duree ($idTicket = 0, $debut = "", $fin = "") {
			$this->attr__debut = "";
			$this->attr__fin = "";
			$this->attr__idTicket = 0;

			$this->debut ($debut);
			$this->fin ($fin);
			$this->id ($idTicket);
		}
		
		public function insert () {
			$pdo = GestionTicket::$attr__connection;
			$debut = $pdo->quote($this->attr__debut);
			$fin = $pdo->quote($this->attr__fin);
			$idTicket = $pdo->quote($this->attr__idTicket);

			$sql = "INSERT INTO `Ticket` (`debut`, `fin`, `idTicket`) VALUES ('$debut', '$fin', '$idTicket')";
			return GestionTicket::exec ($sql);
		}
		
		public function update () {
			$pdo = GestionTicket::$attr__connection;
			$debut = $this->attr__debut;
			$fin = $this->attr__fin;
			$idTicket = $pdo->quote($this->attr__idTicket);

			$sql = "UPDATE `Ticket` SET `fin`='$fin'";
			return GestionTicket::exec ($sql);

		}
		
		public function delete () {
			$pdo = GestionTicket::$attr__connection;
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
			$pdo = GestionTicket::$attr__connection;
			if (isset($debut) && isset($idTicket)) {
				$debut = $this->attr__debut;
				$idTicket = $this->attr__idTicket;
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
					$this->attr__debut = GestionTicket::quote($val);
				}
			return $this->attr__debut;
		}

		public function fin ($val = null) {
			if (isset($val))
				if (is_string($val)) {
					$this->attr__fin = GestionTicket::quote($val);
				}
			return $this->attr__fin;
		}

		public function id ($val = null) {
			if (isset($val))
				if (is_int($val)) {
					if ($val >= 0) {
						$this->attr__idTicket = GestionTicket::quote($val);
					}
				}
			return $this->attr__idTicket;
		}

		private $attr__debut;
		private $attr__fin;
		private $attr__idTicket;
	}
?>