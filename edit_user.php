<?php

require_once 'config/db.php';
session_start();


if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'admin') {
    header('Location: login.php');  
    exit;
}

$id = $_GET['id'] ?? null;

if ($id) {
    $sql = "SELECT * FROM estudiantes WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);
    $estudiante = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "ID de estudiante no válido.";
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $anio_ingreso = $_POST['anio_ingreso'];
    $carrera = $_POST['carrera'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    $sql = "UPDATE estudiantes SET nombre = :nombre, apellido = :apellido, anio_ingreso = :anio_ingreso, carrera = :carrera, fecha_nacimiento = :fecha_nacimiento WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':nombre' => $nombre,
        ':apellido' => $apellido,
        ':anio_ingreso' => $anio_ingreso,
        ':carrera' => $carrera,
        ':fecha_nacimiento' => $fecha_nacimiento,
        ':id' => $id
    ]);

    header('Location: admin.php'); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="./css/estilos4.css"> 
</head>
<body>
    <h2>Editar Usuario</h2>
    <form action="admin_edit.php?id=<?php echo $id; ?>" method="POST">
        Nombre: <input type="text" name="nombre" value="<?php echo $estudiante['nombre']; ?>" required><br>
        Apellido: <input type="text" name="apellido" value="<?php echo $estudiante['apellido']; ?>" required><br>
        Año de Ingreso: <input type="number" name="anio_ingreso" value="<?php echo $estudiante['anio_ingreso']; ?>" required><br>
        Carrera: <input type="text" name="carrera" value="<?php echo $estudiante['carrera']; ?>" required><br>
        Fecha de Nacimiento: <input type="date" name="fecha_nacimiento" value="<?php echo $estudiante['fecha_nacimiento']; ?>" required><br>
        <input type="submit" value="Actualizar">
    </form>

    <a href="admin.php">Volver al Panel de Administración</a>
</body>
</html>
