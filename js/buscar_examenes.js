// Obtener el valor del campo de texto
function confirmarEliminacion(idExamen) {
    if (confirm('¿Está seguro de que desea eliminar este examen?')) {
        fetch(`http://localhost/ProyectoSena/ProyectoSena/php/eliminar_examen.php?idExamen=${idExamen}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                } else {
                    alert(data.message);
                }
                // Redireccionar a la página de listado
                window.location.href = data.redirect;
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al procesar la solicitud');
                window.location.href = 'listar_examen.php';
            });
    }
}

function buscarExamenes() {
const idPaciente = document.getElementById('buscar').value;

// Verificar que el valor no esté vacío y sea un número válido
if (!idPaciente || isNaN(idPaciente)) {
    alert('Por favor, ingresa un ID de paciente válido.');
} else {
    // Enviar una solicitud AJAX al servidor
    fetch(`http://localhost/ProyectoSena/ProyectoSena/php/buscar_examenes.php?identificacion=${parseInt(idPaciente)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor.');
            }
            return response.json();
        })
        .then(data => {
            // Verificar si hay datos devueltos
            if (data.length === 0) {
                alert('No se encontraron registros para el ID de paciente proporcionado.');
                return;
            }

            // Vaciar el cuerpo de la tabla antes de llenarla con nuevos datos
            const tbody = document.querySelector('table tbody');
            tbody.innerHTML = '';

            // Recorrer los datos y agregarlos a la tabla
            data.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${row.idExamen}</td>
                    <td>${row.fecha}</td>
                    <td>${row.profesional}</td>
                    <td>${row.ojo_derecho}</td>
                    <td>${row.ojo_izquierdo}</td>
                    <td>${row.distancia_pupilar}</td>
                    <td>${row.identificacion_paciente}</td>
                    <td>
                        <a href='editar_examen.php?idExamen=${row.idExamen}' class='btn btn-outline-dark btn-sm'>Editar</a>
                        <button onclick='confirmarEliminacion(${row.idExamen})' class='btn btn-danger btn-sm'>Eliminar</button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error al realizar la búsqueda.');
        });
}
}