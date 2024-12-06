<?php
// registrar_proveedor_marca.php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";  // Cambia esto si es necesario
$password = "";  // Cambia esto si es necesario
$dbname = "proyectosena";
$port = 3306;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar conexión
if ($conn->connect_error) {
    echo json_encode(['estado' => 'error', 'mensaje' => 'Conexión fallida: ' . $conn->connect_error]);
    exit();
}

// Obtener los valores del formulario y validar
$nit = isset($_POST['nit']) ? intval($_POST['nit']) : 0;
$razon_social = $_POST['razon_social'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$correo = $_POST['correo'] ?? '';
$marca = $_POST['marca'] ?? '';

// Validación del teléfono: debe tener entre 7 y 10 dígitos
if (!preg_match('/^[0-9]{7,10}$/', $telefono)) {
    echo json_encode(['estado' => 'error', 'mensaje' => 'El teléfono debe tener entre 7 y 10 dígitos.']);
    exit();
}

// Verificar si la marca ya existe
$sqlCheckMarca = "SELECT idMarca FROM marca WHERE marca = ?";
$stmtCheckMarca = $conn->prepare($sqlCheckMarca);
$stmtCheckMarca->bind_param("s", $marca);
if (!$stmtCheckMarca->execute()) {
    echo json_encode(['estado' => 'error', 'mensaje' => 'Error al verificar la marca: ' . $stmtCheckMarca->error]);
    exit();
}
$resultMarca = $stmtCheckMarca->get_result();

if ($resultMarca->num_rows > 0) {
    // La marca ya existe
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'La marca ya existe. No se puede registrar un nuevo proveedor con esta marca.'
    ]);
    exit();
}

// Verificar si el proveedor ya existe
$sqlProveedor = "SELECT idPROVEEDOR FROM proveedor WHERE nit = ?";
$stmt = $conn->prepare($sqlProveedor);
$stmt->bind_param("i", $nit);
if (!$stmt->execute()) {
    echo json_encode(['estado' => 'error', 'mensaje' => 'Error al ejecutar consulta: ' . $stmt->error]);
    exit();
}
$result = $stmt->get_result();
$proveedorId = null;

if ($result->num_rows > 0) {
    // El proveedor ya existe
    $row = $result->fetch_assoc();
    $proveedorId = $row['idPROVEEDOR'];

    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'El proveedor con el NIT ingresado ya existe.',
        'proveedorId' => $proveedorId  // Enviar el ID del proveedor
    ]);
    exit();
} else {
    // El proveedor no existe, lo insertamos
    $sqlInsertProveedor = "INSERT INTO proveedor (nit, razon_social, direccion, telefono, correo) VALUES (?, ?, ?, ?, ?)";
    $stmtInsert = $conn->prepare($sqlInsertProveedor);
    $stmtInsert->bind_param("issis", $nit, $razon_social, $direccion, $telefono, $correo);
    if (!$stmtInsert->execute()) {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al insertar proveedor: ' . $stmtInsert->error]);
        exit();
    }
    $proveedorId = $stmtInsert->insert_id;  // Obtenemos el ID del nuevo proveedor
}

// Insertar la nueva marca si el proveedor y la marca son válidos
$sqlInsertMarca = "INSERT INTO marca (marca, proveedor_id) VALUES (?, ?)";
$stmtInsertMarca = $conn->prepare($sqlInsertMarca);
$stmtInsertMarca->bind_param("si", $marca, $proveedorId);
if (!$stmtInsertMarca->execute()) {
    echo json_encode(['estado' => 'error', 'mensaje' => 'Error al insertar la marca: ' . $stmtInsertMarca->error]);
    exit();
}

// Respuesta de éxito y redirección
echo json_encode([
    'estado' => 'exito',
    'mensaje' => 'La información ha sido guardada con éxito',
    'redirect' => 'lista_proveedor_marca.php'
]);

// Cerrar las conexiones
$stmt->close();
$stmtInsert->close();
$stmtCheckMarca->close();
$stmtInsertMarca->close();
$conn->close();
?>
