<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Acomodar montura</title>   
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</head>
<body>

  <?php include 'menu.php'; ?>
  
<br>
<div class="container-fluid row justify-content-lg-center">
  <div class="col-lg-auto"> 
    <h1>Asignar montura al mostrador</h1>
  </div>
</div>

<br>
<div class="row">
<div class="container-fluid col-6 mt-lg-5" > <!-- contenedor para el formulario-->
    <form action="#" method="post">
        <div class="m-3 row justify-content-center">
          <div class="col-6"> <label for="name">Ingrese el id de la montura</label></div>
          <div class="col-6">           
           <input class="CampoTexto" type="text" name="montura" class="form-control">
        </div>
        </div>
        <div class="m-3 row justify-content-center">
          <div class="col-6"> <label for="vitrina">Elija un tipo exhibidor</label></div>  
               <div class="col-6">
                <select class="classic" aria-label="Default select example">
                    <option selected> Seleccione una opción</option>
                    <option value="1">Mostrador</option>
                    <option value="2">Exhibidor frontal 1</option>
                    <option value="3">Exhibidor frontal 2</option>
                    <option value="4">Plafón 1</option>
                    <option value="5">Plafón 2</option>
                    <option value="6">Exhibidor premium</option>                    
                </select>
               </div>
        </div>
        <div class="m-3 row justify-content-center mt-4">
            <div class="col-6"> <label for="fila_vitrina">Seleccione una flauta en caso de ggg asignar a un mostrador</label></div>            
            <div class="col-6">
                <select class="classic" aria-label="Default select example">
                    <option selected> Seleccione una opción</option>
                    <option value="1">A</option>
                    <option value="2">B</option>
                    <option value="3">C</option>
                    <option value="4">D</option>
                    <option value="5">E</option>
                  </select>
          </div>
        </div>
          <div class="m-3 row justify-content-center">
        <div class="col-sm-auto"> <button id="botonNaranja" type="submit">Actualizar montura</button></div>
    </div>
    </form>

    </div>
    <div class="col-6"> <img  class="img-fluid" src="https://images.pexels.com/photos/704241/pexels-photo-704241.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="mostrador"></div>
    
        
</div>




</body>
</html>