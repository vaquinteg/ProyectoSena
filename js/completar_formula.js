function obtenerPacienteFormula() {
    const identificacion = document.getElementById('identificacion').value;
    if (identificacion) {
        fetch(`http://localhost/ProyectoSena/ProyectoSena/php/obtener_paciente_formula.php?identificacion=${identificacion}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById('nombre').value = data.nombre;
                    //document.getElementById('direccion').value = data.direccion;
                    //document.getElementById('telefono').value = data.telefono;
                  
                } else {
                    // Limpiar campos si no se encuentra el proveedor
                    document.getElementById('nombre').value = '';
                    //document.getElementById('direccion').value = '';
                    //document.getElementById('telefono').value = '';
                    
                }
            })
            .catch(error => console.error('Error:', error));
    }
}