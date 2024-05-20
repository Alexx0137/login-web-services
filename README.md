# Proyecto de Registro e Inicio de Sesión

## Instrucciones para Configurar el Proyecto

### Requisitos
- Servidor web (XAMPP, WAMP, MAMP, etc.)
- PHP
- MySQL
- O simplemente levantar el servidor interno de PHP con: `php -S localhost:3000`

### Paso 1: Clonar el Repositorio


git clone https://github.com/Alexx0137/login-web-services.git
cd login-web-services


### Paso 2: Configurar la Base de Datos
Crear la Base de Datos:

- Abre tu herramienta de gestión de bases de datos (por ejemplo, phpMyAdmin, DBeaver).
- Crea una nueva base de datos llamada test.
- Una vez creada la base de datos test, selecciona la base de datos.
- Ejecutar el Script SQL: "setup.sql" que esta en la raiz del proyecto para crear la tabla de usuarios.
- En phpMyAdmin: Selecciona la opción "SQL" y copia el contenido del archivo setup.sql, luego ejecuta el script.

### Paso 3: Configurar la Conexión a la Base de Datos
- Modificar las Credenciales de MySQL:
- Abre el archivo ( database.php ).
- Modifica las credenciales de la base de datos según tu configuración local:

($servername = "localhost";
$username = "root";
$password = "";
$dbname = "test");

