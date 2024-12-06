<?php
// Activar reporte de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configurar el tipo de contenido como JSON
header('Content-Type: application/json');

// Array para la respuesta
$response = array();

// Verificar que se recibió el ID del usuario
if (isset($_GET['idUsuario'])) {
    // Conexión a la base de datos
    $conn = new mysqli('localhost', 'root', '', 'proyectosena');

    // Verificar conexión
    if ($conn->connect_error) {
        $response['status'] = 'error';
        $response['message'] = 'Error de conexión: ' . $conn->connect_error;
        echo json_encode($response);
        exit();
    }

    // Obtener el ID del usuario y sanitizarlo
    $idUsuario = (int)$_GET['idUsuario'];

    // Obtener el rol del usuario
    $stmt_rol = $conn->prepare("SELECT rol FROM usuario WHERE idUsuario = ?");
    $stmt_rol->bind_param("i", $idUsuario);
    $stmt_rol->execute();
    $result_rol = $stmt_rol->get_result();
    $rol_data = $result_rol->fetch_assoc();
    $stmt_rol->close();

    // Verificar si se encontró el rol
    if (!$rol_data) {
        $response['status'] = 'error';
        $response['message'] = 'No se encontró el usuario con el ID proporcionado.';
        echo json_encode($response);
        exit();
    }

    $rol = $rol_data['rol'];

    if ($rol === "paciente") {
        // Eliminar de la tabla paciente y usuario
        $sql_paciente = "DELETE FROM paciente WHERE usuario_id = ?";
        $sql_usuario = "DELETE FROM usuario WHERE idUsuario = ?";
        
        // Preparar y ejecutar ambas consultas
        if ($stmt_paciente = $conn->prepare($sql_paciente)) {
            $stmt_paciente->bind_param("i", $idUsuario);
            $stmt_paciente->execute();
            $stmt_paciente->close();
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error al preparar la consulta para eliminar paciente.';
            echo json_encode($response);
            exit();
        }

        if ($stmt_usuario = $conn->prepare($sql_usuario)) {
            $stmt_usuario->bind_param("i", $idUsuario);
            $stmt_usuario->execute();
            $stmt_usuario->close();
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error al preparar la consulta para eliminar usuario.';
            echo json_encode($response);
            exit();
        }

        $response['status'] = 'success';
        $response['message'] = 'Paciente eliminado exitosamente.';
        $response['redirect'] = 'listar_usuario.php';
        echo json_encode($response);

    } else {
        // Eliminar solo de la tabla usuario
        $sql_usuario = "DELETE FROM usuario WHERE idUsuario = ?";
        if ($stmt = $conn->prepare($sql_usuario)) {
            $stmt->bind_param("i", $idUsuario);
            $stmt->execute();
            $stmt->close();
            $response['status'] = 'success';
            $response['message'] = 'Usuario eliminado exitosamente.';
            $response['redirect'] = 'listar_usuario.php';
            echo json_encode($response);
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error al preparar la consulta para eliminar usuario.';
            echo json_encode($response);
        }
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'No se recibió un ID de usuario.';
    echo json_encode($response);
}
