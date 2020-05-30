<?php

echo "<!DOCTYPE html>
        <html lang='en' dir='ltr'>
          <head>
            <meta charset='utf-8'>
            <title></title>
          </head>
          <body>
            <form method='POST' action='Recibido.php'>
            <center><fieldset style='width: 50%;'>
              <legend> Pedidos </legend>
              Selecciona un producto:
              <select name='Tipo' required>
                <optgroup label='Seleccione:'>
                  <option value='Antojitos'> Antojitos </option>
                  <option value='Bebida'> Bebida </option>
                  <option value='Preparado'> Preparado </option>
                </optgroup>
              </select><br><br>
              <input type='Submit' value='Siguiente'>
            </fieldset></center>
            </form>
          </body>
        </html>";
?>
