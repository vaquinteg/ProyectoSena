function obtenerProveedor() {
    const nit = document.getElementById('nit').value;
    if (nit) {
        fetch(`http://localhost/ProyectoSena/ProyectoSena/php/obtener_proveedor.php?nit=${nit}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById('razon_social').value = data.razon_social;
                    document.getElementById('direccion').value = data.direccion;
                    document.getElementById('telefono').value = data.telefono;
                    document.getElementById('correo').value = data.correo;
                } else {
                    // Limpiar campos si no se encuentra el proveedor
                    document.getElementById('razon_social').value = '';
                    document.getElementById('direccion').value = '';
                    document.getElementById('telefono').value = '';
                    document.getElementById('correo').value = '';
                }
            })
            .catch(error => console.error('Error:', error));
    }
}
