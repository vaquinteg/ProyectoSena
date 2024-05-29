const loginForm = document.getElementById('loginForm');
const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');

loginForm.addEventListener('submit', (event) => {
    event.preventDefault(); // Prevent default form submission

    const username = usernameInput.value.trim();
    const password = passwordInput.value.trim();

    // Simulate login validation (replace with your actual validation logic)
    if (username === 'admin' && password === 'password123') {
        // Login successful, redirect to home page
        window.location.href = 'home.html'; // Replace with your actual home page URL
    } else {
        // Login failed, display error message
        alert('Su contraseña es invalida');
    }
});