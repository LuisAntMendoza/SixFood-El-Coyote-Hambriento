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
//validacion
if(!isset($_POST['Usuario'])) {
    $_POST['Usuario'] = "";
}
if(!isset($_POST['Nombre'])) {
    $_POST['Nombre'] = "";
}
if(!isset($_POST['apPat'])) {
    $_POST['apPat'] = "";
}
if(!isset($_POST['apMat'])) {
    $_POST['apMat'] = "";
}
if(!isset($_POST['id-bebida'])) {
    $_POST['id-bebida'] = "";
}
if(!isset($_POST['id-preparado'])) {
    $_POST['id-preparado'] = "";
}
if(!isset($_POST['id-antojito'])) {
    $_POST['id-antojito'] = "";
}
if(!isset($_POST['id-pedido'])) {
    $_POST['id-pedido'] = "";
}


if($_POST['Usuario'] != "") {
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
        $_SESSION['Error'] = '<h5 class="error">Usuario no encontrado</h5>';
        header("location:supervisor.php");
        exit();
    }
    $consulta = 'SELECT * FROM venta WHERE id_usuario = "'.$usuario2.'"';
    $consultar = mysqli_query($conexion, $consulta);
    if($resultado = mysqli_fetch_array($consultar)) {
        $_SESSION['Error'] = '<h5 class="error">El usuario ya tiene un pedido</h5>';
        header("location:supervisor.php");
        exit();
    }
    $comida = $_POST['comida-pedido'];
    if($comida == "") {
        $comida = "NULL";
    }
    else {
        $consulta = 'SELECT * FROM preparado WHERE id_comida = '.$comida.'';
        $consultar = mysqli_query($conexion, $consulta);
        if(!$resultado = mysqli_fetch_array($consultar)) {
            header("location:../templates/error.html");
            exit();
        }
    }
    $bebida = $_POST['bebida-pedido'];
    if($bebida == "") {
        $bebida = "NULL";
    }
    else {
        $consulta = 'SELECT * FROM bebida WHERE id_bebida = '.$bebida.'';
        $consultar = mysqli_query($conexion, $consulta);
        if(!$resultado = mysqli_fetch_array($consultar)) {
            header("location:../templates/error.html");
            exit();
        }
    }
    $antojito = $_POST['antojito-pedido'];
    if($antojito == "") {
        $antojito = "NULL";
    }
    else {
        $consulta = 'SELECT * FROM antojito WHERE id_antojito = '.$antojito.'';
        $consultar = mysqli_query($conexion, $consulta);
        if(!$resultado = mysqli_fetch_array($consultar)) {
            header("location:../templates/error.html");
            exit();
        }
    }
    $cantidadC = $_POST['cantidadC-pedido'];
    if($cantidadC == "") {
        $cantidadC = 0;
    }
    $cantidadB = $_POST['cantidadB-pedido'];
    if($cantidadB == "") {
        $cantidadB = 0;
    }
    $cantidadA = $_POST['cantidadA-pedido'];
    if($cantidadA == "") {
        $cantidadA = 0;
    }
    $consulta = 'SELECT existencias FROM antojito WHERE id_antojito = '.$antojito.'';
    $consultar = mysqli_query($conexion, $consulta);
    $resultado = mysqli_fetch_array($consultar);
    $cantAntojitos = $resultado[0];
    if($cantAntojitos < $cantidadA) {
        header("location:../templates/error.html");
        exit();
    }
    $cantAntojitos = $cantAntojitos - $cantidadA;
    $consulta = 'UPDATE antojito SET existencias = '.$cantAntojitos.' WHERE id_antojito = '.$antojito.'';
    $consultar = mysqli_query($conexion, $consulta);
    $consulta = 'SELECT existencias FROM bebida WHERE id_bebida = '.$bebida.'';
    $consultar = mysqli_query($conexion, $consulta);
    $resultado = mysqli_fetch_array($consultar);
    $cantBebida = $resultado[0];
    if($cantBebida < $cantidadB) {
        header("location:../templates/error.html");
        exit();
    }
    $cantBebida = $cantBebida - $cantidadB;
    $consulta = 'UPDATE bebida SET existencias = '.$cantBebida.' WHERE id_bebida = '.$bebida.'';
    $consultar = mysqli_query($conexion, $consulta);
    $consulta = 'SELECT existencias FROM preparado WHERE id_comida = '.$comida.'';
    $consultar = mysqli_query($conexion, $consulta);
    $resultado = mysqli_fetch_array($consultar);
    $cantComida = $resultado[0];
    if($cantComida < $cantidadC) {
        header("location:../templates/error.html");
        exit();
    }
    $cantComida = $cantComida - $cantidadC;
    $consulta = 'UPDATE preparado SET existencias = '.$cantComida.' WHERE id_comida = '.$comida.'';
    $consultar = mysqli_query($conexion, $consulta);
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
    if($espera == (11 || 14)) {
        $total = $total + 5;
    }
    elseif ($espera == (12 || 15)) {
        $total = $total + 10;
    }
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
    $consulta = 'INSERT INTO venta VALUES ("'.$id.'", "'.$usuario2.'", '.$comida.', '.$bebida.', '.$antojito.', '.$cantidadC.','.$cantidadB.', '.$cantidadA.', '.$total.', '.$lugar.', '.$espera.')';
    $consultar = mysqli_query($conexion, $consulta);

    $_SESSION['Error'] = "<h5 class='error'>Pedido generado exitosamente</h5>";
    header("location: supervisor.php");
    exit();
}
else {
    header("location:../templates/error.html");
    exit();
}



mysqli_close($conexion);
?>
