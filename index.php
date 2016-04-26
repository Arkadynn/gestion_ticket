<html>
<head>
</head>
<body>
	<?php
		include ("gestionTicket.php");
		new GestionTicket ("localhost|root||freyssinet_gestion_ticket");
		new Agence ();
		new Service ();
		new Ticket ();
		new Duree ();
		echo "<p>All Good ?</p>";
	?>
</body>
</html>
