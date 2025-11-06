<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'agencia_de_viajes';

$conn = new mysqli($host, $user, $pass, $dbname);

if($conn->connect_error){
    die(json_encode([
        'success' => false,
        'message' => 'Database connection error: ' . $conn->connect_error
    ]));
}

?>