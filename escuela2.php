<?php
  $nombre_anterior = session_name("DeLuna");
  session_id("08202003");
  session_start();
  $color = $_POST['color'];
  $fuente = $_POST['fuentes'];
  $_SESSION['usuario'] = $_POST['nomUsuario'];
  if ( !isset($_SESSION['usuario']) && !isset($_POST['nomUsuario']))
  {
    header("Location: escuela.php");
  }
  if (isset($_POST['nomUsuario']))
  {
    $eleccion = $_POST['categorias'];
    if ($eleccion == "Alumno")
    {
      echo "<body style='background-color: ".$color[0]."'>";
      echo "<font color='".$color[1]."' face='".$fuente."'><h1>Bienvenid@ alumn@ ".$_SESSION['usuario']."</h1>";
      echo "<a href='calificaciones.php'>Calificaciones</a> <a href='horarios.php'>Horarios</a> <a href='informes.php'>Informes</a><br>";
      echo "</font>";
      echo "</body>";
    }
    if($eleccion == "Profesor")
    {
      echo "<body style='background-color: ".$color[0]."'>";
      echo "<font color='".$color[1]."' face='".$fuente."'><h1>Bienvenid@ Profesor(a) ".$_SESSION['usuario']."</h1>";
      echo "<a href='avisos.php'>Avisos</a> <a href='eventos.php'>Eventos</a> <a href='programas.php'>Programas</a><br>";
      echo "</font>";
      echo "</body>";
    }
    if ($eleccion == "Padre de familia")
    {
      echo "<body style='background-color: ".$color[0]."'>";
      echo "<font color='".$color[1]."' face='".$fuente."'><h1>Bienvenid@ Sr(a) ".$_SESSION['usuario']."</h1>";
      echo "<a href='calificaciones.php'>Calificaciones</a> <a href='examenes.php'>Examenes</a> <a href='contacto.php'>Contacto</a><br>";
      echo "</font>";
      echo "</body>";
    }
  }
  echo '<a href="cerrar.php">Cerrar sesion</a>';
  echo "<br>";
?>
