<?php
//inciamos sesion y conexion
session_start();
$conexion = mysqli_connect("localhost", "root", "root", "SixFood");
if(!$conexion) {
    header("location: ../templates/error.html");
    exit();
}
//si no tiene sesion lo sacamos
if($_SESSION['usuario'] == "") {
    header("location: login.php");
    exit();
}
//si ya tiene un pedido lo regresamos
$consulta = 'SELECT * FROM venta WHERE id_usuario = "'.$_SESSION['Usuario2'].'"';
$consultar = mysqli_query($conexion, $consulta);
if($resultado = mysqli_fetch_array($consultar)) {
    header("location:pedidos.php");
    exit();
}
//si esta castgado lo regresamos
$consulta = 'SELECT * FROM usuario WHERE id_usuario = "'.$_SESSION['Usuario2'].'"';
$consultar = mysqli_query($conexion, $consulta);
$resultado = mysqli_fetch_array($consultar);
if($resultado[8] != "") {
    header("location:pedidos.php");
    exit();
}

//definmos constantes para decifrar
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
//validamos
if(!isset($_POST['id_recoPedido'])) {
    $_POST['id_recoPedido'] = "";
}
//definimos zona horaria
$zona = date_default_timezone_set('America/Mexico_City');
$fecha = date("d-m-Y_H:i:s");
$form = "";
//si es entrega, guarda este select para mostrarlo
if($_POST['id_recoPedido'] != "") {
    $_SESSION['noPedido'] = $fecha;
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
            <div class="form-pedido">
                <h3>Realiza tu pedido</h3>
                <h4>Seleccione una opción</h4>
                <form action="r-pedido.php" method="post">
                    <input type="submit" name="id_recoPedido" value="Recoger" class="pedido-entregar">
                    <input type="submit" name="id_recoPedido" value="Entregar" class="pedido-entregar">
                </form>';
//si es recoger muestra su formulario
if($_POST['id_recoPedido'] == "Recoger") {
    echo '
            <h3>Añadir Pedido</h3>
            <form action="añadicion.php" method="POST">
                <p class="agregar">Id <input type="text" required name="id-pedido" value="'.$fecha.'" readonly></p>
                <input type="hidden" name="usuario-pedido" value="'.Decifrar($_SESSION['Usuario2']).'">
                <p class="agregar">Comida <input type="number" name="comida-pedido" min="200" max="299" pattern="^\d{3}$"></p>
                <p class="agregar">Bebida <input type="number" name="bebida-pedido" min="101" max="199" pattern="^\d{3}$"></p>
                <p class="agregar">Antojito <input type="number" name="antojito-pedido" min="300" max="399" pattern="^\d{3}$"></p>
                <p class="agregar">Cantidad Comida <input type="number" name="cantidadC-pedido" pattern="^\d{2}$"></p>
                <p class="agregar">Cantidad Bebida <input type="number" name="cantidadB-pedido" pattern="^\d{2}$"></p>
                <p class="agregar">Cantidad Antojito <input type="number" name="cantidadA-pedido" pattern="^\d{2}$"></p>
                <input type="hidden" name="lugar-pedido" value="NULL">
                <p class="agregar">Urgencia (tiene costo extra)
                    <select name="espera-pedido">
                        <option value="10">Normal</option>
                        <option value="11">Express (+$5)</option>
                        <option value="12">Urgente (+$10)</option>
                    </select>
                </p>
                <input type="submit" value="Añadir" class="agregar-usuario">
            </form>
            <h3>Disponibilidad Antojitos</h3>
            <table border="1" class="tabla-pedido">';
    $consulta = 'SELECT * FROM antojito';
    $consultar = mysqli_query($conexion, $consulta);
    echo '      <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Existencias</th>
                </tr>';
    while($resultado = mysqli_fetch_array($consultar)) {
        if($resultado[6] != 0) {
            echo '  <tr>
                        <td>'.$resultado[0].'</td>
                        <td>'.$resultado[1].'</td>
                        <td>'.$resultado[5].'</td>
                        <td>'.$resultado[6].'</td>
                    </tr>';
        }
    }
    echo '  </table>
            <h3>Disponibilidad Bebidas</h3>
            <table border="1" class="tabla-pedido">';
    $consulta = 'SELECT * FROM bebida';
    $consultar = mysqli_query($conexion, $consulta);
    echo '      <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Existencias</th>
                </tr>';
    while($resultado = mysqli_fetch_array($consultar)) {
        if($resultado[5] != 0) {
            echo '
                <tr>
                    <td>'.$resultado[0].'</td>
                    <td>'.$resultado[1].'</td>
                    <td>'.$resultado[4].'</td>
                    <td>'.$resultado[5].'</td>
                </tr>
                ';
        }
    }
    echo '  </table>
            <h3>Disponibilidad Preparado</h3>
            <table border="1" class="tabla-pedido">
';
    $consulta = 'SELECT * FROM preparado';
    $consultar = mysqli_query($conexion, $consulta);
    echo '      <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Existencias</th>
                </tr>';
    while($resultado = mysqli_fetch_array($consultar)) {
        if($resultado[4] != 0) {
            echo '
                <tr>
                    <td>'.$resultado[0].'</td>
                    <td>'.$resultado[1].'</td>
                    <td>'.$resultado[3].'</td>
                    <td>'.$resultado[4].'</td>
                </tr>';
        }
    }
    echo '  </table>';
}
//si es entregar muestra su formulario
if($_POST['id_recoPedido'] == "Entregar") {
    echo '
            <h3>Añadir Pedido</h3>
            <form action="añadicion.php" method="POST">
                <p class="agregar">Id <input type="text" required name="id-pedido" value="'.$fecha.'" readonly></p>
                <input type="hidden" name="usuario-pedido" value="'.Decifrar($_SESSION['Usuario2']).'">
                <p class="agregar">Comida <input type="number" name="comida-pedido" min="200" max="299" pattern="^\d{3}$"></p>
                <p class="agregar">Bebida <input type="number" name="bebida-pedido" min="101" max="199" pattern="^\d{3}$"></p>
                <p class="agregar">Antojito <input type="number" name="antojito-pedido" min="300" max="399" pattern="^\d{3}$"></p>
                <p class="agregar">Cantidad Comida <input type="number" name="cantidadC-pedido" pattern="^\d{2}$"></p>
                <p class="agregar">Cantidad Bebida <input type="number" name="cantidadB-pedido" pattern="^\d{2}$"></p>
                <p class="agregar">Cantidad Antojito <input type="number" name="cantidadA-pedido" pattern="^\d{2}$"></p>
                <p class="agregar">Lugar de entrega:
                    <select name="lugar-pedido">
                        <option value="1">Patio de cuartos</option>
                        <option value="2">Canchas</option>
                        <option value="3">Patio de quintos</option>
                        <option value="4">Pulpo</option>
                        <option value="5">Patio de sextos</option>
                        <option value="6">Pimponeras</option>
                        <option value="7">Area administrativa</option>
                        <option value="8">Sala de maestros</option>
                    </select>
                </p>
                <p class="agregar">Urgencia (tiene costo extra)
                    <select name="espera-pedido">
                        <option value="13">Normal</option>
                        <option value="14">Express (+$5)</option>
                        <option value="15">Urgente (+$10)</option>
                    </select>
                </p>
                <input type="submit" value="Añadir" class="agregar-usuario">
            </form>
            <h3>Disponibilidad Antojitos</h3>
            <table border="1" class="tabla-pedido">';
    $consulta = 'SELECT * FROM antojito';
    $consultar = mysqli_query($conexion, $consulta);
    echo '      <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Existencias</th>
                </tr>';
    while($resultado = mysqli_fetch_array($consultar)) {
        if($resultado[6] != 0) {
            echo '  <tr>
                        <td>'.$resultado[0].'</td>
                        <td>'.$resultado[1].'</td>
                        <td>'.$resultado[5].'</td>
                        <td>'.$resultado[6].'</td>
                    </tr>';
        }
    }
    echo '  </table>
            <h3>Disponibilidad Bebidas</h3>
            <table border="1" class="tabla-pedido">';
    $consulta = 'SELECT * FROM bebida';
    $consultar = mysqli_query($conexion, $consulta);
    echo '      <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Existencias</th>
                </tr>';
    while($resultado = mysqli_fetch_array($consultar)) {
        if($resultado[5] != 0) {
            echo '
                <tr>
                    <td>'.$resultado[0].'</td>
                    <td>'.$resultado[1].'</td>
                    <td>'.$resultado[4].'</td>
                    <td>'.$resultado[5].'</td>
                </tr>
                ';
        }
    }
    echo '  </table>
            <h3>Disponibilidad Preparado</h3>
            <table border="1" class="tabla-pedido">
';
    $consulta = 'SELECT * FROM preparado';
    $consultar = mysqli_query($conexion, $consulta);
    echo '      <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Existencias</th>
                </tr>';
    while($resultado = mysqli_fetch_array($consultar)) {
        if($resultado[4] != 0) {
            echo '
                <tr>
                    <td>'.$resultado[0].'</td>
                    <td>'.$resultado[1].'</td>
                    <td>'.$resultado[3].'</td>
                    <td>'.$resultado[4].'</td>
                </tr>';
        }
    }
    echo '  </table>';
}
echo'
            <div class="botones-index">
                <a href="pedidos.php">
                    <div class="b-pedido">Regresar</div>
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
