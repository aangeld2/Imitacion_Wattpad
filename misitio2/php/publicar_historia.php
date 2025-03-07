<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "Error: No tienes permiso para realizar esta acción.";
    exit();
}

include('config.php');

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $storyId = intval($_POST['id']);
    $autor_id = $_SESSION['user_id'];

    // Asegúrate de que la historia pertenece al usuario
    $query = "UPDATE Historias SET publicado = TRUE WHERE id = $storyId AND autor_id = $autor_id";

    if ($conn->query($query) === TRUE) {
        echo "Éxito: Historia publicada.";
    } else {
        echo "Error publicando la historia: " . $conn->error;
    }
}

$conn->close();
?>
