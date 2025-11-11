<?php 
header('Content-Type: application/json');
session_start();
require_once './config/db.php';

// Recibir los datos del formulario
$email = $_POST['email'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$password = $_POST['contraseña'] ?? '';

// Validar campos vacíos
if (empty($email) || empty($telefono) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios']);
    exit;
}

// Buscar al usuario que coincida con email y teléfono
$stmt = $conn->prepare('
    SELECT id_usuario, nombre_usuario, apellido_paterno, apellido_materno, email, contraseña, telefono
    FROM usuarios
    WHERE email = ? AND telefono = ?
');
$stmt->bind_param('ss', $email, $telefono);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si existe el usuario
if ($user = $result->fetch_assoc()) {
    // Comparar contraseña
    if (password_verify($password, $user['contraseña'])) {
        $_SESSION['id_usuario'] = $user['id_usuario'];

        echo json_encode([
            'success' => true,
            'message' => 'Inicio de sesión exitoso',
            'user' => [
                'id_usuario' => $user['id_usuario'],
                'nombre_usuario' => $user['nombre_usuario'],
                'apellido_paterno' => $user['apellido_paterno'],
                'apellido_materno' => $user['apellido_materno'],
                'telefono' => $user['telefono'],
                'email' => $user['email']
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Contraseña incorrecta']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Correo o teléfono incorrectos']);
}
?>
