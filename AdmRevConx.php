<?php

  session_name("login");
  session_start();
  $Admin = "Administrador";
  if (isset($_SESSION['nomUsuario'])) {
    echo "Haz iniciado sesión como Administrador :)<br>
    <a href='CerrarS.php' style='text-decoration: none;'>"."Cerrar Sesión"."</a>
    <br><br>
    <form method='POST' action='C2.php'>
    Nombre de Usuario: Root <br>
    Contraseña de Usuario: Root <br>
    <input type='Submit' value='Enviar'>
    </form>";
  }
    else {
      // code...
      echo "
      <!DOCTYPE html>
      <html lang='en' dir='ltr'>
      <head>
      <meta charset='utf-8'>
      <title> Inicio de Sesión </title>
      </head>
      <body>
      <br><br>
      <form method='post' action='Check.php'>
      <center><fieldset>
      <legend><strong> Inicio de Sesión </strong></legend><br>
      Usuario <br>
      <input type='text' name='nomUsuario' required placeholder='Usuario' class='texto'><br><br>
      Contraseña <br>
      <input type='password' name='contraseña' required placeholder='Contraseña' class='texto' min='3' max='10'><br><br>
      Seleccione Tipo de Usuario:
      <select name='puesto' required>
      <optgroup label='Seleccione:'>
      <option value='Otro'>Administrador</option>
      </optgroup>
      </select><br><br>
      <input type='Submit' value='Ingresar' class='boton'>
      </fieldset></center>
      </form>
      <br><br>
      </body>
      </html>";
    }


?>
