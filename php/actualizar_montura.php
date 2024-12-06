<?php
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

// Obtener los datos del formulario
$idMontura = $_POST['idMontura'] ?? '';
$marca = $_POST['marca'] ?? '';
$material = $_POST['material'] ?? '';
$color = $_POST['color'] ?? '';
$precio = $_POST['precio'] ?? '';
$referencia = $_POST['referencia'] ?? '';
$posicion = $_POST['posicion'] ?? '';

// Actualizar los datos en la base de datos
$sql = "UPDATE montura 
        SET Marca_idMarca = '$marca', material = '$material', color = '$color', precio = '$precio', 
            referencia = '$referencia', Posicion_idPosicion = '$posicion' 
        WHERE idMontura = '$idMontura'";

if ($conn->query($sql) === TRUE) {
    echo json_encode([
        'estado' => 'exito',
        'mensaje' => 'La información ha sido editada con éxito.',
        'redirect' => 'listamarcamontura.php' // Esta es la URL a la que redirigir después
    ]);
} else {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'La información no pudo ser enviada'
    ]);
}

$conn->close();
?>
