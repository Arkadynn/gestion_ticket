<?php
	include ('agence.php');
	include ('duree.php');
	include ('service.php');
	include ('ticket.php');
	include ('utilisateur.php');


	class GestionTicket {

		public static $attr__connection;
		private $attr__DBPrefix;

		/*
		 *	Initialisation du module de gestion de ticket : 
		 *	 - Creation de le base de donnees si necessaire
		 *	 - Connexion a la base de donnees
		*/
		public function GestionTicket($dbi)	{

			private $attr__connection = null;

			list($host, $user, $password, $dbname) = explode('|', $dbi);


			echo "mysql:host=$host;";

			self::$attr__connection = new PDO("mysql:host=$host;", $user, $password);

			$sql = "CREATE DATABASE IF NOT EXISTS `$dbname`;";
			self::$attr__connection->exec ($sql);

			self::$attr__connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

			$conn = self::$attr__connection;



			Agence::create ();
			Service::create ();
			Utilisateur::create ();
			Ticket::create ();
			Duree::create ();
		}

		public static function exec($sql = null) {
			if (isset($sql)) {
				$sql = PDO::quote ($sql);
				return self::$attr__connection->exec($sql);
			}
			return -1;
		}

		public static function fetchAll ($sql = null) {
			if (isset($sql)) {
				$sql = PDO::quote ($sql);

			}
		}
	}
?>