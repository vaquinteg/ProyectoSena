document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.getElementById("formUsuario");

    formulario.addEventListener("submit", function(event) {
        event.preventDefault();  // Prevenir el envío normal del formulario

        // Crear la solicitud XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/ProyectoSena/ProyectoSena/php/registrar_usuario.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Capturar los valores del formulario
        var nombre = encodeURIComponent(document.getElementsByName("nombre")[0].value); // Agregar este campo
        var tipo_documento = encodeURIComponent(document.getElementsByName("tipo_documento")[0].value);
        var identificacion = encodeURIComponent(document.getElementsByName("identificacion")[0].value);
        var rol = encodeURIComponent(document.getElementsByName("rol")[0].value);
        var email = encodeURIComponent(document.getElementsByName("email")[0].value);
        var password = encodeURIComponent(document.getElementsByName("password")[0].value);
        var telefono = encodeURIComponent(document.getElementsByName("telefono")[0].value);
        var direccion = encodeURIComponent(document.getElementsByName("direccion")[0].value);

        // Preparar los datos para enviar, incluyendo identificación
        var data = "nombre=" + nombre + "&tipo_documento=" + tipo_documento + "&identificacion=" + identificacion + 
                   "&rol=" + rol + "&email=" + email + "&password=" + password + "&telefono=" + telefono + "&direccion=" + direccion;
        xhr.send(data);

        // Procesar la respuesta del servidor
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    var respuesta = JSON.parse(xhr.responseText);
                    if (respuesta.estado === "exito") {  // Coincidir con "Exito" que envías en PHP
                        alert("Éxito: " + respuesta.mensaje);
                    } else if (respuesta.estado === "error") {
                        alert("Error: " + respuesta.mensaje);
                    } else if (respuesta.estado === "inconsistencia") {
                        alert("Inconsistencia: " + respuesta.mensaje);
                    }
                } catch (e) {
                    alert("Error al procesar la respuesta del servidor.");
                }
            } else {
                alert("No se pudo procesar la solicitud.");
            }
        };

        // Manejar errores de red o conexión
        xhr.onerror = function() {
            alert("Error: Problema de conexión con el servidor.");
        };
    });
});
