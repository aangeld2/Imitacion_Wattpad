document.addEventListener('DOMContentLoaded', function() {
    // Limpiar el almacenamiento local (opcional)
    localStorage.clear();

    // Redirigir al usuario a la página de inicio de sesión después de 2 segundos
    setTimeout(function() {
        window.location.href = 'index.html';
    }, 2000);
});
