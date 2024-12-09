
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    <title>Nuevo usuario</title>
</head>
<body>
  
<?php include 'menu.php'; ?>


      <div class="container-fluid row justify-content-lg-center">
        <div class="col-lg-auto"> 
          <h1>Crear usuario o paciente</h1>
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
                    <select name="rol" class="classic" aria-label="rol" id="dinamic_option">
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

          <!--container dinámico que se oculta-->
          <div class="oculto" id="hidden_container">
          <div  class="container-fluid row">
            <!-- Formulario que depende de la selección paciente-->
              <div class="row">
                <div class="col-lg-2"> <label for="edad">Edad</label></div>
                <div class="col-lg-2">
                <input class="CampoTexto ms-1" type="number" name="edad">
                </div>
                <div class="col-2"> </div>
                <div class="col-lg-2 ms-2"> <label for="RH">RH</label> </div>
                <div class="col-2 ms-2">
                    <select name="rh" class="classic" aria-label="rh">
                        <option selected> Seleccione un RH</option>
                        <option value="+">+</option>
                        <option value="-">-</option>
                    </select>
                </div>
              </div>
              <div class="row mt-2">
                
              </div>
              <div class="row mt-2">
                <div class="col-lg-2"> <label for="grupo_sanguineo">Grupo sanguineo</label> </div>
                <div class="col-2 ms-1">
                    <select name="grupo_sanguineo" class="classic" aria-label="grupo_sanguineo">
                        <option selected> Seleccione una opción</option>
                        <option value="O">O</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>                      
                    </select>
                </div>
              </div>
          </div>
          </div>
          <!-- Se cierra el container dinámico-->
          <div class=" row justify-content-center">
                <div class="col-lg-auto mb-4"> <button id="botonNaranja" type="submit">Guardar</button></div>
                </form>
                <div class="col-lg-auto mb-4"> <button class="botonNaranja" onclick="window.location.href='http://localhost/ProyectoSena/ProyectoSena/listar_usuario.php'">Buscar</button></div>
              </div>
            
          
          
<script src="js/resp_validacion_usuario.js"></script>
<script src="js/form_dinamico.js"></script>

</body>

</html>