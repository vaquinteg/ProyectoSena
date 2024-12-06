document.addEventListener("DOMContentLoaded", function() {
    const formulario = document.getElementById("formulario_editar_montura");
  
    formulario.addEventListener("submit", function(e) {
      e.preventDefault(); // Prevenir el envío del formulario antes de la validación
  
      const referencia = formulario.querySelector("input[name='referencia']").value;
      const precio = formulario.querySelector("input[name='precio']").value;
      const idMontura = formulario.querySelector("input[name='idMontura']").value;

      if (!referencia || !precio) {
        alert("Por favor, complete todos los campos.");
        return; // Detener el envío si algún campo está vacío
    }

    // Validación del precio: debe estar entre 50,000 y 10,000,000
    const precioNumerico = parseFloat(precio);
    if (isNaN(precioNumerico) || precioNumerico < 50000 || precioNumerico > 10000000) {
        alert("El precio debe estar entre $50,000 pesos colombianos y $10,000,000 de pesos colombianos.");
        return; // Detener el envío si el precio no está en el rango
    }
  
      // Verificar si la referencia ya existe en otros registros (no el actual)
      verificarReferencia(referencia, idMontura).then(existe => {
        if (existe) {
          alert("La referencia ya está en uso, por favor elija otra.");
        } else {
          // Si la referencia es válida, proceder a enviar el formulario
          enviarFormulario();
        }
      });
    });
  
    function verificarReferencia(referencia, idMontura) {
      return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "php/verificar_referencia.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            const respuesta = JSON.parse(xhr.responseText);
            resolve(respuesta.existe); // Responder con verdadero o falso dependiendo de si la referencia existe
          }
        };
  
        xhr.send("referencia=" + referencia + "&idMontura=" + idMontura); // Enviar el idMontura para excluirlo de la verificación
      });
    }
  
    function enviarFormulario() {
      const formData = new FormData(formulario);
  
      const xhr = new XMLHttpRequest();
      xhr.open("POST", formulario.action, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          const respuesta = JSON.parse(xhr.responseText);
          if (respuesta.estado === "exito") {
            alert(respuesta.mensaje);
            window.location.href = respuesta.redirect; // Redirigir después de guardar los cambios
          } else {
            alert(respuesta.mensaje); // Mostrar mensaje de error
          }
        }
      };
  
      xhr.send(formData);
    }
  });
  
 
  
 
  