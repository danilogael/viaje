<?php
header('Content-Type: application/json');
session_start();

// --- CONEXIÓN A LA BD ---
// Usamos __DIR__ para cargar la ruta correcta sin importar desde dónde se llame
require_once __DIR__ . '/config/db.php';

// --- Recibir datos ---
$firstName  = trim($_POST['first_name'] ?? '');
$lastName   = trim($_POST['last_name'] ?? '');
$middleName = trim($_POST['middle_name'] ?? '');
$email      = trim($_POST['email'] ?? '');
$password   = trim($_POST['password'] ?? '');

// --- Validar campos requeridos ---
if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
    echo json_encode([
        'success' => false,
        'message' => 'Todos los campos obligatorios deben estar llenos.'
    ]);
    exit;
}

// --- Validar formato de correo ---
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'success' => false,
        'message' => 'El correo electrónico no es válido.'
    ]);
    exit;
}

// --- Validar contraseña segura ---
if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/', $password)) {
    echo json_encode([
        'success' => false,
        'message' => 'La contraseña no cumple con los requisitos de seguridad.'
    ]);
    exit;
}

// --- Verificar si el usuario ya existe ---
$stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Este correo ya está registrado.'
    ]);
    exit;
}

// --- Insertar nuevo usuario ---
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    'INSERT INTO users (first_name, last_name, middle_name, email, password)
     VALUES (?, ?, ?, ?, ?)'
);

$stmt->bind_param('sssss', $firstName, $lastName, $middleName, $email, $hashedPassword);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Usuario registrado exitosamente.'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error al registrar el usuario. Inténtalo más tarde.'
    ]);
}

$stmt->close();
$conn->close();
?>
