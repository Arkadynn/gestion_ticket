<?php
	// @author=Quentin aka Arkadynn Deputier
	class Duree {
		public function Duree ($debut = "", $fin = "", $idTicket = 0) {
			$this->attr__debut = null;
			$this->attr__fin = null;
			$this->attr__idTicket = 0;

			$this->debut ($debut);
			$this->fin ($fin);
			$this->idTicket ($idTicket);
		}
		
		public function insert () {
			$debut = GestionTicket::quote($this->debut()->format("Y-m-d H:i:s"));
			$fin = GestionTicket::quote($this->fin()->format("Y-m-d H:i:s"));
			$idTicket = GestionTicket::quote($this->attr__idTicket);

			$sql = "INSERT INTO `Duree` (`debut`, `fin`, `idTicket`) VALUES ($debut, $fin, $idTicket)";

			return GestionTicket::exec ($sql);
		}
		
		public function update () {
			$debut = GestionTicket::quote($this->debut()->format("Y-m-d H:i:s"));
			$fin = GestionTicket::quote($this->fin()->format("Y-m-d H:i:s"));
			$idTicket = GestionTicket::quote($this->idTicket());

			$sql = "UPDATE `Duree` SET `fin`=$fin WHERE `debut` = $debut AND `idTicket` = $idTicket";
			return GestionTicket::exec ($sql);

		}
		
		public function delete () {
			$debut = GestionTicket::quote($this->debut()->format("Y-m-d H:i:s"));
			$idTicket = GestionTicket::quote($this->idTicket());

			$sql = "DELETE FROM `Duree` WHERE `debut` = $debut AND `idTicket` = $idTicket;";
			return GestionTicket::exec ($sql);
		}
		
		public static function ListAll () {
			$sql = "SELECT * FROM `Duree`;";
			$rows = GestionTicket::fetchAll($sql);

			$objects = array();

			foreach ($rows as $row) {
				array_push($objects, new Duree ($row["debut"], $row["fin"], $row["idTicket"]));
			}

			return $objects;
		}
		
		public static function GetWhere ($debut = null, $idTicket = null) {
			if (isset($debut) && isset($idTicket)) {
				if (get_class($debut) === "DateTime" && is_numeric($idTicket)) {
					$debut = GestionTicket::quote($debut->format("Y-m-d H:i:s"));
					$idTicket = GestionTicket::quote($idTicket);

					$sql = "SELECT * FROM `Duree` WHERE `debut` = $debut AND `idTicket` = $idTicket;";

					$row = GestionTicket::fetch($sql);
					return new Duree (new DateTime($row["debut"]), new DateTime($row["fin"]), $row["idTicket"]);
				}
			}
			return null;
		}
		
		public static function SearchWhere ($debut = null, $fin = null, $idTicket = null) {
			$isFirst = true;
			$sql = "SELECT * FROM `Duree` WHERE";

			if (isset($debut)) {
				if (get_class($debut) === "DateTime") {
					$debut = GestionTicket::quote($debut->format("Y-m-d H:i:s"));
					$sql = $sql." `debut` = $debut";
					$isFirst = false;
				}
			}

			if (isset($fin)) {
				if (get_class($fin) === "DateTime") {
					$fin = GestionTicket::quote($fin->format("Y-m-d H:i:s"));
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

			$rows = GestionTicket::fetchAll($sql);

			$objects = array();

			foreach ($rows as $row) {
				array_push($objects, new Duree (new DateTime($row["debut"]), new DateTime($row["fin"]), $row["idTicket"]));
			}

			return $objects;
		}

		public function debut ($val = null) {
			if (isset($val))
				if (get_class($val) === "DateTime") {
					$this->attr__debut = $val;
				}
			return $this->attr__debut;
		}

		public function fin ($val = null) {
			if (isset($val))
				if (get_class($val) === "DateTime") {
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