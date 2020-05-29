<?php 
  if (isset($_POST['nomUsuario']) && isset($_POST['puesto'])) {
    // code..
    session_name("login");
    session_start();
    $_SESSION['nomUsuario'] = $_POST['nomUsuario'];
    $_SESSION['puesto'] = $_POST['puesto'];
  }
  header('location: ./AdmRevConx.php');
?>
