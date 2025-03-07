<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");  
    exit();
}

include('php/config.php');  

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$autor_id = $_SESSION['user_id'];  


if (isset($_POST['publish'])) {
    $story_id = $_POST['story_id'];
    $query_publish = "UPDATE Historias SET publicado = 1 WHERE id = $story_id AND autor_id = $autor_id";
    
    if ($conn->query($query_publish) === TRUE) {
        echo "<script>alert('Historia publicada exitosamente');</script>";
    } else {
        echo "<script>alert('Error al publicar la historia');</script>";
    }
}


if (isset($_POST['unpublish'])) {
    $story_id = $_POST['story_id'];
    $query_unpublish = "UPDATE Historias SET publicado = 0 WHERE id = $story_id AND autor_id = $autor_id";
    
    if ($conn->query($query_unpublish) === TRUE) {
        echo "<script>alert('Publicación eliminada exitosamente');</script>";
    } else {
        echo "<script>alert('Error al eliminar la publicación');</script>";
    }
}

$query = "SELECT * FROM Historias WHERE autor_id = $autor_id";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Historias</title>
    <link rel="stylesheet" href="css/styles_mis_historias.css">
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
            <h1>Mis Historias</h1>
            <button id="newStoryButton" onclick="window.location.href='nueva_historia.php'">Nueva Historia</button>
            <div id="storiesContainer">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='story-card'>";
                        echo "<h2>" . htmlspecialchars($row['titulo']) . "</h2>";
                        echo "<p>" . htmlspecialchars($row['descripcion']) . "</p>";
                        echo "<p><strong>Categoría:</strong> " . htmlspecialchars($row['categoria']) . "</p>";
                    //  echo "<p>" . nl2br(htmlspecialchars($row['contenido'])) . "</p>";

                        
                        if ($row['publicado'] == 1) {
                            echo "<p><strong>Estado:</strong> Publicado</p>";
                            echo "<form method='POST' style='display:inline;'>";
                            echo "<input type='hidden' name='story_id' value='" . $row['id'] . "'>";
                            echo "<button type='submit' name='unpublish' class='unpublish-button'>Eliminar Publicación</button>";
                            echo "</form>";
                        } else {
                            echo "<p><strong>Estado:</strong> No publicado</p>";
                            echo "<form method='POST' style='display:inline;'>";
                            echo "<input type='hidden' name='story_id' value='" . $row['id'] . "'>";
                            echo "<button type='submit' name='publish' class='publish-button'>Publicar</button>";
                            echo "</form>";
                        }

                        echo "<button class='edit-button' onclick=\"window.location.href='editar_historia.php?id=" . $row['id'] . "'\">Editar</button>";
                        echo "<button class='delete-button' onclick=\"if(confirm('¿Estás seguro de que quieres eliminar esta historia?')) window.location.href='eliminar_historia.php?id=" . $row['id'] . "'\">Eliminar</button>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No has creado ninguna historia todavía.</p>";
                }
                ?>
            </div>
        </main>
    </div>
</body>
</html>

<?php
$conn->close();
?>
