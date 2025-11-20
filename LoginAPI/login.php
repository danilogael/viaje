<?php
require "config/db.php";


session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "message" => "Método no permitido"]);
    exit;
}

$correo = $_POST['correo'] ?? '';
$pwd = $_POST['contraseña'] ?? '';

$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ?");
$stmt->execute([$correo]);
$u = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$u || !password_verify($pwd, $u['contraseña'])) {
    echo json_encode(["success" => false, "message" => "Correo o contraseña incorrectos"]);
    exit;
}

// Crear sesión
$_SESSION['user_id'] = $u['id'];
$_SESSION['nombre'] = $u['nombre'];
$_SESSION['rol'] = $u['rol'];

echo json_encode([
    "success" => true,
    "message" => "Login correcto",
    "user" => [
        "id" => $u['id'],
        "nombre" => $u['nombre'],  
        "apellido_paterno" => $u['apellido_paterno'],
        "apellido_materno" => $u['apellido_materno'],
        "correo" => $u['correo'],
        "rol" => $u['rol']
    ]
]);
exit;
