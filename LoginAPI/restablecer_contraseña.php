<?php
session_start();
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Método no permitido");
}

$codigo = $_POST['codigo'] ?? '';
$pwd = $_POST['contraseña'] ?? '';
$pwd2 = $_POST['confirmar_contraseña'] ?? '';

// Comprobar datos
if (empty($codigo) || empty($pwd) || empty($pwd2)) {
    die("Debes completar todos los campos");
}

if ($pwd !== $pwd2) {
    die("Las contraseñas no coinciden");
}

if (strlen($pwd) < 6) {
    die("La contraseña debe tener mínimo 6 caracteres");
}

// Obtener correo desde sesión
$correo = $_SESSION['correo_recuperacion'] ?? null;

if (!$correo) {
    die("Error: No se ha encontrado el correo en la sesión");
}

// Verificar código correcto
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE correo = ? AND codigo_recuperacion = ?");
$stmt->bind_param("si", $correo, $codigo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Código incorrecto");
}

$user = $result->fetch_assoc();
$id = $user['id'];

// Hashear contraseña
$hash = password_hash($pwd, PASSWORD_DEFAULT);

// Actualizar contraseña y borrar código
$upd = $conn->prepare("UPDATE usuarios SET contraseña = ?, codigo_recuperacion = NULL WHERE id = ?");
$upd->bind_param("si", $hash, $id);
$upd->execute();

// Destruir variable de sesión
unset($_SESSION['correo_recuperacion']);

echo "<script>
    alert('Contraseña actualizada correctamente');
    window.location='../iniciarSesion/login.php';
</script>";
?>
