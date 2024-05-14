<?php
session_start();

// Incluir el archivo de conexión a la base de datos
include '../includes/database.php';

// Definir una variable para almacenar el mensaje de error
$mensajeError = '';

// Verificar si se ha enviado una solicitud POST para iniciar sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario de inicio de sesión
    $user = $_POST['user'];
    $password = $_POST['password'];

    // Consultar la base de datos para verificar las credenciales del usuario
    $sql = "SELECT * FROM users WHERE user=? AND password=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ss", $user, $password);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si se encontró un usuario con el nombre proporcionado
    if ($resultado->num_rows == 1) {
        // Autenticación exitosa, establecer la sesión del usuario
        $_SESSION['usuario'] = $user;
        // Redireccionar al usuario a la página de inicio (home.php)
        header('Location: home.php');
        exit;
    } else {
        // Credenciales incorrectas, establecer mensaje de error
        $mensajeError = 'Credenciales incorrectas.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="../assets/login.css">
</head>
<body>
<div class="container" id="container">

    <div class="form-container sign-in-container">
        <form action="login.php" method="post">
            <h1>Iniciar sesión</h1>

            <?php if (!empty($mensajeError)) : ?>
                <p class="error"><?php echo $mensajeError; ?></p>
            <?php endif; ?>

            <input type="text" id="user" name="user" placeholder="Usuario" required />
            <input type="password" id="password" name="password" placeholder="Contraseña" required><br><br>
            <a href="#">¿Olvidó su contraseña?</a>
            <button type="submit">Iniciar sesión</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>Bienvenido</h1>
                <p>Por favor, inicia sesión para acceder al contenido.</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
