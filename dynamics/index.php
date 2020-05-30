<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    $_SESSION['usuario'] = "";
}
if($_SESSION['usuario'] != "") {
    $cS = '<li>
        <div class="cerrar-sesion" id="ultimo-nav">
            <p>Bienvenid@</p>
            <p>'.$_SESSION['usuario'].'</p>
            <a href="cerrarsesion.php">
                <p id="b-cerrarsesion">Cerrar sesión</p>
            </a>
        </div>
    </li>';
    $botones = '
            <div class="botones-index">
                <div class="b-index">¡Bienvenido!</div>
                <a href="pedidos.php">
                    <div class="b-index">Pedir comida</div>
                </a>
            </div>
    ';
}
else {
    $cS = "";
    $botones = '
            <div class="botones-index">
                <a href="registro.php">
                    <div class="b-index">Registrate</div>
                </a><a href="login.php">
                    <div class="b-index">Inicia Sesion</div>
                </a>
            </div>
    ';
}
if(!isset($_SESSION['Poder'])) {
    $_SESSION['Poder'] = "";
}

if(!isset($_SESSION['Usuario2'])) {
    $_SESSION['Ususario2'] = "";
}

if($_SESSION['Poder'] == 1){
    $admin = '  <div class="contenedor-admin">
                    <div class="admin">
                        <p>Bienvenido Admin</p>
                        <a href="admin.php"><p>Consultas</p></a>
                    </div>
                    <div class="supervisor">
                        <p>Bienvenido Supervisor</p>
                        <a href="supervisor.php"><p>Consultas</p></a>
                    </div>
                </div>';
}
elseif ($_SESSION['Poder'] == 2) {
    $admin = '  <div class="contenedor-admin">
                    <div class="supervisor">
                        <p>Bienvenido Supervisor</p>
                        <a href="supervisor.php"><p>Consultas</p></a>
                    </div>
                </div>';
}
else {
    $admin = "";
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
                    '.$cS.'
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
        <article>

            <div class="img-index"></div>
            '.$botones.'
        </article>
    </section>
    <div class="espacio-final"></div>
    <footer>
        <div class="barra-final">Copyright (c) 2020 SixFood: El Coyote Hambriento. Todos los derechos reservados.</div>
        <div class="logo-final">
            <div class="fondo-logo-final"><img src="../statics/img/logo-malteada.png" alt="Logo SixFood"></div>
            <div class="texto-final">SixFood</div>
        </div>
        '.$admin.'
    </footer>

</body>

</html>';
 ?>
