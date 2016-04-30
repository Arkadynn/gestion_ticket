<?php
	// @author=Quentin aka Arkadynn Deputier
	class Ticket {
		
		const ETAT_INVALIDE = -1;
		const ETAT_CREE = 0;
		const ETAT_EN_TRAITEMENT = 1;
		const ETAT_A_VALIDER = 2;
		const ETAT_CLOTURE = 3;
		
		public function Ticket ($id = 0, $titre = "", $objet = "", $importance = 0, $corps = "", $tempsPref = 0, $idUser = 0) {

			$this->attr__id = 0;
			$this->attr__titre = "";
			$this->attr__objet = "";
			$this->attr__importance = 0;
			$this->attr__etat = self::ETAT_INVALIDE;
			$this->attr__corps = "";
			$this->attr__tempsPref = 0;
			$this->attr__idUser = 0;

			$this->id ($id);
			$this->titre ($titre);
			$this->objet ($objet);
			$this->etat (self::ETAT_CREE);
			$this->importance ($importance);
			$this->corps ($corps);
			$this->tempsPref($tempsPref);
			$this->idUser($idUser);
		}
		
		public function insert () {
			$id = $this->id();
			$titre = $this->titre();
			$objet = $this->objet();
			$etat = $this->etat();
			$importance = $this->importance();
			$corps = $this->corps();
			$tempsPref = $this->tempsPref();
			$idUser = $this->idUser();
			$sql = "INSERT INTO `Ticket` (`id`, `titre`, `objet`, `etat`, `importance`, `corps`, `tempsPref`, `idUser`) 
					VALUES ('$id', '$titre', '$objet', '$etat', '$importance', '$corps', '$tempsPref', '$idUser');";
			GestionTicket::exec($sql);
		}
		
		public function update () {
			$id = $this->id();
			$titre = $this->titre();
			$objet = $this->objet();
			$etat = $this->etat();
			$importance = $this->importance();
			$corps = $this->corps();
			$tempsPref = $this->tempsPref();
			$idUser = $this->idUser();
			$sql = "UPDATE `Ticket` SET `titre`=$titre, `objet`=$objet, `etat`=$etat, `importance`=$importance, `corps`=$corps, `tempsPref`=$tempsPref, `idUser`=$idUser WHERE `id` = $id";
			GestionTicket::exec($sql);
		}
		
		public function delete () {
			$pdo = GestionTicket::$attr__connection;
			$id = $this->id();

			$sql = "DELETE FROM `Ticket` WHERE `id` = $id;";
			GestionTicket::exec($sql);
		}
		
		public static function listAll () {
			$sql = "SELECT * FROM `Ticket`;";
			return GestionTicket::fetchAll ($sql);
		}
		
		public static function getWhere ($id = null) {
			$pdo = GestionTicket::$attr__connection;
			if (isset($id)) {
				$id = $this->id();
				$sql = "SELECT * FROM `Ticket` WHERE `id` = $id;";
				$rows = GestionTicket::fetchAll ($sql);
				$row = $rows[0];
				return new Ticket ($row["id"], $row["titre"], $row["objet"], $row["importance"], $row["etat"], $row["corps"], $row["tempsRef"], $row["idUser"]);
			}
		}
		
		public static function searchWhere ($id = null, $titre = null, $objet = null, $etat = null, $importance = null, $corps = null, $tempsPref = null, $idUser = null) {
			// TODO
		}
		
		public function getTicketsFromUser ($userID = null) {
			$ans = null;
			if (isset($userID)) {
			if (is_int($userID)) {
				if ($userID >= 0) 
					$userID = GestionTicket::quote($userID);
					$sql = "SELECT * FROM `Ticket` WHERE `id` IN (SELECT `id` FROM `Ticket` WHERE `idUser` = $userID";
					$ans = GestionTicket::fetchAll($sql);
				}
			}
			return $ans;
		}
		
		public function id ($val = null) {
			if (isset ($val))
			if (is_int ($val)) {
				if ($val >= 0) {
					$this->attr__id = GestionTicket::quote($val);
				}
			}
			return $this->attr__id;
		}
		
		public function titre ($val = null) {
			if (isset ($val))
			if (is_string ($val)) {
				$this->attr__titre = GestionTicket::quote($val);
			}
			return $this->attr__titre;
		}
		
		public function objet ($val = null) {
			if (isset ($val))
			if (is_string ($val)) {
				$this->attr__objet = GestionTicket::quote($val);
			}
			return $this->attr__objet;
		}
		
		public function importance ($val = null) {
			if (isset ($val))
			if (is_int ($val)) {
				$this->attr__importance = GestionTicket::quote($val);
			}
			return $this->attr__importance;
		}
		
		public function etat ($val = null) {
			if (isset ($val))
			if (is_int ($val)) {
				if ($val >= 0 && $val <= 3) {
					$this->attr__etat = GestionTicket::quote($val);
				}
			}
			return $this->attr__etat;
		}
		
		public function corps ($val = null) {
			if (isset ($val))
			if (is_string ($val)) {
				$this->attr__corps = GestionTicket::quote($val);
			}
			return $this->attr__corps;
		}

		public function tempsPref($val = null) {
			if (isset($val))
			if (is_int($val)) {
				if ($val > 0)
					$this->attr__tempsPref = GestionTicket::quote($val);
			}
			return $this->attr__tempsPref;
		}

		public function idUser($val = null)	{
			if (isset($val))
			if (is_int($val)) {
				if ($val >= 0)
					$this->attr__idUser = GestionTicket::quote($val);
			}
			return $this->attr__idUser;
		}
		
		private $attr__id;
		private $attr__titre;
		private $attr__objet;
		private $attr__importance;
		private $attr__etat;
		private $attr__corps;
		private $attr__tempsPref;
		private $attr__idUser;
	}
?>
