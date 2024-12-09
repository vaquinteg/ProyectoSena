<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    <title>Lista de examenes</title>
</head>
<body>
    
 <?php include 'menu.php'; ?>


 <div class="container-fluid row m-1">
  <h2 class="ntitulo" style="text-align: center;">Lista de Examenes</h2>
        <div class="row">
                <div class="col-2">
                    <input class="CampoTexto" type="number" id="buscar" name="buscar" placeholder="Ingrese ID del paciente">
                </div>
                <div class="col-1"> 
                    <button class="botonBuscar" onclick="buscarExamenes()">Buscar</button>
                </div>
                <div class="col-1"> 
                    <button class="ms-2 botonBuscar" style="width: 200px" onclick="window.location.href='http://localhost/ProyectoSena/ProyectoSena/subir_formula.php'">Agregar examen</button>
                </div>
        </div>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Fecha</th>
        <th>Profesional</th>
        <th>O.D.</th>
        <th>O.I</th>
        <th>D. pupilar</th>
        <th>Documento del paciente</th>
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
                $sql = "SELECT e.idExamen, e.fecha, e.profesional, e.ojo_derecho,
                        e.ojo_izquierdo, e.distancia_pupilar, u.identificacion AS identificacion_paciente
                        FROM examen e
                        INNER JOIN paciente p ON e.paciente_id = p.idPaciente
                        INNER JOIN usuario u ON p.usuario_id = u.idUsuario
                        ORDER BY e.idExamen";

                // Ejecutar la consulta
                $result = $conn->query($sql);

                // Verificar si hay resultados
                if ($result && $result->num_rows > 0) {
                    // Mostrar los datos
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['idExamen']}</td>
                                <td>{$row['fecha']}</td>
                                <td>{$row['profesional']}</td>
                                <td>{$row['ojo_derecho']}</td>
                                <td>{$row['ojo_izquierdo']}</td>
                                <td>{$row['distancia_pupilar']}</td>
                                <td>{$row['identificacion_paciente']}</td>
                                <td>
                                  <a href='editar_examen.php?idExamen={$row['idExamen']}' class='btn btn-outline-dark btn-sm'>Editar</a>
                                  <button onclick='confirmarEliminacion({$row['idExamen']})' class='btn btn-danger btn-sm'>Eliminar</button>
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

<script src="../ProyectoSena/js/buscar_examenes.js"></script>
</body>
</html>