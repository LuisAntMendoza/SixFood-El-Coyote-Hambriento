<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "root", "pruebaSixFood");
if(!$conexion) {
    header("location:../templates/error.html");
    exit();
}
if(! isset($_SESSION['usuario'])) {
    header("location: login.php");
    exit();
}
$zona = date_default_timezone_set('America/Mexico_City');

$consulta = 'SELECT * FROM venta WHERE id_usuario = "'.$_SESSION['Usuario2'].'"';
$consultar = mysqli_query($conexion, $consulta);
if($resultado = mysqli_fetch_array($consultar)) {
    $mensaje = '<h3>¡Ya has realizado un pedido!</h3>
                <p>Espera a que sea completado para hacer otro pedido.</p>';
    $mensaje2 = "";
}
else {
    $mensaje = '<h3>¡Aún no has realizado un pedido!</h3>
                <p>Haz clic en la opción de abajo para realizar un pedido.</p>';
    $mensaje2 = '
                <div class="img-pedido">
                    <img src="../statics/img/FotosPrepa/2.jpg" alt="Patio de Cuartos">
                    <div class="degradado">
                        <a href="r-pedido.php">
                            <span>Realiza tu pedido</span>
                        </a>
                    </div>
                </div>';
}
$consulta = 'SELECT * FROM usuario WHERE id_usuario = "'.$_SESSION['Usuario2'].'"';
$consultar = mysqli_query($conexion, $consulta);
$resultado = mysqli_fetch_array($consultar);
if($resultado[8] != "") {
    if($resultado[8] < date("d-m-Y_H:i:s")) {
        $mensaje = '<h3 class="error">Usted ha sido castigado</h3>
                    <p>No podrá realizar pedidos hasta '.$resultado[8].'</p>';
        $mensaje2 = "";
    }
    else {
        $consulta = 'UPDATE usuario SET castigo = NULL WHERE id_usuario = "'.$_SESSION['Usuario2'].'"';
        $consultar = mysqli_query($conexion, $consulta);
    }
}

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
                        <div class="cerrar-sesion" id="ultimo-nav">
                            <p>Bienvenid@</p>
                            <p>'.$_SESSION['usuario'].'</p>
                            <a href="cerrarsesion.php">
                                <p id="b-cerrarsesion">Cerrar sesión</p>
                            </a>
                        </div>
                    </li>
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
        <article class="body-pedidos">
            <h3></h3>
            <div class="menu-pedidos">
                '.$mensaje.'
                '.$mensaje2.'
            </div>
            <div class="botones-index">
                <a href="index.php">
                    <div class="b-pedido">Volver a la página principal</div>
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
?>
