<?php
header('Content-Type: application/json');
session_start();
require_once './config/db.php';

$firstName = $_POST['first_name'] ?? '';
$lastName = $_POST['last_name'] ?? '';
$middleName = $_POST['middle_name'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($firstName) || empty($lastName) || empty($phone) || empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

// Verificar si ya existe un usuario con el mismo email o teléfono
$stmt = $conn->prepare('SELECT id FROM users WHERE email = ? OR phone = ?');
$stmt->bind_param('ss', $email, $phone);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'El correo o el teléfono ya están registrados']);
    exit;
}

// Encriptar contraseña
$hash = password_hash($password, PASSWORD_DEFAULT);

// Insertar nuevo usuario
$stmt = $conn->prepare('INSERT INTO users (first_name, last_name, middle_name, phone, email, password) VALUES (?, ?, ?, ?, ?, ?)');
$stmt->bind_param('ssssss', $firstName, $lastName, $middleName, $phone, $email, $hash);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Usuario registrado correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al registrar usuario']);
}
?>
