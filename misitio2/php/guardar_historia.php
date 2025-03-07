<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.html");
    exit();
}

include('config.php');  // Asegúrate de que la configuración de la base de datos esté incluida

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica que los datos se están recibiendo correctamente
    $titulo = $conn->real_escape_string($_POST['title']);
    $descripcion = $conn->real_escape_string($_POST['description']);
    $categoria = $conn->real_escape_string($_POST['category']);
    $contenido = $conn->real_escape_string($_POST['content']);
    $autor_id = $_SESSION['user_id'];  // Suponiendo que guardaste el ID de usuario en la sesión

    $query = "INSERT INTO Historias (titulo, descripcion, categoria, contenido, autor_id) 
              VALUES ('$titulo', '$descripcion', '$categoria', '$contenido', $autor_id)";

    if ($conn->query($query) === TRUE) {
        header("Location: ../mis_historias.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

$conn->close();
?>

