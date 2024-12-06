function obtenerPrecioMontura() {
    const referencia = document.getElementById('montura').value;
    if (referencia) {
        fetch(`http://localhost:83/ProyectoSena/ProyectoSena/php/obtener_precio_montura.php?referencia=${referencia}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById('precioMontura').value = data.Precio;
                    document.getElementById('precioMontura').dispatchEvent(new Event('input'));
                    
                } else {
                    // Limpiar campos si no se encuentra el proveedor
                    document.getElementById('precioMontura').value = '';
                    
                }
            })
            .catch(error => console.error('Error:', error));
    }
}

function obtenerPrecioMarcaLente() {
    const marca_lente = document.getElementById('marca_lente').value;
    if (marca_lente) {
        fetch(`http://localhost:83/ProyectoSena/ProyectoSena/php/obtener_precio_marca_lente.php?marca_lente=${marca_lente}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById('precio_marca_lente').value = data.precio;
                    document.getElementById('precio_marca_lente').dispatchEvent(new Event('input'));
                    
                } else {
                    // Limpiar campos si no se encuentra el proveedor
                    document.getElementById('precio_marca_lente').value = '';
                    
                }
            })
            .catch(error => console.error('Error:', error));
    }
}


function obtenerPrecioFiltroLente() {
    const filtro_lente = document.getElementById('filtro_lente').value;
    if (filtro_lente) {
        fetch(`http://localhost:83/ProyectoSena/ProyectoSena/php/obtener_precio_filtro_lente.php?filtro_lente=${filtro_lente}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById('precio_filtro_lente').value = data.precio;
                    document.getElementById('precio_filtro_lente').dispatchEvent(new Event('input'));
                    
                } else {
                    // Limpiar campos si no se encuentra el proveedor
                    document.getElementById('precio_filtro_lente').value = '';
                    
                }
            })
            .catch(error => console.error('Error:', error));
    }
}

function obtenerPrecioTipoLente() {
    const tipo_lente = document.getElementById('tipo_lente').value;
    if (tipo_lente) {
        fetch(`http://localhost:83/ProyectoSena/ProyectoSena/php/obtener_precio_tipo_lente.php?tipo_lente=${tipo_lente}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById('precio_tipo_lente').value = data.precio;
                    document.getElementById('precio_tipo_lente').dispatchEvent(new Event('input'));
                    
                } else {
                    // Limpiar campos si no se encuentra el proveedor
                    document.getElementById('precio_tipo_lente').value = '';
                    
                }
            })
            .catch(error => console.error('Error:', error));
    }
}

// Función para calcular el total
function calcularTotal() {
    // Obtener los valores de los precios
    const precioMontura = parseFloat(document.getElementById('precioMontura').value) || 0;
    const precioMarcaLente = parseFloat(document.getElementById('precio_marca_lente').value) || 0;
    const precioFiltroLente = parseFloat(document.getElementById('precio_filtro_lente').value) || 0;
    const precioTipoLente = parseFloat(document.getElementById('precio_tipo_lente').value) || 0;

    // Sumar los precios
    let sumaTotal = precioMontura + precioMarcaLente + precioFiltroLente + precioTipoLente;

    // Obtener el descuento seleccionado
    const descuento = document.querySelector('select[name="descuento"]').value;
    let descuentoValor = 0;

    if (descuento) {
        // Convertir el descuento a porcentaje (por ejemplo, "10%" a 0.10)
        descuentoValor = parseFloat(descuento) / 100;
        // Aplicar el descuento
        sumaTotal -= sumaTotal * descuentoValor;
    }

    // Actualizar el campo total
    document.getElementById('total').value = sumaTotal.toFixed(2);
}

// Event listeners para actualizar el total automáticamente
document.getElementById('precioMontura').addEventListener('input', calcularTotal);
document.getElementById('precio_marca_lente').addEventListener('input', calcularTotal);
document.getElementById('precio_filtro_lente').addEventListener('input', calcularTotal);
document.getElementById('precio_tipo_lente').addEventListener('input', calcularTotal);
document.querySelector('select[name="descuento"]').addEventListener('change', calcularTotal);
