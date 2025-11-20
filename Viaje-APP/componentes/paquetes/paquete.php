<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Paquetes - Remolinos Tours</title>
  <link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos/header.css">
  <link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos_footer/estilos_footer.css">
  <link rel="stylesheet" href="paquete.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/viaje/viaje/Viaje-APP/componentes/header/header.php'); ?>

<main>
  <!-- Banner -->
  <section class="packages-banner">
    <h1>Descubre Nuestros Paquetes</h1>
    <p>Viaja con comodidad y ahorra hasta un 20% en tus destinos favoritos</p>
  </section>

  <!-- Lista de paquetes -->
  <section class="packages-list">
    <h2>Paquetes Populares</h2>

    <div class="package-item">
      <img src="/viaje/viaje/Viaje-APP/componentes/img/paquete1.jpg" alt="Paquete Cancún">
      <div class="package-details">
        <h3>Escapada a Cancún</h3>
        <p>Disfruta de 5 noches en hotel 4★ con desayuno incluido y traslado al aeropuerto.</p>
        <div class="rating">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star-half-alt"></i>
          <i class="far fa-star"></i>
        </div>
        <div class="package-bottom">
          <span class="price">€450 por persona</span>
          <i class="fas fa-heart favorite"></i>
        </div>
      </div>
    </div>

    <div class="package-item">
      <img src="/viaje/viaje/Viaje-APP/componentes/img/paquete2.jpg" alt="Paquete Ciudad de México">
      <div class="package-details">
        <h3>Aventura CDMX</h3>
        <p>3 noches en hotel céntrico con tour guiado por la ciudad y entradas a museos.</p>
        <div class="rating">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="far fa-star"></i>
        </div>
        <div class="package-bottom">
          <span class="price">€320 por persona</span>
          <i class="fas fa-heart favorite"></i>
        </div>
      </div>
    </div>

    <div class="package-item">
      <img src="/viaje/viaje/Viaje-APP/componentes/img/paquete3.jpg" alt="Paquete Playa del Carmen">
      <div class="package-details">
        <h3>Relax Playa del Carmen</h3>
        <p>7 noches en resort todo incluido frente al mar, con spa y actividades acuáticas.</p>
        <div class="rating">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star-half-alt"></i>
          <i class="far fa-star"></i>
        </div>
        <div class="package-bottom">
          <span class="price">€680 por persona</span>
          <i class="fas fa-heart favorite"></i>
        </div>
      </div>
    </div>

    <div class="package-item">
      <img src="/viaje/viaje/Viaje-APP/componentes/img/paquete4.jpg" alt="Paquete Tulum">
      <div class="package-details">
        <h3>Tulum Eco-Resort</h3>
        <p>5 noches en eco-resort con vista al mar, desayuno incluido y tour arqueológico.</p>
        <div class="rating">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <div class="package-bottom">
          <span class="price">€720 por persona</span>
          <i class="fas fa-heart favorite"></i>
        </div>
      </div>
    </div>

  </section>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/footer/footer.php"); ?>
<script src="/viaje/viaje/Viaje-APP/componentes/js/header.js"></script>
</body>
</html>
