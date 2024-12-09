<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    <title>Lista de usuarios</title>
</head>
<body>
    
 <?php include 'menu.php'; ?>


 <div class="container-fluid row m-1">
  <h2 class="ntitulo" style="text-align: center;">Lista de Usuarios y Pacientes</h2>
        <div class="row mt-3">
                <div class="col-auto">
                    <input required class="CampoTexto" type="number" id="buscar" name="buscar" placeholder="Ingrese documento del usuario o paciente" style="width: 400px;">
                </div>
                <div class="col-auto"> 
                    <button class="botonBuscar" onclick="buscarUsuarios()">Buscar</button>
                </div>
                <div class="col-auto"> 
                    <button class="botonBuscar" style="width: 200px" onclick="window.location.href='http://localhost/ProyectoSena/ProyectoSena/crear_usuario.php'">Crear nuevo</button>
                </div>
        </div>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre y Apellido</th>
        <th>identificación</th>
        <th>Tipo documento</th>
        <th>Rol</th>
        <th>E-mail</th>
        <th>Teléfono</th>
        <th>Dirección</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php
                // Conexión a la base de datos
                $conn = new mysqli('localhost', 'root', '', 'proyectosena', 3306);
                
                // Verificar conexión
                if ($conn->connect_error) {
                    die("Error de conexión: " . $conn->connect_error);
                }

                // Preparar la consulta SQL
                $sql = "SELECT idUsuario, nombre, email, rol, identificacion, tipo_documento, 
                                telefono, direccion
                        FROM usuario
                        ORDER BY idUsuario";

                // Ejecutar la consulta
                $result = $conn->query($sql);

                // Verificar si hay resultados
                if ($result && $result->num_rows > 0) {
                    // Mostrar los datos
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['idUsuario']}</td>
                                <td>{$row['nombre']}</td>
                                <td>{$row['identificacion']}</td>
                                <td>{$row['tipo_documento']}</td>
                                <td>{$row['rol']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['telefono']}</td>
                                <td>{$row['direccion']}</td>
                                <td>
                                  <a href='editar_usuario.php?idUsuario={$row['idUsuario']}' class='btn btn-outline-dark btn-sm'>Editar</a>
                                  <button onclick='confirmarEliminacion({$row['idUsuario']})' class='btn btn-danger btn-sm mt-1'>Eliminar</button>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No se encontraron registros</td></tr>";
                }

                // Cerrar la conexión
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    </tbody>
  </table>
</div>

<script src="../ProyectoSena/js/buscar_usuario.js"></script>
</body>
</html>