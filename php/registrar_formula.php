<?php
error_reporting(E_ALL); // Muestra todos los errores
ini_set('display_errors', 1); // Habilita la visualización de errores en pantalla

$servername = "localhost";
$username = "root";  // Cambia esto si tienes un usuario diferente
$password = "";  // Cambia esto si tienes una contraseña diferente
$dbname = "proyectosena";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, 3306);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode([
        'estado' => 'error',
        'mensaje' => 'Conexión fallida: ' . $conn->connect_error
    ]));
}

// Validar datos entrantes
$identificacion = $_POST['identificacion'] ?? null;
$fecha = $_POST['fecha'] ?? null;
$profesional = $_POST['profesional'] ?? null;
$ojo_derecho = $_POST['ojo_derecho'] ?? null;
$ojo_izquierdo = $_POST['ojo_izquierdo'] ?? null;
$distancia_pupilar = $_POST['distancia_pupilar'] ?? null;

if (!$identificacion || !$fecha || !$profesional || !$ojo_derecho || !$ojo_izquierdo || !$distancia_pupilar) {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'Datos incompletos. Verifique los campos enviados.'
    ]);
    exit();
}

// Consultar id de usuario con identificación
$sql = "SELECT idUsuario FROM usuario WHERE identificacion = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'Error en la preparación de la consulta de usuario: ' . $conn->error
    ]);
    exit();
}
$stmt->bind_param("i", $identificacion);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    echo json_encode([
        'estado' => 'inconsistencia',
        'mensaje' => 'No se encontró un usuario con esa identificación'
    ]);
    exit();
}

$id_usuario = $row['idUsuario'];

// Consultar id del paciente
$sql2 = "SELECT idPaciente FROM paciente WHERE usuario_id = ?";
$stmt2 = $conn->prepare($sql2);
if (!$stmt2) {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'Error en la preparación de la consulta de paciente: ' . $conn->error
    ]);
    exit();
}
$stmt2->bind_param("i", $id_usuario);
$stmt2->execute();
$result2 = $stmt2->get_result();
$row2 = $result2->fetch_assoc();

if (!$row2) {
    echo json_encode([
        'estado' => 'inconsistencia',
        'mensaje' => 'No se encontró un paciente asociado al usuario'
    ]);
    exit();
}

$id_paciente = $row2['idPaciente'];

// Insertar datos en la tabla examen
$stmt_formula = $conn->prepare(
    "INSERT INTO examen (fecha, profesional, ojo_derecho, ojo_izquierdo, distancia_pupilar, Paciente_id) 
    VALUES (?, ?, ?, ?, ?, ?)"
);
if (!$stmt_formula) {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'Error en la preparación de la consulta de examen: ' . $conn->error
    ]);
    exit();
}

$stmt_formula->bind_param("sssssi", $fecha, $profesional, $ojo_derecho, $ojo_izquierdo, $distancia_pupilar, $id_paciente);

if ($stmt_formula->execute()) {
    echo json_encode([
        'estado' => 'exito',
        'mensaje' => 'Fórmula agregada con éxito'
    ]);
} else {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'No se pudo agregar la fórmula: ' . $stmt_formula->error
    ]);
}

// Cerrar conexiones
$stmt->close();
$stmt2->close();
$stmt_formula->close();
$conn->close();
?>
