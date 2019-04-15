<?php

define('DB_TYPE', 'mysql');		// Wat voor type database gebruik je?
define('DB_HOST', '127.0.0.1'); // Wat is het IP adres van de server (127.0.0.1 is de lokae machine)
define('DB_NAME', 'games'); // Wat is de database naam
define('DB_USER', 'root'); 		// Wat is de database gebruiker
define('DB_PASS', 'mysql');			// Wat is het database wachtwoord
define('DB_CHARSET', 'utf8');

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)
  OR die('Could not connect to MySQL ' .
          mysqli_connect_error());

 ?>
