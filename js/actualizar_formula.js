document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.getElementById("formFormulaAct");

    formulario.addEventListener("submit", function(event) {
        event.preventDefault();  // Prevenir el envío normal del formulario

        // Crear la solicitud XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/ProyectoSena/ProyectoSena/php/actualizar_formula.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Capturar los valores del formulario
        var idExamen = encodeURIComponent(document.getElementsByName("idExamen")[0].value); // Agregar este campo
        var fecha = encodeURIComponent(document.getElementsByName("fecha")[0].value);
        var profesional = encodeURIComponent(document.getElementsByName("profesional")[0].value);
        var ojo_derecho = encodeURIComponent(document.getElementsByName("ojo_derecho")[0].value);
        var ojo_izquierdo = encodeURIComponent(document.getElementsByName("ojo_izquierdo")[0].value);
        var distancia_pupilar = encodeURIComponent(document.getElementsByName("distancia_pupilar")[0].value);

        // Preparar los datos para enviar, incluyendo identificación
        var data = "idExamen=" + idExamen + "&fecha=" + fecha + "&profesional=" + profesional + 
                   "&ojo_derecho=" + ojo_derecho + "&ojo_izquierdo=" + ojo_izquierdo + "&distancia_pupilar=" + distancia_pupilar;
        xhr.send(data);

        // Procesar la respuesta del servidor
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    var respuesta = JSON.parse(xhr.responseText);
                    if (respuesta.estado === "exito") {  // Coincidir con "Exito" que envías en PHP
                        alert("Éxito: " + respuesta.mensaje);
                        window.location.href = "listar_examen.php";
                    } else if (respuesta.estado === "error") {
                        alert("Error: " + respuesta.mensaje);
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

