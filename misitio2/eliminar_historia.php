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

$storyId = isset($_GET['id']) ? intval($_GET['id']) : 0;  // Obtiene el ID de la historia desde la URL

// Asegúrate de que el usuario solo pueda eliminar sus propias historias
$query = "DELETE FROM Historias WHERE id = $storyId AND autor_id = " . $_SESSION['user_id'];

if ($conn->query($query) === TRUE) {
    // Redirige al usuario de vuelta a la página de "Mis Historias"
    header("Location: mis_historias.php");
    exit();
} else {
    echo "Error eliminando la historia: " . $conn->error;
}

$conn->close();
?>
