<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Crear nuevo proveedor</title>
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>

</head>
<body>
  
<?php include 'menu.php'; ?>

<div class="container-fluid row  m-1">
  <h6 class="ntitulo" style="text-align: center;"> Creación de nuevo proveedor</h6>

    <div class="col-md-6 d-flex flex-column justify-content-between">
           
            <!-- Formulario login -->
           <div class="row">

             <div class="col-md-6 d-flex justify-content-between">
              <label for="RazonS">RAZON SOCIAL</label></div>

             <div class="col-md-6  d-flex justify-content-between">
                <div class="col-md-6  d-flex justify-content-between"><input type="text" name="RazonS" class="es3 primary2"></div>
             </div>
           </div>

           <div class="row">
            <div class="col-md-6  d-flex justify-content-between"> <label for="NIT">NIT:</label></div>
            <div class="col-md-6 d-flex justify-content-between">
                <div class="col-md-6  d-flex justify-content-between"><input type="number" name="NIT" class="es3 primary2"></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 d-flex justify-content-between"><label for="telefono">TELÉFONO</label></div>
            <div class="col-md-6  d-flex justify-content-between">
                <div class="col-md-6 d-flex justify-content-between"><input type="number" name="telefono" class="es3 primary2"></div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-6  d-flex justify-content-between"><label for="correo"> CORREO</label></div>
            <div class="col-md-6 d-flex justify-content-between"><input type="text" name="correo" class="es3 primary2"></div>
          </div>

          <div class="row">
            <div class="col-md-6 d-flex justify-content-between"><label for="direccion" >DIRECCIÓN</label></div>
            <div class="col-md-6 b d-flex justify-content-between"><input type="text" name="direccion" class="es3 primary2"></div>
          </div>

          <div class="row m-4">
            <div style="text-align: center;"><button class="bt primary"> Guardar </button></div>
          </div>
    </div>



    <div class="col-md-6 col-sm-1 d-flex justify-content-between">
      <img src="imagen/gafasopticanaan2.jpg" alt="foto" width="765" height="485" class="imag2" >
      <!---->
    </div>
</div>






 

</body>
</html>