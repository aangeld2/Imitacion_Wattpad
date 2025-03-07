<?php
session_start();
session_unset();
session_destroy();
header("Location: ../logout.html");  // Redirige a la página de inicio después de cerrar la sesión
exit();
?>