<?php
	// @author=Quentin aka Arkadynn Deputier
	class Utilisateur {
		private $attr__id;

		public function Utilisateur($id = null) {
			$this->attr__id = 0;

			$this->id($id);
		}

		public function insert () {
			if (isset($id)) {
				GestionTicket::exec("INSERT INTO `Utilisateur` (`id`) VALUES ($id);");
			} else {
				GestionTicket::exec("INSERT INTO `Utilisateur` (`id`) VALUES ($id);");
			}
		}

		public function id($val = null) {
			if (isset($val)) {
				if (is_numeric($val)) {
					$this->attr__id = intval($val);
				}
			}
			return $this->attr__id;
		}
	}
?>