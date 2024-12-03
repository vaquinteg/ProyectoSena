<?php
header('Content-Type: application/json');

// Conexión a la base de datos
include 'db.php';

$respuesta = array(); // Inicializar la variable respuesta

// Validar datos
$nombre = $_POST['nombre'];
$tipo_documento = $_POST['tipo_documento'];
$identificacion = $_POST['identificacion'];
$rol = $_POST['rol'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

$sql1 = "INSERT INTO usuario (nombre, tipo_documento, identificacion, rol, email, password, telefono, direccion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("ssisssis", $nombre, $tipo_documento, $identificacion, $rol, $email, $password, $telefono, $direccion);

if ($stmt1->execute()) {
    $respuesta = [
        'estado' => 'exito',
        'mensaje' => 'usuario creado con éxito'
    ];

    if ($rol == "paciente") {
        // Verificar si los campos del paciente existen
        if(isset($_POST['edad']) && isset($_POST['rh']) && isset($_POST['grupo_sanguineo'])) {
            $id_usuario = $conn->insert_id;
            $edad_paciente = $_POST['edad'];
            $rh = $_POST['rh'];
            $grupo_sanguineo = $_POST['grupo_sanguineo'];
            
            $stmt2 = $conn->prepare("INSERT INTO paciente (edad, grupo_sanguineo, rh, usuario_id) VALUES (?, ?, ?, ?)");
            $stmt2->bind_param("issi", $edad_paciente, $grupo_sanguineo, $rh, $id_usuario);
            
            if ($stmt2->execute()) {       
                $respuesta = [
                    'estado' => 'exito', 
                    'mensaje' => 'Paciente agregado con éxito'
                ];
            } else {
                $respuesta = [
                    'estado' => 'error',
                    'mensaje' => 'No pudo agregarse el paciente: ' . $stmt2->error
                ];
            }
        } else {
            $respuesta = [
                'estado' => 'error',
                'mensaje' => 'Faltan campos requeridos para el paciente'
            ];
        }
    }
} else {
    $respuesta = [
        'estado' => 'error',
        'mensaje' => 'No se pudo crear usuario'
    ];
}

echo json_encode($respuesta);
?>