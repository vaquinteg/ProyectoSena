document.addEventListener("DOMContentLoaded", function () {
    var formulario = document.getElementById("formUsuario");

    formulario.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevenir el envío normal del formulario

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/ProyectoSena/ProyectoSena/php/registrar_usuario.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Capturar y limpiar los valores del formulario
        function getCleanValue(name) {
            return encodeURIComponent(document.getElementsByName(name)[0].value.trim());
        }

        var nombre = getCleanValue("nombre");
        var tipo_documento = getCleanValue("tipo_documento");
        var identificacion = getCleanValue("identificacion");
        var rol = getCleanValue("rol");
        var email = getCleanValue("email");
        var password = getCleanValue("password");
        var telefono = getCleanValue("telefono");
        var direccion = getCleanValue("direccion");

        var data = `nombre=${nombre}&tipo_documento=${tipo_documento}&identificacion=${identificacion}` +
            `&rol=${rol}&email=${email}&password=${password}&telefono=${telefono}&direccion=${direccion}`;

        if (rol === "paciente") {
            var edad = getCleanValue("edad");
            var rh = getCleanValue("rh");
            var grupo_sanguineo = getCleanValue("grupo_sanguineo");

            data += `&edad=${edad}&rh=${rh}&grupo_sanguineo=${grupo_sanguineo}`;
        }

        xhr.send(data);

        xhr.onload = function () {
            if (xhr.status === 200) {
                try {
                    var respuesta = JSON.parse(xhr.responseText);
                    if (respuesta.estado.toLowerCase() === "exito") {
                        alert("Éxito: " + respuesta.mensaje);
                        window.location.href = "/listar_usuario.php";
                    } else {
                        alert("Error: " + respuesta.mensaje);
                    }
                } catch (e) {
                    alert("Error al procesar la respuesta del servidor.");
                }
            } else {
                alert("No se pudo procesar la solicitud.");
            }
        };

        xhr.onerror = function () {
            alert("Error: Problema de conexión con el servidor.");
        };
    });
});
