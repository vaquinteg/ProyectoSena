<?php
// Conexión a la base de datos

include 'db.php';



// Validar datos
$nombre = $_POST['nombre'];
$tipo_documento = $_POST['tipo_documento'];
$identificacion = $_POST['identificacion'];
$rol = $_POST['rol'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];


$sql = "INSERT INTO usuario (nombre, tipo_documento, identificacion, rol, email, password, telefono, direccion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssisssis", $nombre, $tipo_documento, $identificacion, $rol, $email, $password, $telefono, $direccion);

if ($stmt->execute()) {
    $respuesta = [
        'estado' => 'exito',
        'mensaje' => 'La información ha sido guardada con éxito'
    ];
} else {
   
    $respuesta = [
        'estado' => 'error',
        'mensaje' => 'No se no pudo enviar la información'
    ];
}
header('Content-Type: application/json');
echo json_encode($respuesta);
$stmt->close();
        
?>