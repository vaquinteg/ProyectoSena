const loginForm = document.getElementById('loginForm');
const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');   


loginForm.addEventListener('submit', (event) => {
    event.preventDefault();

    const username = usernameInput.value.trim();   

    const password = passwordInput.value.trim();

    // Validación de entrada
    if (username === '' || password === '') {
        alert('Por favor, ingrese su nombre de usuario y contraseña.');
        return;
    }

    // Validación adicional según tus requisitos (por ejemplo, patrones de contraseña)

    // Simulación de validación de inicio de sesión
    if (username === 'admin' && password === 'admin') {
        // Inicio de sesión exitoso, redireccionar a la página de inicio
        window.location.href = 'home.php';
    } else {
        // Inicio de sesión fallido, mostrar mensaje de error
        alert('Su contraseña es inválida.');
    }
});