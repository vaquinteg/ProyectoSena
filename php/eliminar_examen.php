<?php
// Activar reporte de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configurar el tipo de contenido como JSON
header('Content-Type: application/json');

// Array para la respuesta
$response = array();

// Verificar que se recibió el ID del examen
if (isset($_GET['idExamen'])) {
    // Conexión a la base de datos
    $conn = new mysqli('localhost', 'root', '', 'proyectosena');
    
    // Verificar conexión
    if ($conn->connect_error) {
        $response['status'] = 'error';
        $response['message'] = 'Error de conexión: ' . $conn->connect_error;
        echo json_encode($response);
        exit();
    }

    // Obtener el ID del examen y sanitizarlo
    $idExamen = (int)$_GET['idExamen'];
    
    // Preparar la consulta SQL para eliminar
    $sql = "DELETE FROM examen WHERE idExamen = ?";
    
    // Preparar la sentencia
    if ($stmt = $conn->prepare($sql)) {
        // Vincular el parámetro
        $stmt->bind_param("i", $idExamen);
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Examen eliminado exitosamente';
            $response['redirect'] = 'listar_examen.php';
            echo json_encode($response);
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error al eliminar el examen';
            $response['redirect'] = 'listar_examen.php';
            echo json_encode($response);
        }
        
        // Cerrar la sentencia
        $stmt->close();
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error en la preparación de la consulta';
        $response['redirect'] = 'listar_examen.php';
        echo json_encode($response);
    }
    
    // Cerrar la conexión
    $conn->close();
} else {
    $response['status'] = 'error';
    $response['message'] = 'No se proporcionó ID del examen';
    $response['redirect'] = 'listar_examen.php';
    echo json_encode($response);
}
?>