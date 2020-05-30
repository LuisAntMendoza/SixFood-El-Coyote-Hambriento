<?php

  include("Datos.php");

  $Pedido = $_POST['Producto'];
  $Cantidad = $_POST['Cantidad'];
  $Entrega = $_POST['tipoE'];

  $PedidoT = [
    /*Antojitos*/
    '300' => 'Motelles',
    '301' => 'Sopes sencillo',
    '302' => 'Sopes con queso',
    '303' => 'Sopes con queso y carne',
    '304' => 'Tacos de pollo',
    '305' => 'Tocos de bistec',
    '306' => 'Chilaquiles chicos pollo o huevo',
    '307' => 'Chilaqueles grandes pollo o huevo',
    '308' => 'Chilaquiles chicos biste',
    '309' => 'Chilaqules grandes bistec',
    '310' => 'Pambazos Sencillos',
    '311' => 'Pambazos Especiales',
    '312' => 'Papas a la francesa Chicas ',
    '313' => 'Papas a la francesa Grandes',
    '314' => 'Hamburguesa sencilla',
    '315' => 'Hamburguesa con queso',
    '316' => 'Hamburguesa doble',
    /*Bebidas*/
    '101' => 'Agua jamaica',
    '102' => 'Agua horchata',
    '103' => 'Agua limón',
    '104' => 'Agua limon chia',
    '105' => 'Jugo naranja',
    '106' => 'Jugo zanahoria',
    '107' => 'Jugo mandarina',
    '108' => 'Jugo betabel',
    '109' => 'Jugo vampiro',
    '110' => 'Jugo cítrico',
    '111' => 'Jugo verde',
    '112' => 'Boing mango',
    '113' => 'Boing manzana',
    '114' => 'Boing guayaba',
    '115' => 'Boing uva',
    '116' => 'Boing fresa',
    '117' => 'Botella de agua',
    '118' => 'Coca-cola',
    '119' => 'Power Punch',
    '120' => 'Fanta',
    '121' => 'Pepsi',
    '122' => 'Arizona mango',
    '123' => 'Arizona sandia',
    /*Preparado*/
    '200' => 'Maruchan Res',
    '201' => 'Maruchan Camaron',
    '202' => 'Maruchan Pollo',
    '203' => 'Sandwich Pollo',
    '204' => 'Sandwich Jamon',
    '205' => 'Sandwich Vegetariano',
    '206' => 'Torta Jamón',
    '207' => 'Torta Salchicha',
    '208' => 'Torta Rusa',
    '209' => 'Torta Pierna',
    '210' => 'Torta Cubana',
    '211' => 'Torta Hawaina'
  ];
  foreach ($PedidoT as $key => $value) {
    // code...
    if ($key == $Pedido) {
      // code...
      echo "Ha ordenado: ".$value."<br>";
    }
  }

  $EntregaT = [
    '11' => 'Normal',
    '12' => 'Express',
    '13' => 'Urgente'
  ];
  foreach ($EntregaT as $key => $value) {
    // code...
    if ($key == $Entrega) {
      // code...
      echo "Con un tipo de envio: ".$value."<br>";
    }
  }

  echo "Con cantidad/es de ".$Cantidad." Unidad/es";

  $conexion = connectDB2("sistemadb");
  if(!$conexion) {
    echo mysqli_connect_error()."<br>";
    echo mysqli_connect_errno()."<br>";
    exit();
  }
  else {
  //Inserción de registros en tabla instructor
    /*for($x = 0; $x < count($instructoresNoms); $x++)
    {
      $sql = sprintf("INSERT INTO instructor VALUES ('%d', '%s', '%s', '%s', '%d', '%d')",
             ($x+1),
             $instructoresNoms[$x],
             $instructoresApP[$x],
             $instructoresApM[$x],
             $edades[$x],
             $constancias[$x]);
      mysqli_query($conexion, $sql);
    }*/
  }

?>
