document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.getElementById("formulario_AgregarMarcaProveedor");

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
        xhr.open("POST", "http://localhost:83/ProyectoSena/ProyectoSena/php/registro_AgregarMarcaProveedor.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Capturar los valores del formulario
        var nit = encodeURIComponent(document.getElementsByName("nit")[0].value);
        var razon_social = encodeURIComponent(document.getElementsByName("razon_social")[0].value);
        var direccion = encodeURIComponent(document.getElementsByName("direccion")[0].value);
        var telefono = encodeURIComponent(document.getElementsByName("telefono")[0].value);
        var correo = encodeURIComponent(document.getElementsByName("correo")[0].value);

            // Validación de razón social (no puede estar vacío)
            if (razon_social === "") {
            alert("La razón social no puede estar vacía.");
            return;  // Detener el envío si la razón social está vacía
        }

        // Validación de dirección (no puede estar vacío)
        if (direccion === "") {
            alert("La dirección no puede estar vacía.");
            return;  // Detener el envío si la dirección está vacía
        }

        // Validación de teléfono (debe ser numérico y entre 7 y 10 dígitos)
        

        // Validación de marca (no puede estar vacío)
        if (marca === "") {
            alert("Error: El campo Marca no puede estar vacío.");
            return;  // Detener el envío del formulario si la marca está vacía
        }
        
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
