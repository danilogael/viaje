<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Remolinos Tours</title>
  <link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos/header.css">
     <link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos_footer/estilos_footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="planea.css"
</head>
<body>
 <?php include($_SERVER['DOCUMENT_ROOT'] . '/viaje/viaje/Viaje-APP/componentes/header/header.php'); ?>
<section class="plan-trip">
  <div class="plan-trip-banner">
    <h2>Planea tu viaje</h2>
    <p>Cotiza tu viaje personalizado y elige lo que quieras: hotel, transporte, actividades o todo incluido.</p>
  </div>

  <div class="plan-trip-form">
    <div class="plan-option">
      <label for="destination">Destino</label>
      <input type="text" id="destination" placeholder="¿A dónde quieres ir?">
    </div>

    <div class="plan-option">
      <label for="checkin">Fecha de inicio</label>
      <input type="date" id="checkin">
    </div>

    <div class="plan-option">
      <label for="checkout">Fecha de fin</label>
      <input type="date" id="checkout">
    </div>

    <div class="plan-option guests">
      <label>Viajeros</label>
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
    </div>

    <div class="plan-options-checkbox">
      <label><input type="checkbox" name="services" value="hotel"> Hotel</label>
      <label><input type="checkbox" name="services" value="car"> Transporte</label>
      <label><input type="checkbox" name="services" value="activities"> Actividades</label>
      <label><input type="checkbox" name="services" value="all"> Todo incluido</label>
    </div>

    <button class="plan-trip-btn">Cotizar viaje</button>
  </div>
</section>

  <?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/footer/footer.php"); ?>
</body>
</html>
