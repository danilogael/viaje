
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
  <div class="logo-titulo">

    <img src="/viaje/viaje/Viaje-APP/componentes/imagenes/Logo.png" alt="Logo Remolinos Tours" width="100">
    
    <h1>Remolinos Tours</h1>
  </div>

  <nav>
    <ul class="nav-links" id="nav-links">
      <li><a href="/viaje/viaje/Viaje-APP/default.php">Listo para tu viaje</a></li>
      <li><a href="/viaje/viaje/Viaje-APP/componentes/paquetes/paquete.php">Paquetes</a></li>
      <li><a href="/viaje/viaje/Viaje-APP/componentes/Planea/planea.php">Planea tu viaje</a></li>
      <li><a href="/viaje/viaje/Viaje-APP/componentes/ofertas/ofertas.php">Ofertas</a></li>
      <li><a href="#">Idioma y Moneda</a></li>

      <?php if (isset($_SESSION['user_id'])): ?>
     

        <li class="user-menu">
          <!-- Ícono del perfil (puedes usar FontAwesome o un ícono propio) -->
          <div class="user-icon">
            <i class="fas fa-user-circle"></i>
          </div>

          <!-- Menú desplegable que aparece al pasar el mouse sobre el ícono -->
          <ul class="dropdown">
            <li><a href="/viaje/viaje/Viaje-APP/componentes/ViewData/ViewData.php">Mi perfil</a></li>
      
            <li><a href="/viaje/viaje/LoginAPI/logOut.php">Cerrar sesión</a></li>
          </ul>
        </li>

      <?php else: ?>
        <li><a href="/viaje/viaje/Viaje-APP/componentes/iniciarsesion/sign.php">Iniciar sesión</a></li>
      <?php endif; ?>
    </ul>
  </nav>

  
</header>
