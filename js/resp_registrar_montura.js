document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.getElementById("formulario_montura_marca_posicion");

    formulario.addEventListener("submit", function(event) {
        event.preventDefault();  // Prevenir el envío normal del formulario

        // Crear la solicitud XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/ProyectoSena/ProyectoSena/php/select_marca_montura_posicion.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Capturar los valores del formulario
        var marca = encodeURIComponent(document.getElementsByName("marca")[0].value);
        var material = encodeURIComponent(document.getElementsByName("material")[0].value);
        var color = encodeURIComponent(document.getElementsByName("color")[0].value);
        var precio = encodeURIComponent(document.getElementsByName("precio")[0].value);
        var referencia = encodeURIComponent(document.getElementsByName("referencia")[0].value);
        var posicion = encodeURIComponent(document.getElementsByName("posicion")[0].value);

        // Preparar los datos para enviar
        var data = "marca=" + marca + "&material=" + material + "&color=" + color + "&precio=" + precio + "&referencia=" + referencia + "&posicion=" + posicion;
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
