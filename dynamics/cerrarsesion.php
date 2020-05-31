<?php
//destruimos las variables de la sesion
session_start();
session_unset();
session_destroy();
header("location: index.php");







?>
