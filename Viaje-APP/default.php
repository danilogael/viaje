<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Remolinos Tours - Inicio</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos/header.css">
  <link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos_footer/estilos_footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/header/header.php"); ?>

<main>
<section class="search-section">
  <h2>¿Conoce tu proxima aventura?</h2>
  <form class="search-form">
    <div class="search-input">
  <label>Destino</label>
  <input type="text" id="destino" placeholder="Ciudad, país o alojamiento" autocomplete="off">
  <div id="destino-list" class="autocomplete-list"></div>
</div>
    <div class="search-input">
      <label>Check-in</label>
      <input type="date">
    </div>
    <div class="search-input">
      <label>Check-out</label>
      <input type="date">
    </div>
    <div class="search-input">
  <label>Huéspedes</label>
  <div class="guests-dropdown">
    <button type="button" id="guests-btn">1 adulto, 0 niños, 1 habitación</button>
    <div class="guests-menu">
      <div class="guest-row">
        <span>Adultos</span>
        <div class="guest-controls">
          <button type="button" class="minus" data-type="adults">-</button>
          <span id="adults-count">1</span>
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
      <div id="children-ages" style="margin-top:10px;"></div>
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
</div>

</section>

  <!-- Sección: Ofertas -->
  <!-- Sección: Oferta destacada -->
<section class="offers-section">
  <h2>Ofertas de Fin de Año</h2>
  <div class="offer-banner">
    <p>Pasarla bien por un rato<br>Disfruta hasta el último rayo de sol con al menos un 15% de descuento</p>
    <a href="/viaje/viaje/Viaje-APP/componentes/ofertas/ofertas.php" class="offer-btn">Ver más ofertas</a>
  </div>
</section>

  <!-- Sección: Destinos de moda -->
  <section class="trending-section">
    <h2>Destinos de moda</h2>
    <div class="cards-container">
      <div class="card">París</div>
      <div class="card">Nueva York</div>
      <div class="card">Tokio</div>
      <div class="card">Roma</div>
    </div>
  </section>

  <!-- Sección: Buscar por tipo de alojamiento -->
  <section class="type-section">
    <h2>Buscar por tipo de alojamiento</h2>
    <div class="cards-container">
      <div class="card">Hotel</div>
      <div class="card">Casa</div>
      <div class="card">Departamento</div>
      <div class="card">Hostal</div>
    </div>
  </section>

  <!-- Sección: Planificador rápido -->
  <section class="planner-section">
    <h2>Un planificador de viajes fácil y rápido</h2>
    <p>Organiza tu viaje en minutos y encuentra las mejores opciones según tus preferencias.</p>
    <button>Comenzar</button>
  </section>

  <!-- Sección: Viaja más por menos -->
  <section class="save-section">
    <h2>Viaja más por menos</h2>
    <p>Encuentra descuentos exclusivos y promociones solo para usuarios registrados.</p>
  </section>

  <!-- Sección: Atracciones populares -->
  <section class="attractions-section">
    <h2>Atracciones populares</h2>
    <div class="cards-container">
      <div class="card">Torre Eiffel</div>
      <div class="card">Gran Cañón</div>
      <div class="card">Playa de Copacabana</div>
      <div class="card">Coliseo</div>
    </div>
  </section>

  <!-- Sección: Casas y departamentos favoritos -->
  <section class="favorite-section">
    <h2>Casas y departamentos que les encantan a los huéspedes</h2>
    <div class="cards-container">
      <div class="card">Apartamento en París</div>
      <div class="card">Casa en Bali</div>
      <div class="card">Loft en Nueva York</div>
    </div>
    <button>Explorar más</button>
  </section>

  <!-- Sección: Por qué Booking.com -->
  <section class="why-section">
    <h2>¿Por qué Remolinos Tours?</h2>
    <div class="benefits-container">
      <div class="benefit">
        <strong>Reserva ahora, paga en el alojamiento</strong>
        <p>Cancelación GRATIS en la mayoría de las habitaciones.</p>
      </div>
      <div class="benefit">
        <strong>Más de 300 millones de comentarios</strong>
        <p>Información confiable de huéspedes como tú.</p>
      </div>
      <div class="benefit">
        <strong>Más de 2 millones de alojamientos</strong>
        <p>Hoteles, casas de huéspedes, departamentos y más.</p>
      </div>
      <div class="benefit">
        <strong>Atención al cliente 24 horas</strong>
        <p>Siempre estamos para ayudarte.</p>
      </div>
    </div>
  </section>
</main>

<script src="/viaje/viaje/Viaje-APP/index.js"></script>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/footer/footer.php"); ?>
</body>
</html>
