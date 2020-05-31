<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "root", "SixFood");
if(!$conexion) {
    header("location:../templates/error.html");
    exit();
}
if($_SESSION['usuario'] == "") {
    header("location:../templates/error.html");
    exit();
}
if(!isset($_POST["Tipo-edit"])) {
    $_POST['Tipo-edit'] = "";
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
                            <p>'.$_SESSION["usuario"].'</p>
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
';
if($_POST['Tipo-edit'] == "Lugar") {
    $consulta = 'UPDATE venta SET id_lugar = '.$_POST['Lugar'].' WHERE id_usuario = "'.$_SESSION['Usuario2'].'"';
    $consultar = mysqli_query($conexion, $consulta);
    header("location:pedidos.php");
}
echo '
        <h3>Editar Lugar de Entrega</h3>
        <form action="cambiarentrega.php" method="POST">
            <p class="agregar">Lugar:
                <select name="Lugar">
                    <option value="1">Patio de cuartos</option>
                    <option value="2">Canchas</option>
                    <option value="3">Patio de quintos</option>
                    <option value="4">Pulpo</option>
                    <option value="5">Patio de sextos</option>
                    <option value="6">Pimponeras</option>
                    <option value="7">Área administrativa</option>
                    <option value="8">Sala de maestros</option>
                    <option value="NULL">Recoger en cafetería</option>
                </select>
            </p>
            <input type="hidden" value="Lugar" name="Tipo-edit">
            <input type="submit" value="Editar" class="agregar-usuario">
        </form>
        <div class="botones-index">
            <a href="pedidos.php">
                <div class="b-pedido">Volver</div>
            </a>
        </div>';


?>
