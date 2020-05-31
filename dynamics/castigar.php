<?php
//iniciamos sesion y conexion
session_start();
$conexion = mysqli_connect("localhost", "root", "root", "SixFood");
if(!$conexion) {
    header("location:../templates/error.html");
    exit();
}
//si no viene de supervisor le manda error
if(!$_POST['Castigar']) {
    header("location:../templates/error.html");
    exit();
}
//obtenemos el tiempo de castigo
$zona = date_default_timezone_set('America/Mexico_City');
$castigo = date("d-m-Y_H:i:s", time() + 5 * (60 * 60 * 24));
//actualizamos su castigo en la tabla y lo regresamos a admin
$consulta = 'UPDATE usuario SET castigo = "'.$castigo.'" WHERE id_usuario = "'.$_POST['Castigar'].'"';
$consultar = mysqli_query($conexion, $consulta);
$_SESSION['Error'] = '<h5 class="error">Usuario castigado</h5>';
header("location:supervisor.php");
mysqli_close($conexion);
?>
