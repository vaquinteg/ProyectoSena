<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'proyectosena', 3306);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$idUsuario = (int)$_GET['idUsuario'];
if (!$idUsuario) {
  echo("id usuario está vacio");
}

// Obtener el rol del usuario
$stmt_rol = $conn->prepare("SELECT rol FROM usuario WHERE idUsuario = ?");
$stmt_rol->bind_param("i", $idUsuario);
$stmt_rol->execute();
$result_rol = $stmt_rol->get_result();
$rol_data = $result_rol->fetch_assoc();
$stmt_rol->close();

if (!$rol_data) {
  $response['status'] = 'error';
  $response['message'] = 'No se encontró el usuario con el ID proporcionado.';
  echo json_encode($response);
  exit();
}
$rol = $rol_data['rol'];

if ($rol === "paciente") {
      $sql_paciente = "SELECT idPaciente, edad, rh, grupo_sanguineo, usuario_id, estado_gafa_id
            FROM paciente
            WHERE usuario_id = ?";

      $stmt_paciente = $conn->prepare($sql_paciente);
      $stmt_paciente->bind_param("i", $idUsuario);
      if ($stmt_paciente->execute()) {
        $result_paciente = $stmt_paciente->get_result();
    
        if ($result_paciente->num_rows > 0) {
            // Obtener los datos
            $row = $result_paciente->fetch_assoc();
            // Mostrar los datos en el formulario
            $edad = $row['edad'];
            $rh = $row['rh'];
            $grupo_sanguineo = $row['grupo_sanguineo'];
            $estado_gafa_id = $row['estado_gafa_id'];
        } else {
            echo "No se encontró un paciente con el ID proporcionado.";
            exit();
        }
    } else {
        echo "Error al ejecutar la consulta de paciente: " . $stmt->error;
        exit();
    }

}
// Preparar la consulta SQL

$sql = "SELECT idUsuario, nombre, email, rol, identificacion, tipo_documento, password, telefono, direccion
            FROM usuario
            WHERE idUsuario = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idUsuario); // Vincular el parámetro como un entero

// Ejecutar la consulta
if ($stmt->execute()) {
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Obtener los datos
        $row = $result->fetch_assoc();
        // Mostrar los datos en el formulario
        $nombre = $row['nombre'];
        $identificacion = $row['identificacion'];
        $tipo_documento = $row['tipo_documento'];
        $rol = $row['rol'];
        $email = $row['email'];
        $telefono = $row['telefono'];
        $direccion = $row['direccion'];
        $password = $row['password'];
    } else {
        echo "No se encontró un usuario con el ID proporcionado.";
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    <title>Editar usuario</title>
</head>
<body>
  
<?php include 'menu.php'; ?>

      <div class="container-fluid row justify-content-lg-center">
        <div class="col-lg-auto"> 
          <h1>Editar usuario o paciente</h1>
        </div>
      </div>
      
          <div class="container-fluid row mt-5" >
            <div class="col-lg-6">
              <form id="formUsuario" action="php/actualizar_usuario.php" method="post">
              <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $idUsuario;?>">
              <div class="row">
                <div class="col-lg-4"> <label class="label" for="nombre">Nombres y apellidos</label> 
                </div>
                <div class="col-auto">          
                <input class="campo_texto_nom" type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $nombre;?>" >
                </div>
              </div>
              
              <div class="row mt-1">
                <div class="col-lg-4">     
                <label for="idetificacion">Número de documento</label> 
                </div>
                <div class="col-auto">          
               <input class="CampoTexto" type="number" name="identificacion" class="form-control" value="<?php echo $identificacion;?>">
                </div>
            </div>
              <div class="row mt-1">
                <div class="col-lg-4"> <label for="rol">Rol</label> </div>
                <div class="col-auto">
                <select name="rol" class="classic" aria-label="rol" id="dinamic_option">
                    <option value="" <?php echo ($rol === null || $rol === '') ? 'selected' : ''; ?>>Seleccione un rol</option>
                    <option value="paciente" <?php echo ($rol === 'paciente') ? 'selected' : ''; ?>>Paciente</option>
                    <option value="administrador" <?php echo ($rol === 'administrador') ? 'selected' : ''; ?>>Administrador</option>
                    <option value="empleado" <?php echo ($rol === 'empleado') ? 'selected' : ''; ?>>Empleado</option>
                </select>
                </div>
              </div>
             
              <div class="row mt-4">
                <div class="col-lg-4">     
                <label for="telefono">Número de teléfono</label> 
                </div>
                <div class="col-auto">          
               <input class="CampoTexto" type="number" name="telefono" class="form-control" value="<?php echo $telefono;?>" >
                </div>
              </div>
            </div>
      
            <div class="col-lg-6 mb-2">
            <div class="row">
                <div class="col-lg-4"> <label for="tipo_documento">Tipo de documento</label> </div>
                <div class="col-auto">
                <select name="tipo_documento" class="classic" aria-label="tipo_documento">
                    <option value="" <?php echo ($tipo_documento === null || $tipo_documento === '') ? 'selected' : ''; ?>>Seleccione un tipo de documento</option>
                    <option value="CC" <?php echo ($tipo_documento === 'CC') ? 'selected' : ''; ?>>CC</option>
                    <option value="CE" <?php echo ($tipo_documento === 'CE') ? 'selected' : ''; ?>>CE</option>
                    <option value="TI" <?php echo ($tipo_documento === 'TI') ? 'selected' : ''; ?>>TI</option>
                    <option value="RC" <?php echo ($tipo_documento === 'RC') ? 'selected' : ''; ?>>RC</option>
                    <option value="PASAPORTE" <?php echo ($tipo_documento === 'PASAPORTE') ? 'selected' : ''; ?>>PASAPORTE</option>
                </select>

                </div>
              </div>
              
              <div class="row mt-4">
                <div class="col-lg-4"> <label for="password">Contraseña</label> </div>
                <div class="col-auto">
                <input class="CampoTexto" type="password" name="password" class="form-control" value="<?php echo $password;?>" >
                </div>
              </div>

              <div class="row mt-1">
                <div class="col-lg-4">     
                <label for="direccion">Dirección</label> 
                </div>
                <div class="col-auto">          
               <input class="CampoTexto" type="text" name="direccion" class="form-control" value="<?php echo $direccion;?>" >
                </div>
              </div>

              <div class="row mt-1">
                <div class="col-lg-4">     
                <label for="email">Correo</label> 
                </div>
                <div class="col-auto">          
               <input class="CampoTexto" type="email" name="email" class="form-control" value="<?php echo $email;?>" >
                </div>
              </div>
              
            </div>
          </div>

          <!--container dinámico que se oculta-->
          <div class="oculto" id="hidden_container">
          <div  class="container-fluid row">
            <!-- Formulario que depende de la selección paciente-->
              <div class="row">
                <div class="col-lg-2"> <label for="edad">Edad</label></div>
                <div class="col-lg-2">
                <input class="CampoTexto ms-1" type="number" name="edad" value="<?php echo $edad;?>">
                </div>
                <div class="col-2"> </div>
                <div class="col-lg-2 ms-2"> <label for="RH">RH</label> </div>
                <div class="col-2 ms-2">
                  <select name="rh" class="classic" aria-label="rh">
                      <option value="" <?php echo ($rh === null || $rh === '') ? 'selected' : ''; ?>>Seleccione un RH</option>
                      <option value="+" <?php echo ($rh === '+') ? 'selected' : ''; ?>>+</option>
                      <option value="-" <?php echo ($rh === '-') ? 'selected' : ''; ?>>-</option>
                  </select>
                </div>
              </div>
              <div class="row mt-2">
                
              </div>
              <div class="row mt-2">
                <div class="col-lg-2"> <label for="grupo_sanguineo">Grupo sanguineo</label> </div>
                <div class="col-2 ms-1">
                <select name="grupo_sanguineo" class="classic" aria-label="grupo_sanguineo">
                    <option value="" <?php echo ($grupo_sanguineo === null || $grupo_sanguineo === '') ? 'selected' : ''; ?>>Seleccione una opción</option>
                    <option value="O" <?php echo ($grupo_sanguineo === 'O') ? 'selected' : ''; ?>>O</option>
                    <option value="A" <?php echo ($grupo_sanguineo === 'A') ? 'selected' : ''; ?>>A</option>
                    <option value="B" <?php echo ($grupo_sanguineo === 'B') ? 'selected' : ''; ?>>B</option>
                    <option value="AB" <?php echo ($grupo_sanguineo === 'AB') ? 'selected' : ''; ?>>AB</option>
                </select>

                </div>
              </div>
          </div>
          </div>
          <!-- Se cierra el container dinámico-->
          <div class=" row justify-content-center">
                <div class="col-sm-auto mb-4"> <button id="botonNaranja" type="submit">Actualizar</button></div>
              </div>
            </form>
          
          
<script src="js/actualizar_usuario.js"></script>
<script src="js/form_dinamico.js"></script>

</body>

</html>