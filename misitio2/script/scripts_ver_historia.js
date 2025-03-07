document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggleButton');
    const accordion = document.getElementById('accordion');
    const commentsContainer = document.getElementById('commentsContainer');
    const commentForm = document.getElementById('commentForm');

    toggleButton.addEventListener('click', function() {
        if (accordion.classList.contains('show')) {
            accordion.classList.remove('show');
            setTimeout(() => {
                accordion.style.display = 'none';
            }, 400);
        } else {
            accordion.style.display = 'block';
            setTimeout(() => {
                accordion.classList.add('show');
            }, 10);
            loadComments(); // Cargar los comentarios al mostrar la sección de comentarios
        }
    });

    function loadComments() {
        const historiaId = toggleButton.getAttribute('data-id'); // Asegúrate de que el toggleButton tenga data-id correctamente
        fetch(`php/get_comments.php?historia_id=${historiaId}`)
            .then(response => response.json())
            .then(data => {
                commentsContainer.innerHTML = '';
                data.forEach(comment => {
                    const commentElement = document.createElement('div');
                    commentElement.classList.add('comment');
                    commentElement.innerHTML = `
                        <p><strong><a href="perfil.php?user=${comment.username}" class="username-link">${comment.username}</a></strong> dice:</p>
                        <p>${comment.content}</p>
                    `;
                    commentsContainer.appendChild(commentElement);
                });
            })
            .catch(error => console.error('Error al cargar los comentarios:', error));
    }

    commentForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(commentForm);
        fetch('php/post_comment.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                commentForm.reset();
                loadComments(); 
            } else {
                alert('Error al enviar el comentario');
            }
        })
        .catch(error => console.error('Error al enviar el comentario:', error));
    });
});
