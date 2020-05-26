<?php
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
        <div class="barra-inicio"><a href="../templates/index.html">
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
            <a href="http://www.facebook.com" target="_blank">
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
session_start();
//establecemos conexion
$conexion = mysqli_connect("localhost", "root", "root", "pruebaSixFood");
if(!$conexion) {
    header("location:../templates/error.html");
}

//si la sesion ya esta iniciada lo sacamos
if(isset($_SESSION['usuario'])) {
    header("location: index.php");
}

//reiniciamos varibales
$noNoCuenta = "";
$contraIncorrecta = "";
$noRFC = "";

//sirven para almacenar en que menu estamos.
if($_POST['tipo'] == "Alumno") {
    $_SESSION['tipo'] = "Alumno";
}
elseif($_POST['tipo'] == "Funcionario/profesor") {
    $_SESSION['tipo'] = "Funcionario/profesor";
}

//valida con regex que se mande lo que se solicita
if($_POST['noCuenta']) {
    if(! preg_match("/^[0-9]{9}$/",$_POST['noCuenta'])) {
        header("location:../templates/error.html");
    }
}
if($_POST['RFC']) {
    if(! preg_match("/^[A-Z]{4}[0-9]{6}[0-9A-Z]{3}$/",$_POST['RFC'])) {
        header("location:../templates/error.html");
    }
}

if($_SESSION['tipo'] == "Alumno") {
    if($_POST['noCuenta']) {
        $escapar = mysqli_real_escape_string($conexion,$_POST['noCuenta']);
        $consultar = 'SELECT * FROM Usuario WHERE noCuenta = "'.$escapar.'"';
        $consulta = mysqli_query($conexion, $consultar);
        $resultado = mysqli_fetch_array($consulta, MYSQLI_ASSOC);
        if($resultado['noCuenta'] == $_POST['noCuenta']) {
            if($resultado['Contraseña'] == $_POST['clave']) {
                $_SESSION['usuario'] = $_POST['noCuenta'];
                header("location:pedidos.php");
            }
            else {
                $contraIncorrecta = "<br><p>Contraseña incorrecta</p>";
            }
        }
        else {
            $noNoCuenta = "<br><br><p>No se encontró ese número de cuenta.</p>";
        }
    }
    echo
    '       <div class="tipo-login">
                <form action="login.php" method="post">
                    <input type="submit" class="escoger-login" name="tipo" value="Alumno">
                    <input type="submit" class="escoger-login" name="tipo" value="Funcionario/profesor">
                </form>
            </div>
            <div class="login-alumno">
                <form action="login.php" method="POST">
                    <h3>Inicie sesión</h3>
                    <h5>Ingrese su número de cuenta</h5>
                    <input type="text" name="noCuenta" pattern="[0-9]{9}" title="Ingrese un número de cuenta válido"
                    maxlength="9" required class="noCuenta">'.$noNoCuenta.'
                    <h5>Ingrese su contraseña</h5>
                    <input type="password" name="clave" required>'.$contraIncorrecta.'
                    <br>
                    <input type="submit" value="Ingresar" class="login-enviar">
                </form>
            </div>';

}
elseif ($_SESSION['tipo'] == "Funcionario/profesor") {
    if($_POST['RFC']) {
        $escapar = mysqli_real_escape_string($conexion,$_POST['RFC']);
        $consultar = 'SELECT * FROM Usuario2 WHERE RFC = "'.$escapar.'"';
        $consulta = mysqli_query($conexion, $consultar);
        $resultado = mysqli_fetch_array($consulta, MYSQLI_ASSOC);
        if($resultado['RFC'] == $_POST['RFC']) {
            if($resultado['Contraseña'] == $_POST['clave']) {
                $_SESSION['usuario'] = $_POST['RFC'];
                header("location:pedidos.php");
            }
            else {
                $contraIncorrecta = "<br><p>Contraseña incorrecta</p>";
            }
        }
        else {
            $noRFC = "<br><br><p>No se encontró ese RFC.</p>";
        }
    }

    echo '  <div class="tipo-login">
                <form action="login.php" method="post">
                    <input type="submit" class="escoger-login" name="tipo" value="Alumno">
                    <input type="submit" class="escoger-login" name="tipo" value="Funcionario/profesor">
                </form>
            </div>
            <div class="login-alumno">
                <form action="login.php" method="POST">
                    <h3>Inicie sesión</h3>
                    <h5>Ingrese su RFC</h5>
                    <input type="text" name="RFC" title="Ingrese un RFC válido" pattern="[A-Z]{4}[0-9]{6}[0-9A-Z]{3}"
                    maxlength="13" required class="RFC">'.$noRFC.'
                    <h5>Ingrese su contraseña</h5>
                    <input type="password" name="clave" required>'.$contraIncorrecta.'
                    <br>
                    <input type="submit" value="Ingresar" class="login-enviar">
                </form>
            </div>';
}
else {
    echo '  <div class="login-alumno">
                <h2>Favor de seleccionar una opción</h2>
            </div>
            <div class="tipo-login">
                <form action="login.php" method="post">
                    <input type="submit" class="escoger-login" name="tipo" value="Alumno">
                    <input type="submit" class="escoger-login" name="tipo" value="Funcionario/profesor">
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
mysqli_close($conexion);
?>
