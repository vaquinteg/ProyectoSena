document.addEventListener("DOMContentLoaded", function () {
    var formulario = document.getElementById("formUsuario");

    formulario.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevenir el envío normal del formulario

        // Crear la solicitud XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/ProyectoSena/ProyectoSena/php/actualizar_usuario.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Capturar los valores del formulario
        var idUsuario = encodeURIComponent(document.getElementsByName("idUsuario")[0].value);
        var nombre = encodeURIComponent(document.getElementsByName("nombre")[0].value);
        var tipo_documento = encodeURIComponent(document.getElementsByName("tipo_documento")[0].value);
        var identificacion = encodeURIComponent(document.getElementsByName("identificacion")[0].value);
        var rol = encodeURIComponent(document.getElementsByName("rol")[0].value);
        var email = encodeURIComponent(document.getElementsByName("email")[0].value);
        var password = encodeURIComponent(document.getElementsByName("password")[0].value);
        var telefono = encodeURIComponent(document.getElementsByName("telefono")[0].value);
        var direccion = encodeURIComponent(document.getElementsByName("direccion")[0].value);

        // Datos adicionales si el rol es paciente
        var data = "idUsuario=" + idUsuario +
            "&nombre=" + nombre +
            "&tipo_documento=" + tipo_documento +
            "&identificacion=" + identificacion +
            "&rol=" + rol +
            "&email=" + email +
            "&password=" + password +
            "&telefono=" + telefono +
            "&direccion=" + direccion;

        if (rol === "paciente") {
            var edad = encodeURIComponent(document.getElementsByName("edad")[0].value);
            var rh = encodeURIComponent(document.getElementsByName("rh")[0].value);
            var grupo_sanguineo = encodeURIComponent(document.getElementsByName("grupo_sanguineo")[0].value);

            data += "&edad=" + edad + "&rh=" + rh + "&grupo_sanguineo=" + grupo_sanguineo;
        }

        // Enviar los datos
        xhr.send(data);
        // Procesar la respuesta del servidor
        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log("Respuesta raw del servidor:", xhr.responseText); // Añadido
                try {
                    var respuesta = JSON.parse(xhr.responseText);
                    console.log("Respuesta parseada:", respuesta); // Añadido
                    if (respuesta.estado.toLowerCase() === "exito") {
                        alert("Éxito: " + respuesta.mensaje);
                        window.location.href = "listar_usuario.php";
                    } else if (respuesta.estado.toLowerCase() === "error") {
                        alert("Error: " + respuesta.mensaje);
                    } else {
                        alert("Respuesta inesperada: " + respuesta.mensaje);
                    }
                } catch (e) {
                    console.error("Error en el parsing:", e); // Añadido
                    alert("Error al procesar la respuesta del servidor.");
                }
            } else {
                alert("No se pudo procesar la solicitud.");
            }
        };

        // Manejar errores de red o conexión
        xhr.onerror = function () {
            alert("Error: Problema de conexión con el servidor.");
        };
    });
});
