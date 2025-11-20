
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ofertas de Fin de Año - Remolinos Tours</title>
  <link rel="stylesheet" href="ofertas.css">
  <link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos/header.css">
  <link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos_footer/estilos_footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/header/header.php"); ?>

<main>
  <!-- Sección principal: Banner de Ofertas -->
  <section class="offer-banner">
    <h1>Ofertas de Fin de Año</h1>
    <p>Persigue el atardecer. Ahorra 15% o más en alojamientos hasta el 7 enero 2026.</p>

    <!-- Buscador estilo Booking -->
    <div class="search-offers">
      <input type="text" placeholder="¿A dónde vas?">
      <input type="date" placeholder="Check-in">
      <input type="date" placeholder="Check-out">
      <div class="guests-dropdown">
        <button id="guests-btn">2 adultos · 0 niños · 1 habitación</button>
        <div class="guests-menu">
          <div class="guest-row">
            <span>Adultos</span>
            <div class="guest-controls">
              <button type="button" class="minus" data-type="adults">-</button>
              <span id="adults-count">2</span>
              <button type="button" class="plus" data-type="adults">+</button>
            </div>
          </div>
          <div class="guest-row">
            <span>Niños</span>
            <div class="guest-controls">
              <button type="button" class="minus" data-type="children">-</button>
              <span id="children-count">0</span>
              <button type="button" class="plus" data-type="children">+</button>
            </div>
          </div>
          <div class="guest-row">
            <span>Habitaciones</span>
            <div class="guest-controls">
              <button type="button" class="minus" data-type="rooms">-</button>
              <span id="rooms-count">1</span>
              <button type="button" class="plus" data-type="rooms">+</button>
            </div>
          </div>
        </div>
      </div>
      <button>Buscar</button>
    </div>
  </section>

  <!-- Sección: Lista de Ofertas -->
  <section class="offers-list">
    <h2>Ofertas de Fin de Año incluidas en tu búsqueda</h2>
    <p>Los mejores destinos</p>

    <div class="offer-item">
      <div>
        <strong>181 Ofertas de Fin de Año</strong>
        <span>Ciudad de México</span>
      </div>
      <span class="price">Desde €34 por noche</span>
    </div>

    <div class="offer-item">
      <div>
        <strong>140 Ofertas de Fin de Año</strong>
        <span>Playa del Carmen</span>
      </div>
      <span class="price">Desde €22 por noche</span>
    </div>

    <div class="offer-item">
      <div>
        <strong>131 Ofertas de Fin de Año</strong>
        <span>Tulum</span>
      </div>
      <span class="price">Desde €27 por noche</span>
    </div>

    <div class="offer-item">
      <div>
        <strong>129 Ofertas de Fin de Año</strong>
        <span>Madrid</span>
      </div>
      <span class="price">Desde €94 por noche</span>
    </div>

    <div class="offer-item">
      <div>
        <strong>90 Ofertas de Fin de Año</strong>
        <span>Cancún</span>
      </div>
      <span class="price">Desde €22 por noche</span>
    </div>
  </section>

  <!-- Sección: Preguntas frecuentes -->
  <section class="faq-section">
    <h2>Preguntas frecuentes</h2>

    <div class="faq-item">
      <strong>¿Cuánto puedo ahorrar con Ofertas de Fin de Año?</strong>
      <p>Las Ofertas de Fin de Año empiezan desde 15% menos y pueden aumentar. Este descuento se aplica al precio antes de que se agreguen impuestos y otros cargos.</p>
    </div>

    <div class="faq-item">
      <strong>¿Cuándo puedo reservar Ofertas de Fin de Año?</strong>
      <p>Se puede reservar entre 4 septiembre 2025 y 7 enero 2026.</p>
    </div>

    <div class="faq-item">
      <strong>¿Cuándo puedo viajar usando Ofertas de Fin de Año?</strong>
      <p>Las Ofertas están disponibles en los establecimientos participantes de todo el mundo, para estancias entre 1 octubre 2025 y 7 enero 2026.</p>
    </div>
  </section>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/footer/footer.php"); ?>
<script src="/viaje/viaje/Viaje-APP/componentes/js/header.js"></script>
</body>
</html>
