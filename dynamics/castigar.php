<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "root", "pruebaSixFood");
if(!$conexion) {
    header("location:../templates/error.html");
    exit();
}
if(!$_POST['Castigar']) {
    header("location:../templates/error.html");
    exit();
}
$zona = date_default_timezone_set('America/Mexico_City');
$castigo = date("d-m-Y_H:i:s", time() + 5 * (60 * 60 * 24));
$consulta = 'UPDATE usuario SET castigo = "'.$castigo.'" WHERE id_usuario = "'.$_POST['Castigar'].'"';
$consultar = mysqli_query($conexion, $consulta);
$_SESSION['Error'] = '<h5 class="error">Usuario castigado</h5>';
header("location:supervisor.php");
mysqli_close($conexion);
?>
