<?php
$servername = "localhost";
$username = "root";  // Cambia esto si tienes un usuario diferente
$password = "";  // Cambia esto si tienes una contraseña diferente
$dbname = "proyectosena";
$port= 3307;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$referencia = $_GET['referencia'];

// Buscar el proveedor por NIT
$sql = "SELECT Precio FROM montura WHERE referencia = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $referencia);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $montura = $result->fetch_assoc();
    echo json_encode($montura);
} else {
    echo json_encode(null); // No se encontró el proveedor
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>