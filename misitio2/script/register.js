document.getElementById('registerForm').addEventListener('submit', function(event) {
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirm_password').value;

    if (password !== confirmPassword) {
        event.preventDefault(); // Evita que el formulario se envíe
        alert('Las contraseñas no coinciden. Por favor, inténtalo de nuevo.');
    }
});
