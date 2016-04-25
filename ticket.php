<?php
	$t = new Ticket (,"1", "2", "3", "4");
	echo "\r\n".$t->id()." ".$t->titre()." ".$t->objet()." ".$t->etat()." ".$t->importance()." ".$t->corps()."\r\n";
	
	
	class Ticket {
		
		const ETAT_CREE = 0;
		const ETAT_EN_TRAITEMENT = 1;
		const ETAT_A_VALIDER = 2;
		const ETAT_CLOTURE = 3;
		
		public function Ticket ($id = 0, $titre = "", $objet = "", $importance = "", $corps = "") {
			$this->id ($id);
			$this->titre ($titre);
			$this->objet ($objet);
			$this->etat (self::ETAT_CREE);
			$this->importance ($importance);
			$this->corps ($corps);
		}
		
		public function create () {}
		
		public static function update () {}
		
		public static function insert () {}
		
		public static function delete () {}
		
		public static function listAll () {
			$sql = "SELECT * FROM `Ticket`;";
			// TODO
		}
		
		public static function getWhere ($id = null, $titre = null, $objet = null, $etat = null, $importance = null, $corps = null) {
			// TODO	
		}
		
		public static function searchWhere ($id = null, $titre = null, $objet = null, $etat = null, $importance = null, $corps = null) {
			// TODO	
		}
		
		public function getTicketsFromUser ($uid) {
			$sql = "";
			// TODO
		}
		
		public function id ($val = null) {
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
			if (is_string ($val)) {
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
		
		private $attr__id;
		private $attr__titre;
		private $attr__objet;
		private $attr__importance;
		private $attr__etat;
		private $attr__corps;
	}

?>
