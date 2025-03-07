document.getElementById('newStoryButton').addEventListener('click', function() {
    window.location.href = 'nueva_historia.php';
});

document.addEventListener('DOMContentLoaded', function() {
    const storiesContainer = document.getElementById('storiesContainer');
    const stories = JSON.parse(localStorage.getItem('stories')) || [];

    stories.forEach(story => {
        const storyCard = document.createElement('div');
        storyCard.classList.add('story-card');
        
        const storyTitle = document.createElement('h2');
        storyTitle.textContent = story.title;
        
        const storyDescription = document.createElement('p');
        storyDescription.textContent = story.description;

        const editButton = document.createElement('button');
        editButton.textContent = 'Editar';
        editButton.classList.add('edit-button');
        editButton.setAttribute('data-id', story.id);  // Asegúrate de asignar el ID correcto
        editButton.addEventListener('click', function() {
            window.location.href = 'editar_historia.php?id=' + story.id;
        });

        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Eliminar';
        deleteButton.classList.add('delete-button');
        deleteButton.setAttribute('data-id', story.id);  // Asegúrate de asignar el ID correcto
        deleteButton.addEventListener('click', function() {
            if (confirm('¿Estás seguro de que quieres eliminar esta historia?')) {
                window.location.href = 'eliminar_historia.php?id=' + story.id;
            }
        });

        storyCard.appendChild(storyTitle);
        storyCard.appendChild(storyDescription);
        storyCard.appendChild(editButton);
        storyCard.appendChild(deleteButton);

        storiesContainer.appendChild(storyCard);
    });

    const editButtons = document.querySelectorAll('.edit-button');
    const deleteButtons = document.querySelectorAll('.delete-button');

    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const storyId = this.getAttribute('data-id');
            window.location.href = 'editar_historia.php?id=' + storyId;
        });
    });

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const storyId = this.getAttribute('data-id');
            if (confirm('¿Estás seguro de que quieres eliminar esta historia?')) {
                window.location.href = 'eliminar_historia.php?id=' + storyId;
            }
        });
    });
});
