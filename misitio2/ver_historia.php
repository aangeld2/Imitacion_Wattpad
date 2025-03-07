<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

include('php/config.php');  

$historia_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener la historia
$query = "SELECT * FROM Historias WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $historia_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $historia = $result->fetch_assoc();
} else {
    echo "<p>Historia no encontrada.</p>";
    exit();
}
$stmt->close();

// Obtener los comentarios
$query = "SELECT * FROM Comentarios WHERE historia_id = ? ORDER BY fecha DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $historia_id);
$stmt->execute();
$comentarios = $stmt->get_result();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($historia['titulo']); ?></title>
    <link rel="stylesheet" href="css/styles_ver_historia.css">
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
                <button id="toggleButton" data-id="<?php echo $historia_id; ?>">Comentarios</button>
                <li><a href="#">Configuración</a></li>
            </ul>
        </aside>
        <main class="content">
            <h1><?php echo htmlspecialchars($historia['titulo']); ?></h1>
            <div class="story-content">
                <?php echo nl2br(htmlspecialchars($historia['contenido'])); ?>
            </div>
            <p><strong>Categoría:</strong> <?php echo htmlspecialchars($historia['categoria']); ?></p>
        </main>
        <div id="accordion" class="accordion-content">
            <h2>Comentarios</h2>
            <?php while ($comentario = $comentarios->fetch_assoc()): ?>
                <div class="comment">
                    <p><strong><?php echo htmlspecialchars($comentario['usuario']); ?></strong> (<?php echo $comentario['fecha']; ?>):</p>
                    <p><?php echo nl2br(htmlspecialchars($comentario['comentario'])); ?></p>
                </div>
            <?php endwhile; ?>

            <form id="commentForm" action="php/guardar_comentario.php" method="POST">
                <input type="hidden" name="historia_id" value="<?php echo $historia_id; ?>">
                <textarea name="comentario" rows="4" placeholder="Escribe tu comentario..." required></textarea>
                <button type="submit">Publicar comentario</button>
            </form>
        </div>
    </div>
    <script src="script/scripts_ver_historia.js"></script>
</body>
</html>
