<?php
session_start();

if (isset($_SESSION['usuarios'])) {
  header("Location: /Viaje-APP/default.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos/header.css">
   <link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos_footer/estilos_footer.css">
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/header/header.php"); ?>
  <div class="container">
    <div class="welcome-panel">
      <div class="welcome-icon"><i class="fas fa-user-plus"></i></div>
      <h1>¡Bienvenido!</h1>
      <p>Regístrate para accedera todas las funciones y disfrutar de nuestra plataforma.</p>
    </div>

    <div class="register-panel">
      <h2>Crear Cuenta</h2>
      <form id="registerForm">
        <div class="input-group">
          <i class="fas fa-user"></i>
          <input type="text" id="nombre_usuario" name="nombre_usuario" autocomplete="off" placeholder="Nombre" required>
        </div>
        <div class="input-group">
          <i class="fas fa-user"></i>
          <input type="text" id="apellido_paterno" name="apellido_paterno" autocomplete="off" placeholder="Apellido Paterno" required>
        </div>
        <div class="input-group">
          <i class="fas fa-user"></i>
          <input type="text" id="apellido_materno" name="apellido_materno" autocomplete="off" placeholder="Apellido Materno">
        </div>
        <div class="input-group">
          <i class="fas fa-phone"></i>
          <input type="tel" id="telefono" name="telefono" autocomplete="off" placeholder="telefono" required minlength="10" title="Debe contener 10 numeros">
        </div>
        <div class="input-group">
          <i class="fas fa-envelope"></i>
          <input type="email" id="email" name="email" autocomplete="off" placeholder="Correo" required>
        </div>
        <div class="input-group">
          <i class="fas fa-lock" id="togglecontraseña"></i>
          <input type="password" id="contraseña" name="contraseña" autocomplete="new-password" placeholder="Contraseña" required minlength="6">
        </div>
        <div id="contraseña-info">
          <span id="charLength">6+ caracteres</span> |
          <span id="uppercase">Mayúscula</span> |
          <span id="lowercase">Minúscula</span> |
          <span id="number">Número</span> |
          <span id="special">Carácter especial</span>
        </div>
        <button type="submit">Registrarse</button>
      </form>
      <p>¿Ya tienes cuenta? <a href="/Viaje-APP/componentes/iniciarsesion/sign.php">Inicia sesión aquí</a></p>
    </div>
  </div>
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/footer/footer.php"); ?>
</body>

</html>
