<?php
header('Content-Type: application/json');
session_start();

if(!isset($_SESSION['inicio_sesion'])) { 
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}
?>