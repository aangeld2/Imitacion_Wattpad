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

$username = $_SESSION['username'];
$query = "SELECT * FROM Usuarios WHERE nombre_usuario = '$username'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();  
} else {
    echo "No se encontraron datos del usuario.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="css/styles_perfil.css">
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
            <h1>Perfil</h1>
            <form id="profileForm" action="php/guardar_perfil.php" method="POST">
                <div class="form-group">
                    <label for="username">Nombre de usuario:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['nombre_usuario']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['correo']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="bio">Biografía:</label>
                    <textarea id="bio" name="bio" rows="5"><?php echo htmlspecialchars($user['biografia']); ?></textarea>
                </div>
                <button type="submit">Guardar cambios</button>
            </form>
        </main>
    </div>
    <script src="script/scripts_perfil.js"></script>
</body>
</html>
