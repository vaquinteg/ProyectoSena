
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
          <h1>Crear usuario</h1>
        </div>
      </div>
      
      
      
          <div class="container-fluid row mt-5" >
            <div class="col-lg-6">
              <form id="formUsuario" action="php/registrar_usuario.php" method="post">
              <div class="row">
                <div class="col-lg-4"> <label class="label" for="nombre">Nombres y apellidos</label> 
                </div>
                <div class="col-auto">          
                <input class="campo_texto_nom" type="text" id="nombre" name="nombre" class="form-control" >
                </div>
              </div>
              
              <div class="row mt-1">
                <div class="col-lg-4">     
                <label for="idetificacion">Número de documento</label> 
                </div>
                <div class="col-auto">          
               <input class="CampoTexto" type="number" name="identificacion" class="form-control" >
                </div>
              </div>
    
              
              <div class="row mt-1">
                <div class="col-lg-4"> <label for="rol">Rol</label> </div>
                <div class="col-auto">
                    <select name="rol" class="classic" aria-label="rol">
                        <option selected> Seleccione un rol</option>
                        <option value="paciente">Paciente</option>
                        <option value="administrador">Administrador</option>
                        <option value="empleado">Empleado</option>
                
                    </select>
                </div>
              </div>
             
              <div class="row mt-4">
                <div class="col-lg-4">     
                <label for="telefono">Número de teléfono</label> 
                </div>
                <div class="col-auto">          
               <input class="CampoTexto" type="number" name="telefono" class="form-control" >
                </div>
              </div>

                                 
            </div>
      
            <div class="col-lg-6 mb-2">
            <div class="row">
                <div class="col-lg-4"> <label for="tipo_documento">Tipo de documento</label> </div>
                <div class="col-auto">
                    <select name="tipo_documento" class="classic" aria-label="tipo_documento">
                        <option value=""> Seleccione un tipo de documento</option>
                        
                        <option value="CC">CC</option>
                        <option value="CE">CE</option>
                        <option value="TI">TI</option>
                        <option value="RC">RC</option>
                        <option value="PASAPORTE">PASAPORTE</option>
                    </select>
                </div>
              </div>

              
              <div class="row mt-4">
                <div class="col-lg-4"> <label for="password">Contraseña</label> </div>
                <div class="col-auto">
                <input class="CampoTexto" type="password" name="password" class="form-control" >
                </div>
              </div>

              <div class="row mt-1">
                <div class="col-lg-4">     
                <label for="direccion">Dirección</label> 
                </div>
                <div class="col-auto">          
               <input class="CampoTexto" type="text" name="direccion" class="form-control" >
                </div>
              </div>

              <div class="row mt-1">
                <div class="col-lg-4">     
                <label for="email">Correo</label> 
                </div>
                <div class="col-auto">          
               <input class="CampoTexto" type="email" name="email" class="form-control" >
                </div>
              </div>

              
            </div>
          </div>

          <div class=" row justify-content-center">
                <div class="col-sm-auto mb-4"> <button id="botonNaranja" type="submit">Guardar</button></div>
              </div>
            </form>
          
          
<script src="js/resp_validacion_usuario.js"></script>
</body>

</html>