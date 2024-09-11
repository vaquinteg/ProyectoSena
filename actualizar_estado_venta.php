<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Actualizar estado de venta</title>   
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</head>
<body>

<?php include 'menu.php'; ?>

<br>
<div class="container-fluid row justify-content-lg-center">
  <div class="col-lg-auto"> 
    <h1>Actualizar estado de venta</h1>
  </div>
</div>

<br>
<div class="row">
<div class="container-fluid col-6 mt-lg-5" > <!-- contenedor para el formulario-->
    <form action="#" method="post">
        <div class="m-3 row justify-content-center">
          <div class="col-6"> <label for="nombre">Ingrese nombre del paciente</label></div>
          <div class="col-6">           
           <input class="CampoTexto" type="text" name="nombre" class="form-control">
        </div>
        </div>
        <div class="m-3 row justify-content-center">
          <div class="col-6"> <label for="vitrina">Elija tipo de documentor</label></div>  
               <div class="col-6">
                <select class="classic" aria-label="Default select example">
                    <option selected> Seleccione una opción</option>
                    <option value="1">CC</option>
                    <option value="2">CE</option>
                    <option value="3">TI</option>
                    <option value="4">RC</option>
                    <option value="5">Pasaporte</option>
                                   
                </select>
               </div>
        </div>
        <div class="m-3 row justify-content-center">
            <div class="col-6 mt-3"> <label for="identificacion">Ingrese número de documento</label></div>
            <div class="col-6">           
             <input class="CampoTexto mt-3" type="number" name="identificacion" class="form-control">
          </div>
          </div>
        <div class="m-3 row justify-content-center mt-4">
            <div class="col-6"> <label for="fila_vitrina">Seleccione estado de gafas</label></div>            
            <div class="col-6">
                <select class="classic" aria-label="Default select example">
                    <option selected> Seleccione una opción</option>
                    <option value="1">En espera</option>
                    <option value="2">Listas para entrega</option>
                   
                  </select>
          </div>
        </div>
          <div class="m-3 row justify-content-center">
        <div class="col-sm-auto"> <button id="botonNaranja" type="submit">Actualizar estado</button></div>
    </div>
    </form>

    </div>
    <div class="col-6"> <img  class="img-fluid p-5" src="https://images.pexels.com/photos/8293641/pexels-photo-8293641.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="foto_estado"></div>
    
        
</div>




</body>
</html>