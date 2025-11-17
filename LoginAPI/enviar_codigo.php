<?php
session_start();
require '../config/db.php'; // ← ADAPTA TU RUTA

$correo = $_POST['correo'] ?? '';

if (empty($correo)) {
    die("Correo requerido");
}

$codigo = rand(100000, 999999);

// Guardar código temporal
$stmt = $conn->prepare("UPDATE usuarios SET codigo_recuperacion = ? WHERE correo = ?");
$stmt->bind_param("is", $codigo, $correo);
$stmt->execute();

if ($stmt->affected_rows > 0) {

    // GUARDAR EL CORREO EN SESIÓN PARA USARLO DESPUÉS
    $_SESSION['correo_recuperacion'] = $correo;

    // ENVIAR CORREO
    $asunto = "Código de recuperación";
    $mensaje = "Tu código para recuperar la contraseña es: $codigo";
    mail($correo, $asunto, $mensaje);

    echo "<script>
        alert('Se ha enviado un código a tu correo');
        window.location='restablecer.php';
    </script>";

} else {
    echo "<script>
        alert('El correo no está registrado');
        window.location='solicitar.php';
    </script>";
}
?>
