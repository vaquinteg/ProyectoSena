document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.getElementById("formulario_editar_proveedor_marca");

    formulario.addEventListener("submit", function(event) {
        event.preventDefault();  // Prevenir el envío normal del formulario

        // Capturar el valor del campo 'marca'
        var marca = document.getElementsByName("marca")[0].value.trim();

        // Validar si el campo 'marca' está vacío
        if (marca === "") {
            alert("Error: El campo Marca no puede estar vacío.");
            return;  // Detener el envío del formulario si la marca está vacía
        }

        // Crear la solicitud XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost:83/ProyectoSena/ProyectoSena/editar_proveedor.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Capturar los valores del formulario
        var nit = encodeURIComponent(document.getElementsByName("nit")[0].value);
        var razon_social = encodeURIComponent(document.getElementsByName("razon_social")[0].value);
        var direccion = encodeURIComponent(document.getElementsByName("direccion")[0].value);
        var telefono = encodeURIComponent(document.getElementsByName("telefono")[0].value);
        var correo = encodeURIComponent(document.getElementsByName("correo")[0].value);

        // Preparar los datos para enviar
        var data = "nit=" + nit + "&razon_social=" + razon_social + "&direccion=" + direccion + "&telefono=" + telefono + "&correo=" + correo + "&marca=" + marca;
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