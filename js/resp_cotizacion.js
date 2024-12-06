document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.getElementById("formCotizacion");

    formulario.addEventListener("submit", function(event) {
        event.preventDefault();  // Prevenir el envío normal del formulario

        // Capturar los valores del formulario
        var identificacion = document.getElementsByName("identificacion")[0].value.trim();
        var montura = document.getElementsByName("montura")[0].value.trim();
        var marca_lente = document.getElementsByName("marca_lente")[0].value.trim();
        var tipo_lente = document.getElementsByName("tipo_lente")[0].value.trim();
        var filtro_lente = document.getElementsByName("filtro_lente")[0].value.trim();
        var descuento = document.getElementsByName("descuento")[0].value.trim();
        var precio_total = document.getElementsByName("precio_total")[0].value.trim();

        // Validar que los campos no estén vacíos
        if (!identificacion || !montura || !marca_lente || !tipo_lente || !filtro_lente || !precio_total) {
            alert("Todos los campos son obligatorios. Por favor, complete todos los campos.");
            return; // Detener la ejecución si falta algún campo
        }

        // Crear la solicitud XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "php/registrar_cotizacion.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Preparar los datos para enviar
        var data = "identificacion=" + encodeURIComponent(identificacion) + 
                   "&montura=" + encodeURIComponent(montura) + 
                   "&marca_lente=" + encodeURIComponent(marca_lente) + 
                   "&tipo_lente=" + encodeURIComponent(tipo_lente) + 
                   "&filtro_lente=" + encodeURIComponent(filtro_lente) + 
                   "&descuento=" + encodeURIComponent(descuento) + 
                   "&precio_total=" + encodeURIComponent(precio_total);
        xhr.send(data);

        // Procesar la respuesta del servidor
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    var respuesta = JSON.parse(xhr.responseText);
                    if (respuesta.estado === "exito") {
                        alert("Éxito: " + respuesta.mensaje);
                        window.location.href = respuesta.redirect;
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
