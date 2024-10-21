<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";  // Cambia esto si es necesario
$password = "";  // Cambia esto si es necesario
$dbname = "proyectosena";
//$port =3307;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

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


$sql = "INSERT INTO montura (Marca_idMarca , color, material, precio, referencia, Posicion_idPosicion) VALUES ('$Marca_idMarca', '$color', '$material', '$precio', '$referencia','$Posicion_idPosicion')";
if ($conn->query($sql) === TRUE) {
    
    $respuesta = [
        'estado' => 'exito',
        'mensaje' => 'La información ha sido guardada con éxito'
    ];
} else {

    $respuesta = [
        'estado' => 'Error',
        'mensaje' => 'La información no pudo ser enviada'
    ];
}

    header('Content-Type: application/json');
    echo json_encode($respuesta);
?>