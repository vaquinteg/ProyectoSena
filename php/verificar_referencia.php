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

// Obtener la referencia y el idMontura desde la solicitud POST
$referencia = $_POST['referencia'] ?? '';
$idMontura = $_POST['idMontura'] ?? '';

// Verificar si la referencia existe en la base de datos, excluyendo el registro actual
$sql = "SELECT COUNT(*) as total FROM montura WHERE referencia = '$referencia' AND idMontura != '$idMontura'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Verificar si la referencia ya existe en otro registro
if ($row['total'] > 0) {
    echo json_encode(['existe' => true]);
} else {
    echo json_encode(['existe' => false]);
}

// Cerrar la conexión
$conn->close();
?>

