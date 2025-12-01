<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Remolinos Tours</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="planea.css">
  <link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos/estilos_footer.css">
  <link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos/planea.css">
  <link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos/header.css">
</head>
<body>
  <?php
require_once "/viaje/viaje/Viaje-APP/componentes/currency/convert.php";
$precio = 3500;
?>
<p>Precio: <?php echo convertCurrency($precio); ?></p>

  <?php include($_SERVER['DOCUMENT_ROOT'] . '/viaje/viaje/Viaje-APP/componentes/header/header.php'); ?>
   <?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/footer/footer.php"); ?>
</body>
</html>


 