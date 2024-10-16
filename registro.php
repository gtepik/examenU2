<?php
// Archivo: registro.php
require_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $anio_ingreso = $_POST['anio_ingreso'];
    $carrera = $_POST['carrera'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO estudiantes (nombre, apellido, anio_ingreso, carrera, fecha_nacimiento, password) 
            VALUES (:nombre, :apellido, :anio_ingreso, :carrera, :fecha_nacimiento, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':nombre' => $nombre,
        ':apellido' => $apellido,
        ':anio_ingreso' => $anio_ingreso,
        ':carrera' => $carrera,
        ':fecha_nacimiento' => $fecha_nacimiento,
        ':password' => $password
    ]);

    echo "Registro exitoso";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Estudiantes</title>
    <link rel="stylesheet" href="./css/estilos2.css"> <!-- Enlace al archivo CSS -->
</head>
<body>
    <div class="container">
        <h2>Formulario de Registro</h2>
        <form action="registro.php" method="POST">
            Nombre: <input type="text" name="nombre" required><br>
            Apellido: <input type="text" name="apellido" required><br>
            Año de Ingreso: <input type="number" name="anio_ingreso" required><br>
            Carrera: <input type="text" name="carrera" required><br>
            Fecha de Nacimiento: <input type="date" name="fecha_nacimiento" required><br>
            Contraseña: <input type="password" name="password" required><br>
            <input type="submit" value="Registrarse">
        </form>

        <br>
        <div class="login-button">
            <a href="login.php"><button>Iniciar sesión</button></a>
        </div>
    </div>
</body>
</html>
