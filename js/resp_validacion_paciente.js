document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.getElementById("formPaciente");

    formulario.addEventListener("submit", function(event) {
        event.preventDefault();  // Prevenir el envío normal del formulario

        // Crear la solicitud XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost:83/ProyectoSena/ProyectoSena/php/registrar_paciente.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Capturar los valores del formulario
       // var identificacion = encodeURIComponent(document.getElementsByName("identificacion")[0].value);
        var edad = encodeURIComponent(document.getElementsByName("edad")[0].value);
        var rh = encodeURIComponent(document.getElementsByName("rh")[0].value);
        var grupo_sanguineo = encodeURIComponent(document.getElementsByName("grupo_sanguineo")[0].value);
       

        // Preparar los datos para enviar
        var data = "edad=" + edad + "&rh=" + rh + "&grupo_sanguineo=" + grupo_sanguineo;// +"&identificacion=" + identificacion;
        xhr.send(data);

        // Procesar la respuesta del servidor
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    var respuesta = JSON.parse(xhr.responseText);
                    if (respuesta.estado === "Exito") {
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
