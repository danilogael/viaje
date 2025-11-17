<?php
require "config/db.php";
session_start();

header('Content-Type: application/json; charset=utf-8');

// Verificar sesión
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "No has iniciado sesión"]);
    exit;
}

$id = intval($_SESSION['user_id']);

// Recibir datos
$nombre   = trim($_POST['nombre'] ?? '');
$ap       = trim($_POST['apellido_paterno'] ?? '');
$am       = trim($_POST['apellido_materno'] ?? '');
$telefono = trim($_POST['telefono'] ?? '');
$correo   = trim($_POST['correo'] ?? '');

// Validaciones
if (!$nombre || !$ap || !$correo || !$telefono) {
    echo json_encode(["success" => false, "message" => "Todos los campos obligatorios deben estar completos"]);
    exit;
}

// Validar email
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["success" => false, "message" => "Correo inválido"]);
    exit;
}

// Verificar que el correo no esté repetido en otro usuario
$check = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ? AND id <> ? LIMIT 1");
$check->execute([$correo, $id]);

if ($check->fetch()) {
    echo json_encode(["success" => false, "message" => "Ese correo ya está registrado por otro usuario"]);
    exit;
}

// Actualizar datos
try {
    $update = $conexion->prepare("
        UPDATE usuarios 
        SET nombre = ?, apellido_paterno = ?, apellido_materno = ?, correo = ?, telefono = ?
        WHERE id = ?
    ");

    $update->execute([$nombre, $ap, $am, $correo, $telefono, $id]);

    echo json_encode(["success" => true, "message" => "Datos actualizados correctamente"]);

} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Error al actualizar"]);
}
exit;
