<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Cotizacionlente</title>
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>

</head>
<body>

<?php include 'menu.php'; ?>

<div class="container-fluid row m-1">
  <h6 class="ntitulo" style="text-align: center;"> Cotización de lentes</h6>

    <div  class="col-md-9">
           
            <!-- Formulario -->
 
            <form action="php/registrar_cotizacion.php" id="formCotizacion" method="post">
            <div class="row">

              <div class="col-md-4  d-flex justify-content-between">
              <label for="identificacion" >Identificación:</label></div>

              <div class="col-md-4 justify-content-between">
              <input type="text" name="identificacion" id="identificacion" class="es3 primary2">
              </div>

            </div>

           <div class="row">

             <div class="col-md-4  d-flex justify-content-between">
              <label for="montura" >Referencia de montura:</label></div>

             <div class="col-md-4 justify-content-between">
              <input type="text" name="montura" class="es3 primary2" id="montura" onblur="obtenerPrecioMontura()">
             </div>

             <div class="col-md-4 d-flex justify-content-between">
              <input type="number" name="precioMontura" id="precioMontura" class="es3 primary2" placeholder="Precio" readonly="readonly">
            </div>

           </div>

           <div class="row">
            <div class="col-md-4 d-flex justify-content-between"> <label for="marcalente">Marca del lente:</label></div>
            <div class="col-md-4 d-flex justify-content-between">
            <select class="classic" id="marca_lente" name="marca_lente" onblur="obtenerPrecioMarcaLente()" >
              <option value="">Seleccione la marca</option>
              <?php
                $conn = new mysqli('localhost', 'root', '', 'proyectosena');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $result = $conn->query("SELECT idmarca_lente, marca FROM marca_lente");
                
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['idmarca_lente']}'>{$row['marca']}</option>";
                }
                $conn->close();
              ?>
                </select>
            </div>
            <div class="col-md-4  d-flex justify-content-between">
              <input type="number" name="precio_marca_lente" id="precio_marca_lente" class="es3 primary2" placeholder="Precio" readonly="readonly">
            </div>

          </div>

          <div class="row">
            <div class="col-md-4 d-flex justify-content-between"><label for="tipolente">Filtro:</label></div>
            <div class="col-md-4 d-flex justify-content-between">
            <select class="classic" id="filtro_lente" name="filtro_lente" onblur="obtenerPrecioFiltroLente()" >
              <option value="">Seleccione el filtro</option>
              <?php
                $conn = new mysqli('localhost', 'root', '', 'proyectosena');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $result = $conn->query("SELECT idfiltro_lente, filtro FROM filtro_lente");
                
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['idfiltro_lente']}'>{$row['filtro']}</option>";
                }
                $conn->close();
              ?>
            </select>

            </div>
            <div class="col-md-4 d-flex justify-content-between">
              <input type="number" name="precio_filtro_lente" id="precio_filtro_lente" class="es3 primary2" placeholder="Precio" readonly="readonly">
             
            </div>
          </div>


          <div class="row">
            <div class="col-md-4 d-flex justify-content-between"><label for="filtro">Tipo de lente:</label></div>
            <div class="col-md-4 d-flex justify-content-between">
            <select class="classic" id="tipo_lente" name="tipo_lente" onblur="obtenerPrecioTipoLente()" >
              <option value="">Seleccione el tipo</option>
              <?php
                $conn = new mysqli('localhost', 'root', '', 'proyectosena');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $result = $conn->query("SELECT idtipo_lente, tipo FROM tipo_lente");
                
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['idtipo_lente']}'>{$row['tipo']}</option>";
                }
                $conn->close();
              ?>
                </select>
            </div>
            <div class="col-md-4 d-flex justify-content-between">
              <input type="number" name="precio_tipo_lente" id="precio_tipo_lente" class="es3 primary2" placeholder="Precio" readonly="readonly">
            </div>
            
          </div>

          <div class="row">
            <div class="col-md-4 d-flex justify-content-between"><label for="descuento">Descuento:</label></div>
            <div class="col-md-4 d-flex justify-content-between">
              <select  class="classic" name="descuento" id="descuento">
              <option value="">Descuento</option>
              <option value="10">10%</option>
              <option value="20">20%</option>
              <option value="30">30%</option>
              <option value="40">40%</option>
              <option value="50">50%</option>
              </select>
              </div>

             
          </div>


          <div class="row m-4">
            <div  style="text-align: center;">
            <label for="precio_total">Total:</label>
            <input readonly type="number" name="precio_total" id="total" class="es3 primary2">
          </div>
          </div>

          <div class="row m-4">
            <div style="text-align: center;"><button class="bt primary" href="actualizar_estado_venta.html"> Guardar </button></div>
          </div>
        </form>
          
    </div>


    <div class="col-md-3"><img src="imagen/gafasopticanaan.jpg" class="imagCot" > </div>
    
</div>


</div>






 <script src="js/completar_precio.js"></script>
 <script src="js/resp_cotizacion.js" ></script>
</body>
</html>

