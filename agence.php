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
			$id = $this->id();
			$nom = $this->nom();
			$adresse = $this->adresse();

			$sql = "INSERT INTO `Agence` (`id`, `nom`, `adresse`) VALUES ($id, $nom, $adresse);";
			return GestionTicket::exec ($sql);
		}
		
		public function update () {
			$id = $this->id();
			$nom = $this->nom();
			$adresse = $this->adresse();

			$sql = "UPDATE `Agence` SET `nom`=$nom, `adresse`=$adresse WHERE `id`=$id;";
			return GestionTicket::exec ($sql);
		}
		
		public function delete () {
			$id = $this->id();

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
				$id = $this->id();
				$sql = $sql."`id` = $id";
				$isFirst = false;
			}

			if (isset($nom)) {
				$nom = $this->nom();
				if ($isFirst)
					$sql = $sql." AND ";
				$sql = $sql."`nom` = $nom";
				$isFirst = false;
			}

			if (isset($adresse)) {
				$adresse = $this->adresse();
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
					if ($val > 0) {
						$this->attr__id = GestionTicket::quote($val);
					}
				}
			}
			return $this->attr__id;
		}

		public function nom ($val = null)
		{
			if (isset($val)) {
				if (is_string($val)) {
					$this->attr__nom = GestionTicket::quote($val);
				}
			}
			return $this->attr__nom;
		}

		public function adresse ($val = null)
		{
			if (isset($val)) {
				if (is_string($val)) {
					$this->attr__adresse = GestionTicket::quote($val);
				}
			}
			return $this->attr__adresse;
		}

		private $attr__id;
		private $attr__nom;
		private $attr__adresse;
	}
?>