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
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $bio = $conn->real_escape_string($_POST['bio']);
    $currentUsername = $_SESSION['username'];

    // Actualiza los datos del usuario en la base de datos
    $query = "UPDATE Usuarios SET nombre_usuario='$username', correo='$email', biografia='$bio' WHERE nombre_usuario='$currentUsername'";

    if ($conn->query($query) === TRUE) {
        // Actualiza el nombre de usuario en la sesión si se cambió
        $_SESSION['username'] = $username;
        header("Location: ../perfil.php");
        exit();
    } else {
        echo "Error actualizando el perfil: " . $conn->error;
        echo "Consulta: " . $query;  // Muestra la consulta para depuración
    }
}

$conn->close();
?>
