<?php
	class Utilisateur {

		public static function create () {
			$sql = "CREATE TABLE IF NOT EXISTS `Utilisateur` (id INT(11) PRIMARY KEY AUTO_INCREMENT);";
			return GestionTicket::exec ($sql);
		}
	}
?>