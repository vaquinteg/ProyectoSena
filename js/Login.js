document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.getElementById("loginFor");

    formulario.addEventListener("submit", function(event) {
        event.preventDefault();  // Prevenir el envío normal del formulario

        // Crear la solicitud XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost:83/ProyectoSena/ProyectoSena/php/validar_usuario.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Obtener los valores de los campos
        var identificacion = parseInt(document.getElementById("identificacion").value, 10);
        var password = encodeURIComponent(document.getElementById("password").value);

        // Preparar los datos para enviar
        var data = "identificacion=" + identificacion + "&password=" + password;
        xhr.send(data);

        // Procesar la respuesta del servidor
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    var respuesta = JSON.parse(xhr.responseText);
                    if (respuesta.estado === "exito") {
                        alert("Inicio de sesión exitoso: " + respuesta.mensaje);
                        // Redirigir al usuario a la página principal, si es necesario
                        window.location.href = "home.php";
                    } else if (respuesta.estado === "error") {
                        alert("Error: " + respuesta.mensaje);
                    }
                } catch (e) {
                    alert("Error al procesar la respuesta del servidor.");
                }
            } else {
                alert("Error: No se pudo procesar la solicitud.");
            }
        };

        // Manejar errores de red o conexión
        xhr.onerror = function() {
            alert("Error: Problema de conexión con el servidor.");
        };
    });
});
