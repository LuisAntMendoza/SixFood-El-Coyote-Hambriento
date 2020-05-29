<?php
session_start();
if(! isset($_SESSION['usuario'])) {
    header("location: login.php");
}
$zona = date_default_timezone_set('America/Mexico_City');//Define la zona horaria a la de México
$fecha = date("d-m-Y"); //Da la fecha
$hora = date("H:i:s"); //Da la hora formato de 24hrs
$form = "";
if($_POST['id_recoPedido']) {
    $_SESSION['noPedido'] = $fecha.'_'.$hora;
    if($_POST['id_recoPedido'] == "Entregar") {
        $form = '
                <p>Lugar de entrega:</p>
                <select name="Lugar">
                    <option value="Patio de cuartos">Patio de cuartos</option>
                    <option value="Canchas">Canchas</option>
                    <option value="Patio de quintos">Patio de quintos</option>
                    <option value="Pulpo">Pulpo</option>
                    <option value="Patio de sextos">Patio de sextos</option>
                    <option value="Pimpos">Pimponeras</option>
                    <option value="Area administrativa">Area administrativa</option>
                    <option value="Sala de maestros">Sala de maestros</option>
                </select>
        ';
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
        <div class="barra-inicio"><a href="index.html">
                <div class="logo"><img src="../statics/img/logo_pizza.png" alt="Logo SixFood" id="logo-inicio"></div>
            </a>

            <h1>SixFood: El Coyote Hambriento</h1>
            <nav class="barranav">
                <ul>
                    <li>
                        <div class="cerrar-sesion" id="ultimo-nav">
                            <p>Sesión iniciada como:</p>
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
            <div class="form-pedido">
                <h3>Realiza tu pedido</h3>
                <h4>Seleccione una opción</h4>
                <form action="r-pedido.php" method="post">
                    <input type="submit" name="id_recoPedido" value="Recoger" class="pedido-entregar">
                    <input type="submit" name="id_recoPedido" value="Entregar" class="pedido-entregar">
                </form>';
if($_POST['id_recoPedido']) {
    echo '      <form action="escogercomida.php" method="post">
                    '.$form.'
                    <p>Urgencia (Costo extra):'.$_SESSION['noPedido'].'</p>
                    <select name="Urgencia">
                        <option value="Normal">Normal</option>
                        <option value="Express">Express</option>
                        <option value="Urgente">Urgente</option>
                    </select>
                    <br>
                    <br>
                    <input type="submit" value="Continuar">


                </form>
    ';
}
echo'       </div>
            <div class="botones-index">
                <a href="pedidos.php">
                    <div class="b-error">Regresar</div>
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
