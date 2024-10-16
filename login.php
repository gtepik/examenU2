<?php
require_once 'config/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM estudiantes WHERE nombre = :nombre";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':nombre' => $nombre]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($usuario && password_verify($password, $usuario['password'])) {
        $_SESSION['usuario'] = $usuario['nombre'];
        $_SESSION['es_admin'] = ($usuario['nombre'] === 'admin'); // Verificar si es admin

        // Redirigir según si es administrador o usuario normal
        if ($_SESSION['es_admin']) {
            header('Location: admin.php');  // Redirige a la página admin.php
        } else {
            header('Location: home.php');   // Redirige a la página home.php para usuarios regulares
        }
        exit;
    } else {
        echo "Nombre o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/estilos1.css"> 
</head>
<body>
    <div class="card"> 
        <div class="card-info"> 
            <h2 class="title">Iniciar Sesión</h2>
            <form action="login.php" method="POST">
                Nombre: <input type="text" name="nombre" required><br>
                Contraseña: <input type="password" name="password" required><br>
                <input type="submit" value="Login" class="btn">
            </form>
            <div class="register-button">
                <a href="registro.php"><button class="btn">Registrar</button></a>
            </div>
        </div>
    </div>
</body>
</html>
