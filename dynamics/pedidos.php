<?php
//iniciamos sesion y conexion
session_start();
$conexion = mysqli_connect("localhost", "root", "root", "SixFood");
if(!$conexion) {
    header("location:../templates/error.html");
    exit();
}
//si no esta logueado lo sacamos
if($_SESSION['usuario'] == "") {
    header("location: login.php");
    exit();
}
//definimos zona horaria
$zona = date_default_timezone_set('America/Mexico_City');

//consulta el lugar de entrega
$consulta = 'SELECT lugar FROM venta NATURAL JOIN entrega WHERE id_usuario = "'.$_SESSION['Usuario2'].'"';
$consultar = mysqli_query($conexion, $consulta);
$resultado = mysqli_fetch_array($consultar);
$lugar = $resultado[0];
if($lugar == "") {
    $lugar = "Cafeteria";
}

//checa si el usuario ha sido castigado y guarda su contenido
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

//checa si ya tienes un pedido o no y guarda su resoectivo contenido
$consulta = 'SELECT * FROM venta NATURAL JOIN tiempoespera WHERE id_usuario = "'.$_SESSION['Usuario2'].'"';
$consultar = mysqli_query($conexion, $consulta);
if($resultado = mysqli_fetch_array($consultar)) {
    $mensaje = '<h3>¡Ya has realizado un pedido!</h3>
                <p>ID de su pedido: '.$resultado[1].'</p>
                <p>Costo total de su pedido: $'.$resultado[9].'</p>
                <p>Tiempo de espera: '.$resultado[13].' min</p>
                <p>Lugar de entrega: '.$lugar.'</p>
                <a href="cambiarentrega.php"><p>Haz clic aquí para cambiar tu lugar de entrega</p></a>
                <p>Favor de completar un pedido antes de hacer otro</p>';
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

//estructura basica HTML
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

mysqli_close($conexion);
?>
