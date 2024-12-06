<?php
$servername = "localhost";
$username = "root";  // Cambia esto si tienes un usuario diferente
$password = "";  // Cambia esto si tienes una contraseña diferente
$dbname = "proyectosena";
$port =3306;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nit = $_GET['nit'];

// Buscar el proveedor por NIT
$sql = "SELECT razon_social, direccion, telefono, correo FROM proveedor WHERE nit = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $nit);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $proveedor = $result->fetch_assoc();
    echo json_encode($proveedor);
} else {
    echo json_encode(null); // No se encontró el proveedor
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>