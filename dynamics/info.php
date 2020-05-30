<?php
session_start();
if(!isset($_SESSION['usuario'])){
    $_SESSION['usuario'] = "";
}
if($_SESSION['usuario'] != "") {
    $cS = '
    <li>
        <div class="cerrar-sesion" id="ultimo-nav">
            <p>Bienvenid@</p>
            <p>'.$_SESSION['usuario'].'</p>
            <a href="cerrarsesion.php">
                <p id="b-cerrarsesion">Cerrar sesión</p>
            </a>
        </div>
    </li>';
}
else {
    $cS = "";
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
            <div class="img-info"><img src="../statics/img/FotosPrepa/2.jpg" alt="Patio de Cuartos"></div>
            <div class="choro-info">
                <p>© Six Food: El Coyote Hambriento S.A. de C.V. busca brindarte la mejor experiencia para adquirir comida de calidad y al mejor precio.
                </p>
                <p>Somos una empresa dedicada al servicio al cliente, nuestros usuarios son nuestra prioridad y constantemente
                    estamos mejorando para darte el mejor servicio dentro de la industria alimentaria. Nuestra misión es ofrecerte
                    una plataforma completa en la que puedas realizar pedidos de manera rápida y segura, donde tu información personal esté protegida. </p>
                <p>Contamos con un (extenso) catálogo de productos que puedes consultar en cualquier momento para satisfacer todos tus antojos. Y, si
                    alguna vez quieres un producto en particular y este no se encuentra en nuestro menú, no dudes en escribir tu propuesta de adiciones
                    en el apartado de “Sugerencias”.
                </p>
                <p>Todo nuestro repertorio de Comida por Pedido está elaborado con los mejores productos del mercado, con carne de calidad y las verduras
                    más frescas. Todo preparado al momento. Si tienes curiosidad por nuestros proveedores, puedes consultar la sección “¿De dónde viene la
                    comida?”, donde encontrarás los lugares que proveen de materia prima a tu cafetería.
                </p>
                <p>Si te interesa saber más acerca de la página o de sus creadores y accionistas, puedes revisar nuestras redes sociales en la sección de “¡Conócenos!”.
                </p>
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
