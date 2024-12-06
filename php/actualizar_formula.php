<?php
$conn = new mysqli('localhost', 'root', '', 'proyectosena');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$idExamen = $_POST['idExamen'];
$fecha = $_POST['fecha'];
$profesional = $_POST['profesional'];
$ojo_izquierdo = $_POST['ojo_izquierdo'];
$ojo_derecho = $_POST['ojo_derecho'];
$distancia_pupilar = $_POST['distancia_pupilar'];


$sql = "UPDATE examen SET fecha = ?, profesional = ?, ojo_izquierdo = ?, ojo_derecho = ?, distancia_pupilar = ? WHERE idExamen = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $fecha, $profesional, $ojo_izquierdo, $ojo_derecho, $distancia_pupilar, $idExamen);

if ($stmt->execute()) {
     $respuesta = [
                'estado' => 'exito', 
                'mensaje' => 'Formula actualizada con éxito'
            ];
} else {
    $respuesta = [
        'estado' => 'error', 
        'mensaje' => 'No se pudo actualizar formula'
    ];
}
echo json_encode($respuesta); 
$stmt->close();
$conn->close();
