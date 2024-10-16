<?php
require_once 'config/db.php'; 
// Contraseña para el admin
$admin_password = password_hash('1234', PASSWORD_DEFAULT); 
$sql = "INSERT INTO estudiantes (nombre, password, es_admin) VALUES (:nombre, :password, 1)"; 
$stmt = $conn->prepare($sql);
$stmt->execute([':nombre' => 'admin', ':password' => $admin_password]);

echo "Usuario admin creado con éxito.";
?>
