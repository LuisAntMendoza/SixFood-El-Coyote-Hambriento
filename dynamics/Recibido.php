<?php

  include("Datos.php");

  $conexion = connectDB2("sistemadb");
  if(!$conexion) {
    echo mysqli_connect_error()."<br>";
    echo mysqli_connect_errno()."<br>";
    exit();
  }
  else {
    if ($_POST['Tipo'] == "Antojitos") {
      // code...
      echo "<form method='POST' action='Recibo.php'>
      Por favor selecciona el artículo que deseas comprar:
      <select name='Producto' required>
        <optgroup label='Antojito:'>
          <option value='300'> Molletes </option>
          <option value='301'> Sopes sencillo </option>
          <option value='302'> Sopes con queso </option>
          <option value='303'> Sopes con queso y carne </option>
          <option value='304'> Tacos de pollo </option>
          <option value='305'> Tocos de bistec </option>
          <option value='306'> Chilaquiles chicos pollo o huevo </option>
          <option value='307'> Chilaqueles grandes pollo o huevo </option>
          <option value='308'> Chilaquiles chicos bistec </option>
          <option value='309'> Chilaqules grandes bistec </option>
          <option value='310'> Pambazos Sencillos </option>
          <option value='311'> Pambazos Especiales </option>
          <option value='312'> Papas a la francesa Chicas </option>
          <option value='313'> Papas a la francesa Grandes </option>
          <option value='314'> Hamburguesa sencilla </option>
          <option value='315'> Hamburguesa con queso </option>
          <option value='316'> Hamburguesa doble </option>
          </optgroup> 
        </select><br><br>
        Por favor digita la cantidad que deseas comprar:
        <input type='number' name='Cantidad' value='1' min='1' max='10'><br><br>
        Selecciona un metodo de entrega:
        <select name='tipoE' required>
          <optgroup label='Seleccione:'>
            <option value='11'> Normal </option>
            <option value='12'> Express </option>
            <option value='13'> Urgente </option>
          </optgroup>
        </select><br><br>
        <input type='Submit' value='Siguiente'>
        </form><br>";
        if ($_POST['Tipo'] == "Antojitos") {
          // code...
          $consulta = "SELECT * FROM antojito";
          echo "Antojitos:";
          $respuesta = mysqli_query($conexion, $consulta);
          echo "<table border='2'>";
          echo "  <tr>";
          echo "    <th>Nombre</th>";
          echo "    <th>Cantidad</th>";
          echo "    <th>Precio</th>";
          echo "  </tr>";
          while($row = mysqli_fetch_array($respuesta)) {
            echo "<tr>";
            echo "  <td>".$row[1]."</td>";
            echo "  <td>".$row[3]."</td>";
            echo "  <td>".$row[4]."</td>";
            echo "</tr>";
          }
        }
        $consulta = "SELECT * FROM tipoentrega";
        $respuesta = mysqli_query($conexion, $consulta);
        echo "<table border='2'>";
        echo "  <tr>";
        echo "    <th>Envío</th>";
        echo "    <th>Monto</th>";
        echo "  </tr>";
        while($row = mysqli_fetch_array($respuesta)) {
          echo "<tr>";
          echo "  <td>".$row[1]."</td>";
          echo "  <td>".$row[2]."</td>";
          echo "</tr>";
        }
      echo "<br>Tipo de envio:";
    }
    else {
      if ($_POST['Tipo'] == "Bebida") {
        // code...
        echo "<form method='POST' action='Recibo.php'>
        Por favor selecciona el artículo que deseas comprar:
        <select name='Producto' required>
          <optgroup label='Bebidas:'>
            <option value='101'> Agua jamaica </option>
            <option value='102'> Agua horchata </option>
            <option value='103'> Agua limón </option>
            <option value='104'> Agua limon chia </option>
            <option value='105'> Jugo naranja </option>
            <option value='106'> Jugo zanahoria </option>
            <option value='107'> Jugo mandarina </option>
            <option value='108'> Jugo betabel </option>
            <option value='109'> Jugo vampiro </option>
            <option value='110'> Jugo cítrico </option>
            <option value='111'> Jugo verde </option>
            <option value='112'> Boing mango </option>
            <option value='113'> Boing manzana </option>
            <option value='114'> Boing guayaba </option>
            <option value='115'> Boing uva </option>
            <option value='116'> Boing fresa </option>
            <option value='117'> Botella de agua </option>
            <option value='118'> Coca-cola </option>
            <option value='119'> Power Punch </option>
            <option value='120'> Fanta </option>
            <option value='121'> Pepsi </option>
            <option value='122'> Arizona mango </option>
            <option value='123'> Arizona sandia </option>
          </optgroup>
        </select><br><br>
        Por favor digita la cantidad que deseas comprar:
        <input type='number' name='Cantidad' value='1' min='1' max='10'><br><br>
        Selecciona un metodo de entrega:
        <select name='tipoE' required>
          <optgroup label='Seleccione:'>
            <option value='11'> Normal </option>
            <option value='12'> Express </option>
            <option value='13'> Urgente </option>
          </optgroup>
        </select><br><br>
        <input type='Submit' value='Siguiente'>
        </form><br>";
        if ($_POST['Tipo'] == "Bebida") {
          // code...
          $consulta = "SELECT * FROM bebida";
          echo "Bebidas:";
          $respuesta = mysqli_query($conexion, $consulta);
          echo "<table border='2'>";
          echo "  <tr>";
          echo "    <th>Nombre</th>";
          echo "    <th>Cantidad</th>";
          echo "    <th>Precio</th>";
          echo "  </tr>";
          while($row = mysqli_fetch_array($respuesta)){
            echo "<tr>";
            echo "  <td>".$row[1]."</td>";
            echo "  <td>".$row[3]."</td>";
            echo "  <td>".$row[4]."</td>";
            echo "</tr>";
          }
        }
        $consulta = "SELECT * FROM tipoentrega";
        $respuesta = mysqli_query($conexion, $consulta);
        echo "<table border='2'>";
        echo "  <tr>";
        echo "    <th>Envío</th>";
        echo "    <th>Monto</th>";
        echo "  </tr>";
        while($row = mysqli_fetch_array($respuesta)) {
          echo "<tr>";
          echo "  <td>".$row[1]."</td>";
          echo "  <td>".$row[2]."</td>";
          echo "</tr>";
        }
      echo "<br>Tipo de envio:";
    }
    else {
      // code...
      if ($_POST['Tipo'] == "Preparado") {
        // code...
        echo "<form method='POST' action='Recibo.php'>
        Por favor selecciona el artículo que deseas comprar:
        <select name='Producto' required>
          <optgroup label='Preparado:'>
            <option value='200'> Maruchan Res </option>
            <option value='201'> Maruchan Camaron </option>
            <option value='202'> Maruchan Pollo </option>
            <option value='203'> Sandwich Pollo </option>
            <option value='204'> Sandwich Jamon </option>
            <option value='205'> Sandwich Vegetariano </option>
            <option value='206'> Torta Jamón </option>
            <option value='207'> Torta Salchicha </option>
            <option value='208'> Torta Rusa </option>
            <option value='209'> Torta Pierna </option>
            <option value='210'> Torta Cubana </option>
            <option value='211'> Torta Hawaina </option>
          </optgroup>
        </select><br><br>
        Por favor digita la cantidad que deseas comprar:
        <input type='number' name='Cantidad' value='1' min='1' max='10'><br><br>
        Selecciona un metodo de entrega:
        <select name='tipoE' required>
          <optgroup label='Seleccione:'>
            <option value='11'> Normal </option>
            <option value='12'> Express </option>
            <option value='13'> Urgente </option>
          </optgroup>
        </select><br><br>
        <input type='Submit' value='Siguiente'>
        </form><br>";
        if ($_POST['Tipo'] == "Preparado") {
          // code...
          $consulta = "SELECT * FROM preparado";
          echo "Alimentos Preparados:";
          $respuesta = mysqli_query($conexion, $consulta);
          echo "<table border='2'>";
          echo "  <tr>";
          echo "    <th>Nombre</th>";
          echo "    <th>Precio</th>";
          echo "  </tr>";
          while($row = mysqli_fetch_array($respuesta)){
            echo "<tr>";
            echo "  <td>".$row[1]."</td>";
            echo "  <td>".$row[3]."</td>";
            echo "</tr>";
          }
        }
        $consulta = "SELECT * FROM tipoentrega";
        $respuesta = mysqli_query($conexion, $consulta);
        echo "<table border='2'>";
        echo "  <tr>";
        echo "    <th>Envío</th>";
        echo "    <th>Monto</th>";
        echo "  </tr>";
        while($row = mysqli_fetch_array($respuesta)) {
          echo "<tr>";
          echo "  <td>".$row[1]."</td>";
          echo "  <td>".$row[2]."</td>";
          echo "</tr>";
        }
      echo "<br>Tipo de envio:";
      }
      else {
        //code...
        echo "neel";
      }
      }
    }
  }


?>
