<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "root", "pruebaSixFood");
if(!$conexion) {
    header("location:../templates/error.html");
    exit();
}
if(!$_POST['Borrar']) {
    header("location:../templates/error.html");
    exit();
}
if($_POST['Tipo-tabla'] == "Usuario") {
    $usuario = $_POST['Borrar'];
    $consulta = 'DELETE FROM usuario WHERE id_usuario = "'.$usuario.'"';
    $consultar = mysqli_query($conexion, $consulta);
    $_SESSION['Error'] = "<h5 class='error'>Eliminación exitosa</h5>";
    header("location:admin.php");
    exit();
}
elseif ($_POST['Tipo-tabla'] == "Bebida") {
    $id = $_POST['Borrar'];
    $consulta = 'DELETE FROM bebida WHERE id_bebida = '.$id.'';
    $consultar = mysqli_query($conexion, $consulta);
    $_SESSION['Error'] = "<h5 class='error'>Eliminación exitosa</h5>";
    header("location:admin.php");
    exit();
}
elseif ($_POST['Tipo-tabla'] == "Preparado") {
    $id = $_POST['Borrar'];
    $consulta = 'DELETE FROM preparado WHERE id_comida = '.$id.'';
    $consultar = mysqli_query($conexion, $consulta);
    $_SESSION['Error'] = "<h5 class='error'>Eliminación exitosa</h5>";
    header("location:admin.php");
    exit();
}
elseif ($_POST['Tipo-tabla'] == "Antojito") {
    $id = $_POST['Borrar'];
    $consulta = 'DELETE FROM antojito WHERE id_antojito = '.$id.'';
    $consultar = mysqli_query($conexion, $consulta);
    $_SESSION['Error'] = "<h5 class='error'>Eliminación exitosa</h5>";
    header("location:admin.php");
    exit();
}

?>
