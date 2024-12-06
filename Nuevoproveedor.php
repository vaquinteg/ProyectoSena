<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Crear nuevo proveedor-marca</title>
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>
  
<?php include 'menu.php'; ?>

<div class="container-fluid row m-1">
  <h6 class="ntitulo" style="text-align: center;"> Creación de nueva marca</h6>

  <div class="col-md-6 d-flex flex-column justify-content-between">
    <!-- Formulario login -->
    <form id="formulario_marca_proveedor" action="php/registrar_proveedor_marca.php" method="post">
      <div class="row">
        <div class="col-md-4 d-flex justify-content-between"><label for="nit">NIT:</label></div>
        <div class="col-md-4 d-flex justify-content-between">
          <input type="number" name="nit" id="nit" class="es3 primary2" onblur="obtenerProveedor()" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 d-flex justify-content-between"><label for="razon_social">Razón Social</label></div>
        <div class="col-md-4 d-flex justify-content-between">
          <input type="text" name="razon_social" id="razon_social" class="es3 primary2" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 d-flex justify-content-between"><label for="telefono">Teléfono</label></div>
        <div class="col-md-4 d-flex justify-content-between">
          <input type="number" name="telefono" id="telefono" class="es3 primary2" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 d-flex justify-content-between"><label for="correo">Correo</label></div>
        <div class="col-md-4 d-flex justify-content-between">
          <input type="email" id="correo" name="correo" class="es3 primary2" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 d-flex justify-content-between"><label for="direccion">Dirección</label></div>
        <div class="col-md-4 d-flex justify-content-between">
          <input type="text" name="direccion" id="direccion" class="es3 primary2" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 d-flex justify-content-between"><label for="marca">Marca</label></div>
        <div class="col-md-4 d-flex justify-content-between">
          <input type="text" name="marca" id="marca" class="es3 primary2" required>
        </div>
      </div>

      <div class="row m-4">
        <div style="text-align: center;">
          <button type="submit" class="bt primary">Guardar</button>
        </div>
      </div>
    </form>
  </div>

          <div class="row m-4">
            <div style="text-align: center;"><button type="submit" id="botonNaranja"> Guardar </button></div>
          </div>
          </form>
  <div class="col-md-6 d-flex flex-column justify-content-between">
    <h3 class="lmm"><a class="ablink" href="lista_proveedor_marca.php">Lista de Proveedores y Marcas</a></h3>
    <h7>Puede consultar la lista de proveedores en "Lista de Proveedores y marcas", Si el proveedor está registrado y desea agregarle una marca pulse <a class="rem" href="AgregarMarcaProveedor.php">Agregar Marca</a></h7>
    <div class="row">
      <img src="https://images.pexels.com/photos/39716/pexels-photo-39716.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="foto" width="586" height="432">
    </div>
  </div>

  
</div>

<script src="js/resp_validacion_marca_proveedor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
