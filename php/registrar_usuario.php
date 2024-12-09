<?php
header('Content-Type: application/json');

// Conexión a la base de datos
include '../php/db.php';

try {
    // Validar datos y eliminar espacios en blanco
    $nombre = trim($_POST['nombre'] ?? '');
    $tipo_documento = trim($_POST['tipo_documento'] ?? '');
    $identificacion = trim($_POST['identificacion'] ?? '');
    $rol = trim($_POST['rol'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $direccion = trim($_POST['direccion'] ?? '');

    // Verificar que los datos no estén vacíos
    if (empty($nombre) || empty($tipo_documento) || empty($identificacion) || empty($rol) || empty($email) || empty($password) || empty($telefono) || empty($direccion)) {
        throw new Exception('Todos los campos son obligatorios.');
    }

    // Hash de la contraseña
    $password_hashed = password_hash($password, PASSWORD_BCRYPT);

    // Preparar la consulta SQL
    $sql1 = "INSERT INTO usuario (nombre, tipo_documento, identificacion, rol, email, password, telefono, direccion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("ssisssis", $nombre, $tipo_documento, $identificacion, $rol, $email, $password_hashed, $telefono, $direccion);

    if ($stmt1->execute()) {
        $id_usuario = $conn->insert_id; // Obtener el ID del usuario recién creado

        // Si el rol es paciente, validar y guardar datos adicionales
        if ($rol === "paciente") {
            $edad_paciente = trim($_POST['edad'] ?? '');
            $rh = trim($_POST['rh'] ?? '');
            $grupo_sanguineo = trim($_POST['grupo_sanguineo'] ?? '');

            if (empty($edad_paciente) || empty($rh) || empty($grupo_sanguineo)) {
                throw new Exception('Campos adicionales para paciente son obligatorios.');
            }

            $stmt2 = $conn->prepare("INSERT INTO paciente (edad, grupo_sanguineo, rh, usuario_id) VALUES (?, ?, ?, ?)");
            $stmt2->bind_param("issi", $edad_paciente, $grupo_sanguineo, $rh, $id_usuario);

            if (!$stmt2->execute()) {
                throw new Exception('No pudo agregarse el paciente: ' . $stmt2->error);
            }
        }

        $respuesta = [
            'estado' => 'exito',
            'mensaje' => 'Usuario guardado con éxito'
        ];
    } else {
        throw new Exception('No se pudo crear el usuario: ' . $stmt1->error);
    }
} catch (Exception $e) {
    $respuesta = [
        'estado' => 'error',
        'mensaje' => $e->getMessage()
    ];
}

echo json_encode($respuesta);
exit;
