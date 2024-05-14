<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redireccionar al usuario a la página de inicio de sesión
    header('Location: login.php');
    exit;
}
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
    <h2>Diseño y Desarrollo de Servicios Web - caso</h2>
    <p>GA7-220501096-AA5-EV01</p>
</div>
</body>
</html>
