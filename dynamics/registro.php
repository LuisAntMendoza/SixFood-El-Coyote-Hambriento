<?php
session_start();
//inicio estructura HTML
echo '<!DOCTYPE html>
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
        <article class="body-registro">
            <div class="img-info"><img src="../statics/img/FotosPrepa/5.jpg" alt="Patio de Cuartos"></div>
';

//establecemos conexion
$conexion = mysqli_connect("localhost", "root", "root", "pruebaSixFood");
if(!$conexion) {
    header("location:../templates/error.html");
}

//si la sesion ya esta iniciada lo sacamos
if($_SESSION['usuario'] != "") {
    header("location: index.php");
}

if(!isset($_SESSION['tipo'])) {
    $_SESSION['tipo'] = "";
}
if(!isset($_POST['tipo'])) {
    $_POST['tipo'] = "";
}

//sirven para almacenar en que menu estamos.
if($_POST['tipo'] == "Alumno") {
    $_SESSION['tipo'] = "Alumno";
}
elseif($_POST['tipo'] == "Académico") {
    $_SESSION['tipo'] = "Académico";
}
elseif($_POST['tipo'] == "Trabajador") {
    $_SESSION['tipo'] = "Trabajador";
}

//si escogemos alumno muestra su menu de registro
if($_SESSION['tipo'] == "Alumno") {
    echo
    '
            <div class="tipo-login">
                <form action="registro.php" method="post">
                    <input type="submit" class="escoger-registro" name="tipo" value="Alumno">
                    <input type="submit" class="escoger-registro" name="tipo" value="Académico">
                    <input type="submit" class="escoger-registro" name="tipo" value="Trabajador">
                </form>
            </div>
            <div class="registro-alumno">
                <form action="registracion.php" method="POST">
                    <h3>Ingrese los campos que se le solicitan.</h3>
                    '.$_SESSION['Error'].'
                    <h4>Nombre(s)</h4>
                    <input type="text" name="Nombre" pattern="(^[A-Z][a-zñÑáéíóúÁÉÍÓÚ]+$)|(^[A-Z][a-zñÑáéíóúÁÉÍÓÚ]+[ ][A-Z][a-zñÑáéíóúÁÉÍÓÚ]+$)" title="Ingrese un nombre válido"
                    maxlength="20" required>
                    <h4>Apellido Paterno</h4>
                    <input type="text" name="apPat" required pattern="(^[A-Z][a-zñÑáéíóúÁÉÍÓÚ]+$)" title="Ingrese un Apellido válido">
                    <h4>Apellido Materno</h4>
                    <input type="text" name="apMat" required pattern="(^[A-Z][a-zñÑáéíóúÁÉÍÓÚ]+$)" title="Ingrese un Apellido válido">
                    <h4>Número de cuenta</h4>
                    <input type="text" name="noCuenta" pattern="(^\d{9}$)" required maxlength="9" class="noCuenta" title="Ingrese su número de cuenta sin guiones">
                    <h4>Grupo</h4>
                    <input type="text" name="Grupo" required pattern="^(\d{3})$" maxlength="3" title="Ingrese un grupo válido" class="Grupo">
                    <h4>Contraseña</h4>
                    <input type="password" name="Contraseña" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!-+])([A-Za-z\d!-+]|[^ ]){10,20}$" required
                    title="Ingrese una contraseña válida. Requiere entre 10 y 20 caracteres, mínimo 1 minúscula, 1 mayúscula y 1 caractér especial.">
                    <h4>Repita su contraseña</h4>
                    <input type="password" name="rContraseña" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!-+])([A-Za-z\d!-+]|[^ ]){10,20}$" required
                    title="Ingrese una contraseña válida. Requiere entre 10 y 20 caracteres, mínimo 1 minúscula, 1 mayúscula y 1 caractér especial.">
                    <br>
                    <input type="submit" value="Ingresar" class="login-enviar">
                </form>
            </div>';

}
//si escogemos académico muestra su menu de registro
elseif ($_SESSION['tipo'] == "Académico") {
    echo '
            <div class="tipo-login">
                <form action="registro.php" method="post">
                    <input type="submit" class="escoger-registro" name="tipo" value="Alumno">
                    <input type="submit" class="escoger-registro" name="tipo" value="Académico">
                    <input type="submit" class="escoger-registro" name="tipo" value="Trabajador">
                </form>
            </div>
            <div class="registro-alumno">
            <form action="registracion.php" method="POST">
                <h3>Ingrese los campos que se le solicitan.</h3>
                '.$_SESSION['Error'].'
                <h4>Nombre(s)</h4>
                <input type="text" name="Nombre" pattern="(^[A-Z][a-zñÑáéíóúÁÉÍÓÚ]+$)|(^[A-Z][a-zñÑáéíóúÁÉÍÓÚ]+[ ][A-Z][a-zñÑáéíóúÁÉÍÓÚ]+$)" title="Ingrese un nombre válido"
                maxlength="20" required>
                <h4>Apellido Paterno</h4>
                <input type="text" name="apPat" required pattern="(^[A-Z][a-zñÑáéíóúÁÉÍÓÚ]+$)" title="Ingrese un Apellido válido">
                <h4>Apellido Materno</h4>
                <input type="text" name="apMat" required pattern="(^[A-Z][a-zñÑáéíóúÁÉÍÓÚ]+$)" title="Ingrese un Apellido válido">
                <h4>RFC</h4>
                <input type="text" name="RFC" pattern="^[A-Z]{4}[0-9]{6}[0-9A-Z]{3}$" required maxlength="13" class="RFC" title="Ingrese un RFC válido">
                <h4>Colegio</h4>
                <select name="Colegio">
                    <optgroup label="Área I">
                        <option value="Física">Física</option>
                        <option value="Informática">Informática</option>
                        <option value="Matemáticas">Matemáticas</option>
                    </optgroup>
                    <optgroup label="Área II">
                        <option value="Biología">Biología</option>
                        <option value="Educación Física">Educación Física</option>
                        <option value="Morfología, Fisiología y Salud">Morfología, Fisioligía y Salud</option>
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
                </select>
                <h4>Contraseña</h4>
                <input type="password" name="Contraseña" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!-+])([A-Za-z\d!-+]|[^ ]){10,20}$" required
                title="Ingrese una contraseña válida. Requiere entre 10 y 20 caracteres, mínimo 1 minúscula, 1 mayúscula y 1 caractér especial.">
                <h4>Repita su contraseña</h4>
                <input type="password" name="rContraseña" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!-+])([A-Za-z\d!-+]|[^ ]){10,20}$" required
                title="Ingrese una contraseña válida. Requiere entre 10 y 20 caracteres, mínimo 1 minúscula, 1 mayúscula y 1 caractér especial.">
                <br>
                <input type="submit" value="Ingresar" class="login-enviar">
            </form>
            </div>';
}
//si escogemos trabajador muestra su menu de registro
elseif ($_SESSION['tipo'] == "Trabajador") {
    echo '
            <div class="tipo-login">
                <form action="registro.php" method="post">
                    <input type="submit" class="escoger-registro" name="tipo" value="Alumno">
                    <input type="submit" class="escoger-registro" name="tipo" value="Académico">
                    <input type="submit" class="escoger-registro" name="tipo" value="Trabajador">
                </form>
            </div>
            <div class="registro-alumno">
            <form action="registracion.php" method="POST">
                <h3>Ingrese los campos que se le solicitan.</h3>
                '.$_SESSION['Error'].'
                <h4>Nombre(s)</h4>
                <input type="text" name="Nombre" pattern="(^[A-Z][a-zñÑáéíóúÁÉÍÓÚ]+$)|(^[A-Z][a-zñÑáéíóúÁÉÍÓÚ]+[ ][A-Z][a-zñÑáéíóúÁÉÍÓÚ]+$)" title="Ingrese un nombre válido"
                maxlength="20" required>
                <h4>Apellido Paterno</h4>
                <input type="text" name="apPat" required pattern="(^[A-Z][a-zñÑáéíóúÁÉÍÓÚ]+$)" title="Ingrese un Apellido válido">
                <h4>Apellido Materno</h4>
                <input type="text" name="apMat" required pattern="(^[A-Z][a-zñÑáéíóúÁÉÍÓÚ]+$)" title="Ingrese un Apellido válido">
                <h4>Número de Trabajador</h4>
                <input type="text" name="noTrabajador" pattern="^(\d{6})$" required maxlength="6" title="Ingrese un número de trabajador válido" class="noTrabajador">
                <h4>Contraseña</h4>
                <input type="password" name="Contraseña" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!-+])([A-Za-z\d!-+]|[^ ]){10,20}$" required
                title="Ingrese una contraseña válida. Requiere entre 10 y 20 caracteres, mínimo 1 minúscula, 1 mayúscula y 1 caractér especial.">
                <h4>Repita su contraseña</h4>
                <input type="password" name="rContraseña" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!-+])([A-Za-z\d!-+]|[^ ]){10,20}$" required
                title="Ingrese una contraseña válida. Requiere entre 10 y 20 caracteres, mínimo 1 minúscula, 1 mayúscula y 1 caractér especial.">
                <br>
                <input type="submit" value="Ingresar" class="login-enviar">
            </form>
            </div>';
}
//si no hemos escogido alguno muestra el menu para escoger
else {
    echo '  <div class="login-alumno">
                <h2>Favor de seleccionar una opción</h2>
            </div>
            <div class="tipo-login">
                <form action="registro.php" method="post">
                    <input type="submit" class="escoger-registro" name="tipo" value="Alumno">
                    <input type="submit" class="escoger-registro" name="tipo" value="Académico">
                    <input type="submit" class="escoger-registro" name="tipo" value="Trabajador">
                </form>
            </div>
            ';
}
//ciere de estructura HTML
echo '  </article>
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
mysqli_close($conexion);
?>
