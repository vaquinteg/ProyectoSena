<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyectosena";

// Crear conexión con mysqli
$conn = new mysqli($servername, $username, $password, $dbname,3306);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$identificacion = isset($_POST['identificacion']) ? $_POST['identificacion'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';



$sql = "SELECT * FROM usuario WHERE identificacion = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $identificacion);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si el usuario existe
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Validar contraseña
    if (password_verify($password, $user['password'])) {
        // Contraseña correcta: Iniciar sesión
        session_start();
        $_SESSION['idUsuario'] = $user['idUsuario'];
        $_SESSION['identificacion'] = $user['identificacion'];
        
        $respuesta = [
            'estado' => 'exito',
            'mensaje' => 'Inicio de sesión exitoso. Bienvenido, ' //. htmlspecialchars($user['identificacion']) . '!'
        ];
        // Redirigir al usuario a la página de inicio o dashboard

    } else {
        $respuesta = [
            'estado' => 'error',
            'mensaje' => 'Contraseña incorrecta'
        ]; // Contraseña incorrecta
        
    }
} else {
    // Usuario no encontrado
    $respuesta = [
        'estado' => 'error',
        'mensaje' => 'No se encontró un usuario con esa identificación'
    ];
}

header('Content-Type: application/json');
echo json_encode($respuesta);

// Cerrar la conexión
$conn->close();
?>
