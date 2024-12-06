<?php
header('Content-Type: application/json');

// Conexión a la base de datos
include '../php/db.php';

try {
    // Validar datos
    $nombre = $_POST['nombre'];
    $tipo_documento = $_POST['tipo_documento'];
    $identificacion = $_POST['identificacion'];
    $rol = $_POST['rol'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $sql1 = "INSERT INTO usuario (nombre, tipo_documento, identificacion, rol, email, password, telefono, direccion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("ssisssis", $nombre, $tipo_documento, $identificacion, $rol, $email, $password, $telefono, $direccion);

    if ($stmt1->execute()) {
        $id_usuario = $conn->insert_id; // Obtener el ID del usuario recién creado
        $respuesta = [
            'estado' => 'exito',
            'mensaje' => 'Usuario guardado con éxito'
        ];

        // Si el rol es paciente, insertar los datos adicionales
        if ($rol == "paciente") {
            if (isset($_POST['edad'], $_POST['rh'], $_POST['grupo_sanguineo'])) {
                $edad_paciente = $_POST['edad'];
                $rh = $_POST['rh'];
                $grupo_sanguineo = $_POST['grupo_sanguineo'];

                $stmt2 = $conn->prepare("INSERT INTO paciente (edad, grupo_sanguineo, rh, usuario_id) VALUES (?, ?, ?, ?)");
                $stmt2->bind_param("issi", $edad_paciente, $grupo_sanguineo, $rh, $id_usuario);

                if ($stmt2->execute()) {
                    $respuesta = [
                        'estado' => 'exito',
                        'mensaje' => 'Paciente guardado con éxito'
                    ];
                } else {
                    throw new Exception('No pudo agregarse el paciente: ' . $stmt2->error);
                }
            } else {
                throw new Exception('Faltan campos requeridos para el paciente');
            }
        }

        // Redirigir al usuario tras éxito
        header('Location: /../../listar_usuario.php');
        exit;
    } else {
        throw new Exception('No se pudo crear el usuario: ' . $stmt1->error);
    }
} catch (Exception $e) {
    // Manejo de errores
    $respuesta = [
        'estado' => 'error',
        'mensaje' => $e->getMessage()
    ];
    echo json_encode($respuesta);
    exit;
}
