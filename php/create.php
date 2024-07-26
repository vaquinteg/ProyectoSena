<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $tipo_documento = $_POST['tipo_documento'];
    $numero_documento = $_POST['numero_documento'];
    $edad_paciente = $_POST['edad_paciente'];
    $tipo_sangre = $_POST ['tipo_sangre'];
    $numero_telefono_paciente = $_POST ['numero_telefono_paciente'];
   
    print_r($nombre);

    $sql = "INSERT INTO paciente (nombre, tipo_documento, numero_documento, edad_paciente, tipo_sangre, numero_telefono_paciente)".
           " VALUES ('$nombre', '$tipo_documento', '$numero_documento', '$edad_paciente', '$tipo_sangre', '$numero_telefono_paciente')";

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