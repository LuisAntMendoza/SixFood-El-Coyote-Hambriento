<?php
//inicamos sesion y conexion
session_start();
$conexion = mysqli_connect("localhost", "root", "root", "SixFood");
if(!$conexion) {
    header("location:../templates/error.html");
    exit();
}

//definimos constantes para la funcion decifrar
define("PASSWORD", "Shrek Amo Del Multiverso");
define("HASH", "sha256");
define("METHOD", "aes-128-cbc-hmac-sha1");

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
//inicio estructura HTML
echo '<!DOCTYPE html>
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
                        <a href="info.php">
                            <div class="linav" id="ultimo-nav">Más info</div>
                        </a>

                    </li>
                    <li>
                        <a href="pedidos.php">
                            <div class="linav">Pedidos</div>
                        </a>

                    </li>
                    <li><a href="index.php">
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
            <a href="http://www.twitter.com" target="_blank">
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
            <div class="img-info"><img src="../statics/img/FotosPrepa/4.jpg" alt="Patio de Cuartos"></div>
';


//si la sesion ya esta iniciada lo sacamos
if($_SESSION['usuario'] != "") {
    header("location: index.php");
    exit();
}

//validamos variables
if(!isset($_POST['tipo'])) {
    $_POST['tipo'] = "";
}
if(!isset($_POST['noCuenta'])) {
    $_POST['noCuenta'] = "";
}
if(!isset($_POST['RFC'])) {
    $_POST['RFC'] = "";
}
if(!isset($_POST['noTrabajador'])) {
    $_POST['noTrabajador'] = "";
}
if(!isset($_POST['clave'])) {
    $_POST['clave'] = "";
}
if(!isset($_SESSION['tipo'])) {
    $_SESSION['tipo'] = "";
}
//sirven para almacenar en que menu estamos.
if($_POST['tipo'] == "Alumno") {
    $_SESSION['tipo'] = "Alumno";
}
elseif($_POST['tipo'] == "Académico") {
    $_SESSION['tipo'] = "Académico";
}
elseif($_POST['tipo'] == "Trabajador") {
    $_SESSION['tipo'] = "Trabajador";
}
$usuario = "";

//validamos la contraseña
if($_POST['clave'] != "") {
    if(! preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!-+])([A-Za-z\d!-+]|[^ ]){10,20}$/", $_POST['clave'])) {
        header("location:../templates/error.html");
        exit();
    }
    else {
        $clave = mysqli_real_escape_string($conexion, $_POST['clave']);
    }
}

//valida con regex que se mande lo que se solicita
if($_POST['noCuenta'] != "") {
    if(! preg_match("/^[0-9]{9}$/",$_POST['noCuenta'])) {
        header("location:../templates/error.html");
        exit();
    }
    else {
        $usuario = mysqli_real_escape_string($conexion, $_POST['noCuenta']);
    }
}
if($_POST['RFC'] != "") {
    if(! preg_match("/^[A-Z]{4}[0-9]{6}[0-9A-Z]{3}$/",$_POST['RFC'])) {
        header("location:../templates/error.html");
        exit();
    }
    else {
        $usuario = mysqli_real_escape_string($conexion, $_POST['RFC']);
    }
}
if($_POST['noTrabajador'] != "") {
    if(! preg_match("/^\d{6}$/", $_POST['noTrabajador'])) {
        header("location:../templates/error.html");
        exit();
    }
    else {
        $usuario = mysqli_real_escape_string($conexion, $_POST['noTrabajador']);
    }
}
//algoritmo para verificar si el usuario y contraseña son los correctos
if($usuario != "") {
    $consulta = 'SELECT * FROM usuario';
    $consultar = mysqli_query($conexion, $consulta);
    while($resultado = mysqli_fetch_array($consultar)) {
        $usuarioBase = Decifrar($resultado[0]);
        if($usuarioBase == $usuario) {
            if(password_verify($clave, $resultado[6])) {
                $_SESSION['usuario'] = Decifrar($resultado[1]);
                $_SESSION['Usuario2'] = $resultado[0];
                $_SESSION['Poder'] = $resultado[7];
                header("location: index.php");
                exit();
            }
            else {
                $_SESSION['Error'] = "<p>Contraseña incorrecta</p>";
                header("location:login.php");
                exit();
            }
        }
    }
    $_SESSION['Error'] = "<p>Usuario no encontrado</p>";
    header("location:login.php");
    exit();
}

//formulario para los alumnos
if($_SESSION['tipo'] == "Alumno") {
    echo
    '       <div class="tipo-login">
                <form action="login.php" method="post">
                    <input type="submit" class="escoger-registro" name="tipo" value="Alumno">
                    <input type="submit" class="escoger-registro" name="tipo" value="Académico">
                    <input type="submit" class="escoger-registro" name="tipo" value="Trabajador">
                </form>
            </div>
            <div class="login-alumno">
                <form action="login.php" method="POST">
                    <h3>Inicie sesión</h3>
                    '.$_SESSION['Error'].'
                    <h5>Ingrese su número de cuenta</h5>
                    <input type="text" name="noCuenta" pattern="[0-9]{9}" title="Ingrese un número de cuenta válido"
                    maxlength="9" required class="noCuenta">
                    <h5>Ingrese su contraseña</h5>
                    <input type="password" name="clave" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!-+])([A-Za-z\d!-+]|[^ ]){10,20}$" required
                    title="Ingrese una contraseña válida. Requiere entre 10 y 20 caracteres, mínimo 1 minúscula, 1 mayúscula y 1 caractér especial.">
                    <br>
                    <input type="submit" value="Ingresar" class="login-enviar">
                </form>
            </div>';

}
//formulario para los academicos
elseif ($_SESSION['tipo'] == "Académico") {

    echo '  <div class="tipo-login">
                <form action="login.php" method="post">
                    <input type="submit" class="escoger-registro" name="tipo" value="Alumno">
                    <input type="submit" class="escoger-registro" name="tipo" value="Académico">
                    <input type="submit" class="escoger-registro" name="tipo" value="Trabajador">
                </form>
            </div>
            <div class="login-alumno">
                <form action="login.php" method="POST">
                    <h3>Inicie sesión</h3>
                    '.$_SESSION['Error'].'
                    <h5>Ingrese su RFC</h5>
                    <input type="text" name="RFC" title="Ingrese un RFC válido" pattern="[A-Z]{4}[0-9]{6}[0-9A-Z]{3}"
                    maxlength="13" required class="RFC">
                    <h5>Ingrese su contraseña</h5>
                    <input type="password" name="clave" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!-+])([A-Za-z\d!-+]|[^ ]){10,20}$" required
                    title="Ingrese una contraseña válida. Requiere entre 10 y 20 caracteres, mínimo 1 minúscula, 1 mayúscula y 1 caractér especial.">
                    <br>
                    <input type="submit" value="Ingresar" class="login-enviar">
                </form>
            </div>';
}
//formualrio para los trabajadores
elseif ($_SESSION['tipo'] == "Trabajador") {
    echo '  <div class="tipo-login">
                <form action="login.php" method="post">
                    <input type="submit" class="escoger-registro" name="tipo" value="Alumno">
                    <input type="submit" class="escoger-registro" name="tipo" value="Académico">
                    <input type="submit" class="escoger-registro" name="tipo" value="Trabajador">
                </form>
            </div>
            <div class="login-alumno">
                <form action="login.php" method="POST">
                    <h3>Inicie sesión</h3>
                    '.$_SESSION['Error'].'
                    <h5>Ingrese su Número de Trabajador</h5>
                    <input type="text" name="noTrabajador" title="Ingrese un Número de Trabajador válido" pattern="^\d{6}$"
                    maxlength="6" required class="noTrabajador">
                    <h5>Ingrese su contraseña</h5>
                    <input type="password" name="clave" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!-+])([A-Za-z\d!-+]|[^ ]){10,20}$" required
                    title="Ingrese una contraseña válida. Requiere entre 10 y 20 caracteres, mínimo 1 minúscula, 1 mayúscula y 1 caractér especial.">
                    <br>
                    <input type="submit" value="Ingresar" class="login-enviar">
                </form>
            </div>';
}
//muestra el menu de escoger una opcion
else {
    echo '  <div class="login-alumno">
                <h2>Favor de seleccionar una opción</h2>
            </div>
            <div class="tipo-login">
                <form action="login.php" method="post">
                    <input type="submit" class="escoger-registro" name="tipo" value="Alumno">
                    <input type="submit" class="escoger-registro" name="tipo" value="Académico">
                    <input type="submit" class="escoger-registro" name="tipo" value="Trabajador">
                </form>
            </div>
            ';
}
//ciere de estructura HTML
echo '  </article>
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
$_SESSION['Error'] = "";
mysqli_close($conexion);
?>
