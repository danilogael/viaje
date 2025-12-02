<?php
session_start();

// Si llega la moneda por GET (MXN, USD, EUR)
if (isset($_GET['currency'])) {

    // Guardamos la moneda seleccionada
    $_SESSION['currency'] = $_GET['currency'];
}

echo "OK";
