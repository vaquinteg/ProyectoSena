<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_apellido = $_POST['nombre_apellido'];
    $tipo_documento = $_POST['tipo_documento'];
    $numero_documento = $_POST['numero_documento'];
    $edad_paciente = $_POST['edad_paciente'];
    $RH_paciente = $_POST ['RH_paciente'];
    $grupo_sanguineo = $_POST ['grupo_sanguineo'];
    $numero_telefono = $_POST ['numero_telefono'];
   
    print_r($nombre);

    $sql = "INSERT INTO paciente (nombre_apellido, tipo_documento, numero_documento, edad_paciente, RH_paciente, grupo_sanguineo, numero_telefono)".
           " VALUES ('$nombre_apellido', '$tipo_documento', '$numero_documento', '$edad_paciente', '$Rh_paciente', '$grupo_sanguineo', '$numero_telefono')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo registro creado exitosamente";
        ?>
        <form action="read.php">
            
        <input type="submit" name="boton" value="Listar">
        </form>
    <?php

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>