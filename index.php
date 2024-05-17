<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redireccionar al usuario a la página de inicio de sesión
    header('Location: pages/login.html');
    exit;
} else {
    // Redireccionar al usuario a la página de inicio
    header('Location: pages/home.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
</head>
<body>
<h1>Bienvenido, <?php echo $_SESSION['usuario']; ?>!</h1>
<!-- Aquí puedes incluir el contenido de la página -->
</body>
</html>
