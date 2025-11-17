<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "No has iniciado sesión"]);
    exit;
}

require_once "db.php"; // Aquí usas mysqli ($conn)

$user_id = $_SESSION['user_id'];

$currentPassword = $_POST["current_password"] ?? "";
$newPassword = $_POST["new_password"] ?? "";

if (empty($currentPassword) || empty($newPassword)) {
    echo json_encode(["success" => false, "message" => "Completa todos los campos"]);
    exit;
}

// Obtener contraseña actual
$stmt = $conn->prepare("SELECT contraseña FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo json_encode(["success" => false, "message" => "Usuario no encontrado"]);
    exit;
}

// Verificar contraseña actual
if (!password_verify($currentPassword, $user["contraseña"])) {
    echo json_encode(["success" => false, "message" => "La contraseña actual es incorrecta"]);
    exit;
}

// Encriptar nueva contraseña
$newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

// Guardar nueva
$update = $conn->prepare("UPDATE usuarios SET contraseña = ? WHERE id = ?");
$update->bind_param("si", $newPasswordHash, $user_id);

if ($update->execute()) {
    echo json_encode(["success" => true, "message" => "Tu contraseña fue actualizada correctamente"]);
} else {
    echo json_encode(["success" => false, "message" => "Error al actualizar contraseña"]);
}
?>
