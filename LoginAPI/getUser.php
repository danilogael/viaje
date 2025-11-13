<?php
header('Content-Type: application/json');
require_once 'auth.php';
require_once './config/db.php';

$userId = $_SESSION['user_id'];

$stmt= $conn->prepare('SELECT id, first_name, last_name, middle_name, email FROM users WHERE id = ?');
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();

if($user = $result->fetch_assoc()){
    echo json_encode(['success' => true, 'user' => $user]);
}else{
    echo json_encode(['success' => false, 'message' => 'User not found']);
}

?>