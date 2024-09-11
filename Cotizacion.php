<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Cotizacionlente</title>
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>

</head>
<body>

<?php include 'menu.php'; ?>

<div class="container-fluid row m-1">
  <h6 class="ntitulo" style="text-align: center;"> Cotización de lentes</h6>

    <div  class="col-md-9">
           
            <!-- Formulario -->
 
            <form>
           <div class="row">

             <div class="col-md-4  d-flex justify-content-between">
              <label for="montura" >MONTURA:</label></div>

             <div class="col-md-4 justify-content-between">
              <input type="text" name="montura" class="es3 primary2">
             </div>

             <div class="col-md-4 d-flex justify-content-between">
              <input type="number" name="montura2" class="es3 primary2" placeholder="Precio" readonly="readonly">
            </div>

           </div>

           <div class="row">
            <div class="col-md-4 d-flex justify-content-between"> <label for="marcalente">MARCA DEL LENTE:</label></div>
            <div class="col-md-4 d-flex justify-content-between">
              <select  class="classic" name="marcalente" >
                <option value="marca lente 1" > Marca lente 1 </option>
                <option value="marca lente 2">Marca lente 2</option>
                <option value="marca lente 3">Marca lente 3</option>
                </select>
            </div>
            <div class="col-md-4  d-flex justify-content-between">
              <input type="number" name="marcalente2" class="es3 primary2" placeholder="Precio" readonly="readonly">
            </div>

          </div>

          <div class="row">
            <div class="col-md-4 d-flex justify-content-between"><label for="tipolente">TIPO DE LENTE:</label></div>
            <div class="col-md-4 d-flex justify-content-between">
              <select  class="classic" name="tipolente" >
                <option value="ti2">Tipo lente 1</option>
                <option value="ti2">Tipo lente 2</option>
                <option value="ti3">Tipo lente 3</option>
                </select>
            </div>

            <div class="col-md-4 d-flex justify-content-between">
              <input type="number" name="tipolente2" class="es3 primary2" placeholder="Precio" readonly="readonly">
             
            </div>
          </div>


          <div class="row">
            <div class="col-md-4 d-flex justify-content-between"><label for="filtro">FILTRO:</label></div>
            <div class="col-md-4 d-flex justify-content-between"><input type="text" name="filtro" class="es3 primary2"></div>
            <div class="col-md-4 d-flex justify-content-between">
              <input type="number" name="filtro2" class="es3 primary2" placeholder="Precio" readonly="readonly">
            </div>
            
          </div>

          <div class="row">
            <div class="col-md-4 d-flex justify-content-between"><label for="descuento">DESCUENTO:</label></div>
            <div class="col-md-4 d-flex justify-content-between"><select  class="classic" name="descuento" >
              <option value="au">10%</option>
              <option value="ca">20%</option>
              <option value="usa">30%</option>
              <option value="usa">40%</option>
              <option value="usa">50%</option>
              </select>
              </div>

              <div class="col-md-4  d-flex justify-content-between">
                <input type="number" name="descuento2" class="es3 primary2" placeholder="Precio" readonly="readonly">
              </div>
          </div>


          <div class="row m-4">
            <div  style="text-align: center;">
            <label for="total">Total:</label>
            <input type="text" name="total" class="es3 primary2">
          </div>
          </div>

          <div class="row m-4">
            <div style="text-align: center;"><button class="bt primary" href="actualizar_estado_venta.html"> Guardar e imprimir </button></div>
          </div>
        </form>
          
    </div>


    <div class="col-md-3"><img src="imagen/gafasopticanaan.jpg" class="imagCot" > </div>
    
</div>


</div>






 
</body>
</html>

