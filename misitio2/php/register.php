<?php
session_start();
include('config.php');  // Incluye el archivo de configuración

// Establecer la conexión a la base de datos usando las variables del archivo de configuración
$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    
    // Verificar que las contraseñas coinciden
    if ($password !== $confirm_password) {
        echo "Las contraseñas no coinciden.";
        exit();
    }

    // Encriptar la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Verificar que el nombre de usuario o el correo no estén ya en uso
    $query = "SELECT * FROM Usuarios WHERE nombre_usuario='$username' OR correo='$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "El nombre de usuario o el correo ya están en uso.";
    } else {
        // Insertar el nuevo usuario en la base de datos
        $insert_query = "INSERT INTO Usuarios (nombre_usuario, correo, contraseña) VALUES ('$username', '$email', '$hashed_password')";
        
        if ($conn->query($insert_query) === TRUE) {
            echo "Registro exitoso. Ahora puedes iniciar sesión.";
            header("Location: ../index.html");
            exit();
        } else {
            echo "Error al registrar el usuario: " . $conn->error;
        }
    }
}

// Cerrar la conexión
$conn->close();
?>
