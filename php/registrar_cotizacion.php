<?php
$servername = "localhost";
$username = "root";  
$password = "";  
$dbname = "proyectosena";
$port = 3307;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Validar si los campos están vacíos
$identificacion = $_POST['identificacion'] ?? '';
$referencia_montura = $_POST['montura'] ?? '';
$marca_lente = $_POST['marca_lente'] ?? '';
$tipo_lente = $_POST['tipo_lente'] ?? '';
$filtro_lente = $_POST['filtro_lente'] ?? '';
$descuento = $_POST['descuento'] ?? '';
$precio_total = $_POST['precio_total'] ?? '';

// Comprobar si algún campo importante está vacío
if (empty($identificacion) || empty($referencia_montura) || empty($marca_lente) || empty($tipo_lente) || empty($filtro_lente) || empty($precio_total)) {
    echo json_encode(['estado' => 'error', 'mensaje' => 'Todos los campos son obligatorios. Por favor, complete todos los campos.']);
    exit;
}

// Consultar idUsuario para la identificación
$sql_identificacion = "SELECT idUsuario FROM usuario WHERE identificacion = ?";
$stmt_identificacion = $conn->prepare($sql_identificacion);
$stmt_identificacion->bind_param("i", $identificacion);
$stmt_identificacion->execute();
$result_identificacion = $stmt_identificacion->get_result(); 
$row_identificacion = $result_identificacion->fetch_assoc();

if (!$row_identificacion) {
    echo json_encode(['estado' => 'error', 'mensaje' => 'Identificación no encontrada']);
    exit;
}

$sql_montura = "SELECT idMontura FROM montura WHERE referencia = ?";
$stmt_montura = $conn->prepare($sql_montura);
$stmt_montura->bind_param("s", $referencia_montura);
$stmt_montura->execute();
$result_montura = $stmt_montura->get_result(); 
$row_montura = $result_montura->fetch_assoc();

if (!$row_montura) {
    echo json_encode(['estado' => 'error', 'mensaje' => 'Montura no encontrada']);
    exit;
}

if ($row_identificacion) {
    $id_usuario = $row_identificacion['idUsuario'];
    $sql_paciente = "SELECT idPaciente FROM paciente WHERE usuario_id = ?";
    $stmt_paciente = $conn->prepare($sql_paciente);
    $stmt_paciente->bind_param("i", $id_usuario);
    $stmt_paciente->execute();
    $result_paciente = $stmt_paciente->get_result(); 
    $row_paciente = $result_paciente->fetch_assoc();

    if (!$row_paciente) {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Paciente no encontrado']);
        exit;
    }

    if ($row_paciente) {
        // Insertar cotización
        $sql_insert_cotizacion = "INSERT INTO cotizacion (idPaciente, montura_id, idmarca_lente, idtipo_lente, idfiltro_lente, descuento, precio_total) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert_cotizacion = $conn->prepare($sql_insert_cotizacion);
        $stmt_insert_cotizacion->bind_param("iiiiiid", 
            $row_paciente['idPaciente'], $row_montura['idMontura'], $marca_lente, 
            $tipo_lente, $filtro_lente, $descuento, $precio_total);

        if ($stmt_insert_cotizacion->execute()) {
            echo json_encode([
                'estado' => 'exito',
                 'mensaje' => 'Cotización registrada exitosamente',
                 'redirect' => 'listacotizacion.php'
        ]);

        } else {
            echo json_encode(['estado' => 'error', 'mensaje' => 'Error al insertar la cotización: ' . $conn->error]);
        }
    }
}

$stmt_identificacion->close();
$stmt_montura->close();
$stmt_paciente->close();
$conn->close();
?>
