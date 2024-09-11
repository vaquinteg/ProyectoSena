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

<div class="container-fluid row justify-content-lg-center">
<div class="col-lg-auto"> 
  <h1>Subir formula oftálmica</h1>
</div>
</div>

<div class="container-fluid d-flex justify-content-center mt-5" >
  <form action="#" method="post">
      <div class="container-fluid row justify-content-center">     
        <div class="col-lg-3">     
           <label for="Nombre">Nombres y apellidos</label> 
        </div>
        <div class="col-lg-6">          
         <input class="campo_texto_nom" type="text" name="Nombre" class="form-control" >
      </div>
    </div>
    <div class="container-fluid row mt-2">
      <div class="col-lg-2"> <label for="tipo_documento">Tipo de documento</label></div>
      <div class="col-lg-2">
          <select class="classic" aria-label="tipo documento">
              <option selected> Seleccione una opción</option>
              <option value="1">CC</option>
              <option value="2">CE</option>
              <option value="3">TI</option>
              <option value="4">RC</option>
              <option value="5">Pasaporte</option>
            </select>
      </div>
      <div class="col-lg-2"></div>
    <div class="col-lg-2">     
       <label for="numero_documento">Número de documento</label> 
    </div>
    <div class="col-lg-2">          
     <input class="CampoTexto" type="number" name="numero_documento" class="form-control" >
  </div>
  </div>
<div class="container-fluid row mt-2"> 
  <div class="col-lg-2">     
    <label for="formula_OI">Formula ojo izquierdo</label> 
 </div>
 <div class="col-lg-2">          
  <input class="CampoTexto" type="text" name="formula_OI" class="form-control" >
</div>
<div class="col-lg-2"></div>
  <div class="col-lg-2">   
     <label for="formula_OD">Fórmula ojo derecho</label> 
  </div>
  <div class="col-lg-2">          
   <input class="CampoTexto" type="text" name="formula_OD" class="form-control" >
</div>
</div>
      

        <div class="m-3 row justify-content-center">
          <div class="col-sm-auto"> <button id="botonNaranja" type="submit">Subir fórmula</button></div>
        </div>
  </div>
  </form>
</div>



</body>
</html>