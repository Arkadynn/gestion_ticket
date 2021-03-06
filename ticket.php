<?php
	// @author=Quentin aka Arkadynn Deputier
	class Ticket {
		
		const ETAT_INVALIDE = -1;
		const ETAT_CREE = 0;
		const ETAT_EN_TRAITEMENT = 1;
		const ETAT_A_VALIDER = 2;
		const ETAT_CLOTURE = 3;
		
		public function Ticket ($id = 0, $titre = "", $objet = "", $importance = 0, $corps = "", $tempsPref = 0, $idUser = 0, $etat = self::ETAT_INVALIDE) {

			$this->attr__id = 0;
			$this->attr__titre = "";
			$this->attr__objet = "";
			$this->attr__importance = 0;
			$this->attr__etat = self::ETAT_INVALIDE;
			$this->attr__corps = "";
			$this->attr__tempsPref = 0;
			$this->attr__idUser = 0;

			$this->id($id);
			$this->titre ($titre);
			$this->objet ($objet);
			$this->etat (self::ETAT_CREE);
			$this->importance ($importance);
			$this->corps ($corps);
			$this->tempsPref($tempsPref);
			$this->idUser($idUser);
		}
		
		public function insert () {
			$id = GestionTicket::quote($this->id());
			$titre = GestionTicket::quote($this->titre());
			$objet = GestionTicket::quote($this->objet());
			$etat = GestionTicket::quote($this->etat());
			$importance = GestionTicket::quote($this->importance());
			$corps = GestionTicket::quote($this->corps());
			$tempsPref = GestionTicket::quote($this->tempsPref());
			$idUser = GestionTicket::quote($this->idUser());

			if ($id === 0) {
				$sql = "INSERT INTO `Ticket` (`titre`, `objet`, `etat`, `importance`, `corps`, `tempsPref`, `idUser`) 
						VALUES ($titre, $objet, $etat, $importance, $corps, $tempsPref, $idUser);";
			} else {
				$sql = "INSERT INTO `Ticket` (`id`, `titre`, `objet`, `etat`, `importance`, `corps`, `tempsPref`, `idUser`) 
						VALUES ($id, $titre, $objet, $etat, $importance, $corps, $tempsPref, $idUser);";
			}

			return GestionTicket::exec($sql);
		}
		
		public function update () {
			$id = GestionTicket::quote($this->id());
			$titre = GestionTicket::quote($this->titre());
			$objet = GestionTicket::quote($this->objet());
			$etat = GestionTicket::quote($this->etat());
			$importance = GestionTicket::quote($this->importance());
			$corps = GestionTicket::quote($this->corps());
			$tempsPref = GestionTicket::quote($this->tempsPref());
			$idUser = GestionTicket::quote($this->idUser());
			$sql = "UPDATE `Ticket` SET `titre`=$titre, `objet`=$objet, `etat`=$etat, `importance`=$importance, `corps`=$corps, `tempsPref`=$tempsPref, `idUser`=$idUser WHERE `id` = $id";
			GestionTicket::exec($sql);
		}
		
		public function delete () {
			$pdo = GestionTicket::$attr__connection;
			$id = $this->id();

			$sql = "DELETE FROM `Ticket` WHERE `id` = $id;";
			GestionTicket::exec($sql);
		}
		
		public static function ListAll () {
			$sql = "SELECT * FROM `Ticket`;";
			$rows = GestionTicket::fetchAll($sql);

			$objects = array();

			foreach ($rows as $row) {
				array_push($objects, new Ticket ($row["id"], $row["titre"], $row["objet"], $row["importance"], $row["etat"], $row["corps"], $row["tempsRef"], $row["idUser"]));
			}

			return $objects;
		}
		
		public static function GetWhere ($id = null) {
			if (isset($id)) {
				if (is_numeric($id) && $id > 0) {
					$id = GestionTicket::quote($id);
					$sql = "SELECT * FROM `Ticket` WHERE `id` = $id;";

					$row = GestionTicket::fetch($sql);
					$t = new Ticket ($row["id"], $row["titre"], $row["objet"], $row["importance"], $row["etat"], $row["corps"], $row["tempsRef"], $row["idUser"]);
					return $t;
				}
			}
			return null;
		}
		
		public static function SearchWhere ($id = null, $titre = null, $objet = null, $etat = null, $importance = null, $corps = null, $tempsPref = null, $idUser = null) {
			$isFirst = true;
			$sql = "SELECT * FROM `Ticket` WHERE ";

			if (isset($id)) {
				if (is_numeric($id) && $id > 0) {
					$id = GestionTicket::quote($id);
					$sql = $sql."`id` = $id";
					$isFirst = false;
				}
			}

			if (isset($titre)) {
				if (is_string($titre)) {
					$titre = GestionTicket::quote($titre);
					if (!$isFirst) {
						$sql = $sql." AND ";
					}

					$sql = $sql."`titre` = $titre;";
					$isFirst = false;
				}
			}

			if (isset($objet)) {
				if (is_string($objet)) {
					$objet = GestionTicket::quote($objet);
					if (!$isFirst) {
						$sql = $sql." AND ";
					}

					$sql = $sql."`objet` = $objet;";
					$isFirst = false;
				}
			}

			if (isset($etat)) {
				if (is_numeric($etat) && $etat > self::ETAT_INVALIDE) {
					$etat = GestionTicket::quote($etat);
					if (!$isFirst) {
						$sql = $sql." AND ";
					}
					
					$sql = $sql."`etat` = $etat";
					$isFirst = false;
				}
			}

			if (isset($importance)) {
				if (is_numeric($importance)) {
					$importance = GestionTicket::quote($importance);
					if (!$isFirst) {
						$sql = $sql." AND ";
					}

					$sql = $sql."`importance` = $importance";
					$isFirst = false;
				}
			}

			if (isset($corps)) {
				if (is_string($corps)) {
					$corps = GestionTicket::quote($corps);
					if (!$isFirst) {
						$sql = $sql." AND ";
					}

					$sql = $sql."`corps` = $corps;";
					$isFirst = false;
				}
			}

			if (isset($tempsPref)) {
				if (is_numeric($tempsPref)) {
					$tempsPref = GestionTicket::quote($tempsPref);
					if (!$isFirst) {
						$sql = $sql." AND ";
					}

					$sql = $sql."`tempsPref` = $tempsPref;";
					$isFirst = false;
				}
			}

			if (isset($idUser)) {
				if (is_numeric($idUser) && $idUser > 0) {
					$idUser = GestionTicket::quote($idUser);
					if (!$isFirst) {
						$sql = $sql." AND ";
					}

					$sql = $sql."`idUser` = $idUser";
					$isFirst = false;
				}
			}

			if ($isFirst) 
				return null;

			echo $sql;

			$rows = GestionTicket::fetchAll($sql);

			$objects = array();

			foreach ($rows as $row) {
				array_push($objects, new Ticket ($row["id"], $row["titre"], $row["objet"], $row["importance"], $row["corps"], $row["tempsPref"], $row["idUser"], $row["etat"]));
			}

			return $objects;
		}
		
		public function getTicketsFromUser ($userID = null) {
			$ans = null;
			if (isset($userID)) {
			if (is_numeric($userID)) {
				if ($userID >= 0) 
					$userID = GestionTicket::quote($userID);
					$sql = "SELECT * FROM `Ticket` WHERE `id` IN (SELECT `id` FROM `Ticket` WHERE `idUser` = $userID";
					$ans = GestionTicket::fetchAll($sql);
				}
			}
			return $ans;
		}

		public function getAuthor () {
			$idUser = $this->idUser();
			if ($idUser > 0) {
				$user = Utilisateur::GetWhere ($idUser);
				return $user;
			}
			return null;
		}
		
		public function id ($val = null) {
			if (isset ($val)) {
				if (is_numeric ($val)) {
					if ($val > 0) {
						$this->attr__id = intval($val);
					}
				}
			}
			return $this->attr__id;
		}
		
		public function titre ($val = null) {
			if (isset ($val))
			if (is_string ($val)) {
				$this->attr__titre = $val;
			}
			return $this->attr__titre;
		}
		
		public function objet ($val = null) {
			if (isset ($val))
			if (is_string ($val)) {
				$this->attr__objet = $val;
			}
			return $this->attr__objet;
		}
		
		public function importance ($val = null) {
			if (isset ($val))
			if (is_numeric ($val)) {
				$this->attr__importance = intval($val);
			}
			return $this->attr__importance;
		}
		
		public function etat ($val = null) {
			if (isset ($val))
			if (is_numeric ($val)) {
				if ($val >= 0 && $val <= 3) {
					$this->attr__etat = intval($val);
				}
			}
			return $this->attr__etat;
		}
		
		public function corps ($val = null) {
			if (isset ($val))
			if (is_string ($val)) {
				$this->attr__corps = $val;
			}
			return $this->attr__corps;
		}

		public function tempsPref($val = null) {
			if (isset($val))
			if (is_numeric($val)) {
				if ($val > 0)
					$this->attr__tempsPref = intval($val);
			}
			return $this->attr__tempsPref;
		}

		public function idUser($val = null)	{
			if (isset($val))
			if (is_numeric($val)) {
				if ($val >= 0)
					$this->attr__idUser = intval($val);
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
