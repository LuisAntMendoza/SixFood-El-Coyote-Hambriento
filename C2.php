<?php
  session_name("login");
  session_start();

  include("Datos.php");

  echo "Haz iniciado sesión como Administrador :)<br>
  <a href='CerrarS.php' style='text-decoration: none;'>"."Cerrar Sesión"."</a>
  <br><br>";

  $conexion = connectDB2("sistemadb2");
  if(!$conexion) {
    echo mysqli_connect_error()."<br>";
    echo mysqli_connect_errno()."<br>";
    exit();
  }
  else {
    echo "Conenctado con la base sistemasdb2 :)"."<br>";
    //Consulta y formato de los índices
    // $consulta = "SELECT * FROM antojitos";
    // $respuesta = mysqli_query($conexion, $consulta);
    // while($row = mysqli_fetch_array($respuesta)){
    //   echo "ID_antojito: ".$row['id_antojito']."<br>";
    //   echo "Nombre: ".$row[1]."<br>";
    //   echo "ID_presentación: ".$row[2]."<br>";
    //   echo "Cantidad: ".$row[3]."<br>";
    //   echo "Precio: ".$row[4]."<br>";
    //   echo "Existencías: ".$row[5]."<br>"."<br>";
    // }
    //Impresion de resultados en formato de tabla
    $consulta = "SELECT * FROM antojitos";
    $respuesta = mysqli_query($conexion, $consulta);
    echo "<table border='2'>";
    echo "  <tr>";
    echo "    <th>ID_antojito</th>";
    echo "    <th>Nombre</th>";
    echo "    <th>ID_presentación</th>";
    echo "    <th>Cantidad</th>";
    echo "    <th>Precio</th>";
    echo "    <th>Existencías</th>";
    echo "  </tr>";
    while($row = mysqli_fetch_array($respuesta)){
      echo "<tr>";
      echo "  <td>".$row[0]."</td>";
      echo "  <td>".$row[1]."</td>";
      echo "  <td>".$row[2]."</td>";
      echo "  <td>".$row[3]."</td>";
      echo "  <td>".$row[4]."</td>";
      echo "  <td>".$row[5]."</td>";
      echo "</tr>";
    }
    echo "</table><br>";
    //Info extra
    echo"Filas afectadas: ".mysqli_affected_rows($conexion)."<br>"; //Filas afectadas
    echo "Columnas afectadas: ".mysqli_field_count($conexion)."<br>"; //Columnas
    echo "Tipo de Carácter: ".mysqli_character_set_name($conexion)."<br>"; //Tipo de Carácter
    //print_r(mysqli_error_list($conexion)); //error en consultas
    echo "Estado del servidor: ".mysqli_ping($conexion)."<br>"; //Verifica el estado del servidor
    echo "Información del host: ".mysqli_get_host_info($conexion);
    //Una vez finalizados los procedimientos se cierra la conexion con la base
    mysqli_close($conexion);
  }

?>
