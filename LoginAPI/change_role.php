<?php
require "config/db.php";
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../Viaje-APP/componentes/iniciarSesion/login.php");
    exit;
}

$id = intval($_GET['id'] ?? 0);
$to = $_GET['to'] === 'admin' ? 'admin' : 'cliente';

if ($id > 0) {
    $stmt = $conexion->prepare("UPDATE usuarios SET rol = ? WHERE id = ?");
    $stmt->execute([$to, $id]);
}

header("Location: ../Viaje-APP/componentes/admin/usuarios.php");
exit;
