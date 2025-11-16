<?php

header('Content-Type: application/json');
session_start();
require_once './config/db.php';

$firstName = $_POST['first_name'] ?? '';
$lastName = $_POST['last_name'] ?? '';
$middleName = $_POST['middle_name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if(empty($firstName) || empty($lastName) || empty($email) || empty($password)){
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

//check if user already exist
$stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
$stmt ->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0){
    echo json_encode(['success' => false, 'message' => 'User already exists']);
    exit;
}

//Insert new User
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare('INSERT INTO users (first_name, last_name, middle_name, email, password) VALUES (?,?,?,?,?)');
$stmt->bind_param('sssss', $firstName, $lastName, $middleName, $email, $hash);

if($stmt->execute()){
    echo json_encode(['success' =>true, 'message' => 'User registered successfully']);
}else{
    echo json_encode(['success' => false, 'message' => 'registration failed']);
}


?>