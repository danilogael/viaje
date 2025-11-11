<?php
session_start();

if (isset($_SESSION['usuarios'])) {
  header("Location: ../Viaje-APP/default.php");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  header('Content-Type: application/json');

  $first_name = $_POST['nombre_usuario'] ?? '';
  $last_name = $_POST['apellido_paterno'] ?? '';
  $middle_name = $_POST['apellido_materno'] ?? '';
  $email = $_POST['email'] ?? '';
  $password = $_POST['contraseña'] ?? '';
  $phone = $_POST['telefono'] ?? '';

  if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/', $password)) {
    echo json_encode([
      'success' => false,
      'message' => 'La contraseña debe tener al menos 6 caracteres, una mayúscula, una minúscula, un número y un carácter especial.'
    ]);
    exit;
  }

  echo json_encode(['success' => true]);
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
</head>
<body>
  <div class="container">
    <div class="welcome-panel">
      <div class="welcome-icon"><i class="fas fa-user-plus"></i></div>
      <h1>¡Bienvenido!</h1>
      <p>Regístrate para acceder a todas las funciones y disfrutar de nuestra plataforma.</p>
    </div>

    <div class="register-panel">
      <h2>Crear Cuenta</h2>
      <form id="registerForm">
        <div class="input-group">
          <i class="fas fa-user"></i>
          <input type="text" id="first_name" name="first_name" placeholder="Nombre" required>
        </div>
        <div class="input-group">
          <i class="fas fa-user"></i>
          <input type="text" id="last_name" name="last_name" placeholder="Apellido Paterno" required>
        </div>
        <div class="input-group">
          <i class="fas fa-user"></i>
          <input type="text" id="middle_name" name="middle_name" placeholder="Apellido Materno">
        </div>
        <div class="input-group">
          <i class="fas fa-phone"></i>
          <input type="tel" id="phone" name="phone" placeholder="telefono" required pattern="[0-9]{10}" title="Debe contener 10 numeros">
        </div>
        <div class="input-group">
          <i class="fas fa-envelope"></i>
          <input type="email" id="email" name="email" placeholder="Correo" required>
        </div>
        <div class="input-group">
          <i class="fas fa-lock" id="togglePassword"></i>
          <input type="password" id="password" name="password" placeholder="Contraseña" required minlength="6">
        </div>
        <div id="password-info">
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
</body>

</html>
