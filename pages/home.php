<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    // Si no está autenticado, redirigirlo al formulario de inicio de sesión
    header('Location: login.php');
    exit;
}

// Obtener el nombre y apellido del usuario de la sesión
$nombreUsuario = $_SESSION['nombre'] ?? 'Usuario Desconocido';
$apellidoUsuario = $_SESSION['apellido'] ?? 'Apellido Desconocido';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <link rel="stylesheet" href="../assets/home.css">
</head>
<body>
<div class="container">
    <h1>Autenticación satisfactoria!</h1>
    <h2>Bienvenido, <?php echo htmlspecialchars($nombreUsuario) . ' ' . htmlspecialchars($apellidoUsuario); ?>!</h2>
    <h3>Diseño y Desarrollo de Servicios Web - caso</h3>
    <p>GA7-220501096-AA5-EV01</p>

    <a href="logout.php">Cerrar sesión</a>
</div>
</body>
</html>
