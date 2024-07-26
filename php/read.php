<?php
include 'db.php';

$sql = "SELECT nombre, tipo_documento, numero_documento, edad_paciente, tipo_sangre, numero_telefono_paciente FROM paciente";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="table-container">
        <h2>Lista de Usuarios</h2>
        <?php
        if ($result->num_rows > 0) {
            echo "<table><tr><th>ID</th><th>Nombre</th><th>Tipo documento</th><th>Numero documento</th><th>Edad</th><th>Tipo sangre</th><th>Telefono</th><th>Acciones</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"]. "</td><td>" . $row["nombre"]. "</td><td>" . $row["tipo_documento"]. "</td><td>" . $row["numero_documento"]. 
                "</td><td>" . $row["edad_paciente"] .  "</td><td>" . $row["tipo_sangre"] . "</td><td>" . $row["numero_telefono_paciente"] ."</td>" ;
                echo "<td><a href='update.php?id=" . $row["id"] . "' class='btn btn-success'>Editar</a> | <a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger'>Eliminar</a></td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No hay usuarios registrados.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>