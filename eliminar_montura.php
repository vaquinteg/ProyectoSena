
<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'proyectosena', 3306);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar que el parámetro 'idMontura' está presente en la URL
if (isset($_GET['idMontura'])) {
    // Obtener el idMontura desde la URL
    $idMontura = $_GET['idMontura'];
    
    // Verificar si la montura está asociada a una cotización
    $checkCotizacionSql = "SELECT COUNT(*) FROM cotizacion WHERE montura_id = ?";
    
    if ($stmt = $conn->prepare($checkCotizacionSql)) {
        // Vincular el parámetro (el idMontura debe ser un entero)
        $stmt->bind_param("i", $idMontura);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener el resultado
        $stmt->bind_result($cotizacionesCount);
        $stmt->fetch();
        $stmt->close();
        
        // Si la montura está asociada a una cotización, mostrar mensaje y evitar eliminación
        if ($cotizacionesCount > 0) {
            // Mostrar un mensaje de advertencia si la montura tiene cotizaciones asociadas
            echo "<script>
                    alert('No se puede eliminar esta montura porque está asociada a una cotización, para volver a la lista de monturas presione aceptar.');
                    window.location.href = 'listamarcamontura.php'; // Redirigir a la lista de monturas
                  </script>";
        } else {
            // Preparar la consulta para eliminar la montura
            $sql = "DELETE FROM montura WHERE idMontura = ?";
            
            // Preparar la sentencia SQL
            if ($stmt = $conn->prepare($sql)) {
                // Vincular el parámetro (el idMontura debe ser un entero)
                $stmt->bind_param("i", $idMontura);
                
                // Ejecutar la consulta
                if ($stmt->execute()) {
                    // Si la eliminación fue exitosa, redirigir a la lista de monturas
                    header("Location: listamarcamontura.php?mensaje=Eliminado exitosamente");
                    exit();
                } else {
                    // Si ocurrió un error, mostrar un mensaje
                    echo "Error al eliminar la montura: " . $stmt->error;
                }
            } else {
                echo "Error al preparar la consulta: " . $conn->error;
            }
        }
    } else {
        echo "Error al preparar la consulta de cotización: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
