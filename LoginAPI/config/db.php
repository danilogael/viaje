<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'agencia_viajes';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die(json_encode([
        'success' => false,
        'message' => 'Error de conexión a la base de datos: ' . $conn->connect_error
    ]));
}

?>
