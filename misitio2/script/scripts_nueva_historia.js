document.getElementById('newStoryForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const title = document.getElementById('title').value;
    const description = document.getElementById('description').value;
    const category = document.getElementById('category').value;
    
    const newStory = { title, description, category };
    
    let stories = JSON.parse(localStorage.getItem('stories')) || [];
    stories.push(newStory);
    localStorage.setItem('stories', JSON.stringify(stories));
    
    alert('Historia creada exitosamente');
    window.location.href = 'mis_historias.php';
});
