<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");  
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Historia</title>
    <link rel="stylesheet" href="css/styles_nueva_historia.css">
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
            <h1>Crear Nueva Historia</h1>
            <form id="newStoryForm" action="php/guardar_historia.php" method="POST">
                <div class="form-group">
                    <label for="title">Título:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Descripción:</label>
                    <textarea id="description" name="description" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="category">Categoría:</label>
                    <select id="category" name="category" required>
                        <option value="Categoría 1">Categoría 1</option>
                        <option value="Categoría 2">Categoría 2</option>
                        <option value="Categoría 3">Categoría 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="content">Contenido de la Historia:</label>
                    <textarea id="content" name="content" rows="10" required></textarea>
                </div>
                <button type="submit">Crear Historia</button>
            </form>

        </main>
    </div>
    <script src="cript/scripts_nueva_historia.js"></script>
</body>
</html>
