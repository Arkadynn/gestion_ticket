<html>
<head>
	<data-author>Quentin Deputier</data-author>
</head>
<body>
	<?php
		echo "<p>All Good ?</p>";
		require_once ("gestionTicket.php");
		new GestionTicket ("localhost|root||gestion_ticket");
		echo "<p>Yup !</p>";
	?>
</body>
</html>
