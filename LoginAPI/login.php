<?php
header('Content-type: application/json');
session_start();
require_once './config/db.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if(empty($email) || empty($password)){
    echo json_encode(['success' => false, 'message' => 'missing credentials']);
    exit;
}

$stmt = $conn->prepare('SELECT id, first_name, last_name, middle_name, phone, email, password FROM users WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if($user = $result->fetch_assoc()) {
    if(password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        echo json_encode([
            'success' => true,
            'message' => 'Login successful',
            'user' => [
                'id' => $user['id'],
                'last_name' => $user['last_name'],
                'first_name' => $user['first_name'],
                'middle_name' => $user['middle_name'],
                'phone' => $user['phone'],
                'email' => $user['email']
               


            ]
        ]);
    }else{
        echo json_encode(['success' => false, 'message' => 'Invalid password']);
    }
} else{
    echo json_encode([ 'success' => false, 'message' => 'User not found']);
}


?>