const selectRol = document.getElementById('dinamic_option');
const hiddenContainer = document.getElementById('hidden_container');

// Función para mostrar u ocultar el contenedor según el valor del select
function toggleHiddenContainer() {
    if (selectRol.value === 'paciente') {
        hiddenContainer.classList.remove('oculto'); // Muestra el contenedor
    } else {
        hiddenContainer.classList.add('oculto'); // Oculta el contenedor
    }
}

// Llamar a la función al cargar la página para verificar el valor actual
toggleHiddenContainer();

// Escucha el evento 'change' del select
selectRol.addEventListener('change', toggleHiddenContainer);
