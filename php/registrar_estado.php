<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";  // Cambia esto si tienes un usuario diferente
$password = "";  // Cambia esto si tienes una contraseña diferente
$dbname = "proyectosena";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    echo json_encode(['estado' => 'error', 'mensaje' => 'Conexión fallida: ' . $conn->connect_error]);
    exit();
}

// Verificar que 'identificacion' y 'id_estado' fueron enviados
if (isset($_POST['identificacion']) && isset($_POST['id_estado'])) {
    $identificacion = $_POST['identificacion'];
    $id_estado = $_POST['id_estado'];

    // Buscar el ID del usuario
    $sql = "SELECT idUsuario FROM usuario WHERE identificacion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $identificacion);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $id_usuario = $row['idUsuario'];

        // Buscar el ID del paciente correspondiente
        $sql2 = "SELECT idPaciente FROM paciente WHERE usuario_id = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("i", $id_usuario);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $row2 = $result2->fetch_assoc();

        if ($row2) {
            $id_paciente = $row2['idPaciente'];

            // Preparar la consulta de actualización
            $sql3 = "UPDATE paciente SET estado_gafa_id = ? WHERE idPaciente = ?";
            $stmt3 = $conn->prepare($sql3);
            $stmt3->bind_param("ii", $id_estado, $id_paciente);

            // Ejecutar la consulta de actualización
            if ($stmt3->execute()) {
                $respuesta = [
                    'estado' => 'exito',
                    'mensaje' => 'La información ha sido guardada con éxito'
                ];
            } else {
                $respuesta = [
                    'estado' => 'error',
                    'mensaje' => 'Estado no pudo ser actualizado'
                ];
            }

            // Cerrar la consulta
            $stmt3->close();
        } else {
            $respuesta = [
                'estado' => 'error',
                'mensaje' => 'Paciente no encontrado'
            ];
        }

        // Cerrar la segunda consulta
        $stmt2->close();
    } else {
        $respuesta = [
            'estado' => 'error',
            'mensaje' => 'Usuario no encontrado'
        ];
    }

    // Cerrar la primera consulta
    $stmt->close();
} else {
    $respuesta = [
        'estado' => 'error',
        'mensaje' => 'No se han enviado todos los datos necesarios'
    ];
}

// Enviar la respuesta en formato JSON
echo json_encode($respuesta);

// Cerrar la conexión
$conn->close();
?>
