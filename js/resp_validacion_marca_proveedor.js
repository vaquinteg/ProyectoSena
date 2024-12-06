document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.getElementById("formulario_marca_proveedor");

    formulario.addEventListener("submit", function(event) {
        event.preventDefault();  // Prevenir el envío normal del formulario

        // Capturar los valores de los campos del formulario
        var nit = document.getElementsByName("nit")[0].value.trim();
        var razon_social = document.getElementsByName("razon_social")[0].value.trim();
        var direccion = document.getElementsByName("direccion")[0].value.trim();
        var telefono = document.getElementsByName("telefono")[0].value.trim();
        var correo = document.getElementsByName("correo")[0].value.trim();
        var marca = document.getElementsByName("marca")[0].value.trim();

        // Validación de NIT (debe ser numérico y con un largo adecuado)
        var nitRegex = /^[0-9]{10}$/;  // Aseguramos que el NIT tenga entre 6 y 10 dígitos numéricos
        if (!nitRegex.test(nit)) {
            alert("El NIT debe tener 10 dígitos numéricos.");
            return;  // Detener el envío si el NIT no es válido
        }

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
        var telefonoRegex = /^[0-9]{7,10}$/;
        if (!telefonoRegex.test(telefono)) {
            alert("El teléfono debe tener entre 7 y 10 dígitos numéricos.");
            return;  // Detener el envío si el teléfono no es válido
        }

        // Validación de correo (formato básico de correo electrónico)
        var correoRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!correoRegex.test(correo)) {
            alert("El correo electrónico no es válido.");
            return;  // Detener el envío si el correo no es válido
        }

        // Validación de marca (no puede estar vacío)
        if (marca === "") {
            alert("Error: El campo Marca no puede estar vacío.");
            return;  // Detener el envío del formulario si la marca está vacía
        }

        // Crear la solicitud XMLHttpRequest para verificar si la marca ya existe
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "php/registrar_proveedor_marca.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Preparar los datos para enviar
        var data = "nit=" + encodeURIComponent(nit) + 
                   "&razon_social=" + encodeURIComponent(razon_social) + 
                   "&direccion=" + encodeURIComponent(direccion) + 
                   "&telefono=" + encodeURIComponent(telefono) + 
                   "&correo=" + encodeURIComponent(correo) + 
                   "&marca=" + encodeURIComponent(marca);

        xhr.send(data);

        // Procesar la respuesta del servidor
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    var respuesta = JSON.parse(xhr.responseText);
                    if (respuesta.estado === "exito") {
                        alert("Éxito: " + respuesta.mensaje);
                        // Redirigir a la lista de proveedores y marcas
                        window.location.href = respuesta.redirect;
                    } else if (respuesta.estado === "error") {
                        alert("Error: " + respuesta.mensaje);  // Mostrar error si la marca ya existe
                        
                        if (respuesta.proveedorId) {
                            var mensaje = "El NIT ya existe. ¿Qué deseas hacer?\n\n";
                            mensaje += "1. Editar el proveedor y/o Ver la lista de proveedores \n";
                            mensaje += "2. Agregar marca";

                            var opcion = prompt(mensaje);

                            if (opcion === "1") {
                                window.location.href = "lista_proveedor_marca.php?id=" + respuesta.proveedorId;
                            } else if (opcion === "2") {
                                window.location.href = "AgregarMarcaProveedor.php";
                            }
                        }
                    }
                } catch (e) {
                    alert("Error al procesar la respuesta del servidor.");
                }
            } else {
                alert("Error: No se pudo procesar la solicitud.");
            }
        };

        xhr.onerror = function() {
            alert("Error: Problema de conexión con el servidor.");
        };
    });
});
