<html>
<head>
</head>
<body>
	<?php
		echo "<p>All Good ?</p>";
		include ("gestionTicket.php");
		new GestionTicket ("localhost|root||freyssinet_gestion_ticket");
		new Agence ();
		new Service ();
		new Ticket ();
		new Duree ();
		echo "<p>Yup !</p>";
	?>
</body>
</html>
