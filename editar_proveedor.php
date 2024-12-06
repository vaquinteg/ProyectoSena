<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyectosena";
$port = 3306;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los IDs del proveedor y la marca desde la URL
$idProveedor = isset($_GET['idProveedor']) ? $_GET['idProveedor'] : '';
$idMarca = isset($_GET['idMarca']) ? $_GET['idMarca'] : '';

// Consultar los datos del proveedor y la marca asociada
$sql = "SELECT p.idPROVEEDOR, p.nit, p.razon_social, p.telefono, p.correo, p.direccion, m.idMarca, m.marca
        FROM proveedor p
        LEFT JOIN marca m ON p.idPROVEEDOR = m.proveedor_id
        WHERE p.idPROVEEDOR = '$idProveedor' AND m.idMarca = '$idMarca'";

$result = $conn->query($sql);

// Verificar si el proveedor y la marca existen
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Proveedor o Marca no encontrado.");
}

// Procesar el formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir los datos del formulario
    $nit = $_POST['nit'];
    $razon_social = $_POST['razon_social'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $marca = $_POST['marca'];

    // Validar si la marca ya existe
    $checkMarcaSql = "SELECT idMarca FROM marca WHERE marca = ? AND idMarca != ?";
    if ($stmt = $conn->prepare($checkMarcaSql)) {
        // Vincular los parámetros
        $stmt->bind_param("si", $marca, $idMarca);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            // Si la marca ya existe, mostrar alerta
            echo "<script>
                    alert('La marca ya existe. Por favor, elige otro nombre de marca.');
                    window.history.back(); // Volver al formulario sin actualizar
                  </script>";
            exit();
        }
    }

    // Actualizar los datos del proveedor
    $updateProveedorSql = "UPDATE proveedor 
                           SET nit = '$nit', razon_social = '$razon_social', telefono = '$telefono', correo = '$correo', direccion = '$direccion' 
                           WHERE idPROVEEDOR = '$idProveedor'";

    // Actualizar los datos de la marca
    $updateMarcaSql = "UPDATE marca 
                       SET marca = '$marca' 
                       WHERE idMarca = '$idMarca'";

    if ($conn->query($updateProveedorSql) === TRUE && $conn->query($updateMarcaSql) === TRUE) {
        echo "Proveedor y Marca actualizados correctamente.";
        // Redirigir al listado de proveedores
        header('Location: lista_proveedor_marca.php');
    } else {
        echo "Error al actualizar los datos: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar Proveedor</title>
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container">
    <h2 class="mt-4">Editar Proveedor y Marca</h2>
    <form method="POST" id="formulario_editar_proveedor_marca" action="editar_proveedor.php?idProveedor=<?php echo $idProveedor; ?>&idMarca=<?php echo $idMarca; ?>">
        <!-- Datos del Proveedor -->
        <div class="mb-3">
            <label for="nit" class="form-label">NIT</label>
            <input type="text" class="form-control" id="nit" name="nit" value="<?php echo $row['nit']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="razon_social" class="form-label">Razón Social</label>
            <input type="text" class="form-control" id="razon_social" name="razon_social" value="<?php echo $row['razon_social']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $row['telefono']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $row['correo']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $row['direccion']; ?>" required>
        </div>

        <!-- Datos de la Marca -->
        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" class="form-control" id="marca" name="marca" value="<?php echo $row['marca']; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>

<script type="text/javascript">
    // Validación del formulario
    document.getElementById('formulario_editar_proveedor_marca').onsubmit = function(event) {
        // Validación del teléfono
        var telefono = document.getElementById('telefono').value;
        var telefonoRegex = /^[0-9]{7,10}$/;

        if (!telefonoRegex.test(telefono)) {
            alert('El teléfono debe tener entre 7 y 10 dígitos.');
            event.preventDefault(); // Evitar el envío del formulario
            return false;
        }

        // Si todas las validaciones son correctas, el formulario se enviará
        return true;
    };
</script>

</body>
</html>
