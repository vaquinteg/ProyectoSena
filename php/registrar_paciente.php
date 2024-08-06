<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'proyectosena');

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Preparar consultas

$stmt_personas = $conn->prepare("INSERT INTO persona (nombre_apellido, tipo_documento, identificacion, telefono, direccion) VALUES (?, ?, ?, ?, ?)");
$stmt_pacientes = $conn->prepare("INSERT INTO paciente (edad, grupo_sanguineo, rh, id_persona_fk) VALUES (?, ?, ?, ?)");

// Validar datos
$nombre_apellido = $_POST['nombre_apellido'];
$tipo_documento = $_POST['tipo_documento'];
$identificacion = $_POST['numero_documento'];
$edad_paciente = $_POST['edad'];
$rh = $_POST['rh'];
$grupo_sanguineo = $_POST['grupo_sanguineo'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

// Insertar datos en personas
$stmt_personas->bind_param("ssiis", $nombre_apellido, $tipo_documento, $identificacion, $telefono, $direccion);
if ($stmt_personas->execute()) {
    $id_persona = $stmt_personas->insert_id;
    // Insertar datos en pacientes
    $stmt_pacientes->bind_param("issi", $edad_paciente, $grupo_sanguineo, $rh, $id_persona);
    if ($stmt_pacientes->execute()) {
        echo "Datos insertados correctamente";
    } else {
        echo "Error al insertar datos en pacientes: " . $stmt_pacientes->error;
    }
} else {
    echo "Error al insertar datos en personas: " . $stmt_personas->error;
}

// Cerrar conexión
$conn->close();
?>