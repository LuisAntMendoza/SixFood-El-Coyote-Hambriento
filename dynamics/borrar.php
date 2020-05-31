<?php
//inciamos sesion y conexion
session_start();
$conexion = mysqli_connect("localhost", "root", "root", "SixFood");
if(!$conexion) {
    header("location:../templates/error.html");
    exit();
}
//validamos variables
if(!$_POST['Borrar']) {
    header("location:../templates/error.html");
    exit();
}

//borra los datos si recibe usuario
if($_POST['Tipo-tabla'] == "Usuario") {
    $usuario = $_POST['Borrar'];
    $consulta = 'DELETE FROM usuario WHERE id_usuario = "'.$usuario.'"';
    $consultar = mysqli_query($conexion, $consulta);
    $_SESSION['Error'] = "<h5 class='error'>Eliminación exitosa</h5>";
    header("location:admin.php");
    exit();
}
//borra los datos si recibe bebida
elseif ($_POST['Tipo-tabla'] == "Bebida") {
    $id = $_POST['Borrar'];
    $consulta = 'DELETE FROM bebida WHERE id_bebida = '.$id.'';
    $consultar = mysqli_query($conexion, $consulta);
    $_SESSION['Error'] = "<h5 class='error'>Eliminación exitosa</h5>";
    header("location:admin.php");
    exit();
}
//borra los datos si recibe preparado
elseif ($_POST['Tipo-tabla'] == "Preparado") {
    $id = $_POST['Borrar'];
    $consulta = 'DELETE FROM preparado WHERE id_comida = '.$id.'';
    $consultar = mysqli_query($conexion, $consulta);
    $_SESSION['Error'] = "<h5 class='error'>Eliminación exitosa</h5>";
    header("location:admin.php");
    exit();
}
//borra los datos si recibe antojito
elseif ($_POST['Tipo-tabla'] == "Antojito") {
    $id = $_POST['Borrar'];
    $consulta = 'DELETE FROM antojito WHERE id_antojito = '.$id.'';
    $consultar = mysqli_query($conexion, $consulta);
    $_SESSION['Error'] = "<h5 class='error'>Eliminación exitosa</h5>";
    header("location:admin.php");
    exit();
}
//borra los datos si recibe pedido
elseif ($_POST['Tipo-tabla'] == "Pedido") {
    $id = $_POST['Borrar'];
    $consulta = 'DELETE FROM venta WHERE id_venta = "'.$id.'"';
    $consultar = mysqli_query($conexion, $consulta);
    $_SESSION['Error'] = "<h5 class='error'>Pedido completado correctamente</h5>";
    header("location:supervisor.php");
    exit();
}

mysqli_close($conexion);
?>
