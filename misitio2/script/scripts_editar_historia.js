document.addEventListener('DOMContentLoaded', function() {
    const storyTitle = document.getElementById('editTitle');
    const storyDescription = document.getElementById('editDescription');
    const storyCategory = document.getElementById('editCategory');

    const storyToEdit = JSON.parse(localStorage.getItem('storyToEdit'));

    if (storyToEdit) {
        storyTitle.value = storyToEdit.title;
        storyDescription.value = storyToEdit.description;
        storyCategory.value = storyToEdit.category;
    }

    document.getElementById('editStoryForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const updatedTitle = storyTitle.value;
        const updatedDescription = storyDescription.value;
        const updatedCategory = storyCategory.value;

        let stories = JSON.parse(localStorage.getItem('stories')) || [];
        const storyIndex = stories.findIndex(story => story.title === storyToEdit.title);

        if (storyIndex > -1) {
            stories[storyIndex] = { title: updatedTitle, description: updatedDescription, category: updatedCategory };
            localStorage.setItem('stories', JSON.stringify(stories));
            localStorage.removeItem('storyToEdit');
            alert('Historia actualizada exitosamente');
            window.location.href = 'mis_historias.php';
        }
    });
});
