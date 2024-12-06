<?php
header('Content-Type: application/json');
// Conexión a la base de datos
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

$respuesta = array(); // Inicializar la variable respuesta

// Validar datos
$idUsuario = $_POST['idUsuario']; 
$nombre = $_POST['nombre'];
$tipo_documento = $_POST['tipo_documento'];
$identificacion = $_POST['identificacion'];
$rol = $_POST['rol'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

$sql1 = "UPDATE usuario SET nombre = ?, tipo_documento = ?, identificacion = ?, rol = ?, email = ?, 
        password = ?, telefono = ?, direccion = ? 
        WHERE idUsuario = ?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("ssisssisi", $nombre, $tipo_documento, $identificacion, $rol, $email, $password, $telefono, $direccion, $idUsuario);

if ($stmt1->execute()) {
    $respuesta = [
        'estado' => 'exito',
        'mensaje' => 'usuario actualizado con éxito'
    ];

    if ($rol == "paciente") {
        // Verificar si los campos del paciente existen
        if(isset($_POST['edad']) && isset($_POST['rh']) && isset($_POST['grupo_sanguineo'])) {
            $edad_paciente = $_POST['edad'];
            $rh = $_POST['rh'];
            $grupo_sanguineo = $_POST['grupo_sanguineo'];
            
            $stmt2 = $conn->prepare("UPDATE paciente SET edad = ?, grupo_sanguineo = ?, rh = ? 
                                            WHERE usuario_id = ?");
            $stmt2->bind_param("issi", $edad_paciente, $grupo_sanguineo, $rh, $idUsuario);
            
            if ($stmt2->execute()) {       
                $respuesta = [
                    'estado' => 'exito', 
                    'mensaje' => 'Paciente actualizado con éxito'
                ];
            } else {
                $respuesta = [
                    'estado' => 'error',
                    'mensaje' => 'No pudo actualizarse el paciente: ' . $stmt2->error
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