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

$identificacion = $_GET['identificacion'];

// Buscar el paciente por identificacion
$sql = "SELECT nombre FROM usuario WHERE identificacion = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $identificacion);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $paciente = $result->fetch_assoc();
    echo json_encode($paciente);
} else {
    echo json_encode(null); // No se encontró el paciente
}

// Cerrar conexión
$stmt->close();
$conn->close();