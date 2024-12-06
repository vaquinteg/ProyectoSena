<?php
$conn = new mysqli('localhost', 'root', '', 'proyectosena', 3307);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recoger el parámetro de búsqueda si existe
$buscar_identificacion = isset($_GET['buscar_identificacion']) ? $_GET['buscar_identificacion'] : '';

// Iniciar la consulta SQL base
$sql = "SELECT c.idCotizacion, u.identificacion, m.referencia AS montura, 
        ml.marca AS marca_lente, tl.tipo AS tipo_lente, 
        fl.filtro AS filtro_lente, c.descuento, c.precio_total 
    FROM cotizacion c
    JOIN paciente p ON c.idPaciente = p.idPaciente
    JOIN usuario u ON p.usuario_id = u.idUsuario
    JOIN montura m ON c.montura_id = m.idMontura
    JOIN marca_lente ml ON c.idmarca_lente = ml.idmarca_lente
    JOIN tipo_lente tl ON c.idtipo_lente = tl.idtipo_lente
    JOIN filtro_lente fl ON c.idfiltro_lente = fl.idfiltro_lente";

// Filtrar si se ha proporcionado un valor de búsqueda
if (!empty($buscar_identificacion)) {
    $sql .= " WHERE u.identificacion LIKE '%" . $conn->real_escape_string($buscar_identificacion) . "%'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Lista de cotizaciones</title>
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container-fluid row m-1">
  <h6 class="ntitulo" style="text-align: center;">Lista de Cotizaciones</h6>
  


    <form method="get" id="formBuscar" action="">
      <div class="input-group">
          <input type="text" name="buscar_identificacion" id="buscar_identificacion" class="form-control" placeholder="Ingrese Identificación" value="<?php echo isset($_GET['buscar_identificacion']) ? $_GET['buscar_identificacion'] : ''; ?>">
          <button type="submit" class="btn btn-dark">Buscar</button>
          <button id="btn btn-white" type="button" onclick="window.location.href='Cotizacion.php';">Nueva Cotización</button>
      </div>
    </form>


  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Identificación</th>
        <th>Montura</th>
        <th>Marca de Lente</th>
        <th>Tipo de Lente</th>
        <th>Filtro de Lente</th>
        <th>Descuento</th>
        <th>Precio Total</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['idCotizacion'] . "</td>";
            echo "<td>" . $row['identificacion'] . "</td>";
            echo "<td>" . $row['montura'] . "</td>";
            echo "<td>" . $row['marca_lente'] . "</td>";
            echo "<td>" . $row['tipo_lente'] . "</td>";
            echo "<td>" . $row['filtro_lente'] . "</td>";
            echo "<td>" . $row['descuento'] . "%</td>";
            echo "<td>$" . $row['precio_total'] . "</td>";
            echo "</tr>";
        }
      } else {
          echo "<tr><td colspan='8' class='text-center'>No se encontraron cotizaciones</td></tr>";
      }
      $conn->close();
      ?>
    </tbody>
  </table>
</div>

</body>
</html>

