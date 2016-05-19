<html>
<head>
	<link rel="stylesheet" href="tests.css" />
</head>
<body>
	<div class="debug">
		<h1 class="infos">Test Begin</h1>

		<?php
			$tests = new Tests();
			$tests->test_database();
			$tests->test_agence();
			$tests->test_service();
			$tests->test_utilisateur();
			$tests->test_ticket();
			$tests->test_duree();

			class Tests {

				public function test_database() {
					echo "<p>including module : Gestion Ticket ... ";
						require_once("gestionTicket.php");
					echo "<span class='OK'>Done !</span></p>";

					echo "<p>Connecting to Database ... ";
						new GestionTicket("localhost|root|perdu.42|freyssinet_gestion_ticket", true);
					echo "<span class='OK'>Done !</span></p>";
				}

				public function test_agence() {
					echo "<p><h4 class='Infos'>Testing agence.php ...</h4>";
					{ // Object Creation
						echo "Creating a default Agence Object : new Agence ()</br>"; 
						$a = new Agence ();
						echo "setting id to 1 : ";
							$ans = $a->id(1);
						if ($ans === 1)
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";

						echo "setting name to 'Freyssinet aerospace' : ";
							$ans = $a->nom("Freyssinet aerospace");
						if ($ans === "Freyssinet aerospace")
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";

						echo "setting adresse to 'TOULOUSE' : ";
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
						echo "setting id to 1 : ";
							$ans = $a->id(1);
						if ($ans === 1)
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";

						echo "setting name to Methode : ";
							$ans = $a->nom("Methode");
						if ($ans === "Methode")
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";

						echo "setting idAgence to 1: ";
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
					$a = null;
					echo "<p><h4 class='Infos'>Testing utilisteur.php ...</h4>";
					echo "<span class ='KO'>Error : Utilisateur file still not integrated</span>";
					echo "<h4 class='Infos'>Done!</h4></p>";
					$a = new Utilisateur (1);
					$a->insert();
				}

				public function test_ticket() {
					$a = null;
					echo "<p><h4 class='Infos'>Testing ticket.php ...</h4>";
					{ // Object Creation
						echo "Creating a default Ticket Object : new Ticket ()</br>"; 
						$a = new Ticket ();

						echo "setting id to 1 : ";
							$ans = $a->id(1);
						if ($ans === 1)
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";

						echo "setting titre to 'titre' : ";
							$ans = $a->titre("titre");
						if ($ans === "titre")
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";

						echo "setting objet to 'objet' : ";
							$ans = $a->objet("objet");
						if ($ans === "objet")
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";

						echo "setting importance to 3 : ";
							$ans = $a->importance(3);
						if ($ans === 3)
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";

						echo "setting corps to 'corps' : ";
							$ans = $a->corps("corps");
						if ($ans === "corps")
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";

						echo "setting tempsPref to 20 : ";
							$ans = $a->tempsPref(20);
						if ($ans === 20)
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";

						echo "setting idUser to 1 : ";
							$ans = $a->idUser(1);
						if ($ans === 1)
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";
					}

					{ // INSERT
						//*
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
						//*/
					}

					{ // GetWhere
						echo "Retrieving database entry from id using GetWhere method : ";
							$ans = Ticket::GetWhere ($a->id());
						if ($ans->id() === $a->id())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed : id = ".$ans->id()." and not ".$a->id()."</span></br>";
					}

					{ // UPDATE
						echo "updating Ticket object 'titre' from titre to title : ";
							$a->titre("title");
							$a->update();
							$ans = Ticket::GetWhere ($a->id());
						if ($ans->titre() === "title")
							echo "<span class='OK'>OK</span><br />";
						else
							echo "<span class='KO'>Failed : ".($ans->nom())."</span><br />";
					}

					{ // SearchWhere
						echo "Retrieving database entry from id using SearchWhere method : ";
							$ans = Ticket::SearchWhere ($a->id());
						if (count($ans) === 1 && $ans[0]->id() === $a->id())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";

						echo "Retrieving database entry from titre using SearchWhere method : ";
							$ans = Ticket::SearchWhere (null, $a->titre());
						if (count($ans) === 1 && $ans[0]->titre() === $a->titre())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";
						
						echo "Retrieving database entry from objet using SearchWhere method : ";
							$ans = Ticket::SearchWhere (null, null, $a->objet());
						if (count($ans) === 1 && $ans[0]->objet() === $a->objet())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";
						
						echo "Retrieving database entry from etat using SearchWhere method : ";
							$ans = Ticket::SearchWhere (null, null, null, $a->etat());
						if (count($ans) === 1 && $ans[0]->etat() === $a->etat())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";
						
						echo "Retrieving database entry from importance using SearchWhere method : ";
							$ans = Ticket::SearchWhere (null, null, null, null, $a->importance());
						if (count($ans) === 1 && $ans[0]->importance() === $a->importance())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";
						
						echo "Retrieving database entry from corps using SearchWhere method : ";
							$ans = Ticket::SearchWhere (null, null, null, null, null, $a->corps());
						if (count($ans) === 1 && $ans[0]->corps() === $a->corps())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";
						
						echo "Retrieving database entry from tempsPref using SearchWhere method : ";
							$ans = Ticket::SearchWhere (null, null, null, null, null, null, $a->tempsPref());
						if (count($ans) === 1 && $ans[0]->tempsPref() === $a->tempsPref())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";
						
						echo "Retrieving database entry from idUser using SearchWhere method : ";
							$ans = Ticket::SearchWhere (null, null, null, null, null, null, null, $a->idUser());
						if (count($ans) === 1 && $ans[0]->idUser() === $a->idUser())
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";
					}

					{ // ListAll
						echo "counting members of table Ticket should be 1 : ";
							$ans = Ticket::ListAll();
						if ((count($ans)) === 1)
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";
					}

					{ // DELETE
						echo "deleting object from Ticket : ";
						$a->delete();
						$ans = Ticket::ListAll();
						if ((count($ans)) === 0)
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";
					}

					$a->insert();
					echo "<h4 class='Infos'>Done !</h4></p>";
				}

				public function test_duree() {
					$a = null;
					echo "<p><h4 class='Infos'>Testing duree.php ...</h4>";
					{ // Object Creation
						echo "Creating a default Duree Object : new Duree ()</br>"; 
						$a = new Duree ();
						echo "setting debut to 2016-05-17 : ";
							$ans = $a->debut(new DateTime("2016-05-17"));
						if ($ans->format("Y-m-d") === "2016-05-17")
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";

						echo "setting fin to 2016-05-18 : ";
							$ans = $a->fin(new DateTime("2016-05-18"));
						if ($ans->format("Y-m-d") === "2016-05-18")
							echo "<span class='OK'>OK</span></br>";
						else
							echo "<span class='KO'>Failed</span></br>";

						echo "setting idTicket to 1: ";
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

		<h1 class="infos">Test End</h1>
	</div>
</body>
</html>