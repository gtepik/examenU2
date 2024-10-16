<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}


$nombre = $_SESSION['usuario'];

$sql = "SELECT * FROM estudiantes WHERE nombre = :nombre";
$stmt = $conn->prepare($sql);
$stmt->execute([':nombre' => $nombre]);
$estudiante = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$estudiante) {
    echo "No se encontró al usuario.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="./css/estilos3.css">
    <style>
        table {
            width: 50%;
            margin: auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Bienvenido, <?php echo $estudiante['nombre']; ?></h1>

    <table>
        <tr>
            <th>ID</th>
            <td><?php echo $estudiante['id']; ?></td>
        </tr>
        <tr>
            <th>Nombre</th>
            <td><?php echo $estudiante['nombre']; ?></td>
        </tr>
        <tr>
            <th>Apellido</th>
            <td><?php echo $estudiante['apellido']; ?></td>
        </tr>
        <tr>
            <th>Año de Ingreso</th>
            <td><?php echo $estudiante['anio_ingreso']; ?></td>
        </tr>
        <tr>
            <th>Carrera</th>
            <td><?php echo $estudiante['carrera']; ?></td>
        </tr>
        <tr>
            <th>Fecha de Nacimiento</th>
            <td><?php echo $estudiante['fecha_nacimiento']; ?></td>
        </tr>
    </table>

    <br>
    <div style="text-align: center;">
        <a href="logout.php">Cerrar sesión</a>
    </div>
</body>
</html>

