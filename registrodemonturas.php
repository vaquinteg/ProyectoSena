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
           <div class="row">

             <div class="col-md-6 d-flex justify-content-between">
              <label for="marca">MARCA DE LA MONTURA:</label></div>

             <div class="col-md-6 d-flex justify-content-between">
              <select class="classic" name="marca" >
                <option value="marca lente 1" >marca montura 2</option>
                <option value="marca lente 2">marca montura 2</option>
                <option value="marca lente 3">marca montura3</option>
                </select>
             </div>
           </div>

           <div class="row">
            <div class="col-md-6 d-flex justify-content-between"> <label for="material">MATERIAL:</label></div>
            <div class="col-md-6 d-flex justify-content-between">
              <select  class="classic" name="material" >
                <option value="marca lente 1" >material 1</option>
                <option value="marca lente 2">material 2</option>
                <option value="marca lente 3">material 3</option>
                </select>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 d-flex justify-content-between"><label for="color">COLOR:</label></div>
            <div class="col-md-6 d-flex justify-content-between">
              <select  class="classic" name="color" >
                <option value="marca lente 1" >NEGRO</option>
                <option value="marca lente 2">AZUL</option>
                <option value="marca lente 3">BLANCO</option>
                </select>
            </div>
          </div>


          <div class="row">
            <div class="col-md-6 d-flex justify-content-between"><label for="referencia"> REFERENCIA</label></div>
            <div class="col-md-6 d-flex justify-content-between"><input type="number" name="referencia" class="es3 primary2"></div>
          </div>

          <div class="row">
            <div class="col-md-6 d-flex justify-content-between"><label for="idmontura"> ID DE LA MONTURA</label></div>
            <div class="col-md-6 d-flex justify-content-between"><input type="number" name="idmontura" class="es3 primary2"></div>
          </div>

          <div class="row m-4">
            <div style="text-align: center;"><button class="bt primary"> Guardar e imprimir </button></div>
          </div>
    </div>



    <div class="col-md-6 col-sm-1 d-flex justify-content-between p-2">
      <img src="imagen/gafasopticanaan2.jpg" alt="foto" width="765" height="485" class="imag2" >
      <!---->
    </div>
</div>






 


</body>
</html>