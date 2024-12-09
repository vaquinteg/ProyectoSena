document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.getElementById("formFormula");

    formulario.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevenir el envío normal del formulario

        // Crear la solicitud XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/ProyectoSena/ProyectoSena/php/registrar_formula.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Capturar los valores del formulario
        var identificacion = encodeURIComponent(document.querySelector("[name='identificacion']").value);
        var fecha = encodeURIComponent(document.querySelector("[name='fecha']").value);
        var profesional = encodeURIComponent(document.querySelector("[name='profesional']").value);
        var ojo_derecho = encodeURIComponent(document.querySelector("[name='ojo_derecho']").value);
        var ojo_izquierdo = encodeURIComponent(document.querySelector("[name='ojo_izquierdo']").value);
        var distancia_pupilar = encodeURIComponent(document.querySelector("[name='distancia_pupilar']").value);

        // Validar datos antes de enviar
        if (!identificacion || !fecha || !profesional || !ojo_derecho || !ojo_izquierdo || !distancia_pupilar) {
            alert("Por favor, completa todos los campos del formulario.");
            return;
        }

        // Preparar los datos para enviar
        var data = `identificacion=${identificacion}&fecha=${fecha}&profesional=${profesional}` +
                   `&ojo_derecho=${ojo_derecho}&ojo_izquierdo=${ojo_izquierdo}&distancia_pupilar=${distancia_pupilar}`;
        xhr.send(data);

        // Procesar la respuesta del servidor
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    var respuesta = JSON.parse(xhr.responseText);

                    if (respuesta.estado === "exito") {
                        alert("Éxito: " + respuesta.mensaje);
                        window.location.href="http://localhost/ProyectoSena/ProyectoSena/listar_examen.php"; // Limpia el formulario después de enviar
                    } else {
                        alert("Aviso: " + respuesta.mensaje);
                    }
                } catch (e) {
                    console.error("Error al procesar la respuesta:", e);
                    alert("Error al interpretar la respuesta del servidor.");
                }
            } else {
                alert(`Error: El servidor respondió con el código ${xhr.status}.`);
            }
        };

        // Manejar errores de red o conexión
        xhr.onerror = function() {
            alert("Error: No se pudo conectar con el servidor. Por favor, verifica tu conexión.");
        };
    });
});
