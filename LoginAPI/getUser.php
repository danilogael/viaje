<?php
header('Content-Type: application/json');
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/config/db.php';

$userId = $_SESSION['id_usuario'] ?? null;

if (!$userId) {
    echo json_encode(['success' => false, 'message' => 'Sesión no válida']);
    exit;
}

$stmt = $conn->prepare('SELECT id_usuario, nombre_usuario, apellido_paterno, apellido_materno, email, contraseña, telefono FROM usuarios WHERE id_usuario = ?');
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    echo json_encode(['success' => true, 'user' => $user]);
} else {
    echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
}
?>
