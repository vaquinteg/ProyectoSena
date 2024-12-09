<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'proyectosena', 3306);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(['error' => 'Error de conexión: ' . $conn->connect_error]));
}

// Obtener la identificación desde la solicitud
$identificacion = isset($_GET['identificacion']) ? (int)$_GET['identificacion'] : 0;
//$identificacion=1234;
if ($identificacion === 0) {
    die(json_encode(['error' => 'El parámetro u.identificacion no fue enviado correctamente']));
}
// Preparar y ejecutar la consulta
$sql = "SELECT e.idExamen, e.fecha, e.profesional, e.ojo_derecho, e.ojo_izquierdo,
               e.distancia_pupilar, u.identificacion AS identificacion_paciente
        FROM examen e
        INNER JOIN paciente p ON e.paciente_id = p.idPaciente
        INNER JOIN usuario u ON p.usuario_id = u.idUsuario
        WHERE u.identificacion = ?
        ORDER BY e.idExamen";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $identificacion);
$stmt->execute();
$result = $stmt->get_result();

// Convertir los resultados a JSON
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$stmt->close();
$conn->close();

if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    die(json_encode(['error' => 'Error al codificar JSON']));
}
// Enviar la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($data);
?>