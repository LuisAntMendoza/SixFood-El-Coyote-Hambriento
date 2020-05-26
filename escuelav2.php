<?php
  session_start();
  if ( isset($_SESSION['usuario']))
  {
    header("Location: escuela2.php");
  }
  else
  {
  echo "<!DOCTYPE>";
  echo "<body>";
  echo "<h1>Bienvenido a la página principal</h1>";
    echo "<form action='escuela2.php' method='POST'>";
      echo "<fieldset>";
        echo "<legend><h1>Registrate</h1></legend>";
        echo "Usuario: <input type='text' name='nomUsuario'><br>";
        echo "Categoria: <select name='categorias'>";
          echo "<option>Alumno</option>";
          echo "<option>Profesor</option>";
          echo "<option>Padre de familia</option>";
        echo "</select><br>";
        echo "Color de fondo: <input type='color' list name='color[]'><br>";
        echo "Color de letra: <input type='color' list name='color[]'><br>";
        echo "Selecciona la fuente que gustes: <select name='fuentes'>";
          echo "<option value='arial'>Arial</option>";
          echo "<option value='\"Arial Black\", Gadget, sans-serif'>Arial Black</option>";
          echo "<option value='Impact'>Impact</option>";
          echo "<option value='\"Comic Sans MS\", Gadget, sans-serif'>Comic Sans MS</option>";
        echo "</select><br>";
        echo "<input type='submit' value='Ingresar'>";
      echo "</fieldset>";
    echo "<br><br>";
    echo "<fieldset>";
    echo "<legend><h1>Conócenos</h1></legend>";
    echo "<center><img src='https://upload.wikimedia.org/wikipedia/commons/thumb/b/b1/Escudo_enp_6.svg/1200px-Escudo_enp_6.svg.png' alt='escuela' width='60px'></center>";
    echo "<p>Nuestro objetivo es ver a nuestros estudiantes cumplir sus sueños junto a los seres que ama, preparandolos para las adversidades y conflictos que se les presente.</p><br>";
    echo 'Visita <a href="escuela.php">nuestra página</a> para conocernos mejor';
    echo "</fieldset>";
    echo "</form>";
    echo "</body>";
  }
?>
