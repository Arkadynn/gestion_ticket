<?php
	// @author=Quentin aka Arkadynn Deputier
	class Duree {
		public function Duree ($idTicket = 0, $debut = "", $fin = "") {
			$this->attr__debut = "";
			$this->attr__fin = "";
			$this->attr__idTicket = 0;

			$this->debut ($debut);
			$this->fin ($fin);
			$this->idTicket ($idTicket);
		}
		
		public function insert () {
			$debut = GestionTicket::quote($this->attr__debut);
			$fin = GestionTicket::quote($this->attr__fin);
			$idTicket = GestionTicket::quote($this->attr__idTicket);

			$sql = "INSERT INTO `Ticket` (`debut`, `fin`, `idTicket`) VALUES ($debut, $fin, $idTicket)";
			return GestionTicket::exec ($sql);
		}
		
		public function update () {
			$debut = GestionTicket::quote($this->debut());
			$fin = GestionTicket::quote($this->fin());
			$idTicket = GestionTicket::quote($this->idTicket());

			$sql = "UPDATE `Ticket` SET `fin`=$fin WHERE `debut` = $debut AND `idTicket` = $idTicket";
			return GestionTicket::exec ($sql);

		}
		
		public function delete () {
			$debut = GestionTicket::quote($this->debut());
			$idTicket = GestionTicket::quote($this->idTicket());

			$sql = "DELETE FROM `Duree` WHERE `debut` = $debut AND `idTicket` = $idTicket;";
			return GestionTicket::exec ($sql);
		}
		
		public static function ListAll () {
			$sql = "SELECT * FROM `Duree`;";
			return GestionTicket::fetchAll ($sql);
		}
		
		public static function GetWhere ($debut = null, $idTicket = null) {
			if (isset($debut) && isset($idTicket)) {
				$debut = GestionTicket::quote($debut);
				$idTicket = GestionTicket::quote($idTicket);

				$sql = "SELECT * FROM `Duree` WHERE `debut` = $debut AND `idTicket` = $idTicket;";
				
				$row = GestionTicket::fetch($sql);
				
				return new Duree ($row["debut"], $row["fin"], $row["idTicket"]);
			}
		}
		
		public static function SearchWhere ($debut = null, $fin = null, $idTicket = null) {
			$isFirst = true;
			$sql = "SELECT * FROM `Duree` WHERE";

			if (isset($debut)) {
				if (is_string($debut)) {
					$debut = GestionTicket::quote($debut);
					$sql = $sql." `debut` = $debut";
					$isFirst = false;
				}
			}

			if (isset($fin)) {
				if (is_string($fin)) {
					$fin = GestionTicket::quote($fin);
					if (!$isFirst)
						$sql = $sql." AND";
					$sql = $sql." `fin` = $fin";
					$isFirst = false;
				}
			}

			if (isset($idTicket)) {
				if (is_numeric($idTicket) && $idTicket > 0) {
					$idTicket = GestionTicket::quote($idTicket);
					if (!$isFirst)
						$sql = $sql." AND";
					$sql = $sql." `idTicket` = $idTicket";
					$isFirst = false;
				}
			}

			if ($isFirst)
				return null;

			$rows = GestionTicket::fetch($sql);

			return new Duree ($row["debut"], $row["fin"], $row["idTicket"]);
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

		public function idTicket ($val = null) {
			if (isset($val))
				if (is_numeric($val)) {
					if ($val >= 0) {
						$this->attr__idTicket = intval($val);
					}
				}
			return $this->attr__idTicket;
		}

		private $attr__debut;
		private $attr__fin;
		private $attr__idTicket;
	}
?>