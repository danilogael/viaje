<?php
require_once "config/db.php";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir texto escrito
$term = $_GET['term'] ?? '';
$term = $conn->real_escape_string($term);

// Consulta para autocompletar destinos
$sql = "SELECT id, nombre, pais FROM destinos WHERE nombre LIKE '%$term%' OR pais LIKE '%$term%' LIMIT 10";
$result = $conn->query($sql);

$destinos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $destinos[] = [
            'id' => $row['id'],
            'label' => $row['nombre'] . ', ' . $row['pais'], // lo que se ve en la lista
            'value' => $row['nombre'] // lo que se pone en el input
        ];
    }
}

// Devolver JSON
header('Content-Type: application/json');
echo json_encode($destinos);
$conn->close();
?>
