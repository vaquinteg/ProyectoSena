<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'proyectosena', 3306);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se recibe el idExamen
$idExamen = $_GET['idExamen'] ?? '';
if (!$idExamen) {
    die("No se proporcionó un ID de examen válido.");
}

// Preparar la consulta SQL
$sql = "SELECT e.idExamen, e.fecha, e.profesional, e.ojo_derecho, e.ojo_izquierdo, e.distancia_pupilar, 
        u.identificacion AS identificacion_paciente
        FROM examen e
        INNER JOIN paciente p ON e.paciente_id = p.idPaciente
        INNER JOIN usuario u ON p.usuario_id = u.idUsuario
        WHERE e.idExamen = ?"; // Filtrar por el idExamen

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idExamen); // Vincular el parámetro como un entero

// Ejecutar la consulta
if ($stmt->execute()) {
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Obtener los datos
        $row = $result->fetch_assoc();

        // Mostrar los datos en el formulario
        $fecha = $row['fecha'];
        $profesional = $row['profesional'];
        $ojo_derecho = $row['ojo_derecho'];
        $ojo_izquierdo = $row['ojo_izquierdo'];
        $distancia_pupilar = $row['distancia_pupilar'];
        $identificacion = $row['identificacion_paciente'];
    } else {
        echo "No se encontró un examen con el ID proporcionado.";
        exit();
    }
} else {
    echo "Error al ejecutar la consulta: " . $stmt->error;
    exit();
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar examen</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
 
</head>
<body>
<?php include 'menu.php';?>

<div class="container-fluid row justify-content-center">
<div class="col-lg-auto"> 
  <h1>Editar examen</h1>
</div>
</div>

<div class="container-fluid d-flex justify-content-center mt-5">
        <form id="formFormulaAct" action="../ProyectoSena/php/actualizar_formula.php" method="post">
        <input type="hidden" name="idExamen" id="idExamen" value="<?php echo $idExamen; ?>">
            <div class="container-fluid row justify-content-center mt-2">
                <div class="col-lg-1">
                    <label for="fecha">Fecha</label>
                </div>
                <div class="col-lg-3">
                    <input class="CampoTexto" type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>">
                </div>
                <div class="col-lg-2 text-end">
                    <label for="profesional">Profesional</label>
                </div>
                <div class="col-lg-4">
                    <input class="campo_texto_nom" type="text" id="profesional" name="profesional" value="<?php echo $profesional; ?>">
                </div>
            </div>
            <div class="container-fluid row mt-2">
                <div class="col-lg-2">
                    <label for="ojo_izquierdo">Fórmula ojo izquierdo</label>
                </div>
                <div class="col-lg-1">
                    <input class="CampoTexto" type="text" name="ojo_izquierdo" id="ojo_izquierdo" value="<?php echo $ojo_izquierdo; ?>">
                </div>
                <div class="col-lg-2"></div>
                <div class="col-lg-2 text-end">
                    <label for="ojo_derecho">Fórmula ojo derecho</label>
                </div>
                <div class="col-lg-2">
                    <input class="CampoTexto" type="text" name="ojo_derecho" id="ojo_derecho" value="<?php echo $ojo_derecho; ?>">
                </div>
            </div>
            <div class="m-3 row">
                <div class="col-lg-2 text-start">
                    <label for="distancia_pupilar">Distancia Pupilar</label>
                </div>
                <div class="col-lg-2">
                    <input class="CampoTexto" type="text" name="distancia_pupilar" id="distancia_pupilar" value="<?php echo $distancia_pupilar; ?>">
                </div>
                <div class="col-lg-1">
                   
                </div>
                <div class="col-lg-2">
                    <label for="identificacion">Identificación</label>
                </div>
                <div class="col-lg-2">
                    <input readonly class="CampoTexto" type="number" id="identificacion" value="<?php echo $identificacion; ?>" name="identificacion">
                </div>
            </div>
            <div class="m-3 row justify-content-center">
                <div class="col-sm-auto">
                    <button id="botonNaranja" type="submit">Guardar cambios</button>
                </div>
            </div>
        </form>
    </div>
    <script src="../ProyectoSena/js/actualizar_formula.js"></script>
</body>
</html>