<?php
session_start();
//definimos constantes
define("PASSWORD", "Shrek Amo Del Multiverso");
define("HASH", "sha256");
define("METHOD", "aes-128-cbc-hmac-sha1");

//concectamos a SQL
$conexion = mysqli_connect("localhost", "root", "root", "SixFood");

//funcion para cifrar
function Cifrar($text){
  $key = openssl_digest(PASSWORD, HASH);
  $iv_len = openssl_cipher_iv_length (METHOD);
  $iv = openssl_random_pseudo_bytes ($iv_len);

  $key = openssl_digest(PASSWORD,HASH);

  $rawCiff = openssl_encrypt($text, METHOD, $key, OPENSSL_RAW_DATA, $iv);
  $textoCifrado = base64_encode($iv.$rawCiff);

  return $textoCifrado;
}

//funcion para descifrar
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

//validamos nombre
if(preg_match("/(^[A-Z][a-zñÑáéíóúÁÉÍÓÚ]+$)|(^[A-Z][a-zñÑáéíóúÁÉÍÓÚ]+[ ][A-Z][a-zñÑáéíóúÁÉÍÓÚ]+$)/", $_POST['Nombre'])) {
    $nombre = mysqli_real_escape_string($conexion, $_POST['Nombre']);
}
else {
    header("location:../templates/error.html");
    exit();
}

//validamos Apellido Paterno
if(preg_match("/(^[A-Z][a-zñÑáéíóúÁÉÍÓÚ]+$)/", $_POST['apPat'])) {
    $apPat = mysqli_real_escape_string($conexion, $_POST['apPat']);
}
else {
    header("location:../templates/error.html");
    exit();
}

//validamos Apellido Materno
if(preg_match("/(^[A-Z][a-zñÑáéíóúÁÉÍÓÚ]+$)/", $_POST['apMat'])) {
    $apMat = mysqli_real_escape_string($conexion, $_POST['apMat']);
}
else {
    header("location:../templates/error.html");
    exit();
}

//si es alumno...
if($_SESSION['tipo'] == "Alumno") {
    if(preg_match("/(^\d{9}$)/", $_POST['noCuenta'])) {
        //validamos Numero de Cuenta y checamos que no este registrado
        $noCuenta = mysqli_real_escape_string($conexion, $_POST['noCuenta']);
        $consulta = 'SELECT * FROM usuario';
        $consultar = mysqli_query($conexion, $consulta);
        while($resultado = mysqli_fetch_array($consultar)) {
            $usuariodec = Decifrar($resultado[0]);
            if($usuariodec == $noCuenta) {
                $_SESSION['Error'] = "<p>Usuario ya registrado</p>";
            }
        }
        if($_SESSION['Error'] == "<p>Usuario ya registrado</p>") {
            header("location: registro.php");
            exit();
        }
    }
    else {
        header("location:../templates/error.html");
        exit();
    }
    //validamos Grupo
    if(preg_match("/^(\d{3})$/", $_POST['Grupo'])) {
        $Grupo = mysqli_real_escape_string($conexion, $_POST['Grupo']);
    }
    else {
        header("location:../templates/error.html");
        exit();
    }
}
//si es academico...
elseif ($_SESSION['tipo'] == "Académico") {
    if(preg_match("/^[A-Z]{4}[0-9]{6}[0-9A-Z]{3}$/", $_POST['RFC'])) {
        //validamos RFC y checamos que no este registrado
        $RFC = mysqli_real_escape_string($conexion, $_POST['RFC']);
        $consulta = 'SELECT * FROM usuario';
        $consultar = mysqli_query($conexion, $consulta);
        while($resultado = mysqli_fetch_array($consultar)) {
            $usuariodec = Decifrar($resultado[0]);
            if($usuariodec == $RFC) {
                $_SESSION['Error'] = "<p>Usuario ya registrado</p>";
            }
        }
        if($_SESSION['Error'] == "<p>Usuario ya registrado</p>") {
            header("location: registro.php");
            exit();
        }
    }
    else {
        header("location:../templates/error.html");
        exit();
    }
    //validamos Colegio
    $Colegio = htmlentities($_POST['Colegio']);
    $Colegio = mysqli_real_escape_string($conexion, $Colegio);
}
//si es trabajador...
elseif ($_SESSION['tipo'] == "Trabajador") {
    if(preg_match("/^(\d{6})$/", $_POST['noTrabajador'])) {
        //validamos Numero de Trabajador y checamos que no este registrado
        $noTrabajador = mysqli_real_escape_string($conexion, $_POST['noTrabajador']);
        $consulta = 'SELECT * FROM usuario';
        $consultar = mysqli_query($conexion, $consulta);
        while($resultado = mysqli_fetch_array($consultar)) {
            $usuariodec = Decifrar($resultado[0]);
            if($usuariodec == $noTrabajador) {
                $_SESSION['Error'] = "<p>Usuario ya registrado</p>";
            }
        }
        if($_SESSION['Error'] == "<p>Usuario ya registrado</p>") {
            header("location: registro.php");
            exit();
        }
    }
    else {
        header("location:../templates/error.html");
        exit();
    }
}

//validamos contraseña
if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!-+])([A-Za-z\d!-+]|[^ ]){10,20}$/", $_POST['Contraseña'])) {
    $Contraseña = mysqli_real_escape_string($conexion, $_POST['Contraseña']);
}
else {
    header("location:../templates/error.html");
    exit();
}

//validamos la confirmacion de la contraseña
if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!-+])([A-Za-z\d!-+]|[^ ]){10,20}$/", $_POST['rContraseña'])) {
    $rContraseña = $_POST['rContraseña'];
}
else {
    header("location:../templates/error.html");
    exit();
}

//checamos que sean la misma contraseña
if($Contraseña != $rContraseña) {
    $_SESSION['Error'] = "<p>Las contraseñas no coinciden</p>";
    header("location:registro.php");
    exit();
}

//ciframos datos sensibles
$nombre = Cifrar($nombre);
$apPat = Cifrar($apPat);
$apMat = Cifrar($apMat);
$Contraseña = password_hash($Contraseña, PASSWORD_BCRYPT);
if($_SESSION['tipo'] == "Alumno") {
    $noCuenta = Cifrar($noCuenta);
}
elseif($_SESSION['tipo'] == "Académico") {
    $RFC = Cifrar($RFC);
}
elseif ($_SESSION['tipo'] == "Trabajador") {
    $noTrabajador = Cifrar($noTrabajador);
}

//los subimos al sistema
if($_SESSION['tipo'] == "Alumno") {
    $consulta = 'INSERT INTO usuario VALUES ("'.$noCuenta.'","'.$nombre.'","'.$apPat.'","'.$apMat.'",'.$Grupo.', "","'.$Contraseña.'", 3, NULL)';
}
elseif($_SESSION['tipo'] == "Académico") {
    $consulta = 'INSERT INTO usuario VALUES ("'.$RFC.'", "'.$nombre.'", "'.$apPat.'", "'.$apMat.'", NULL, "'.$Colegio.'", "'.$Contraseña.'", 3, NULL)';
}
elseif ($_SESSION['tipo'] == "Trabajador") {
    $consulta = 'INSERT INTO usuario VALUES ("'.$noTrabajador.'","'.$nombre.'","'.$apPat.'","'.$apMat.'", NULL, NULL,"'.$Contraseña.'", 3, NULL)';
}
$consultar = mysqli_query($conexion, $consulta);

//mostramos la pagina de que se registro con exito
echo '
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>SixFood</title>
    <link rel="stylesheet" href="../statics/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Syncopate&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        <div class="barra-inicio"><a href="index.php">
                <div class="logo"><img src="../statics/img/logo_pizza.png" alt="Logo SixFood" id="logo-inicio"></div>
            </a>

            <h1>SixFood: El Coyote Hambriento</h1>
            <nav class="barranav">
                <ul>
                    <li>
                        <a href="../dynamics/info.php">
                            <div class="linav" id="ultimo-nav">Más info</div>
                        </a>

                    </li>
                    <li>
                        <a href="../dynamics/pedidos.php">
                            <div class="linav">Pedidos</div>
                        </a>

                    </li>
                    <li><a href="../dynamics/index.php">
                            <div class="linav">Inicio</div>
                        </a>

                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <section>
        <aside class="redes">
            <h3 class="redes-titulo">¡Síguenos!</h3>
            <a href="https://www.facebook.com/coyo.sixfood.5" target="_blank">
                <div class="cuadro-red" id="facebook"><img src="../statics/img/logos-red/logo-facebook.png" alt="Logo Facebook" class="logo-red">
                    <h3 class="h3-red">Facebook</h3>
                </div>
            </a>
            <a href="http://www.instagram.com" target="_blank">
                <div class="cuadro-red" id="instagram"><img src="../statics/img/logos-red/logo-instagram.png" alt="Logo Instagram" class="logo-red">
                    <h3 class="h3-red">Instagram</h3>
                </div>
            </a>
            <a href="https://twitter.com/CSixfood" target="_blank">
                <div class="cuadro-red" id="twitter"><img src="../statics/img/logos-red/logo-twitter.png" alt="Logo Twitter" class="logo-red">
                    <h3 class="h3-red">Twitter</h3>
                </div>
            </a>
            <a href="http://www.whatsapp.com" target="_blank">
                <div class="cuadro-red" id="whatsapp"><img src="../statics/img/logos-red/logo-whatsapp.png" alt="Logo Whatsapp" class="logo-red">
                    <h3 class="h3-red">WhatsApp</h3>
                </div>
            </a>
            <a href="http://www.prepa6.unam.mx/ENP6/_P6/" target="_blank">
                <div class="prepa6">
                    <div class="logo-coyote"><img src="../statics/img/coyote.png" alt="Coyote Prepa 6" class="coyotep6"></div>
                    <div class="texto-prepa6">Prepa 6</div>
                    <div class="a-c">"Antonio Caso"</div>
                </div>
            </a>
        </aside>
        <article>

            <div class="img-index"></div>
            <div class="botones-index">

                <div class="b-error">¡Registro exitoso!</div>
                <a href="index.php">
                    <div class="b-error">Volver a la página principal</div>
                </a>
            </div>
        </article>
    </section>
    <div class="espacio-final"></div>
    <footer>
        <div class="barra-final">Copyright (c) 2020 SixFood: El Coyote Hambriento. Todos los derechos reservados.</div>
        <div class="logo-final">
            <div class="fondo-logo-final"><img src="../statics/img/logo-malteada.png" alt="Logo SixFood"></div>
            <div class="texto-final">SixFood</div>
        </div>
    </footer>

</body>

</html>';

//cerramos conexion a SQL
mysqli_close($conexion);
?>
