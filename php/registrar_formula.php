<?php
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

// Preparar consulta para insertar en examen
$stmt_formula = $conn->prepare("INSERT INTO examen (fecha, profesional, ojo_derecho, ojo_izquierdo, distancia_pupilar, Paciente_id) VALUES (?, ?, ?, ?, ?, ?)");

// Validar datos
$identificacion = $_POST['identificacion'];
$fecha = $_POST['fecha'];
$profesional = $_POST['profesional'];
$ojo_derecho = $_POST['ojo_derecho'];
$ojo_izquierdo = $_POST['ojo_izquierdo'];
$distancia_pupilar = $_POST['distancia_pupilar'];

// Consultar id de usuario con identificación
$sql = "SELECT idUsuario FROM usuario WHERE identificacion = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $identificacion);
$stmt->execute();
$result = $stmt->get_result(); 
$row = $result->fetch_assoc();

if ($row) {
    $id_usuario = $row['idUsuario'];
    
    // Corregir consulta de paciente
    $sql2 = "SELECT idPaciente FROM paciente WHERE usuario_id = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("i", $id_usuario);
    $stmt2->execute();
    $result2 = $stmt2->get_result(); 
    $row2 = $result2->fetch_assoc();

    if ($row2) {
        $id_paciente = $row2['idPaciente'];
        
        // Insertar datos en la tabla examen
        $stmt_formula->bind_param("sssssi", $fecha, $profesional, $ojo_derecho, $ojo_izquierdo, $distancia_pupilar, $id_paciente);
        
        if ($stmt_formula->execute()) {
            $respuesta = [
                'estado' => 'Exito', 
                'mensaje' => 'Formula agregada con éxito'
            ];
        } else {
            $respuesta = [
                'estado' => 'error',
                'mensaje' => 'No pudo agregarse la formula: ' . $stmt_formula->error
            ];
        }
    } else {
        $respuesta = [
            'estado' => 'inconsistencia',
            'mensaje' => 'No se encontró un paciente con ese usuario'
        ];
    }
} else {
    $respuesta = [
        'estado' => 'inconsistencia',
        'mensaje' => 'No se encontró un usuario con esa identificación'
    ];
}

header('Content-Type: application/json');
echo json_encode($respuesta);

// Cerrar conexiones
$stmt->close();
$stmt_formula->close();
$stmt2->close();
$conn->close();
?>
