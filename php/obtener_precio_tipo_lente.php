<?php
$servername = "localhost";
$username = "root";  // Cambia esto si tienes un usuario diferente
$password = "";  // Cambia esto si tienes una contraseña diferente
$dbname = "proyectosena";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$tipo_lente = $_GET['tipo_lente'];

// Buscar el proveedor por NIT
$sql = "SELECT precio FROM tipo_lente WHERE idtipo_lente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $tipo_lente);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $tipo = $result->fetch_assoc();
    echo json_encode($tipo);
} else {
    echo json_encode(null); // No se encontró el proveedor
}

// Cerrar conexión
$stmt->close();
$conn->close();