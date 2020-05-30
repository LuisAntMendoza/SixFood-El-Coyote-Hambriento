<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "root", "pruebaSixFood");
if(!$conexion) {
    header("location:../templates/error.html");
    exit();
}
if(!$_POST['Tipo-tabla']) {
    header("location:../templates/error.html");
    exit();
}
$zona = date_default_timezone_set('America/Mexico_City');
$fecha = date("d-m-Y");
$hora = date("H:i:s");

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

';

if($_POST['Tipo-tabla'] == "Usuario") {
    echo '
            <h3>Añadir usuario</h3>
            <form action="añadicion.php" method="POST">
                <p class="agregar">Usuario: <input type="text" name="Usuario" required></p>
                <p class="agregar">Nombre: <input type="text" name="Nombre" required></p>
                <p class="agregar">Apellido Paterno: <input type="text" name="apPat" required></p>
                <p class="agregar">Apellido Materno: <input type="text" name="apMat" required></p>
                <p class="agregar">Grupo: <input type="text" name="Grupo"></p>
                <p class="agregar">Colegio:
                <input type="text" name="Colegio" list="añadir-colegio">
                <datalist id="añadir-colegio">
                    <optgroup label="Área I">
                        <option value="Física">Física</option>
                        <option value="Informática">Informática</option>
                        <option value="Matemáticas">Matemáticas</option>
                    </optgroup>
                    <optgroup label="Área II">
                        <option value="Biología">Biología</option>
                        <option value="Educación Física">Educación Física</option>
                        <option value="Morfología, Fisiología y Salud">Morfología, Fisiología y Salud</option>
                        <option value="Orientación Educativa">Orientación Educativa</option>
                        <option value="Psicología e Higiene Mental">Psicología e Higiene Mental</option>
                        <option value="Química">Química</option>
                    </optgroup>
                    <optgroup label="Área III">
                        <option value="Ciencias Sociales">Ciencias Sociales</option>
                        <option value="Geografía">Geografía</option>
                        <option value="Historia">Historia</option>
                    </optgroup>
                    <optgroup label="Área IV">
                        <option value="Alemán">Alemán</option>
                        <option value="Artes Plásticas">Artes Plásticas</option>
                        <option value="Danza">Danza</option>
                        <option value="Dibujo y Modelado">Dibujo y Modelado</option>
                        <option value="Filosofía">Filosofía</option>
                        <option value="Francés">Francés</option>
                        <option value="Inglés">Inglés</option>
                        <option value="Italiano">Italiano</option>
                        <option value="Letras Clásicas">Letras Clásicas</option>
                        <option value="Literatura">Literatura</option>
                        <option value="Música">Música</option>
                        <option value="Teatro">Teatro</option>
                    </optgroup>
                    <optgroup label="ETE">
                        <option value="Estudios Técnicos Especializados">Estudios Técnicos Especializados</option>
                    </optgroup>
                </datalist>
                </p>
                <p class="agregar">Contraseña: <input type="password" name="Contraseña" required></p>
                <p class="agregar">Poder:
                    <select name="Poder">
                        <option value="1">Admin</option>
                        <option value="2">Supervisor</option>
                        <option value="3">Cliente</option>
                    </select>
                </p>
                <input type="submit" value="Añadir" class="agregar-usuario">
            </form>
            <div class="botones-index">
                <a href="admin.php">
                    <div class="b-pedido">Volver</div>
                </a>
            </div>
    ';
}
if($_POST['Tipo-tabla'] == "Bebida") {
    echo '
            <h3>Añadir Bebida</h3>
            <form action="añadicion.php" method="POST">
                <p class="agregar">Id <input type="number" required name="id-bebida"></p>
                <p class="agregar">Nombre <input type="text" required name="nombre-bebida"></p>
                <p class="agregar">Tipo:
                    <select name="tipo-bebida">
                        <option value="1">Sabor</option>
                        <option value="2">Simple</option>
                        <option value="3">Sencillo</option>
                        <option value="4">Preparado</option>
                        <option value="5">Original</option>
                    </select>
                </p>
                <p class="agregar">Porción:
                    <select name="porcion-bebida">
                        <option value="10">500ml</option>
                        <option value="11">1 L</option>
                        <option value="12">600ml</option>
                    </select>
                </p>
                <p class="agregar">Precio <input type="number" required name="precio-bebida"></p>
                <p class="agregar">Existencias <input type="number" required name="existencias-bebida"></p>
                <input type="submit" value="Añadir" class="agregar-usuario">
            </form>
            <div class="botones-index">
                <a href="admin.php">
                    <div class="b-pedido">Volver</div>
                </a>
            </div>
    ';
}
if($_POST['Tipo-tabla'] == "Preparado") {
    echo '
            <h3>Añadir Preparado</h3>
            <form action="añadicion.php" method="POST">
                <p class="agregar">Id <input type="number" required name="id-preparado"></p>
                <p class="agregar">Nombre <input type="text" required name="nombre-preparado"></p>
                <p class="agregar">Cantidad <input type="number" required name="cantidad-preparado"></p>
                <p class="agregar">Precio <input type="number" required name="precio-preparado"></p>
                <p class="agregar">Existencias <input type="number" required name="existencias-preparado"></p>
                <input type="submit" value="Añadir" class="agregar-usuario">
            </form>
            <div class="botones-index">
                <a href="admin.php">
                    <div class="b-pedido">Volver</div>
                </a>
            </div>
    ';
}
if($_POST['Tipo-tabla'] == "Antojito") {
    echo '
            <h3>Añadir Antojito</h3>
            <form action="añadicion.php" method="POST">
                <p class="agregar">Id <input type="number" required name="id-antojito"></p>
                <p class="agregar">Nombre <input type="text" required name="nombre-antojito"></p>
                <p class="agregar">Presentación:
                    <select name="presentacion-antojito">
                        <option value="1">Sencillos</option>
                        <option value="2">Especial</option>
                        <option value="3">Chicos</option>
                        <option value="4">Grandes</option>
                        <option value="5">Orden</option>
                        <option value="6">Queso, Crema, Cebolla</option>
                        <option value="7">Con papas a la francesa</option>
                    </select>
                </p>
                <p class="agregar">Porción <input type="number" required name="porcion-antojito"></p>
                <p class="agregar">Cantidad <input type="number" required name="cantidad-antojito"></p>
                <p class="agregar">Precio <input type="number" required name="precio-antojito"></p>
                <p class="agregar">Existencias <input type="number" required name="existencias-antojito"></p>
                <input type="submit" value="Añadir" class="agregar-usuario">
            </form>
            <div class="botones-index">
                <a href="admin.php">
                    <div class="b-pedido">Volver</div>
                </a>
            </div>
    ';
}
if($_POST['Tipo-tabla'] == "Pedido") {
    echo '
            <h3>Añadir Pedido</h3>
            <form action="añadicion.php" method="POST">
                <p class="agregar">Id <input type="text" required name="id-pedido" value="'.$fecha.'_'.$hora.'"></p>
                <p class="agregar">Usuario <input type="text" required name="usuario-pedido"></p>
                <p class="agregar">Comida <input type="number" name="comida-pedido" max="299" min="200"></p>
                <p class="agregar">Bebida <input type="number" name="bebida-pedido" min="101" max="199"></p>
                <p class="agregar">Antojito <input type="number" name="antojito-pedido" min="300" max="399"></p>
                <p class="agregar">Cantidad Comida <input type="number" name="cantidadC-pedido"></p>
                <p class="agregar">Cantidad Bebida <input type="number" name="cantidadB-pedido"></p>
                <p class="agregar">Cantidad Antojito <input type="number" name="cantidadA-pedido"></p>
                <p class="agregar">Lugar:
                    <select name="lugar-pedido">
                        <option value="1">Patio de cuartos</option>
                        <option value="2">Canchas</option>
                        <option value="3">Patio de quintos</option>
                        <option value="4">Pulpo</option>
                        <option value="5">Patio de sextos</option>
                        <option value="6">Pimponeras</option>
                        <option value="7">Area administrativa</option>
                        <option value="8">Sala de maestros</option>
                        <option value="NULL">Recoger en la cafetería</option>
                    </select>
                </p>
                <p class="agregar">Espera <input type="number" required name="espera-pedido" max="15" min="10"></p>
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
        echo '  <tr>
                    <td>'.$resultado[0].'</td>
                    <td>'.$resultado[1].'</td>
                    <td>'.$resultado[5].'</td>
                    <td>'.$resultado[6].'</td>
                </tr>';
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
    echo '      <tr>
                    <td>'.$resultado[0].'</td>
                    <td>'.$resultado[1].'</td>
                    <td>'.$resultado[4].'</td>
                    <td>'.$resultado[5].'</td>
                </tr>
                ';
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
    echo '      <tr>
                    <td>'.$resultado[0].'</td>
                    <td>'.$resultado[1].'</td>
                    <td>'.$resultado[3].'</td>
                    <td>'.$resultado[4].'</td>
                </tr>';
    }
    echo '  </table>
            <h3>Tipos de entrega</h3>
            <table border="1" class="tabla-pedido">
';
    $consulta = 'SELECT * FROM tiempoespera NATURAL JOIN tipoentrega';
    $consultar = mysqli_query($conexion, $consulta);
    echo '      <tr>
                    <th>Id</th>
                    <th>Calidad</th>
                    <th>Tipo de entrega</th>
                    <th>Precio Extra</th>
                    <th>Tiempo de entrega</th>
                </tr>';
    while($resultado = mysqli_fetch_array($consultar)) {
    echo '      <tr>
                    <td>'.$resultado[1].'</td>
                    <td>'.$resultado[4].'</td>';
    if($resultado[2] == 1) {
        $entrega = "Cafeteria";
    }
    else {
        $entrega = "Entrega personal";
    }
    echo '          <td>'.$entrega.'</td>
                    <td>'.$resultado[5].'</td>
                    <td>'.$resultado[3].'</td>
                </tr>';
    }
    echo '  </table>
            <div class="botones-index">
                <a href="supervisor.php">
                    <div class="b-pedido">Volver</div>
                </a>
            </div>';
}
echo '
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
