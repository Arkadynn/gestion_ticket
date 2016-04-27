<?php
	class Ticket {
		
		const ETAT_INVALIDE = -1;
		const ETAT_CREE = 0;
		const ETAT_EN_TRAITEMENT = 1;
		const ETAT_A_VALIDER = 2;
		const ETAT_CLOTURE = 3;
		
		public function Ticket ($idTicket = 0, $titre = "", $objet = "", $importance = 0, $corps = "", $tempsPref = 0, $idUser = 0) {

			$this->attr__idTicket = 0;
			$this->attr__titre = "";
			$this->attr__objet = "";
			$this->attr__importance = 0;
			$this->attr__etat = self::ETAT_INVALIDE;
			$this->attr__corps = "";
			$this->attr__tempsPref = 0;
			$this->attr__idUser = 0;

			$this->idTicket ($idTicket);
			$this->titre ($titre);
			$this->objet ($objet);
			$this->etat (self::ETAT_CREE);
			$this->importance ($importance);
			$this->corps ($corps);
			$this->tempsPref($tempsPref);
			$this->idUser($idUser);
		}
		
		public static function create () {
			$sql = "CREATE TABLE IF NOT EXISTS `Ticket` (
						`idTicket` INT(11) PRIMARY KEY AUTO_INCREMENT,
						`titre` VARCHAR(255) NOT NULL,
						`objet` VARCHAR(255) NOT NULL,
						`etat` INT(2) NOT NULL,
						`importance` INT(2) NOT NULL,
						`corps` VARCHAR(1024) NOT NULL,
						`tempsPref` INT (11) NOT NULL,
						`idUser` INT (11) NOT NULL,
						FOREIGN KEY (`idUser`) REFERENCES `Utilisateur`(`id`)
					);";
			return GestionTicket::exec ($sql);
		}

		public static function drop () {}
		
		public function insert () {
			$idTicket = $this->attr__idTicket;
			$titre = $this->attr__titre;
			$objet = $this->attr__objet;
			$etat = $this->attr__etat;
			$importance = $this->attr__importance;
			$corps = $this->attr__corps;
			$tempsPref = $this->attr__tempsPref;
			$idUser = $this->attr__idUser;
			$sql = "INSERT INTO `Ticket` (`idTicket`, `titre`, `objet`, `etat`, `importance`, `corps`, `tempsPref`, `idUser`) 
					VALUES ('$idTicket', '$titre', '$objet', '$etat', '$importance', '$corps', '$tempsPref', '$idUser');";
			GestionTicket::exec($sql);
		}
		
		public function update () {}
		
		public function delete () {}
		
		public static function listAll () {
			$sql = "SELECT * FROM `Ticket`;";
			return GestionTicket::fetchAll ($sql);
		}
		
		public static function getWhere ($idTicket = null, $titre = null, $objet = null, $etat = null, $importance = null, $corps = null, $tempsPref = null, $idUser = null) {
			// TODO	
		}
		
		public static function searchWhere ($idTicket = null, $titre = null, $objet = null, $etat = null, $importance = null, $corps = null, $tempsPref = null, $idUser = null) {
			// TODO	
		}
		
		public function getTicketsFromUser ($userID = null) {
			$ans = null;
			if (isset($userID))
			if (is_int($userID)) {
				if ($userID >= 0) {
					$sql = "SELECT * FROM `Ticket` WHERE `idTicket` IN (SELECT `idTicket` FROM `Ticket` WHERE `idUser` = $userID";
					$ans = GestionTicket::fetchAll($sql);
				}
			}
			return $ans;
		}
		
		public function idTicket ($val = null) {
			if (isset ($val))
			if (is_int ($val)) {
				if ($val >= 0) {
					$this->attr__id = $val;
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
			if (is_int ($val)) {
				$this->attr__importance = $val;
			}
			return $this->attr__importance;
		}
		
		public function etat ($val = null) {
			if (isset ($val))
			if (is_int ($val)) {
				if ($val >= 0 && $val <= 3) {
					$this->attr__etat = $val;
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
			if (is_int($val)) {
				if ($val > 0)
					$this->attr__tempsPref = $val;
			}
			return $this->attr__tempsPref;
		}

		public function idUser($val = null)	{
			if (isset($val))
			if (is_int($val)) {
				if ($val >= 0)
					$this->attr__idUser = $val;
			}
			return $this->attr__idUser;
		}
		
		private $attr__idTicket;
		private $attr__titre;
		private $attr__objet;
		private $attr__importance;
		private $attr__etat;
		private $attr__corps;
		private $attr__tempsPref;
		private $attr__idUser;
	}
?>
