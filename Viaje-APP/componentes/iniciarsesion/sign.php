<?php
session_start();
if (isset($_SESSION['id_usuario'])) { 
    header("Location: Viaje-APP/default.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Remolinos Tours</title>
  <link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos/header.css">
     <link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos_footer/estilos_footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
     <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
 <?php include($_SERVER['DOCUMENT_ROOT'] . '/viaje/viaje/Viaje-APP/componentes/header/header.php'); ?>
 <div class="container">

    <div class="welcome-panel">
        <h1>Welcome Back!</h1>
        <p>Bienvenido de nuevo, inicia sesión para ofrecerte una mejor experiencia.</p>
    </div>
    <div class="login-panel">
        <h2>Iniciar Sesión</h2>
        <form id="loginForm">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" placeholder="Correo" required>
            </div>
            <div class="input-group">
                <i class="fas fa-phone"></i>
                <input type="tel" id="telefono" name="telefono" placeholder="Teléfono" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="contraseña" name="contraseña" placeholder="Contraseña" required>
            </div>

            <button type="submit" id="submitBtn">Entrar</button>
        </form>

        <div class="social-login">
            <p>O inicia sesión con:</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-google"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
        </div>

        <p>¿No tienes cuenta? <a href="/viaje/viaje/Viaje-APP/componentes/Register/Register.php">Regístrate aquí</a></p>
    </div>
</div>
  <script src="/Viaje-APP/componentes/js/header.js"></script>
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/footer/footer.php"); ?>
</body>
</html>
