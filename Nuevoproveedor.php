<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Crear nuevo proveedor</title>
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
  

</head>
<body>
  
<?php include 'menu.php'; ?>

<div class="container-fluid row  m-1">
  <h6 class="ntitulo" style="text-align: center;"> Creación de nueva marca</h6>

    <div class="col-md-6 d-flex flex-column justify-content-between">
           
            <!-- Formulario login -->
            <form action="php/registrar_proveedor_marca.php" method="post">
            <div class="row">
                <div class="col-md-4  d-flex justify-content-between"> <label for="nit">NIT:</label></div>
                <div class="col-md-4 d-flex justify-content-between">
                  <div class="col-md-4  d-flex justify-content-between"><input type="number" name="nit"  id="nit" class="es3 primary2" onblur="obtenerProveedor()"></div>
                </div>
            </div>
            
            <div class="row">
              <div class="col-md-4 d-flex justify-content-between">
              <label for="RazonS">Razón Social</label></div>

              <div class="col-md-4  d-flex justify-content-between">
                <div class="col-md-4 d-flex justify-content-between"><input type="text" name="razon_social" id="razon_social" class="es3 primary2"></div>
              </div>
            </div>
             

          <div class="row">
            <div class="col-md-4 d-flex justify-content-between"><label for="telefono">Teléfono</label></div>
            <div class="col-md-4  d-flex justify-content-between">
                <div class="col-md-4 d-flex justify-content-between"><input type="number" name="telefono" id="telefono" class="es3 primary2"></div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-4  d-flex justify-content-between"><label for="correo"> Correo</label></div>
            <div class="col-md-4 d-flex justify-content-between"><input type="text" name="correo" id="correo" class="es3 primary2"></div>
          </div>

          <div class="row">
            <div class="col-md-4 d-flex justify-content-between"><label for="direccion" >Dirección</label></div>
            <div class="col-md-4 b d-flex justify-content-between"><input type="text" name="direccion" id="direccion" class="es3 primary2"></div>
          </div>

          <div class="row">
            <div class="col-md-4 d-flex justify-content-between"><label for="marca" >Marca</label></div>
            <div class="col-md-4 b d-flex justify-content-between"><input type="text" name="marca" id="marca" class="es3 primary2"></div>
          </div>

          <div class="row m-4">
            <div style="text-align: center;"><button type="submit" class="bt primary"> Guardar </button></div>
          </div>
          </form>
    </div>



    <div class="col-md-6 col-sm-1 d-flex justify-content-between">
      <img src="imagen/gafasopticanaan2.jpg" alt="foto" width="765" height="485" class="imag2" >
      <!---->
    </div>
</div>






<script src="js/completar_proveedor.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>