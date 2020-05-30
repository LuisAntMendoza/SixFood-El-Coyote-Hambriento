<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "root", "pruebaSixFood");
if(!$conexion) {
    header("location:../templates/error.html");
    exit();
}

define("PASSWORD", "Shrek Amo Del Multiverso");
define("HASH", "sha256");
define("METHOD", "aes-128-cbc-hmac-sha1");

function Cifrar($text){
  $key = openssl_digest(PASSWORD, HASH);
  $iv_len = openssl_cipher_iv_length (METHOD);
  $iv = openssl_random_pseudo_bytes ($iv_len);

  $key = openssl_digest(PASSWORD,HASH);

  $rawCiff = openssl_encrypt(
  $text,
  METHOD,
  $key,
  OPENSSL_RAW_DATA,
  $iv
  );
  $textoCifrado = base64_encode($iv.$rawCiff);

  return $textoCifrado;
}

if($_POST['Usuario']) {
    $usuario = Cifrar($_POST['Usuario']);
    $nombre = Cifrar($_POST['Nombre']);
    $apPat = Cifrar($_POST['apPat']);
    $apMat = Cifrar($_POST['apMat']);
    $grupo = $_POST['Grupo'];
    $colegio = $_POST['Colegio'];
    $contraseña = password_hash($_POST['Contraseña'], PASSWORD_BCRYPT);
    $poder = $_POST['Poder'];
    if($grupo == "") {
        $grupo = "NULL";
    }
    if($colegio == "") {
        $colegio = "NULL";
    }
    $consulta = 'INSERT INTO usuario VALUES ("'.$usuario.'","'.$nombre.'","'.$apPat.'","'.$apMat.'", '.$grupo.',"'.$colegio.'","'.$contraseña.'", '.$poder.')';
    $consultar = mysqli_query($conexion, $consulta);
    $_SESSION['Error'] = "<h5 class='error'>Usuario generado exitosamente</h5>";
    header("location: admin.php");
    exit();
}
elseif($_POST['id-bebida']) {
    $id = $_POST['id-bebida'];
    $nombre = $_POST['nombre-bebida'];
    $tipo = $_POST['tipo-bebida'];
    $porcion = $_POST['porcion-bebida'];
    $precio = $_POST['precio-bebida'];
    $existencias = $_POST['existencias-bebida'];
    $consulta = 'INSERT INTO bebida VALUES ('.$id.', "'.$nombre.'", '.$tipo.', '.$porcion.', '.$precio.', '.$existencias.')';
    $consultar = mysqli_query($conexion, $consulta);
    $_SESSION['Error'] = "<h5 class='error'>Bebida generada exitosamente</h5>";
    header("location: admin.php");
    exit();
}
elseif ($_POST['id-preparado']) {
    $id = $_POST['id-preparado'];
    $nombre = $_POST['nombre-preparado'];
    $cantidad = $_POST['cantidad-preparado'];
    $precio = $_POST['precio-preparado'];
    $existencias = $_POST['existencias-preparado'];
    $consulta = 'INSERT INTO preparado VALUES ('.$id.', "'.$nombre.'", '.$cantidad.', '.$precio.', '.$existencias.')';
    $consultar = mysqli_query($conexion, $consulta);
    $_SESSION['Error'] = "<h5 class='error'>Preparado generado exitosamente</h5>";
    header("location: admin.php");
    exit();
}
elseif ($_POST['id-antojito']) {
    $id = $_POST['id-antojito'];
    $nombre = $_POST['nombre-antojito'];
    $presentacion = $_POST['presentacion-antojito'];
    $porcion = $_POST['porcion-antojito'];
    $cantidad = $_POST['cantidad-antojito'];
    $precio = $_POST['precio-antojito'];
    $existencias = $_POST['existencias-antojito'];
    $consulta = 'INSERT INTO antojito VALUES ('.$id.', "'.$nombre.'", '.$presentacion.', '.$porcion.', '.$cantidad.', '.$precio.','.$existencias.')';
    $consultar = mysqli_query($conexion, $consulta);
    $_SESSION['Error'] = "<h5 class='error'>Antojito generado exitosamente</h5>";
    header("location: admin.php");
    exit();
}
else {
    header("location:../templates/error.html");
    exit();
}



mysqli_close($conexion);
?>
