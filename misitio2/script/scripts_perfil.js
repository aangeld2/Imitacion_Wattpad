document.getElementById('profileForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const bio = document.getElementById('bio').value;

    if (username === '' || email === '') {
        alert('Por favor, complete todos los campos obligatorios.');
        return;
    }

    // Crear un objeto FormData para enviar los datos del formulario
    const formData = new FormData();
    formData.append('username', username);
    formData.append('email', email);
    formData.append('bio', bio);

    // Enviar los datos mediante fetch
    fetch('php/guardar_perfil.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.includes('Error')) {
            alert('Hubo un error al actualizar el perfil.');
            console.log(data);  // Muestra el mensaje de error para depuración
        } else {
            alert('Perfil actualizado exitosamente.');
            window.location.href = 'perfil.php';  // Redirige a la página de perfil
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Hubo un error al enviar la solicitud.');
    });
});
