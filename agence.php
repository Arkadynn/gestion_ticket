<?php
	// @author=Quentin aka Arkadynn Deputier
	class Agence {

		public function Agence($id = 0, $nom = "", $adresse = "") {
			$this->attr__id = 0;
			$this->attr__nom = "";
			$this->attr__adresse = "";

			$this->id ($id);
			$this->nom ($nom);
			$this->adresse ($adresse);
		}
		
		public function insert () {
			$id = GestionTicket::quote($this->id());
			$nom = GestionTicket::quote($this->nom());
			$adresse = GestionTicket::quote($this->adresse());

			if ($id === 0) {
				$sql = "INSERT INTO `Agence` (`nom`, `adresse`) VALUES ($nom, $adresse);";
			} else 
				$sql = "INSERT INTO `Agence` (`id`, `nom`, `adresse`) VALUES ($id, $nom, $adresse);";
			return GestionTicket::exec ($sql);
		}
		
		public function update () {
			$id = GestionTicket::quote($this->id());
			$nom = GestionTicket::quote($this->nom());
			$adresse = GestionTicket::quote($this->adresse());

			$sql = "UPDATE `Agence` SET `nom`=$nom, `adresse`=$adresse WHERE `id`=$id;";
			return GestionTicket::exec ($sql);
		}
		
		public function delete () {
			$id = GestionTicket::quote($this->id());
			$sql = "DELETE FROM `Agence` WHERE `id` = $id;";
			return GestionTicket::exec ($sql);
		}
		
		public static function ListAll () {
			$sql = "SELECT * FROM `Service`;";
			GestionTicket::exec($sql);
		}
		
		public static function GetWhere ($id = null, $nom = null) {
			$isFirst = true;
			$sql = "SELECT * FROM `Agence` WHERE ";

			if (isset($id)) {
				if (is_numeric($id) && $id > 0) {
					$id = GestionTicket::quote($id);
					$sql = $sql."`id` = $id";
					$isFirst = false;
				}
			}

			if (isset($nom)) {
				if (is_string($nom)) {
					$nom = GestionTicket::quote($nom);
					if (!$isFirst)
						$sql = $sql." AND ";
					$sql = $sql."`nom` = $nom";
					$isFirst = false;
				}
			}

			if ($isFirst) 
				return null;

			$row = GestionTicket::fetch($sql);

			$a =  new Agence ($row["id"], $row["nom"], $row["adresse"]);
			return $a;
		}
		
		public static function SearchWhere ($id = null, $nom = null, $adresse = null) {
			$isFirst = true;
			$sql = "SELECT * FROM `Agence` WHERE ";

			if (isset($id)) {
				if (is_numeric($id) && $id > 0) {
					$id = GestionTicket::quote($id);
					$sql = $sql."`id` = $id";
					$isFirst = false;
				}
			}

			if (isset($nom)) {
				if (is_string($nom)) {
					$nom = GestionTicket::quote($nom);
					if (!$isFirst)
						$sql = $sql." AND ";
					$sql = $sql."`nom` = $nom";
					$isFirst = false;
				}
			}

			if (isset($adresse)) {
				if (is_string($adresse)) {
					$adresse = GestionTicket::quote($adresse);
					if (!$isFirst)
						$sql = $sql." AND ";
					$sql = $sql."`adresse` = $adresse";
					$isFirst = false;
				}
			}

			if ($isFirst) 
				return null;

			$rows = GestionTicket::fetchAll($sql);

			$objects = array();

			foreach ($rows as $row) {
				array_push($objects, new Agence($row["id"], $row["nom"], $row["adresse"]));
			}

			return $objects;
		}

		public function id($val = null) {
			if (isset($val)) {
				if (is_numeric($val)) {
					if ($val > 0) {
						$this->attr__id = intval($val);
					}
				}
			}
			return $this->attr__id;
		}

		public function nom ($val = null) {
			if (isset($val)) {
				if (is_string($val)) {
					$this->attr__nom = $val;
				}
			}
			return $this->attr__nom;
		}

		public function adresse ($val = null) {
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