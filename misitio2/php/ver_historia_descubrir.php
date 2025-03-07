<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

include('config.php');  


$historia_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


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
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($historia['titulo']); ?></title>
    <link rel="stylesheet" href="../css/styles_principal.css">
</head>
<body>
    <header>
        <div class="logo"></div>
        <nav>
            <ul>
                <li><a href="../principal.php">Inicio</a></li>
                <li><a href="../descubrir.php">Descubrir</a></li>
                <li><a href="../mis_historias.php">Mis historias</a></li>
                <li><a href="../perfil.php">Perfil</a></li>
                <li><a href="logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <main class="content">
            <h1><?php echo htmlspecialchars($historia['titulo']); ?></h1>
            <div class="story-content">
                <?php echo nl2br(htmlspecialchars($historia['contenido'])); ?>
            </div>
            <p><strong>Categoría:</strong> <?php echo htmlspecialchars($historia['categoria']); ?></p>
        </main>
    </div>

</body>
</html>
