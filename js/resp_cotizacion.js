document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.getElementById("formCotizacion");

    formulario.addEventListener("submit", function(event) {
        event.preventDefault();  // Prevenir el envío normal del formulario

        // Crear la solicitud XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/ProyectoSena/ProyectoSena/php/registrar_cotizacion.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Capturar los valores del formulario
        var identificacion = encodeURIComponent(document.getElementsByName("identificacion")[0].value);
        var montura = encodeURIComponent(document.getElementsByName("montura")[0].value);
        var marca_lente = encodeURIComponent(document.getElementsByName("marca_lente")[0].value);
        var tipo_lente = encodeURIComponent(document.getElementsByName("tipo_lente")[0].value);
        var filtro_lente = encodeURIComponent(document.getElementsByName("filtro_lente")[0].value);
        var descuento = encodeURIComponent(document.getElementsByName("descuento")[0].value);
        var precio_total = encodeURIComponent(document.getElementsByName("precio_total")[0].value);

        // Preparar los datos para enviar
        var data = "identificacion=" + identificacion + "&montura=" + montura + "&marca_lente=" + marca_lente + "&tipo_lente=" + tipo_lente + "&filtro_lente=" + filtro_lente + "&descuento=" + descuento + "&precio_total=" + precio_total;
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
