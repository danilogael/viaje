<?php
header('Content-Type: application/json');
require_once 'auth.php';
require_once './config/db.php';

$userId = $_SESSION['id_usuario'];

$stmt= $conn->prepare('SELECT id_usuario,Nombre_user,apellido_paterno,apellido_materno,	correo_electronico,	contraseña,	numero_ telefono,id_rol,	 FROM users WHERE id = ?');
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();

if($user = $result->fetch_assoc()){
    echo json_encode(['success' => true, 'user' => $user]);
}else{
    echo json_encode(['success' => false, 'message' => 'User not found']);
}

?>