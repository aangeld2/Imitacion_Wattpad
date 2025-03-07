<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

include('php/config.php');  // Incluye la configuración de la base de datos

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$storyId = isset($_GET['id']) ? intval($_GET['id']) : 0;  // Obtiene el ID de la historia desde la URL

$query = "SELECT * FROM Historias WHERE id = $storyId AND autor_id = " . $_SESSION['user_id'];
$result = $conn->query($query);

if ($result->num_rows == 1) {
    $story = $result->fetch_assoc();
} else {
    echo "No se encontró la historia o no tienes permiso para editarla.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Historia</title>
    <link rel="stylesheet" href="css/styles_editar_historia.css">
</head>
<body>
    <header>
        <div class="logo"></div>
        <nav>
            <ul>
                <li><a href="principal.php">Inicio</a></li>
                <li><a href="descubrir.php">Descubrir</a></li>
                <li><a href="mis_historias.php">Mis historias</a></li>
                <li><a href="perfil.php">Perfil</a></li>
                <li><a href="php/logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <aside class="sidebar">
            <ul>
                <li><a href="#">Categoría 1</a></li>
                <li><a href="#">Categoría 2</a></li>
                <li><a href="#">Categoría 3</a></li>
                <li><a href="#">Configuración</a></li>
            </ul>
        </aside>
        <main class="content">
            <h1>Editar Historia</h1>
            <form id="editStoryForm" action="php/guardar_cambios.php" method="POST">
                <input type="hidden" name="storyId" value="<?php echo $storyId; ?>">
                <div class="form-group">
                    <label for="editTitle">Título:</label>
                    <input type="text" id="editTitle" name="editTitle" value="<?php echo htmlspecialchars($story['titulo']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="editDescription">Descripción:</label>
                    <textarea id="editDescription" name="editDescription" rows="5" required><?php echo htmlspecialchars($story['descripcion']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="editCategory">Categoría:</label>
                    <select id="editCategory" name="editCategory" required>
                        <option value="Categoría 1" <?php echo $story['categoria'] == 'Categoría 1' ? 'selected' : ''; ?>>Categoría 1</option>
                        <option value="Categoría 2" <?php echo $story['categoria'] == 'Categoría 2' ? 'selected' : ''; ?>>Categoría 2</option>
                        <option value="Categoría 3" <?php echo $story['categoria'] == 'Categoría 3' ? 'selected' : ''; ?>>Categoría 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="content">Contenido de la Historia:</label>
                    <textarea id="content" name="content" rows="10" required><?php echo htmlspecialchars($story['contenido']); ?></textarea>
                </div>
                <button type="submit">Guardar Cambios</button>
            </form>
        </main>
    </div>
</body>
</html>
