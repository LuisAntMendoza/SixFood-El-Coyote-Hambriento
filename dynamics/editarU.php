<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "root", "pruebaSixFood");
if(!$conexion) {
    header("location:../templates/error.html");
    exit();
}
if(!$_POST['Editar']) {
    header("location:../templates/error.html");
    exit();
}

define("PASSWORD", "Shrek Amo Del Multiverso");
define("HASH", "sha256");
define("METHOD", "aes-128-cbc-hmac-sha1");

function Cifrar($text){
  $key = openssl_digest(PASSWORD, HASH);
  $iv_len = openssl_cipher_iv_length (METHOD);
  $iv = openssl_random_pseudo_bytes ($iv_len);

  $key = openssl_digest(PASSWORD,HASH);

  $rawCiff = openssl_encrypt(
  $text,
  METHOD,
  $key,
  OPENSSL_RAW_DATA,
  $iv
  );
  $textoCifrado = base64_encode($iv.$rawCiff);

  return $textoCifrado;
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

';

if($_POST['Tipo-edit'] == "Usuario") {
    if($_POST['Columna'] == "id_usuario") {
        $valor = Cifrar($_POST['Valor']);
    }
    if($_POST['Columna'] == "nombre") {
        $valor = Cifrar($_POST['Valor']);
    }
    if($_POST['Columna'] == "apellidoPat") {
        $valor = Cifrar($_POST['Valor']);
    }
    if($_POST['Columna'] == "apellidoMat") {
        $valor = Cifrar($_POST['Valor']);
    }
    if($_POST['Columna'] == "contraseña") {
        $valor = password_hash($_POST['Valor'], PASSWORD_BCRYPT);
    }
    if($_POST['Columna'] == "grupo") {
        $valor = $_POST['Valor'];
    }
    if($_POST['Columna'] == "colegio") {
        $valor = $_POST['Valor'];
    }
    if($_POST['Columna'] == "id_tipousuario") {
        $valor = $_POST['Valor'];
    }
    $consulta = 'UPDATE usuario SET '.$_POST['Columna'].' = "'.$valor.'" WHERE id_usuario = "'.$_POST['Editar'].'"';
    $consultar = mysqli_query($conexion, $consulta);
    $_SESSION['Error'] = "<h5 class='error'>Usuario editado correctamente</h5>";
    header("location:admin.php");
    exit();
}
elseif ($_POST['Tipo-edit'] == "Bebida") {
    $valor = $_POST['Valor'];
    $consulta = 'UPDATE bebida SET '.$_POST['Columna'].' = "'.$valor.'" WHERE id_bebida = '.$_POST['Editar'].'';
    $consultar = mysqli_query($conexion, $consulta);
    $_SESSION['Error'] = "<h5 class='error'>Bebida editada correctamente</h5>";
    header("location:admin.php");
    exit();
}
elseif ($_POST['Tipo-edit'] == "Preparado") {
    $valor = $_POST['Valor'];
    $consulta = 'UPDATE preparado SET '.$_POST['Columna'].' = "'.$valor.'" WHERE id_comida = '.$_POST['Editar'].'';
    $consultar = mysqli_query($conexion, $consulta);
    $_SESSION['Error'] = "<h5 class='error'>Preparado editado correctamente</h5>";
    header("location:admin.php");
    exit();
}
elseif ($_POST['Tipo-edit'] == "Antojito") {
    $valor = $_POST['Valor'];
    $consulta = 'UPDATE antojito SET '.$_POST['Columna'].' = "'.$valor.'" WHERE id_antojito = '.$_POST['Editar'].'';
    $consultar = mysqli_query($conexion, $consulta);
    $_SESSION['Error'] = "<h5 class='error'>Antojito editado correctamente</h5>";
    header("location:admin.php");
    exit();
}



if($_POST['Tipo-tabla'] == "Usuario") {
    echo '
            <h3>Editar usuario</h3>
            <form action="editarU.php" method="POST">
                <p class="agregar">Dato a editar:
                    <select name="Columna">
                        <option value="id_usuario">Usuario</option>
                        <option value="nombre">Nombre</option>
                        <option value="apellidoPat">Apellido Paterno</option>
                        <option value="apellidoMat">Apellido Materno</option>
                        <option value="grupo">Grupo</option>
                        <option value="colegio">Colegio</option>
                        <option value="contraseña">Contraseña</option>
                        <option value="id_tipousuario">Poder</option>
                    </select>
                </p>
                <p class="agregar">Nuevo valor: <input type="text" name="Valor" required></p>
                <input type="hidden" value="'.$_POST['Editar'].'" name="Editar">
                <input type="hidden" value="Usuario" name="Tipo-edit">
                <input type="submit" value="Editar" class="agregar-usuario">
            </form>
    ';
}
elseif($_POST['Tipo-tabla'] == "Bebida") {
    echo '
            <h3>Editar Bebida</h3>
            <form action="editarU.php" method="POST">
                <p class="agregar">Dato a editar:
                    <select name="Columna">
                        <option value="id_bebida">Id</option>
                        <option value="nombre">Nombre</option>
                        <option value="id_tipoB">Tipo</option>
                        <option value="id_porcionB">Porcion</option>
                        <option value="precio">Precio</option>
                        <option value="existencias">Existencias</option>
                    </select>
                </p>
                <p class="agregar">Nuevo valor: <input type="text" name="Valor" required></p>
                <input type="hidden" value="'.$_POST['Editar'].'" name="Editar">
                <input type="hidden" value="Bebida" name="Tipo-edit">
                <input type="submit" value="Editar" class="agregar-usuario">
            </form>
            <table border="1">
                <tr>
                    <th>Id</th>
                    <th>Tipo</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Sabor</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Simple</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Sencillo</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Preparado</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Original</td>
                </tr>
            </table>
            <br>
            <table border="1">
                <tr>
                    <th>Id</th>
                    <th>Porción</th>
                </tr>
                <tr>
                    <td>10</td>
                    <td>500ml</td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>1 L</td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>600ml</td>
                </tr>
            </table>
    ';
}
elseif ($_POST['Tipo-tabla'] == "Preparado") {
    echo '
            <h3>Editar Preparado</h3>
            <form action="editarU.php" method="POST">
                <p class="agregar">Dato a editar:
                    <select name="Columna">
                        <option value="id_comida">Id</option>
                        <option value="nombre">Nombre</option>
                        <option value="cantidadP">Cantidad</option>
                        <option value="precio">Precio</option>
                        <option value="existencias">Existencias</option>
                    </select>
                </p>
                <p class="agregar">Nuevo valor: <input type="text" name="Valor" required></p>
                <input type="hidden" value="'.$_POST['Editar'].'" name="Editar">
                <input type="hidden" value="Preparado" name="Tipo-edit">
                <input type="submit" value="Editar" class="agregar-usuario">
            </form>
    ';
}
elseif ($_POST['Tipo-tabla'] == "Antojito") {
    echo '
            <h3>Editar Antojito</h3>
            <form action="editarU.php" method="POST">
                <p class="agregar">Dato a editar:
                    <select name="Columna">
                        <option value="id_antojito">Id</option>
                        <option value="nombre">Nombre</option>
                        <option value="id_presentacion">Presentación</option>
                        <option value="porcion">Porción</option>
                        <option value="cantidadA">Cantidad</option>
                        <option value="precio">Precio</option>
                        <option value="existencias">Existencias</option>
                    </select>
                </p>
                <p class="agregar">Nuevo valor: <input type="text" name="Valor" required></p>
                <input type="hidden" value="'.$_POST['Editar'].'" name="Editar">
                <input type="hidden" value="Antojito" name="Tipo-edit">
                <input type="submit" value="Editar" class="agregar-usuario">
            </form>
            <table border="1">
                <tr>
                    <th>Id</th>
                    <th>Presentacion</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Sencillos</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Especial</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Chicos</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Grandes</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Orden</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Queso, Crema, Cebolla</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Con papas a la francesa</td>
                </tr>
            </table>
    ';
}











echo '
            <div class="botones-index">
                <a href="admin.php">
                    <div class="b-error">Volver</div>
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
