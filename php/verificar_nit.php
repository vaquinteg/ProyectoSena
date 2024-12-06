<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyectosena";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar la conexión
if ($conn->connect_error) {
    die(json_encode(['estado' => 'error', 'mensaje' => 'Conexión fallida: ' . $conn->connect_error]));
}

// Obtener el NIT
$nit = isset($_POST['nit']) ? intval($_POST['nit']) : 0;

if ($nit > 0) {
    // Verificar si el NIT existe en la base de datos
    $sql = "SELECT idPROVEEDOR FROM proveedor WHERE nit = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $nit);
    $stmt->execute();
    $result = $stmt->get_result();

    // Comprobar si existe un proveedor con ese NIT
    if ($result->num_rows > 0) {
        echo json_encode(['existe' => true]);
    } else {
        echo json_encode(['existe' => false]);
    }

    $stmt->close();
}

$conn->close();
?>
