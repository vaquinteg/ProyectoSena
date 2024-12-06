<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Registro de monturas</title>
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>

</head>
<body>

<?php include 'menu.php'; ?>
  
<div class="container-fluid row m-1">
  <h6 class="ntitulo" style="text-align: center;"> Registro de montura</h6>

    <div class="col-md-6 d-flex flex-column justify-content-between">
           
            <!-- Formulario login -->
          <form id="formulario_montura_marca_posicion" action="php/select_marca_montura_posicion.php" method="post" >
           <div class="row">

             <div class="col-md-6 d-flex justify-content-between">
              <label for="marca">Marca de la montura:</label></div>

             <div class="col-md-6 d-flex justify-content-between">
              <select class="classic" name="marca" >
              <option value="">Seleccione una marca</option>
              <?php
              $conn = new mysqli('localhost', 'root', '', 'proyectosena');
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }

              $result = $conn->query("SELECT idMarca, marca FROM marca");
              
              while ($row = $result->fetch_assoc()) {
                  echo "<option value='{$row['idMarca']}'>{$row['marca']}</option>";
              }
              $conn->close();
              ?>
                </select>
             </div>
           </div>

           <div class="row">
            <div class="col-md-6 d-flex justify-content-between"> <label for="material">Material:</label></div>
            <div class="col-md-6 d-flex justify-content-between"><input type="text" name="material" id="material" class="es3 primary2"></div>
          </div>

          <div class="row">
            <div class="col-md-6 d-flex justify-content-between"><label for="color">Color:</label></div>
            <div class="col-md-6 d-flex justify-content-between"><input type="text" name="color" id="color" class="es3 primary2"></div>
          </div>

          <div class="row">
            <div class="col-md-6 d-flex justify-content-between"><label for="precio"> Precio</label></div>
            <div class="col-md-6 d-flex justify-content-between"><input type="number" name="precio" id="precio" class="es3 primary2"></div>
          </div>

          <div class="row">
            <div class="col-md-6 d-flex justify-content-between"><label for="referencia"> Referencia</label></div>
            <div class="col-md-6 d-flex justify-content-between"><input type="text" name="referencia" id="referencia" class="es3 primary2"></div>
          </div>

          
          <div class="row">
            <div class="col-md-6 d-flex justify-content-between"><label for="posicion"> Posición</label></div>
            <div class="col-md-6 d-flex justify-content-between">
              <select  class="classic" name="posicion" >
                <option value="" >Selecione una posición</option>
                <?php
              $conn = new mysqli('localhost', 'root', '', 'proyectosena');
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }

              $result = $conn->query("SELECT idPosicion, Exhibidor FROM posicion");
              
              while ($row = $result->fetch_assoc()) {
                  echo "<option value='{$row['idPosicion']}'>{$row['Exhibidor']}</option>";
              }
              $conn->close();
              ?>
                </select>
            </div>
          </div>

          <div class="row m-4">
            <div style="text-align: center;"><button id="botonNaranja" class="bt primary"> Guardar </button></div>
          </div>
          </form>
    </div>



    <div class="col-md-6 col-sm-1 d-flex justify-content-between p-2">
      <img src="imagen/gafasopticanaan2.jpg" alt="foto" width="765" height="542" class="imag2" >
      <!---->
    </div>
</div>






 

<script src="js/resp_registrar_montura.js"></script>
</body>
</html>