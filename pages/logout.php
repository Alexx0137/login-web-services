<?php

// Iniciar la sesión
session_start();

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redireccionar al usuario a la página de inicio de sesión
header("Location: login.html");
exit;

