
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    <title>Nuevo paciente</title>
</head>
<body>

<?php include 'menu.php'; ?>

      <div class="container-fluid row justify-content-lg-center">
        <div class="col-lg-auto"> 
          <h1>Registrar paciente nuevo</h1>
        </div>
      </div>
      
      
      
          <div class="container-fluid row mt-5" >
            <div class="col-lg-6">
              <form action="php/registrar_paciente.php" method="post">
              <div class="row">
                <div class="col-lg-4"> <label class="label" for="nombre_apellido">Nombres y apellidos</label> 
                </div>
                <div class="col-auto">          
                <input class="campo_texto_nom" type="text" id="nombre_apellido" name="nombre_apellido" class="form-control" >
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4"> <label for="tipo_documento">Tipo de documento</label> </div>
                <div class="col-auto">
                    <select name="tipo_documento" class="classic" aria-label="tipo_documento">
                        <option value=""> Seleccione un tipo de documento</option>
                        
                        <option value="CC">CC</option>
                        <option value="CE">CE</option>
                        <option value="TI">TI</option>
                        <option value="NUIP">NUIP</option>
                        <option value="PASAPORTE">PASAPORTE</option>
                    </select>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-lg-4">     
                <label for="numero_documento">Número de documento</label> 
                </div>
                <div class="col-auto pt-2">          
               <input class="CampoTexto" type="number" name="numero_documento" class="form-control" >
                </div>
              </div>
    
              <div class="row">
                <div class="col-lg-4 pt-3"> <label for="edad">Edad</label></div>
                <div class="col-auto pt-2">
                <input class="CampoTexto" type="number" name="edad" class="form-control" >
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-lg-4"> <label for="RH">RH</label> </div>
                <div class="col-auto">
                    <select name="rh" class="classic" aria-label="rh">
                        <option selected> Seleccione un RH</option>
                        <option value="+">+</option>
                        <option value="-">-</option>
                
                    </select>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-lg-4"> <label for="grupo_sanguineo">Grupo sanguineo</label> </div>
                <div class="col-auto">
                    <select name="grupo_sanguineo" class="classic" aria-label="grupo_sanguineo">
                        <option selected> Seleccione una opción</option>
                        <option value="O">O</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>                      
                    </select>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-lg-4">     
                <label for="telefono">Número de teléfono</label> 
                </div>
                <div class="col-auto">          
               <input class="CampoTexto" type="number" name="telefono" class="form-control" >
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-lg-4">     
                <label for="direccion">Dirección</label> 
                </div>
                <div class="col-auto">          
               <input class="CampoTexto" type="text" name="direccion" class="form-control" >
                </div>
              </div>
              <div class=" row justify-content-center">
                <div class="col-sm-auto mb-4"> <button id="botonNaranja" type="submit">Guardar</button></div>
              </div>
            </form>
         
           
            </div>
      
            <div class="col-lg-6 mb-2">
              <img src="https://images.pexels.com/photos/39716/pexels-photo-39716.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="gafas" class="img-fluid">
            </div>
             
          </div> 
           
            
</body>

</html>