
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

  <!-- Hero con buscador -->
  <section class="hero">
    <div class="hero-overlay">
    
      <h1>Descubre el mundo con <span class="marca">Remolinos Tours</span></h1>
      <form class="buscador">
        <input type="text" placeholder="Destino" name="destino" required>
        <input type="date" name="fecha_llegada" required>
        <input type="date" name="fecha_salida" required>
        <input type="number" placeholder="Huéspedes" name="huespedes" min="1" required>
        <input type="number" placeholder="Habitaciones" name="habitaciones" min="1" required>
      </form>
         <button class="btn" type="submit">Buscar</button>
      <button class="btn-reserva">Reserva ahora</button>
    </div>
  </section>

  <!-- Ofertas -->
  <section class="ofertas">
    <h2>Ofertas exclusivas para ti</h2>
    <div class="grid">
      <div class="card">
        <img src="playa.jpg" alt="Oferta Playa">
        <h3>Paquete Playa</h3>
        <p>Desde $499 USD</p>
        <div class="acciones">
          <button class="favorito">❤️</button>
          <span class="estrellas">⭐⭐⭐⭐☆</span>
          <button class="btn">Me interesa</button>
        </div>
      </div>
      <div class="card">
        <img src="montana.jpg" alt="Oferta Montaña">
        <h3>Paquete Montaña</h3>
        <p>Desde $399 USD</p>
        <div class="acciones">
          <button class="favorito">❤️</button>
          <span class="estrellas">⭐⭐⭐☆☆</span>
          <button class="btn">Me interesa</button>
        </div>
      </div>
    </div>
    <div class="ver-mas">
      <a href="ofertas.php" class="btn">Ver más ofertas</a>
    </div>
  </section>

  <!-- Paquetes -->
  <section class="paquetes">
    <h2>Paquetes destacados</h2>
    <div class="grid">
      <div class="card">
        <img src="ciudad.jpg" alt="Paquete Ciudad">
        <h3>Paquete Ciudad</h3>
        <p>Desde $599 USD</p>
        <div class="acciones">
          <button class="favorito">❤️</button>
          <span class="estrellas">⭐⭐⭐⭐⭐</span>
          <button class="btn">Me interesa</button>
        </div>
      </div>
    </div>
    <div class="ver-mas">
      <a href="paquetes.php" class="btn">Ver más paquetes</a>
    </div>
  </section>

  <!-- Por qué elegirnos -->
  <section class="porque-elegirnos">
    <h2>¿Por qué elegir <span class="marca">Remolinos Tours</span>?</h2>
    <div class="beneficios-grid">
      <div class="beneficio">
        <img src="busqueda.png" alt="Busca fácilmente">
        <h3>Busca fácilmente</h3>
        <p>Explora cientos de destinos en segundos con nuestro buscador inteligente.</p>
      </div>
      <div class="beneficio">
        <img src="comparacion.png" alt="Compara con confianza">
        <h3>Compara con confianza</h3>
        <p>Consulta precios y beneficios de cada paquete desde una sola plataforma.</p>
      </div>
      <div class="beneficio">
        <img src="ahorro.png" alt="Ahorra a lo grande">
        <h3>Ahorra a lo grande</h3>
        <p>Accede a ofertas exclusivas y promociones especiales.</p>
      </div>
    </div>
  </section>

  <!-- Búsquedas populares -->
  <section class="busquedas-populares">
    <h2>Búsquedas populares</h2>
    <div class="bp-grid">
      <a class="bp-card" href="ciudad.php?slug=cancun">
        <img src="cancun.jpg" alt="Cancún">
        <div class="bp-info">
          <h3>Cancún</h3>
          <p>1,750 hoteles • $3,672 prom.</p>
        </div>
      </a>
      <a class="bp-card" href="ciudad.php?slug=vallarta">
        <img src="vallarta.jpg" alt="Puerto Vallarta">
        <div class="bp-info">
          <h3>Puerto Vallarta</h3>
          <p>1,228 hoteles • $4,266 prom.</p>
        </div>
      </a>
      <a class="bp-card" href="ciudad.php?slug=acapulco">
        <img src="acapulco.jpg" alt="Acapulco">
        <div class="bp-info">
          <h3>Acapulco</h3>
          <p>621 hoteles • $3,095 prom.</p>
        </div>
      </a>
    </div>
    <div class="ver-mas">
      <a href="busquedas.php" class="btn">Explorar más búsquedas</a>
    </div>
  </section>

  <!-- Testimonios -->
  <section class="testimonios">
    <h2>Lo que dicen nuestros clientes</h2>
    <div class="testimonios-grid">
      <blockquote>
        "El mejor viaje de mi vida, todo organizado a la perfección."  
        <footer>⭐⭐⭐⭐⭐ – Ana G.</footer>
      </blockquote>
      <blockquote>
        "Excelente atención y destinos increíbles."  
        <footer>⭐⭐⭐⭐☆ – Carlos M.</footer>
      </blockquote>
    </div>
  </section>

  <!-- Quiénes somos -->
  <section class="quienes">
    <h2>Conoce <span class="marca">Remolinos Tours</span></h2>
    <p>Somos una agencia mexicana con más de 10 años creando experiencias únicas. Nuestra misión es que cada viaje sea seguro, emocionante y personalizado.</p>
    <img src="equipo.jpg" alt="Nuestro equipo">
  </section>

  <!-- Botón flotante -->
  <div class="reserva-flotante">
    <a href="reservas.php" class="btn">Reserva ahora</a>
  </div>

</main>
<script src="/viaje/viaje/Viaje-APP/index.js"></script>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/footer/footer.php"); ?>
</body>
</html>
