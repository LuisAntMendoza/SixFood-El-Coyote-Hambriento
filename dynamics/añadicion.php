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

function Decifrar ($textoCifrado){
  $key = openssl_digest(PASSWORD, HASH);
  $iv_len = openssl_cipher_iv_length (METHOD);

  $cifrado = base64_decode($textoCifrado);
  $iv = substr($cifrado, 0, $iv_len);
  $rawCiff = substr($cifrado, $iv_len);

  $originalText = openssl_decrypt(
  $rawCiff,
  METHOD,
  $key,
  OPENSSL_RAW_DATA,
  $iv
  );
  return $originalText;
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
    $consulta = 'INSERT INTO usuario VALUES ("'.$usuario.'","'.$nombre.'","'.$apPat.'","'.$apMat.'", '.$grupo.',"'.$colegio.'","'.$contraseña.'", '.$poder.', NULL)';
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
elseif ($_POST['id-pedido']) {
    $id = $_POST['id-pedido'];
    $usuario = $_POST['usuario-pedido'];
    $usuario2 = "";
    $consulta = 'SELECT * FROM usuario';
    $consultar = mysqli_query($conexion, $consulta);
    while ($resultado = mysqli_fetch_array($consultar)) {
        if($usuario == Decifrar($resultado[0])) {
            $usuario2 = $resultado[0];
        }
    }
    if($usuario2 == "") {
        $_SESSION['Error'] = '<h3 class="error">Usuario no encontrado</h3>';
        header("location:supervisor.php");
        exit();
    }
    $comida = $_POST['comida-pedido'];
    $bebida = $_POST['bebida-pedido'];
    $antojito = $_POST['antojito-pedido'];
    $cantidadC = $_POST['cantidadC-pedido'];
    $cantidadB = $_POST['cantidadB-pedido'];
    $cantidadA = $_POST['cantidadA-pedido'];
    if($comida != "") {
        $consulta = 'SELECT * FROM preparado WHERE id_comida = '.$comida.'';
        $consultar = mysqli_query($conexion, $consulta);
        $resultado = mysqli_fetch_array($consultar);
        if($cantidadC != "") {
            $total = $resultado[3] * $cantidadC;
            echo 'Total 1 = '.$total."<br>";
        }
        else {
            $total = $resultado[3];
            echo 'Total 1 = '.$total."<br>";
        }

    }
    if($bebida != "") {
        $consulta = 'SELECT * FROM bebida WHERE id_bebida = '.$bebida.'';
        $consultar = mysqli_query($conexion, $consulta);
        $resultado = mysqli_fetch_array($consultar);
        if($cantidadB != "") {
            $total = ($resultado[4] * $cantidadB) + $total;
            echo 'Total 2 = '.$total."<br>";
        }
        else {
            $total = $resultado[4] + $total;
            echo 'Total 2 = '.$total."<br>";
        }
    }
    if($antojito != "") {
        $consulta = 'SELECT * FROM antojito WHERE id_antojito = '.$antojito.'';
        $consultar = mysqli_query($conexion, $consulta);
        $resultado = mysqli_fetch_array($consultar);
        if($cantidadA != "") {
            $total = ($resultado[5] * $cantidadA) + $total;
            echo 'Total 3 = '.$total."<br>";
        }
        else {
            $total = $resultado[5] + $total;
            echo 'Total 3 = '.$total."<br>";
        }
    }
    $lugar = $_POST['lugar-pedido'];
    $espera = $_POST['espera-pedido'];
    echo $id."<br>";
    echo $usuario2."<br>";
    echo $comida."<br>";
    echo $bebida."<br>";
    echo $antojito."<br>";
    echo $cantidadC."<br>";
    echo $cantidadB."<br>";
    echo $cantidadA."<br>";
    echo $total."<br>";
    echo $lugar."<br>";
    echo $espera."<br>";
    $consulta = 'INSERT INTO pedido VALUES ("'.$id.'", "'.$usuario2.'", '.$comida.', '.$bebida.', '.$antojito.', '.$cantidadC.','.$cantidadB.', '.$cantidadA.', '.$total.', '.$lugar.', '.$espera.')';
    $consultar = mysqli_query($conexion, $consulta);
    $_SESSION['Error'] = "<h5 class='error'>Pedido generado exitosamente</h5>";
    //header("location: supervisor.php");
    //exit();
}
else {
    header("location:../templates/error.html");
    exit();
}



mysqli_close($conexion);
?>
