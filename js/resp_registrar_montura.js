document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.getElementById("formulario_montura_marca_posicion");

    formulario.addEventListener("submit", function(event) {
        event.preventDefault();  // Prevenir el envío normal del formulario

        // Capturar los valores del formulario
        var marca = document.getElementsByName("marca")[0].value;
        var material = document.getElementsByName("material")[0].value;
        var color = document.getElementsByName("color")[0].value;
        var precio = document.getElementsByName("precio")[0].value;
        var referencia = document.getElementsByName("referencia")[0].value;
        var posicion = document.getElementsByName("posicion")[0].value;

        // Validar que los campos no estén vacíos
        if (!marca || !material || !color || !precio || !referencia || !posicion) {
            alert("Por favor, complete todos los campos.");
            return;  // Detener el envío si hay campos vacíos
        }

        // Validar que el precio esté entre $50.000 y $10.000.000
        var precioNumerico = parseInt(precio.replace(/\D/g, '')); // Convertir el precio a número eliminando cualquier no numérico (como "$")
        
        if (isNaN(precioNumerico) || precioNumerico < 50000 || precioNumerico > 10000000) {
            alert("El precio debe estar entre $50,000 pesos colombianos y $10,000,000 de pesos colombianos.");
            return;  // Detener el envío si el precio es inválido
        }

        // Validar si la referencia ya existe
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/ProyectoSena/ProyectoSena/php/verificar_referencia.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            if (xhr.status === 200) {
                var respuesta = JSON.parse(xhr.responseText);
                
                if (respuesta.existe) {
                    alert("Error: La referencia ya existe.");
                } else {
                    // Si la referencia no existe, enviar los datos del formulario
                    enviarFormulario();
                }
            } else {
                alert("Error al verificar la referencia.");
            }
        };

        xhr.send("referencia=" + encodeURIComponent(referencia));
    });

    function enviarFormulario() {
        var formulario = document.getElementById("formulario_montura_marca_posicion");

        var xhr = new XMLHttpRequest();
        xhr.open("POST", formulario.action, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

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

        xhr.onerror = function() {
            alert("Error: Problema de conexión con el servidor.");
        };
    }
});
