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
if($_SESSION['Poder'] == 3) {
    header("location:../templates/error.html");
    exit();
}

if($_SESSION['Poder'] == "") {
    header("location:../templates/error.html");
    exit();
}

$zona = date_default_timezone_set('America/Mexico_City');
$fecha = date("d-m-Y");
$hora = date("H:i:s");

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
            <h3>Pedidos</h3>
            '.$_SESSION['Error'].'
            <div class="tabla-pedidos">
                <table id="supervisor">
                    <tr>
                        <th>Id</th>
                        <th>Usuario</th>
                        <th>Comida</th>
                        <th>Bebida</th>
                        <th>Antojo</th>
                        <th>Cant C</th>
                        <th>Cant B</th>
                        <th>Cant A</th>
                        <th>Total</th>
                        <th>Lugar</th>
                        <th>Urgencia</th>
                        <th>Espera</th>
                        <th>Editar</th>
                        <th>Completar</th>
                        <th>Castigar</th>
                    </tr>';
$consulta = 'SELECT * FROM venta';
$consultar = mysqli_query($conexion, $consulta);
while($resultado = mysqli_fetch_array($consultar)) {
    $id = $resultado[0];
    echo '          <tr>
                        <td>'.$resultado[0].'</td>
                        <td>'.Decifrar($resultado[1]).'</td>
                        <td>'.$resultado[2].'</td>
                        <td>'.$resultado[3].'</td>
                        <td>'.$resultado[4].'</td>
                        <td>'.$resultado[5].'</td>
                        <td>'.$resultado[6].'</td>
                        <td>'.$resultado[7].'</td>
                        <td>'.$resultado[8].'</td>
                        <td>'.$resultado[9].'</td>';
    $idespera = $resultado[10];
    if($idespera == 10) {
        $urgencia = "Normal";
        $espera = 20;
    }
    elseif($idespera == 11) {
        $urgencia = "Express";
        $espera = 15;
    }
    elseif($idespera == 12) {
        $urgencia = "Urgente";
        $espera = 10;
    }
    elseif($idespera == 13) {
        $urgencia = "Normal";
        $espera = 30;
    }
    elseif($idespera == 14) {
        $urgencia = "Express";
        $espera = 25;
    }
    elseif($idespera == 15) {
        $urgencia = "Urgente";
        $espera = 20;
    }
    echo '              <td>'.$urgencia.'</td>
                        <td>'.$espera.'</td>
                        <td>
                            <form action="editarU.php" method="POST">
                                <input type="hidden" value="'.$id.'" name="Editar">
                                <input type="hidden" value="Pedido" name="Tipo-tabla">
                                <input type="image" src="../statics/img/iconos/actualizar.png" class="basura">
                            </form>
                        </td>
                        <td>
                            <form action="borrar.php" method="POST">
                                <input type="hidden" value="'.$id.'" name="Borrar">
                                <input type="hidden" value="Pedido" name="Tipo-tabla">
                                <input type="image" src="../statics/img/iconos/derecho.png" class="basura">
                            </form>
                        </td>
                        <td>
                            <form action="castigar.php" method="POST">
                                <input type="hidden" value="'.$resultado[1].'" name="Castigar">
                                <input type="hidden" value="Pedido" name="Tipo-tabla">
                                <input type="image" src="../statics/img/iconos/prohibido.png" class="basura">
                            </form>
                        </td>
                    </tr>';
}
echo '
                </table>
            </div>
            <div class="opciones-tablas">
                <form action="añadir.php" method="POST">
                    <input type="hidden" value="Pedido" name="Tipo-tabla">
                    <p class="agregar">Añadir Pedido <input type="submit" value="+"></p>
                </form>
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
$_SESSION['Error'] = "";
?>
