<?php
session_start();
if(preg_match("/(^[A-Z][a-zñÑáéíóúÁÉÍÓÚ]+$)|(^[A-Z][a-zñÑáéíóúÁÉÍÓÚ]+[ ][A-Z][a-zñÑáéíóúÁÉÍÓÚ]+$)/", $_POST['Nombre'])) {
    $nombre = $_POST['Nombre'];
}
else {
    header("location:../templates/error.html");
}


if(preg_match("/(^[A-Z][a-zñÑáéíóúÁÉÍÓÚ]+$)/", $_POST['apPat'])) {
    $apPat = $_POST['apPat'];
}
else {
    header("location:../templates/error.html");
}


if(preg_match("/(^[A-Z][a-zñÑáéíóúÁÉÍÓÚ]+$)/", $_POST['apMat'])) {
    $apMat = $_POST['apMat'];
}
else {
    header("location:../templates/error.html");
}

if($_SESSION['tipo'] == "Alumno") {
    if(preg_match("/(^\d{9}$)/", $_POST['noCuenta'])) {
        $noCuenta = $_POST['noCuenta'];
    }
    else {
        header("location:../templates/error.html");
    }
    if(preg_match("/^(\d{3})$/", $_POST['Grupo'])) {
        $Grupo = $_POST['Grupo'];
    }
    else {
        header("location:../templates/error.html");
    }
}
elseif ($_SESSION['tipo'] == "Académico") {
    if(preg_match("/^[A-Z]{4}[0-9]{6}[0-9A-Z]{3}$/", $_POST['RFC'])) {
        $RFC = $_POST['RFC'];
    }
    else {
        header("location:../templates/error.html");
    }
    $Colegio = htmlentities($_POST['Colegio']);
}
elseif ($_SESSION['tipo'] == "Trabajador") {
    if(preg_match("/^(\d{6})$/", $_POST['noTrabajador'])) {
        $noTrabajador = $_POST['noTrabajador'];
    }
    else {
        header("location:../templates/error.html");
    }
}


if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!-+])([A-Za-z\d!-+]|[^ ]){10,20}$/", $_POST['Contraseña'])) {
    $Contraseña = $_POST['Contraseña'];
}
else {
    header("location:../templates/error.html");
}


if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!-+])([A-Za-z\d!-+]|[^ ]){10,20}$/", $_POST['rContraseña'])) {
    $rContraseña = $_POST['rContraseña'];
}
else {
    header("location:../templates/error.html");
}


if($Contraseña != $rContraseña) {
    echo 'No son iguales';
}
else {
    echo "Son iguales";
}

?>
