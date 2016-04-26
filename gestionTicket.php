<?php
	include ('agence.php');
	include ('duree.php');
	include ('service.php');
	include ('ticket.php');
	include ('utilisateur.php');


	class GestionTicket {

		private $attr__connection;
		private $attr__DBPrefix;

		/*
		 *	Initialisation du module de gestion de ticket : 
		 *	 - Creation de le base de donnees si necessaire
		 *	 - Connexion a la base de donnees
		*/
		public function GestionTicket($dbi)	{

			$attr__connection = null;

			list($host, $user, $password, $dbprefix, $dbname) = explode('|', $dbi);

			$sql = "CREATE DATABASE IF NOT EXISTS `".$dbprefix."GestionTicket`";

			Agence.create ();
			Service.create ();
			Utilisateur.create ();
			ticket.create ();
			duree.create ();
		}
	}
?>