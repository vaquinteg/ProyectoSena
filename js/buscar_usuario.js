// Obtener el valor del campo de texto
function confirmarEliminacion(idUsuario) {
    if (confirm('¿Está seguro de que desea eliminar este usuario?')) {
        fetch(`http://localhost/ProyectoSena/ProyectoSena/php/eliminar_usuario.php?idUsuario=${idUsuario}`)
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
                alert('Ocurrió un error: El paciente puede tener un examen o una cotización y no puede ser eliminado');
                window.location.href = 'listar_usuario.php';
            });
    }
}

function buscarUsuarios() {
const idPaciente = document.getElementById('buscar').value;

// Verificar que el valor no esté vacío y sea un número válido
if (!idPaciente || isNaN(idPaciente)) {
    alert('Por favor, ingresa un ID de paciente válido.');
} else {
    // Enviar una solicitud AJAX al servidor
    fetch(`http://localhost/ProyectoSena/ProyectoSena/php/buscar_usuario.php?identificacion=${parseInt(idPaciente)}`)
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
                    <td>${row.idUsuario}</td>
                    <td>${row.nombre}</td>
                    <td>${row.identificacion}</td>
                    <td>${row.tipo_documento}</td>
                    <td>${row.rol}</td>
                    <td>${row.email}</td>
                    <td>${row.telefono}</td>
                    <td>${row.direccion}</td>
                    <td>
                        <a href='editar_usuario.php?idUsuario=${row.idUsuario}' class='btn btn-outline-dark btn-sm'>Editar</a>
                        <button onclick='confirmarEliminacion(${row.idUsuario})' class='btn btn-danger btn-sm'>Eliminar</button>
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