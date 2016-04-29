<?php
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
			$id = $this->attr__id;
			$nom = $this->attr__nom;
			$adresse = $this->attr__adresse;

			$sql = "INSERT INTO `Agence` (`id`, `nom`, `adresse`) VALUES ('$id', '$nom', '$adresse');";
			return GestionTicket::exec ($sql);
		}
		
		public function update () {
			$id = $this->attr__id;
			$nom = $this->attr__nom;
			$adresse = $this->attr__adresse;

			$sql = "UPDATE `Agence` SET `nom`=$nom, `adresse`=$adresse WHERE `id`=$id;";
			return GestionTicket::exec ($sql);
		}
		
		public function delete () {
			$id = $this->attr__id;

			$sql = "DELETE FROM `Agence` WHERE `id` = $id;";
			return GestionTicket::exec ($sql);
		}
		
		public static function listAll () {
			$sql = "SELECT * FROM `Service`;";
			// TODO
		}
		
		public static function getWhere ($id = null, $nom = null, $adresse = null) {
			$isFirst = true;
			$sql = "SELECT * FROM `Agence` WHERE ";

			if (isset($id)) {
				$sql = $sql."`id` = $id";
				$isFirst = false;
			}

			if (isset($nom)) {
				if ($isFirst)
					$sql = $sql." AND ";
				$sql = $sql."`nom` = $nom";
				$isFirst = false;
			}

			if (isset($adresse)) {
				if ($isFirst)
					$sql = $sql." AND ";
				$sql = $sql."`adresse` = $adresse";
				$isFirst = false;
			}

			if (isFirst) 
				return null;

			$rows = GestionTicket::fetchAll ($sql);
			$row = $rows[0];
			return new Ticket ($row["id"], $row["nom"], $row["adresse"]);
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