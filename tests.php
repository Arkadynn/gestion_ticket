<html>
<head>
	<link rel="stylesheet" href="tests.css" />
</head>
<body>
	<div class="debug" style="font-family: Consolas">
		<h1>Test Begin</h1>

		<?php
			class Tests {
				public function Tests() {
					echo "<p class='Warning'>Database should'nt exists for the test to be exhaustive</p>";
				}

				public function test_database() {
					echo "<p>including module : Gestion Ticket ...<br/>";
						require_once("gestionTicket.php");
					echo "Done !</p>";

					echo "<p>Connecting to Database ...";
						new GestionTicket("localhost|root|root|gestion_ticket", true);
					echo "Done !</p>";
				}

				public function test_agence() {
					echo "<p><h4 class='Infos'>Testing agence.php ...</h4>";
					echo "Creating a default Agence Object : new Agence ()</br>";
						$a = new Agence ();

					echo "seting id to 1 : ";
						$ans = $a->id(1);
					if ($ans === 1)
						echo "<span class='OK'>OK</span></br>";
					else
						echo "<span class='KO'>Failed</span></br>";

					echo "seting name to 'Freyssinet aerospace' : ";
						$ans = $a->nom("Freyssinet aerospace");
					if ($ans === "Freyssinet aerospace")
						echo "<span class='OK'>OK</span></br>";
					else
						echo "<span class='KO'>Failed</span></br>";

					echo "seting adresse to 'TOULOUSE' : ";
						$ans = $a->adresse("TOULOUSE");
					if ($ans === "TOULOUSE")
						echo "<span class='OK'>OK</span></br>";
					else
						echo "<span class='KO'>Failed</span></br>";


					echo "inserting into database (should work) : ";
						$ans = $a->insert();
					if ($ans === 1)
						echo "<span class='OK'>OK</span></br>";
					else
						echo "<span class='KO'>Failed</span></br>";

					echo "inserting it again (should'nt work) : ";
						$ans = $a->insert();
					if ($ans === 1)
						echo "<span class='KO'>OK</span></br>";
					else
						echo "<span class='OK'>Failed</span></br>";

					echo "Retrieving database entry from name : ";
						$ans = Agence::GetWhere (null, $a->nom());
					if ($ans->nom() === $a->nom())
						echo "<span class='OK'>OK</span></br>";
					else
						echo "<span class='KO'>Failed : nom = $ans->nom()</span></br>";

					echo "Retrieving database entry from id : ";
						$ans = Agence::GetWhere ($a->id());
					if ($ans->id() === $a->id())
						echo "<span class='OK'>OK</span></br>";
					else
						echo "<span class='KO'>Failed : id = ".$ans->id()." and not ".$a->id()."</span></br>";

					echo "updating Agence object 'adresse' from TOULOUSE to COULOUMEUX : ";
						$a->adresse("COULOUMEUX");
						$a->update();
						$ans = Agence::GetWhere ($a->id());
					if ($ans->adresse() === "COULOUMEUX")
						echo "<span class='OK'>OK</span><br />";
					else
						echo "<span class='KO'>Failed</span><br />";

					echo "counting members of table Agence should be 1 : ";
						$ans = Agence::ListAll();
						echo "[".$ans."]";
					if ($ans === 1)
						echo "<span class='OK'>OK</span></br>";
					else
						echo "<span class='KO'>Failed</span></br>";

					echo "<h4 class='Infos'>Done !</h4></p>";
				}

				public function test_service() {
					
				}

				public function test_utilisateur() {
					
				}

				public function test_ticket() {
					
				}

				public function test_duree() {
					
				}
			}

			$tests = new Tests();
			$tests->test_database();
			$tests->test_agence();
			$tests->test_utilisateur();
			$tests->test_ticket();
			$tests->test_duree();
		?>

		<h1>Test End</h1>
	</div>
</body>
</html>