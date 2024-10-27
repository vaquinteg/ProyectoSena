document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.getElementById("formEstado");

    formulario.addEventListener("submit", function(event) {
        event.preventDefault();  // Prevenir el envío normal del formulario

        // Crear la solicitud XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/ProyectoSena/ProyectoSena/php/registrar_estado.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

       
        var identificacion = encodeURIComponent(document.getElementsByName("identificacion")[0].value);
        var id_estado = encodeURIComponent(document.getElementsByName("id_estado")[0].value);
       

        // Preparar los datos para enviar
        var data = "identificacion=" + identificacion + "&id_estado=" + id_estado;
        xhr.send(data);

        // Procesar la respuesta del servidor
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    var respuesta = JSON.parse(xhr.responseText);
                    if (respuesta.estado === "exito") {
                        alert("Éxito: " + respuesta.mensaje);
                    } else if (respuesta.estado === "error") {
                        alert("Error: " + respuesta.mensaje);
                    }
                } catch (e) {
                    alert("Error al enviar información, revise la información ingresada.");
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
