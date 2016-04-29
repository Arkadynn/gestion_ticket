<?php
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
			$id = $this->attr__id;
			$nom = $this->attr__nom;
			$idAgence = $this->attr__idAgence;

			$sql = "INSERT INTO `Service` (`id`, `nom`, `idAgence`) VALUES ('$id', '$nom', '$idAgence');";
			return GestionTicket::exec ($sql);
		}

		public function update () {
			$id = $this->attr__id;
			$nom = $this->attr__nom;
			$idAgence = $this->attr__idAgence;

			$sql = "UPDATE `Service` SET `nom`='$nom', `idAgence`='$idAgence' WHERE `id`=$id;";
			return GestionTicket::exec ($sql);
		}
		
		public function delete () {
			$id = $this->attr__id;
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
				$sql = $sql."`id` = '$id'";
				$isFirstArg = false;
			}

			if (isset($nom)) {
				if (!$isFirstArg) {
					$sql = $sql." AND "
				}

				$sql = $sql."`nom` = '$nom';";
				$isFirstArg = false;
			}

			if ($isFirstArg) 
				return null;

			$rows = GestionTicket::fetchAll ($sql);
			$row = $rows[0];

			return new Service ($row["id"], $row["nom"], $row["idAgence"]);
		}
		
		public static function searchWhere ($id = null, $nom = null, $idAgence = null) {
			// TODO





		}

		public function getUsersFromService() {
			$sql = "SELECT * FROM `Appartenir` WHERE `id` = $this->attr__id";
			return GestionTicket::fetchAll ($sql);
		}

		public function id ($val = null) {
			if (isset($val))
				if (is_int($val)) {
					if ($val >= 0)
						$this->attr__id = $val;
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
				if (is_int($val)) {
					if ($val >= 0) {
						$this->attr__idAgence = $val;
					}
				}
			return $this->attr__idAgence;
		}

		private $attr__id;
		private $attr__nom;
		private $attr__idAgence;
	}
?>