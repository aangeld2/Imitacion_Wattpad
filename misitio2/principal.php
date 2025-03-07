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

$query = "SELECT * FROM Historias WHERE publicado = 1";  
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="css/styles_principal.css">
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
            <h1>Historias Recomendadas</h1>
            <div id="storiesContainer">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<a href='ver_historia.php?id=" . $row['id'] . "' class='story-link'>";
                        echo "<div class='story-card'>";
                        echo "<h2>" . htmlspecialchars($row['titulo']) . "</h2>";
                        echo "<p>" . htmlspecialchars($row['descripcion']) . "</p>";
                        echo "<p><strong>Categoría:</strong> " . htmlspecialchars($row['categoria']) . "</p>";
                        echo "</div>";
                        echo "</a>";
                    }
                } else {
                    echo "<p>No hay historias publicadas en este momento.</p>";
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
