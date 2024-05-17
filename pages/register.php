<?php
session_start();

// Incluir el archivo de conexión a la base de datos
include '../includes/database.php';

// Verificar si se ha enviado una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos enviados en formato JSON
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Verificar si los datos están completos
    if (!isset($data['name']) || !isset($data['last_name']) || !isset($data['user']) || !isset($data['password']) || !isset($data['confirm_password'])) {
        echo json_encode(array("error" => "Todos los campos son obligatorios."));
        exit;
    } else {
        // Obtener los datos del JSON
        $name = $data['name'];
        $last_name = $data['last_name'];
        $user = $data['user'];
        $password = $data['password'];
        $confirm_password = $data['confirm_password'];

        // Verificar si las contraseñas coinciden
        if ($password !== $confirm_password) {
            echo json_encode(array("error" => "Las contraseñas no coinciden."));
            exit;
        }

        // Verificar si el usuario ya existe en la base de datos
        $sql = "SELECT * FROM users WHERE user=?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            echo json_encode(array("error" => "El usuario ya existe."));
            exit;
        } else {
            // Hash de la contraseña
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insertar el nuevo usuario en la base de datos
            $sql = "INSERT INTO users (name, last_name, user, password) VALUES (?, ?, ?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("ssss", $name, $last_name, $user, $hashedPassword);

            if ($stmt->execute()) {
                echo json_encode(array("success" => "Usuario creado exitosamente."));
                exit;
            } else {
                echo json_encode(array("error" => "Error al registrar el usuario."));
                exit;
            }
        }
    }
} else {
    // Si no es una solicitud POST, mostrar un error
    echo json_encode(array("error" => "Método de solicitud no permitido."));
    exit;
}
?>
