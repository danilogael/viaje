<?php
session_start();
require_once "rates.php";

/*
 convertCurrency()
 Esta función toma un precio en pesos mexicanos
 y lo convierte automáticamente a la moneda del usuario.
*/
function convertCurrency($amountMXN) {
    global $currency_rates;

    // Moneda elegida por el usuario o MXN por defecto
    $selected = $_SESSION["currency"] ?? "MXN";

    // Convertimos el precio usando la tasa
    $converted = $amountMXN * $currency_rates[$selected];

    // Damos formato dependiendo de la moneda
    switch ($selected) {
        case "USD":
            return "$" . number_format($converted, 2) . " USD";

        case "EUR":
            return "€" . number_format($converted, 2) . " EUR";

        default:
            return "$" . number_format($amountMXN, 2) . " MXN";
    }
}
