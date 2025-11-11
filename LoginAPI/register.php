<?php
header('Content-Type: application/json');
session_start();
require_once __DIR__ . '/config/db.php';

$nombre_usuario = $_POST['nombre_usuario'] ?? '';
$apellido_paterno = $_POST['apellido_paterno'] ?? '';
$apellido_materno = $_POST['apellido_materno'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$email = $_POST['email'] ?? '';
$contraseña = $_POST['contraseña'] ?? '';

if (empty($nombre_usuario) || empty($apellido_paterno) || empty($telefono) || empty($email) || empty($contraseña)) {
    echo json_encode(['success' => false, 'message' => 'Faltan campos obligatorios']);
    exit;
}

$stmt = $conn->prepare('SELECT id_usuario FROM usuarios WHERE email = ? OR telefono = ?');
$stmt->bind_param('ss', $email, $telefono);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'El correo o el teléfono ya están registrados']);
    exit;
}

$hash = password_hash($contraseña, PASSWORD_DEFAULT);

$stmt = $conn->prepare('INSERT INTO usuarios (nombre_usuario, apellido_paterno, apellido_materno, email, contraseña, telefono) VALUES (?, ?, ?, ?, ?, ?)');
$stmt->bind_param('ssssss', $nombre_usuario, $apellido_paterno, $apellido_materno, $email, $hash, $telefono);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Usuario registrado correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al registrar usuario']);
}
?>
