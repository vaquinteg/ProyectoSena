<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyectosena";
$port = 3307;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el NIT de la búsqueda
$nitBusqueda = isset($_GET['nit']) ? $_GET['nit'] : '';

// Consultar los proveedores
$sql = "SELECT p.idPROVEEDOR, p.nit, p.razon_social, p.telefono, p.correo, p.direccion, m.idMarca, m.marca
        FROM proveedor p
        LEFT JOIN marca m ON p.idPROVEEDOR = m.proveedor_id";

// Si hay un NIT ingresado, filtrar por ese NIT
if ($nitBusqueda != '') {
    $sql .= " WHERE p.nit = '$nitBusqueda'";
}

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Lista de Proveedores</title>
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container-fluid row m-1">
  <h6 class="ntitulo" style="text-align: center;">Lista de Proveedores</h6>

  

  <form method="GET" action="" class="mb-3">
    <div class="input-group">
      <input type="text" class="form-control" name="nit" placeholder="Buscar por NIT" value="<?php echo isset($_GET['nit']) ? $_GET['nit'] : ''; ?>">
      <button class="btn btn-dark" type="submit">Buscar</button>

      <button id="btn btn-white" type="button" onclick="window.location.href='Nuevoproveedor.php';">Nueva marca o nuevo proveedor</button>
      <button id="btn btn-white" type="button" onclick="window.location.href='AgregarMarcaProveedor.php';">Agregar marca</button>
    </div>
  </form>

 
  

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Marca</th>
        <th>NIT</th>
        <th>Razón Social</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Dirección</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result->num_rows > 0) {
          // Mostrar los proveedores y sus marcas
          while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row['marca'] . "</td>";
              echo "<td>" . $row['nit'] . "</td>";
              echo "<td>" . $row['razon_social'] . "</td>";
              echo "<td>" . $row['telefono'] . "</td>";
              echo "<td>" . $row['correo'] . "</td>";
              echo "<td>" . $row['direccion'] . "</td>";
              // Cambié los enlaces a los IDs de las marcas
              echo "<td>
                        <a href='editar_proveedor.php?idProveedor=" . $row['idPROVEEDOR'] . "&idMarca=" . $row['idMarca'] . "' class='btn btn-outline-dark'>Editar</a>
                    
                        </td>";
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='7'>No se encontraron proveedores</td></tr>";
      }
      // Cerrar la conexión
      $conn->close();
      ?>
    </tbody>
  </table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
