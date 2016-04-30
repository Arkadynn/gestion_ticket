<?php
	// @author=Quentin aka Arkadynn Deputier
	require_once ('agence.php');
	require_once ('duree.php');
	require_once ('service.php');
	require_once ('ticket.php');
	require_once ('utilisateur.php');


	class GestionTicket {

		public static $attr__connection;

		/*
		 *	Initialisation du module de gestion de ticket : 
		 *	 - Creation de le base de donnees si necessaire
		 *	 - Connexion a la base de donnees
		*/
		public function GestionTicket($dbi)	{

			if (!isset(self::$attr__connection)) {

				list($host, $user, $password, $dbname) = explode('|', $dbi);

				// Connect to mysql server
				self::$attr__connection = new PDO("mysql:host=$host;", $user, $password);

				// create database in case it do not exists
				$sql = "CREATE DATABASE IF NOT EXISTS `$dbname`;";
				self::$attr__connection->exec ($sql);

				// connect to database
				self::$attr__connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

				$conn = self::$attr__connection;

				$sql = "CREATE TABLE IF NOT EXISTS `Agence` (
							`id` INT(11) PRIMARY KEY AUTO_INCREMENT,
							`nom` VARCHAR(50) NOT NULL,
							`adresse` VARCHAR(100) NOT NULL
						);";
				$conn->exec ($sql);

				$sql = "CREATE TABLE IF NOT EXISTS `Service` (
							`id` INT(11) PRIMARY KEY AUTO_INCREMENT,
							`nom` VARCHAR(50) NOT NULL,
							`idAgence` INT(11) NOT NULL,
							FOREIGN KEY (`idAgence`) REFERENCES `Agence`(`id`)
						);";
				$conn->exec ($sql);

				$sql = "CREATE TABLE IF NOT EXISTS `Utilisateur` (id INT(11) PRIMARY KEY AUTO_INCREMENT);";
				$conn->exec ($sql);

				$sql = "CREATE TABLE IF NOT EXISTS `Ticket` (
							`id` INT(11) PRIMARY KEY AUTO_INCREMENT,
							`titre` VARCHAR(255) NOT NULL,
							`objet` VARCHAR(255) NOT NULL,
							`etat` INT(2) NOT NULL,
							`importance` INT(2) NOT NULL,
							`corps` VARCHAR(1024) NOT NULL,
							`tempsPref` INT (11) NOT NULL,
							`idUser` INT (11) NOT NULL,
							FOREIGN KEY (`idUser`) REFERENCES `Utilisateur`(`id`)
						);";
				$conn->exec ($sql);

				$sql = "CREATE TABLE IF NOT EXISTS `Duree` 
					   (
					   		`debut` DATETIME,
					   		`fin` DATETIME,
					   		`idTicket` INT(11),
					   		PRIMARY KEY (`debut`, `idTicket`),
					   		FOREIGN KEY (`idTicket`) REFERENCES `Ticket`(`id`)
					   );";
				$conn->exec ($sql);
			} else {
				echo "Deja connecte"."</br>";
			}
		}

		public static function quote($attr = null) {
			if (isset($attr)) {
				return self::$attr__connection->quote ($attr);
			}
			return null;
		}

		public static function exec($sql = null) {
			if (isset($sql)) {
				echo $sql."</br>";
				return self::$attr__connection->exec($sql);
			}
			return -1;
		}

		public static function fetchAll ($sql = null) {
			if (isset($sql)) {

			}
		}
	}
?>