<?php
$zona = date_default_timezone_set('America/Mexico_City');//Define la zona horaria a la de México
$fecha = date("d-m-Y"); //Da la fecha
$hora = date("H:i:s"); //Da la hora formato de 24hrs
echo "La hora es ".$hora.", del día ".$fecha."<br>";
?>
