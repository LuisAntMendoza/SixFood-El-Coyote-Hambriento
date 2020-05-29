<?php
  /*-------------------------------- NOTAS --------------------------------*/
    // N1: El usuario y la contraseña varia según los tipos de usuario registrado, o eso creo :))
    // N2: Cambia según la tabla que se desee consultar
    // N3: Cambiar el tipo de consulta según se requiera
    // N4: Varía según la tabla, se le añaden o quitan las "Columnas" de consulta
  /*-------------------------------- CODIGO --------------------------------*/
  $conexion = mysqli_connect("localhost", "root"/*Nota 1*/, "root"/*Nota 1*/, "sistemadb2");
    if(!$conexion) {
      // Muestra si es que hay algún tipo de error en conexion con la base de datos y especifica más o menos como se encuentra
      echo mysqli_connect_error()."<br>";
      echo mysqli_connect_errno()."<br>";
      exit();
    }
    else {
      // Consulta y formato de los índices
      $consulta = "SELECT * FROM instructor"/*Nota 2*/;
      $respuesta = mysqli_query($conexion, $consulta);
      $row = mysqli_fetch_array($respuesta); //Tanto asociativos como indexados
      print_r($row);
      echo "<br>";
      /* Nota 3
      $row = mysqli_fetch_array($respuesta,MYSQLI_ASSOC); //Asociativos
      print_r($row);
      echo "<br>";
      $row = mysqli_fetch_array($respuesta,MYSQLI_NUM); //Indexados
      print_r($row);
      echo "<br>";
      */
      $consulta = "SELECT * FROM instructor";
      $respuesta = mysqli_query($conexion, $consulta);
      while($row = mysqli_fetch_array($respuesta)){
        /*Nota 4*/
        echo "Id_instructor: ".$row['id_instructor']."<br>";
        echo "Nombre: ".$row[1]."<br>";
      }
      /*-------------------------------- ACTUALIZACIÓN --------------------------------*/
      /*Nota 4*/
      /*Nombre de la tabla*/ //1
      /*Nombre de la columna*/ //2
      /*Dato a actualizar*/ //3
      /*Nombre de la columna*/ //4
      /*Dato a buscar*/ //5
      $sql = "UPDATE instructor/*1*/ SET edad/*2*/=17/*3*/ WHERE nombre/*4*/='Diego'/*5*/";
      mysqli_query($conexion, $sql);
      /*--------------------------- IMPRESION DE RESULTADOS ---------------------------*/
      //Impresion de resultados en formato de tabla
      $consulta = "SELECT * FROM instructor";
      $respuesta = mysqli_query($conexion, $consulta);
      echo "<table border='2'>";
        echo "<tr>";
          echo "<th>Id_instructor</th>";
          echo "<th>Nombre</th>";
      echo "</tr>";
      while($row = mysqli_fetch_array($respuesta)){
        echo "<tr>";
          echo "<td>".$row[0]."</td>";
          echo "<td>".$row[1]."</td>";
        echo "</tr>";
      }
      echo "</table>";
      /*--------------------------- INDORMACIÓN EXTRA ---------------------------*/
      echo mysqli_affected_rows($conexion)."<br>"; // Filas afectadas
      echo mysqli_field_count($conexion)."<br>"; // Columnas
      echo mysqli_character_set_name($conexion)."<br>"; // Tipo de Carácter
      print_r(mysqli_error_list($conexion)); // Error en consultas
      echo "<br>".mysqli_ping($conexion)."<br>"; // Verifica el estado del servidor
      echo "Información del host: ".mysqli_get_host_info($conexion);
    }
  ?>
