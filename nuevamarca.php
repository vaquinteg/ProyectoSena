<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>nueva marca</title>
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>

</head>
<body>

<?php include 'menu.php'; ?>
  
<div class="container-fluid row d-flex justify-content-between"> 
  <h6 class="ntitulo" style="text-align: center;"> Creación de nueva marca</h6>
      
    <div class="col-md-7">

      <div class="row"> 
        <div class="col-md-6 d-flex justify-content-between p-2"><label for="marcanuevamontura"> NOMBRE DE LA NUEVA MONTURA:</label></div>
        <div class="col-md-6 d-flex justify-content-between p-2"><input type="text" name="marcanuevamontura" class="es4 primary2"></div>
      </div>

      <div class="row"> 
        <div class="col-md-6 d-flex justify-content-between p-2"><label for="razonsocial"> RAZON SOCIAL DEL PROVEEDOR:</label></div>
        <div class="col-md-6 d-flex justify-content-between p-2"><input type="text" name="razonsocial" class="es4 primary2"></div>
      </div>

      <div class="row"> 
        <div class="col-md-6 d-flex justify-content-between p-2 "><label for="nitproveedor">NIT DEL PROVEEDOR:</label></div>
        <div class="col-md-6 d-flex justify-content-between p-2"><input type="number" name="nitproveedor" class="es3 primary2"></div>
      </div>

      <div class="row m-4"> 
        <div style="text-align: center;"><button class="bt primary"> Guardar</button></div>
      </div>

    </div>

    <div class="col-md-5 p-2"><img src="https://images.pexels.com/photos/1054777/pexels-photo-1054777.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" height="453" class="imag" ></div>
</div>













</body>
</html>