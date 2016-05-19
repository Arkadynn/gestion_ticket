<html>
<head>
	<link rel="stylesheet" href="tests.css" />
</head>
<body>
	<div class="debug" style="font-family: Consolas">
		<h1>Test Begin</h1>

		<?php
			$tests = new Tests();
			$tests->test_database();
			$tests->test_agence();
			$tests->test_service();
			$tests->test_utilisateur();
			$tests->test_ticket();
			$tests->test_duree();

			class Tests {
				public function Tests() {
					echo "<p class='Warning'>Database should'nt exists for the test to be exhaustive</p>";
				}

				public function test_database() {
					echo "<p>including module : Gestion Ticket ...<br/>";
						require_once("gestionTicket.php");
					echo "Done !</p>";

					echo "<p>Connecting to Database ...";
						new GestionTicket("localhost|root|perdu.42|freyssinet_gestion_ticket", true);
					echo "Done !</p>";
				}

				public function test_agence() {
					echo "<p><h4 class='Infos'>Testing agence.php ...</h4>";
					{ // Object Creation
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
					}

					{ // INSERT
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
					}

					{ // GetWhere
						echo "Retrieving database entry from id using GetWhere method : ";
							$ans = Agence::GetWhere ($a->id());
						if ($ans->id() === $a->id())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed : id = ".$ans->id()." and not ".$a->id()."</span></br>";

						echo "Retrieving database entry from name using GetWhere method : ";
							$ans = Agence::GetWhere (null, $a->nom());
						if ($ans->nom() === $a->nom())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed : nom = $ans->nom()</span></br>";
					}

					{ // UPDATE
						echo "updating Agence object 'adresse' from TOULOUSE to COULOUMEUX : ";
							$a->adresse("COULOUMEUX");
							$a->update();
							$ans = Agence::GetWhere ($a->id());
						if ($ans->adresse() === "COULOUMEUX")
							echo "<span class='OK'>OK</span><br />";
						else
							echo "<span class='KO'>Failed</span><br />";
					}

					{ // SearchWhere
						echo "Retrieving database entry from id using SearchWhere method : ";
							$ans = Agence::SearchWhere ($a->id());
						if (count($ans) === 1 && $ans[0]->id() === $a->id())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed : id = ".$ans->id()." and not ".$a->id()."</span></br>";

						echo "Retrieving database entry from name using SearchWhere method : ";
							$ans = Agence::SearchWhere (null, $a->nom());
						if (count($ans) === 1 && $ans[0]->nom() === $a->nom())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed : nom = $ans->nom()</span></br>";

						echo "Retrieving database entry from adresse using SearchWhere method : ";
							$ans = Agence::SearchWhere (null, null, $a->adresse());
						if (count($ans) === 1 && $ans[0]->adresse() === $a->adresse())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed : adresse = ".($ans[0]->adresse())."</span></br>";
					}

					{ // ListAll
						echo "counting members of table Agence should be 1 : ";
							$ans = Agence::ListAll();
						if ((count($ans)) === 1)
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";
					}

					{ // DELETE
						echo "deleting object from Agence : ";
						$a->delete();
						$ans = Agence::ListAll();
						if ((count($ans)) === 0)
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";
					}

					$a->insert();
					echo "<h4 class='Infos'>Done !</h4></p>";
				}

				public function test_service() {
					$a = null;
					echo "<p><h4 class='Infos'>Testing service.php ...</h4>";
					{ // Object Creation
						echo "Creating a default Service Object : new Service ()</br>"; 
						$a = new Service ();
						echo "seting id to 1 : ";
							$ans = $a->id(1);
						if ($ans === 1)
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";

						echo "seting name to Methode : ";
							$ans = $a->nom("Methode");
						if ($ans === "Methode")
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";

						echo "seting idAgence to 1: ";
							$ans = $a->idAgence(1);
						if ($ans === 1)
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";
					}

					{ // INSERT
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
					}

					{ // GetWhere
						echo "Retrieving database entry from id using GetWhere method : ";
							$ans = Service::GetWhere ($a->id());
						if ($ans->id() === $a->id())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed : id = ".$ans->id()." and not ".$a->id()."</span></br>";

						echo "Retrieving database entry from name using GetWhere method : ";
							$ans = Service::GetWhere (null, $a->nom());
						if ($ans->nom() === $a->nom())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed : nom = $ans->nom()</span></br>";
					}

					{ // UPDATE
						echo "updating Service object 'nom' from Methode to Controle : ";
							$a->nom("Controle");
							$a->update();
							$ans = Service::GetWhere ($a->id());
						if ($ans->nom() === "Controle")
							echo "<span class='OK'>OK</span><br />";
						else
							echo "<span class='KO'>Failed : ".($ans->nom())."</span><br />";
					}

					{ // SearchWhere
						echo "Retrieving database entry from id using SearchWhere method : ";
							$ans = Service::SearchWhere ($a->id());
						if (count($ans) === 1 && $ans[0]->id() === $a->id())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed : id = ".$ans->id()." and not ".$a->id()."</span></br>";

						echo "Retrieving database entry from name using SearchWhere method : ";
							$ans = Service::SearchWhere (null, $a->nom());
						if (count($ans) === 1 && $ans[0]->nom() === $a->nom())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed : nom = $ans->nom()</span></br>";

						echo "Retrieving database entry from idAgence using SearchWhere method : ";
							$ans = Service::SearchWhere (null, null, $a->idAgence());
						if (count($ans) === 1 && $ans[0]->idAgence() === $a->idAgence())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed : idAgence = ".($ans[0]->idAgence())."</span></br>";
					}

					{ // ListAll
						echo "counting members of table Service should be 1 : ";
							$ans = Service::ListAll();
						if ((count($ans)) === 1)
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";
					}

					{ // DELETE
						echo "deleting object from Service : ";
						$a->delete();
						$ans = Service::ListAll();
						if ((count($ans)) === 0)
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";
					}

					$a->insert();
					echo "<h4 class='Infos'>Done !</h4></p>";
				}

				public function test_utilisateur() {
					$a = new Utilisateur (1);
					$a->insert();
				}

				public function test_ticket() {
					$a = new Ticket(1, "titre", "objet", 1, "corps", 0, 1);
					$a->insert();
				}

				public function test_duree() {
					$a = null;
					echo "<p><h4 class='Infos'>Testing duree.php ...</h4>";
					{ // Object Creation
						echo "Creating a default Duree Object : new Duree ()</br>"; 
						$a = new Duree ();
						echo "seting debut to 2016-05-17 : ";
							$ans = $a->debut(new DateTime("2016-05-17"));
						if ($ans->format("Y-m-d") === "2016-05-17")
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";

						echo "seting fin to 2016-05-18 : ";
							$ans = $a->fin(new DateTime("2016-05-18"));
						if ($ans->format("Y-m-d") === "2016-05-18")
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";

						echo "seting idTicket to 1: ";
							$ans = $a->idTicket(1);
						if ($ans === 1)
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";
					}

					{ // INSERT
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
					}

					{ // GetWhere
						echo "Retrieving database entry from debut and idTicket (PRIMARY KEY) using GetWhere method : ";
							$ans = Duree::GetWhere ($a->debut(), $a->idTicket());
						if ($ans->debut()->format("Y-m-d") === $a->debut()->format("Y-m-d") && $ans->idTicket() === $a->idTicket())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed : ".$ans->debut()->format("Y-m-d")." / ".$ans->idTicket()."</span></br>";
					}

					{ // UPDATE
						echo "updating Duree object fin from 2016-05-18 to 2016-05-19 : ";
							$a->fin(new DateTime("2016-05-19"));
							$a->update();
							$ans = Duree::GetWhere ($a->debut(), $a->idTicket());
						if ($ans->fin()->format("Y-m-d") === "2016-05-19")
							echo "<span class='OK'>OK</span><br />";
						else
							echo "<span class='KO'>Failed : ".($ans->fin()->format("Y-m-d"))."</span><br />";
					}

					{ // SearchWhere
						echo "Retrieving database entry from debut using SearchWhere method : ";
							$ans = Duree::SearchWhere ($a->debut());
						if (count($ans) === 1 && $ans[0]->debut()->format("Y-m-d") === $a->debut()->format("Y-m-d"))
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed : id = ".$ans->id()." and not ".$a->id()."</span></br>";

						echo "Retrieving database entry from fin using SearchWhere method : ";
							$ans = Duree::SearchWhere (null, $a->fin());
						if (count($ans) === 1 && $ans[0]->fin()->format("Y-m-d") === $a->fin()->format("Y-m-d"))
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed : fin = ".($ans->fin()->format("Y-m-d"))."</span></br>";

						echo "Retrieving database entry from idTicket using SearchWhere method : ";
							$ans = Duree::SearchWhere (null, null, $a->idTicket());
						if (count($ans) === 1 && $ans[0]->idTicket() === $a->idTicket())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed : idTicket = ".($ans[0]->idTicket())."</span></br>";
					}

					{ // ListAll
						echo "counting members of table Duree should be 1 : ";
							$ans = Duree::ListAll();
						if ((count($ans)) === 1)
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";
					}

					{ // DELETE
						echo "deleting object from Duree : ";
						$a->delete();
						$ans = Duree::ListAll();
						if ((count($ans)) === 0)
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";
					}

					$a->insert();
					echo "<h4 class='Infos'>Done !</h4></p>";
				}
			}

		?>

		<h1>Test End</h1>
	</div>
</body>
</html>