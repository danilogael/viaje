<?php
session_start();
require '../config/db.php'; // Asegúrate de que esta ruta es correcta

// Validar método
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Método no permitido");
}

$codigo = trim($_POST['codigo'] ?? '');
$pwd    = trim($_POST['nueva'] ?? '');
$pwd2   = trim($_POST['confirmar'] ?? '');

// Validaciones básicas
if ($codigo === '' || $pwd === '' || $pwd2 === '') {
    die("Debes llenar todos los campos");
}

if ($pwd !== $pwd2) {
    die("Las contraseñas no coinciden");
}

if (strlen($pwd) < 6) {
    die("La contraseña debe tener al menos 6 caracteres");
}

// Obtener correo desde sesión
$correo = $_SESSION['correo_recuperacion'] ?? null;

if (!$correo) {
    die("Error: No se encontró el correo en la sesión");
}

// Verificar código y correo
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE correo = ? AND codigo_recuperacion = ? LIMIT 1");
$stmt->bind_param("si", $correo, $codigo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Código incorrecto o expirado");
}

$user = $result->fetch_assoc();
$id = $user['id'];

// Hashear nueva contraseña
$hash = password_hash($pwd, PASSWORD_DEFAULT);

// Actualizar contraseña y limpiar el código
$upd = $conn->prepare("
    UPDATE usuarios 
    SET contraseña = ?, codigo_recuperacion = NULL 
    WHERE id = ?
");
$upd->bind_param("si", $hash, $id);
$upd->execute();

// Eliminar correo almacenado
unset($_SESSION['correo_recuperacion']);

echo "<script>
    alert('Contraseña actualizada correctamente');
    window.location='../iniciarSesion/login.php';
</script>";
exit;
