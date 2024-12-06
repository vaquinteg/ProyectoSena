<?php
$servername = "localhost";
$username = "root";  // Cambia esto si tienes un usuario diferente
$password = "";  // Cambia esto si tienes una contraseña diferente
$dbname = "proyectosena";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$filtro_lente = $_GET['filtro_lente'];

// Buscar el proveedor por NIT
$sql = "SELECT precio FROM filtro_lente WHERE idfiltro_lente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $filtro_lente);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $filtro = $result->fetch_assoc();
    echo json_encode($filtro);
} else {
    echo json_encode(null); // No se encontró el proveedor
}

// Cerrar conexión
$stmt->close();
$conn->close();