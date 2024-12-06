<?php
$conn = new mysqli('localhost', 'root', '', 'proyectosena', 3306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener los valores de los campos de búsqueda
$referencia = isset($_GET['referencia']) ? $_GET['referencia'] : '';
$marca = isset($_GET['marca']) ? $_GET['marca'] : '';

// Crear la consulta SQL, añadiendo condiciones si se ingresan parámetros de búsqueda
$sql = "SELECT m.idMontura, ma.marca, m.material, m.color, m.precio, m.referencia, p.Exhibidor 
        FROM montura m
        JOIN marca ma ON m.Marca_idMarca = ma.idMarca
        JOIN posicion p ON m.Posicion_idPosicion = p.idPosicion
        WHERE (m.referencia LIKE '%$referencia%' OR '$referencia' = '')
        AND (ma.marca LIKE '%$marca%' OR '$marca' = '')
        ORDER BY m.idMontura";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Lista de Monturas</title>
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>

  <script type="text/javascript">
    function confirmarEliminacion(url) {
      if (confirm("¿Estás seguro de que quieres eliminar esta montura?")) {
        window.location.href = url;
      }
    }
  </script>
  
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container-fluid row m-1">
  <h6 class="ntitulo" style="text-align: center;">Lista de Monturas</h6>

  <form method="GET" action="" class="mb-3">
    <div class="input-group">
      <input type="text" class="form-control" name="referencia" placeholder="Buscar por referencia" value="<?php echo $referencia; ?>">
      <input type="text" class="form-control" name="marca" placeholder="Buscar por marca" value="<?php echo $marca; ?>">
      <button class="btn btn-dark" type="submit">Buscar</button>
   
       <button id="btn btn-white" type="button" onclick="window.location.href='registrodemonturas.php';">
    Registrar montura nueva</button>

    
    </div>
     
    
  </form>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Marca</th>
        <th>Material</th>
        <th>Color</th>
        <th>Precio ($)</th>
        <th>Referencia</th>
        <th>Posición</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>{$row['idMontura']}</td>
                  <td>{$row['marca']}</td>
                  <td>{$row['material']}</td>
                  <td>{$row['color']}</td>
                  <td>{$row['precio']}</td>
                  <td>{$row['referencia']}</td>
                  <td>{$row['Exhibidor']}</td>
                  <td>
                    <a href='editar_montura.php?idMontura={$row['idMontura']}' class='btn btn-outline-dark btn-sm'>Editar</a>
                    <button onclick='confirmarEliminacion(\"eliminar_montura.php?idMontura={$row['idMontura']}\")' class='btn btn-danger btn-sm'>Eliminar</button>
                  </td>
                </tr>";
      }
      $conn->close();
      ?>
    </tbody>
  </table>
</div>

</body>
</html>
