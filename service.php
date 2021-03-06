<?php
	// @author=Quentin aka Arkadynn Deputier
	class Service {

		public function Service ($id = 0, $nom = "", $idAgence = 0) {
			$this->attr__id = 0;
			$this->attr__nom = "";
			$this->attr__idAgence = 0;

			$this->id ($id);
			$this->nom ($nom);
			$this->idAgence ($idAgence);
		}

		public function insert () {
			$id = GestionTicket::quote($this->id());
			$nom = GestionTicket::quote($this->nom());
			$idAgence = GestionTicket::quote($this->idAgence());
			if ($this->id() === 0) {
				$sql = "INSERT INTO `Service` (`nom`, `idAgence`) VALUES ($nom, $idAgence);";
			} else 
				$sql = "INSERT INTO `Service` (`id`, `nom`, `idAgence`) VALUES ($id, $nom, $idAgence);";
			return GestionTicket::exec ($sql);
		}

		public function update () {
			$id = GestionTicket::quote($this->id());
			$nom = GestionTicket::quote($this->nom());
			$idAgence = GestionTicket::quote($this->idAgence());

			$sql = "UPDATE `Service` SET `nom`=$nom, `idAgence`=$idAgence WHERE `id`=$id;";
			return GestionTicket::exec ($sql);
		}
		
		public function delete () {
			$id = $this->id();
			$sql = "DELETE FROM `Service` WHERE `id` = $id;";
			return GestionTicket::exec ($sql);
		}
		
		public static function ListAll () {
			$sql = "SELECT * FROM `Service`;";
			$rows = GestionTicket::fetchAll($sql);

			$objects = array();

			foreach ($rows as $row) {
				array_push($objects, new Service($row["id"], $row["nom"], $row["idAgence"]));
			}

			return $objects;
		}
		
		public static function GetWhere ($id = null, $nom = null) {
			$isFirst = true;
			$sql = "SELECT * FROM `Service` WHERE ";

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
					if (!$isFirst) {
						$sql = $sql." AND ";
					}

					$sql = $sql."`nom` = $nom;";
					$isFirst = false;
				}
			}

			if ($isFirst) 
				return null;

			$row = GestionTicket::fetch($sql);

			return new Service ($row["id"], $row["nom"], $row["idAgence"]);
		}
		
		public static function SearchWhere ($id = null, $nom = null, $idAgence = null) {
			$isFirst = true;
			$sql = "SELECT * FROM `Service` WHERE ";
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
					if (!$isFirst) {
						$sql = $sql." AND ";
					}

					$sql = $sql."`nom` = $nom;";
					$isFirst = false;
				}
			}

			if (isset($idAgence)) {
				if (is_numeric($idAgence) && $idAgence > 0) {
					$idAgence = GestionTicket::quote($idAgence);
					if (!$isFirst) {
						$sql = $sql." AND ";
					}
					$sql = $sql."`idAgence` = $idAgence";
					$isFirst = false;
				}
			}

			if ($isFirst) 
				return null;

			$rows = GestionTicket::fetchAll($sql);

			$objects = array();

			foreach ($rows as $row) {
				array_push($objects, new Service($row["id"], $row["nom"], $row["idAgence"]));
			}

			return $objects;
		}

		public function getUsersFromService() {
			$id = $this->id();
			$sql = "SELECT * FROM `Appartenir` WHERE `id` = $id";
			return GestionTicket::fetchAll ($sql);
		}

		public function id ($val = null) {
			if (isset($val))
				if (is_numeric($val)) {
					if ($val >= 0)
						$this->attr__id = intval($val);
				}
			return $this->attr__id;
		}

		public function nom ($val = null) {
			if (isset($val))
				if (is_string($val)) {
					$this->attr__nom = $val;
				}
			return $this->attr__nom;
		}

		public function idAgence ($val = null) {
			if (isset($val))
				if (is_numeric($val)) {
					if ($val >= 0) {
						$this->attr__idAgence = intval($val);
					}
				}
			return $this->attr__idAgence;
		}

		private $attr__id;
		private $attr__nom;
		private $attr__idAgence;
	}
?>