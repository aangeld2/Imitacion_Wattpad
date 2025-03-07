<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.html");
    exit();
}

include('config.php');

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $storyId = intval($_POST['storyId']);
    $titulo = $conn->real_escape_string($_POST['editTitle']);
    $descripcion = $conn->real_escape_string($_POST['editDescription']);
    $categoria = $conn->real_escape_string($_POST['editCategory']);
    $contenido = $conn->real_escape_string($_POST['content']);

    $query = "UPDATE Historias SET titulo='$titulo', descripcion='$descripcion', categoria='$categoria', contenido='$contenido' WHERE id=$storyId AND autor_id=" . $_SESSION['user_id'];

    if ($conn->query($query) === TRUE) {
        header("Location: ../mis_historias.php");
        exit();
    } else {
        echo "Error actualizando la historia: " . $conn->error;
    }
}

$conn->close();
?>
