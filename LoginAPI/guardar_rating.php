<?php
require_once __DIR__ . "/db.php";

$foto = null;

if(!empty($_FILES["foto"]["name"])){

    if($_FILES["foto"]["size"] > 3000000){
        die("La imagen es demasiado grande (máximo 3MB).");
    }

    $permitidos = ["image/jpeg","image/png","image/jpg"];

    if(!in_array($_FILES["foto"]["type"], $permitidos)){
        die("Solo se permiten imágenes JPG y PNG.");
    }

    $carpeta = __DIR__ . "/fotos/";

    if(!file_exists($carpeta)){
        mkdir($carpeta,0777,true);
    }

    $nombre = time() . "_" . $_FILES["foto"]["name"];
    $foto = "fotos/" . $nombre;

    move_uploaded_file($_FILES["foto"]["tmp_name"], $carpeta . $nombre);
}

$sql = "INSERT INTO reseñas (nombre, destino, dias, calificacion, mensaje, foto)
        VALUES (?,?,?,?,?,?)";

$stmt = $conexion->prepare($sql);
$stmt->execute([
    $_POST["nombre"],
    $_POST["destino"],
    $_POST["dias"],
    $_POST["rating"],
    $_POST["mensaje"],
    $foto
]);

echo "✔ Reseña guardada correctamente!";
