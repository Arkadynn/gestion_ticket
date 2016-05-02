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
			$pdo = GestionTicket::$attr__connection;
			$id = $this->id();
			$nom = $this->nom();
			$idAgence = $this->idAgence();

			$sql = "INSERT INTO `Service` (`id`, `nom`, `idAgence`) VALUES ('$id', '$nom', '$idAgence');";
			return GestionTicket::exec ($sql);
		}

		public function update () {
			$pdo = GestionTicket::$attr__connection;
			$id = $this->id();
			$nom = $this->nom();
			$idAgence = $this->idAgence();

			$sql = "UPDATE `Service` SET `nom`='$nom', `idAgence`='$idAgence' WHERE `id`=$id;";
			return GestionTicket::exec ($sql);
		}
		
		public function delete () {
			$pdo = GestionTicket::$attr__connection;
			$id = $this->id();
			$sql = "DELETE FROM `Service` WHERE `id` = '$id';";
			return GestionTicket::exec ($sql);
		}
		
		public static function listAll () {
			$sql = "SELECT * FROM `Service`;";
			return GestionTicket::fetchAll ($sql);
		}
		
		public static function getWhere ($id = null, $nom = null) {
			$isFirstArg = true;
			$sql = "SELECT * FROM `Service` WHERE ";
			if (isset($id)) {
				if (is_int($id) && $id > 0) {
					$id = GestionTicket::quote($id);
					$sql = $sql."`id` = '$id'";
					$isFirstArg = false;
				}
			}

			if (isset($nom)) {
				if (is_string($nom)) {
					$nom = GestionTicket::quote($nom);
					if (!$isFirstArg) {
						$sql = $sql." AND ";
					}

					$sql = $sql."`nom` = '$nom';";
					$isFirstArg = false;
				}
			}

			if ($isFirstArg) 
				return null;

			$rows = GestionTicket::fetch($sql);

			return new Service ($row["id"], $row["nom"], $row["idAgence"]);
		}
		
		public static function searchWhere ($id = null, $nom = null, $idAgence = null) {
			$isFirstArg = true;
			$sql = "SELECT * FROM `Service` WHERE ";
			if (isset($id)) {
				if (is_int($id) && $id > 0) {
					$id = GestionTicket::quote($id);
					$sql = $sql."`id` = '$id'";
					$isFirstArg = false;
				}
			}

			if (isset($nom)) {
				if (is_string($nom)) {
					$nom = GestionTicket::quote($nom);
					if (!$isFirstArg) {
						$sql = $sql." AND ";
					}

					$sql = $sql."`nom` = '$nom';";
					$isFirstArg = false;
				}
			}

			if (isset($idAgence)) {
				if (is_int($idAgence) && $idAgence > 0) {
					$idAgence = GestionTicket::quote($idAgence);
					$sql = $sql."`idAgence` = '$idAgence'";
					$isFirstArg = false;
				}
			}

			if ($isFirstArg) 
				return null;

			$rows = GestionTicket::fetchAll($sql);

			$objects = array();

			foreach ($rows as $row) {
				array_push($objects, new Agence($row["id"], $row["nom"], $row["idAgence"]));
			}

			return $objects;
		}

		public function getUsersFromService() {
			$sql = "SELECT * FROM `Appartenir` WHERE `id` = $this->attr__id";
			return GestionTicket::fetchAll ($sql);
		}

		public function id ($val = null) {
			if (isset($val))
				if (is_int($val)) {
					if ($val >= 0)
						$this->attr__id = GestionTicket::quote($val);
				}
			return $this->attr__id;
		}

		public function nom ($val = null) {
			if (isset($val))
				if (is_string($val)) {
					$this->attr__nom = GestionTicket::quote($val);
				}
			return $this->attr__nom;
		}

		public function idAgence ($val = null) {
			if (isset($val))
				if (is_int($val)) {
					if ($val >= 0) {
						$this->attr__idAgence = GestionTicket::quote($val);
					}
				}
			return $this->attr__idAgence;
		}

		private $attr__id;
		private $attr__nom;
		private $attr__idAgence;
	}
?>