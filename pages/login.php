<?php
session_start();

// Incluir el archivo de conexión a la base de datos
include '../includes/database.php';

// Verificar si se ha enviado una solicitud POST para iniciar sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos enviados en formato JSON
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Verificar si los datos están completos
    if (!isset($data['user']) || !isset($data['password'])) {
        echo json_encode(array("error" => "El usuario y la contraseña son obligatorios."));
        exit;
    }

    // Obtener los datos del JSON
    $user = $data['user'];
    $password = $data['password'];

    // Consultar la base de datos para verificar las credenciales del usuario
    $sql = "SELECT * FROM users WHERE user=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si se encontró un usuario con el nombre proporcionado
    if ($resultado->num_rows == 1) {
        // Obtener el hash de la contraseña almacenado en la base de datos
        $fila = $resultado->fetch_assoc();
        $hashAlmacenado = $fila['password'];

        // Verificar si la contraseña ingresada coincide con el hash almacenado
        if (password_verify($password, $hashAlmacenado)) {
            // Autenticación exitosa, establecer la sesión del usuario
            $_SESSION['usuario'] = $user;
            $_SESSION['nombre'] = $fila['name']; // Asignar el nombre del usuario a la sesión
            $_SESSION['apellido'] = $fila['last_name']; // Asignar el apellido del usuario a la sesión


            echo json_encode(array("success" => "Inicio de sesión exitoso"));
            exit;
        } else {
            echo json_encode(array("error" => "Credenciales incorrectas"));
            exit;
        }
    } else {
        echo json_encode(array("error" => "Credenciales incorrectas"));
        exit;
    }
} else {
    echo json_encode(array("error" => "Método de solicitud no permitido."));
    exit;
}
?>
