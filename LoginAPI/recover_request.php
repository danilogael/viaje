<?php
require "config/db.php";
require "config/mail.php";

// PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require __DIR__ . '/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') exit;

// Validar correo
$correo = filter_var($_POST['correo'] ?? '', FILTER_VALIDATE_EMAIL);
if (!$correo) {
    die("Correo inválido.");
}

// Buscar usuario
$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ? LIMIT 1");
$stmt->execute([$correo]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// **SI EXISTE**: generamos token (si no existe devolvemos mensaje neutro igual)
if ($user) {

    // Generar token único y seguro
    $token = bin2hex(random_bytes(32));

    // Guardar token en DB
    $upd = $conexion->prepare("UPDATE usuarios SET reset_token = ? WHERE id = ?");
    $upd->execute([$token, $user['id']]);

    // ================================
    //      ENVIAR CORREO
    // ================================
    $mailConf = require __DIR__ . "/config/mail.php";
    $mail = new PHPMailer(true);

    try {
        // Config SMTP
        $mail->isSMTP();
        $mail->Host       = $mailConf['host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $mailConf['username'];
        $mail->Password   = $mailConf['password'];
        $mail->SMTPSecure = $mailConf['smtp_secure'];
        $mail->Port       = $mailConf['port'];

        $mail->setFrom($mailConf['from_email'], $mailConf['from_name']);
        $mail->addAddress($correo);

        $mail->isHTML(true);

        // **LINK REAL PARA RESTABLECER**
        $link = "http://TU_DOMINIO/Viaje-APP/componentes/iniciarSesion/restablecer.php?token=$token";

        $mail->Subject = "Recuperación de contraseña";
        $mail->Body = "
            <p>Para restablecer tu contraseña, da clic en el siguiente enlace:</p>
            <p><a href='$link'><b>Restablecer contraseña</b></a></p>
            <p>Si no solicitaste esto, ignora este mensaje.</p>
        ";

        $mail->send();

    } catch (Exception $e) {
        // Evitamos mostrar error directamente por seguridad
        // error_log("Error correo: " . $mail->ErrorInfo);
    }
}

// Mensaje neutro (evita que alguien sepa si existe o no el correo)
header("Location: ../Viaje-APP/componentes/iniciarSesion/login.php?recover=1");
exit;
