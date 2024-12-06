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

// Preparar consultas

$stmt_pacientes = $conn->prepare("INSERT INTO paciente (edad, grupo_sanguineo, rh, usuario_id) VALUES (?, ?, ?, ?)");


// Validar datos
$identificacion = $_POST['identificacion'];
$edad_paciente = $_POST['edad'];
$rh = $_POST['rh'];
$grupo_sanguineo = $_POST['grupo_sanguineo'];


//consultar id de usuario con identificación

$sql = "SELECT idUsuario FROM usuario WHERE identificacion = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $identificacion);
$stmt->execute();
$result = $stmt->get_result(); 
$row = $result->fetch_assoc();
        
if ($row) {
    $id_usuario = $row['idUsuario'];
    
    // Insertar datos en la tabla paciente
    $stmt_pacientes->bind_param("issi", $edad_paciente, $grupo_sanguineo, $rh, $id_usuario);
    if ($stmt_pacientes->execute()) {
        $respuesta = [
            'estado' => 'Exito', 
            'mensaje' => 'Paciente agregado con éxito'
        ];
    } else {
        $respuesta = [
            'estado' => 'error',
            'mensaje' => 'No pudo agregarse el paciente: ' . $stmt_pacientes->error
        ];
    }
} else {
    $respuesta = [
        'estado' => 'error',
        'mensaje' => 'No se encontró un usuario con esa identificación'
    ];
}

header('Content-Type: application/json');
echo json_encode($respuesta);

// Cerrar conexiones
$stmt->close();
$conn->close();
?>