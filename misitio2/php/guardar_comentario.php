<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.html");
    exit();
}

include('config.php');

$historia_id = isset($_POST['historia_id']) ? intval($_POST['historia_id']) : 0;
$usuario = $_SESSION['username'];
$comentario = isset($_POST['comentario']) ? trim($_POST['comentario']) : '';

if ($historia_id > 0 && !empty($comentario)) {
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $query = "INSERT INTO Comentarios (historia_id, usuario, comentario) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $historia_id, $usuario, $comentario);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

header("Location: ../ver_historia.php?id=" . $historia_id);
exit();
