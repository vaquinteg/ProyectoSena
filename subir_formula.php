<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Subir formula</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container-fluid row justify-content-center">
<div class="col-lg-auto"> 
  <h1>Nuevo examen</h1>
</div>
</div>

<div class="container-fluid d-flex justify-content-center mt-5" >
  <form id="formFormula" action="../ProyectoSena/php/registrar_formula.php" method="post">

    <div class="container-fluid row justify-content-center">     
      <div class="col-lg-2">     
        <label for="identificacion">Identificación</label> 
      </div>
      <div class="col-lg-3">          
        <input class="CampoTexto" type="number" id="identificacion" name="identificacion" class="form-control" onblur="obtenerPacienteFormula()" >
      </div>   
      <div class="col-lg-2 text-end">     
           <label for="nombre">Nombre</label> 
      </div>
      <div class="col-lg-5">          
         <input readonly class="campo_texto_nom" type="text" name="nombre" id="nombre" class="form-control" >
      </div>
    </div>

    <!-- Esto es otro row-->
    <div class="container-fluid row justify-content-center mt-2">
      
      <div class="col-lg-1">     
          <label for="fecha">Fecha</label> 
      </div>
      <div class="col-lg-3">          
          <input class="CampoTexto" type="date" id="fecha" name="fecha" class="form-control">
      </div>   

      <div class="col-lg-2 text-end">     
          <label for="profesional">Profesional</label> 
      </div>
      <div class="col-lg-4">          
          <input class="campo_texto_nom" type="text" id="profesional" name="profesional" class="form-control">
      </div>   
    
  </div>
<div class="container-fluid row mt-2"> 
      <div class="col-lg-2">     
        <label for="ojo_izquierdo">Formula ojo izquierdo</label> 
    </div>
    <div class="col-lg-1">          
      <input class="CampoTexto" type="text" name="ojo_izquierdo" class="form-control" >
    </div>
    <div class="col-lg-2"></div>
      <div class="col-lg-2 text-end">   
        <label for="ojo_derecho">Fórmula ojo derecho</label> 
      </div>
      <div class="col-lg-2">          
      <input class="CampoTexto" type="text" name="ojo_derecho" class="form-control" >
    </div>
</div>

<div class="m-3 row">
      <div class="col-lg-2 text-start">   
          <label for="distancia_pupilar">Distancia Pupilar</label> 
      </div>
      <div class="col-lg-2">          
          <input class="CampoTexto" type="text" name="distancia_pupilar" class="form-control" >
      </div>
      <div class="col-lg-8 text-start">   
          <!-- espacio en blanco--> 
      </div>
</div>
      

        <div class="m-3 row justify-content-center">
          <div class="col-sm-auto"> <button id="botonNaranja" type="submit" onclick="window.location.href='http://localhost/ProyectoSena/ProyectoSena/listar_examen.php'">Subir fórmula</button></div>
          <div class="col-sm-auto"> <button id="botonNaranja" onclick="window.location.href='http://localhost/ProyectoSena/ProyectoSena/listar_examen.php'">Buscar examen</button></div>
        </div>
  </div>
  </form>
</div>


<script src="js/completar_formula.js"></script>
<script src="js/resp_validacion_formula.js"></script>
</body>
</html>