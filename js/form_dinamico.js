const selectRol = document.getElementById('dinamic_option');
const hiddenContainer = document.getElementById('hidden_container');


// Escucha el evento 'change' del select
selectRol.addEventListener('change', function () {
// Verifica si la opción seleccionada es "paciente"
if (this.value === 'paciente') {
    hiddenContainer.classList.remove('oculto'); // Muestra el contenedor
} else {
    hiddenContainer.classList.add('oculto'); // Oculta el contenedor
}
});
