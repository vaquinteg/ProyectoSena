<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";  // Cambia esto si tienes un usuario diferente
$password = "";  // Cambia esto si tienes una contraseña diferente
$dbname = "proyectosena";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los valores del formulario
$nit = $_POST['nit'];
$razon_social = $_POST['razon_social'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$marca = $_POST['marca'];

// Verificar si el proveedor ya existe
$sqlProveedor = "SELECT idPROVEEDOR FROM proveedor WHERE nit = ?";
$stmt = $conn->prepare($sqlProveedor);
$stmt->bind_param("i", $nit);
$stmt->execute();
$result = $stmt->get_result();
$proveedorId = null;

if ($result->num_rows > 0) {
    // El proveedor ya existe, actualizar datos
    $row = $result->fetch_assoc();
    $proveedorId = $row['idPROVEEDOR'];

    $sqlUpdateProveedor = "UPDATE proveedor SET razon_social = ?, direccion = ?, telefono = ?, correo = ? WHERE idPROVEEDOR = ?";
    $stmtInsert = $conn->prepare($sqlUpdateProveedor);
    $stmtInsert->bind_param("ssisi", $razon_social, $direccion, $telefono, $correo, $proveedorId);
    $stmtInsert->execute();
} else {
    // El proveedor no existe, lo creamos
    $sqlInsertProveedor = "INSERT INTO proveedor (nit, razon_social, direccion, telefono, correo) VALUES (?, ?, ?, ?, ?)";
    $stmtInsert = $conn->prepare($sqlInsertProveedor);
    $stmtInsert->bind_param("issis", $nit, $razon_social, $direccion, $telefono, $correo);
    $stmtInsert->execute();
    $proveedorId = $stmtInsert->insert_id; // Obtenemos el ID del nuevo proveedor
}

// Insertar la marca asociada al proveedor
$sqlInsertMarca = "INSERT INTO marca (marca, proveedor_id) VALUES (?, ?)";
$stmtInsertMarca = $conn->prepare($sqlInsertMarca);
$stmtInsertMarca->bind_param("si", $marca, $proveedorId);
$stmtInsertMarca->execute();

// Cerrar la conexión
$stmt->close();
$stmtInsert->close();
$stmtInsertMarca->close();
$conn->close();

// Redirigir o mostrar mensaje de éxito
header("Location: ../Nuevoproveedor.php"); // O mostrar un mensaje en pantalla
exit();
?>

