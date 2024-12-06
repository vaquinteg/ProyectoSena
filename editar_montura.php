<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";  // Cambia esto si es necesario
$password = "";  // Cambia esto si es necesario
$dbname = "proyectosena";
$port = 3307;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener el ID de la montura desde la URL
$idMontura = $_GET['idMontura'] ?? '';

// Verificar si el ID de la montura está presente
if ($idMontura) {
    // Obtener los datos de la montura desde la base de datos
    $sql = "SELECT m.idMontura, ma.marca, m.material, m.color, m.precio, m.referencia, p.Exhibidor 
            FROM montura m
            JOIN marca ma ON m.Marca_idMarca = ma.idMarca
            JOIN posicion p ON m.Posicion_idPosicion = p.idPosicion
            WHERE m.idMontura = '$idMontura'";
    $result = $conn->query($sql);

    // Verificar si se encontraron los datos de la montura
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $marca = $row['marca'];
        $material = $row['material'];
        $color = $row['color'];
        $precio = $row['precio'];
        $referencia = $row['referencia'];
        $posicion = $row['Exhibidor'];
    } else {
        echo "No se encontró la montura.";
        exit();
    }
} else {
    echo "No se ha proporcionado un ID de montura.";
    exit();
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar Montura</title>
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container-fluid row m-1">
  <h6 class="ntitulo" style="text-align: center;">Editar  Montura</h6>
  
  <!-- Formulario de edición -->
  <div class="col-md-6 d-flex flex-column justify-content-between">
  <form id="formulario_editar_montura" action="php/actualizar_montura.php" method="post">
  <input type="hidden" name="idMontura" value="<?php echo $idMontura; ?>">

  <!-- Marca -->
  <div class="row">
    <div class="col-md-6 d-flex justify-content-between">
      <label for="marca">Marca de la montura:</label>
    </div>
    <div class="col-md-6 d-flex justify-content-between">
      <select class="classic" name="marca" required>
        <option value="">Seleccione una marca</option>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'proyectosena', 3307);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $result = $conn->query("SELECT idMarca, marca FROM marca");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['idMarca']}'>{$row['marca']}</option>";
        }
        $conn->close();
        ?>
      </select>
    </div>
  </div>

  <!-- Material -->
  <div class="row">
    <div class="col-md-6 d-flex justify-content-between">
      <label for="material">Material:</label>
    </div>
    <div class="col-md-6 d-flex justify-content-between">
      <input type="text" name="material" value="<?php echo $material; ?>" class="es3 primary2" required>
    </div>
  </div>

  <!-- Color -->
  <div class="row">
    <div class="col-md-6 d-flex justify-content-between">
      <label for="color">Color:</label>
    </div>
    <div class="col-md-6 d-flex justify-content-between">
      <input type="text" name="color" value="<?php echo $color; ?>" class="es3 primary2" required>
    </div>
  </div>

  <!-- Precio -->
  <div class="row">
    <div class="col-md-6 d-flex justify-content-between">
      <label for="precio">Precio:</label>
    </div>
    <div class="col-md-6 d-flex justify-content-between">
      <input type="number" name="precio" value="<?php echo $precio; ?>" class="es3 primary2" required>
    </div>
  </div>

  <!-- Referencia -->
  <div class="row">
    <div class="col-md-6 d-flex justify-content-between">
      <label for="referencia">Referencia:</label>
    </div>
    <div class="col-md-6 d-flex justify-content-between">
      <input type="text" name="referencia" value="<?php echo $referencia; ?>" class="es3 primary2" required>
    </div>
  </div>

  <!-- Posición -->
  <div class="row">
    <div class="col-md-6 d-flex justify-content-between">
      <label for="posicion">Posición:</label>
    </div>
    <div class="col-md-6 d-flex justify-content-between">
      <select class="classic" name="posicion" required>
        <option value="">Seleccione una posición</option>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'proyectosena', 3307);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $result = $conn->query("SELECT idPosicion, Exhibidor FROM posicion");
        while ($row = $result->fetch_assoc()) {
            
            echo "<option value='{$row['idPosicion']}' $selected>{$row['Exhibidor']}</option>";
        }
        $conn->close();
        ?>
      </select>
    </div>
  </div>

  <div class="row m-4">
    <div style="text-align: center;">
      <button class="bt primary" type="submit">Guardar cambios</button>
    </div>
  </div>
  
</form>
</div>

  <div class="col-md-6 d-flex flex-column justify-content-between ">

  <div class="row">
    <div style="text-align: center;"><label>Datos de la montura sin editar:</label></div>
  </div>

  <div style="text-align: center;">
    <label>Marca de la montura:<?php echo $marca; ?></label>
  </div>

  <div style="text-align: center;">
    <label>Material: <?php echo $material; ?></label>
  </div>

  <div style="text-align: center;">
    <label>Color:<?php echo $color; ?></label>
  </div>

  <div style="text-align: center;">
    <label>Precio:<?php echo $precio; ?></label>
  </div>
  
  <div style="text-align: center;">
    <label>Referencia:<?php echo $referencia; ?></label>
  </div>

  <div style="text-align: center;">
    <label>Posicion: <?php echo $posicion; ?></label>
  </div>
  </div>
  
</div>

<script src="js/resp_validacion_editarmontura.js"></script>
</body>
</html>
