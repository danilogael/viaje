<?php
// Iniciamos la sesión para poder guardar el idioma
session_start();

// Si llega el dato "lang" por URL
if (isset($_GET['lang'])) {

    // Guardamos el idioma en la sesión
    // Ejemplo: es, en, fr
    $_SESSION['lang'] = $_GET['lang'];
}

// Simplemente devolvemos una respuesta
echo "OK";
