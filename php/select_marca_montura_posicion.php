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
    echo json_encode(['estado' => 'error', 'mensaje' => 'Conexión fallida: ' . $conn->connect_error]);
    exit();
}

// Obtener los valores del formulario y validar
$Marca_idMarca = $_POST['marca'] ?? '';
$material = $_POST['material'] ?? '';
$color = $_POST['color'] ?? '';
$precio = $_POST['precio'] ?? '';
$referencia = $_POST['referencia'] ?? '';
$Posicion_idPosicion = $_POST['posicion'] ?? '';

// Realizar la inserción en la base de datos
$sql = "INSERT INTO montura (Marca_idMarca, color, material, precio, referencia, Posicion_idPosicion) 
        VALUES ('$Marca_idMarca', '$color', '$material', '$precio', '$referencia', '$Posicion_idPosicion')";

if ($conn->query($sql) === TRUE) {
    // Enviar una respuesta JSON con un mensaje de éxito y la URL de redirección
    echo json_encode([
        'estado' => 'exito',
        'mensaje' => 'La información ha sido guardada con éxito, Si desea ver el listado de monturas, presione aceptar',
        'redirect' => 'listamarcamontura.php' // Esta es la URL a la que redirigir después
    ]);
} else {
    // Enviar una respuesta de error si no se pudo guardar la información
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'La información no pudo ser enviada'
    ]);
}

// Cerrar la conexión
$conn->close();
?>
