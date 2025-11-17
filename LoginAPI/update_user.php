<?php
// LoginAPI/updateUser.php
header('Content-Type: application/json; charset=utf-8');
require __DIR__ . '/config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'No autenticado']);
    exit;
}

$id = intval($_SESSION['user_id']);
$campo = $_POST['campo'] ?? '';
$valor = $_POST['valor'] ?? '';

if (!$campo || $valor === '') {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

/**
 * MAPEO REAL DE CAMPOS PERMITIDOS SEGÚN TU BASE DE DATOS
 */
$map = [
    'nombre'            => 'nombre',
    'apellido_paterno'  => 'apellido_paterno',
    'apellido_materno'  => 'apellido_materno',
    'correo'            => 'correo',
    'telefono'          => 'telefono',
    'contraseña'        => 'contraseña',
    'password'          => 'contraseña'
];

if (!isset($map[$campo])) {
    echo json_encode(['success' => false, 'message' => 'Campo no permitido']);
    exit;
}

$columna = $map[$campo];

/* Validación especial para contraseña */
if ($columna === 'contraseña') {
    if (strlen($valor) < 6) {
        echo json_encode(['success' => false, 'message' => 'La contraseña debe tener al menos 6 caracteres']);
        exit;
    }
    $valor = password_hash($valor, PASSWORD_DEFAULT);
}

/* Validación especial para correo */
if ($columna === 'correo') {
    $q = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ? AND id <> ? LIMIT 1");
    $q->execute([$valor, $id]);

    if ($q->fetch()) {
        echo json_encode(['success' => false, 'message' => 'El correo ya está en uso por otro usuario']);
        exit;
    }
}

/* Validación opcional del teléfono */
if ($columna === 'telefono' && !preg_match('/^[0-9]{10}$/', $valor)) {
    echo json_encode(['success' => false, 'message' => 'Teléfono inválido (10 dígitos)']);
    exit;
}

try {
    $sql = "UPDATE usuarios SET `$columna` = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$valor, $id]);

    echo json_encode(['success' => true, 'message' => 'Actualizado correctamente']);
    exit;

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al actualizar',
        'error' => $e->getMessage()
    ]);
    exit;
}
