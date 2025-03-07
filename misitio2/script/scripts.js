document.getElementById('loginForm').addEventListener('submit', function(event) {
    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;

    // Validación básica
    if (username === '' || password === '') {
        alert('Por favor, complete todos los campos.');
        event.preventDefault();
        return;
    }

    // Validación adicional de la longitud de la contraseña
    if (password.length < 6) {
        alert('La contraseña debe tener al menos 6 caracteres.');
        event.preventDefault();
        return;
    }

    // Permite que el formulario se envíe para la validación en el servidor
});




