<?php
session_start();

if (isset($_SESSION['user'])) {
  header("Location: ../ViewData/ViewData.php");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  header('Content-Type: application/json');

  $first_name = $_POST['first_name'] ?? '';
  $last_name = $_POST['last_name'] ?? '';
  $middle_name = $_POST['middle_name'] ?? '';
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $phone = $_POST['phone'] ?? '';

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
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(-45deg, #2c3e50, #34495e, #5d6d7e, #1abc9c);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
    }

    @keyframes gradientBG {
      0% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }

      100% {
        background-position: 0% 50%;
      }
    }

    .container {
      width: 800px;
      max-width: 90%;
      display: flex;
      border-radius: 25px;
      overflow: hidden;
      box-shadow: 0 15px 50px rgba(0, 0, 0, 0.5);
    }

    .welcome-panel {
      flex: 1;
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(15px);
      padding: 40px;
      color: #ecf0f1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    .welcome-icon {
      font-size: 60px;
      margin-bottom: 20px;
      color: #f1c40f;
      animation: float 4s ease-in-out infinite;
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-15px);
      }
    }

    .welcome-panel h1 {
      font-size: 34px;
      margin-bottom: 15px;
      text-shadow: 0 0 8px rgba(255, 255, 255, 0.5);
    }

    .welcome-panel p {
      font-size: 16px;
      max-width: 250px;
    }

    /* Panel de registro */
    .register-panel {
      flex: 1;
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(20px);
      padding: 50px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .register-panel h2 {
      color: #ecf0f1;
      font-size: 28px;
      margin-bottom: 30px;
      text-align: center;
    }

    .input-group {
      position: relative;
      margin-bottom: 20px;
    }

    .input-group i {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: rgba(255, 255, 255, 0.7);
      cursor: pointer;
    }

    .input-group input {
      padding: 12px 15px 12px 40px;
      border: none;
      border-radius: 12px;
      font-size: 15px;
      background: rgba(255, 255, 255, 0.2);
      color: #fff;
      outline: none;
      transition: all 0.3s;
      width: 100%;
    }

    .input-group input::placeholder {
      color: rgba(255, 255, 255, 0.7);
    }

    .input-group input:focus {
      background: rgba(255, 255, 255, 0.3);
      box-shadow: 0 0 15px rgba(26, 188, 156, 0.6);
      transform: scale(1.02);
    }

    .register-panel button {
      background: linear-gradient(135deg, #16a085, #1abc9c);
      color: #fff;
      border: none;
      padding: 12px;
      border-radius: 15px;
      font-weight: 700;
      cursor: pointer;
      box-shadow: 0 0 15px rgba(26, 188, 156, 0.5), 0 0 30px rgba(22, 160, 133, 0.3);
      transition: all 0.3s ease;
    }

    .register-panel button:hover {
      box-shadow: 0 0 25px #16a085, 0 0 40px #1abc9c, 0 0 60px rgba(26, 188, 156, 0.5);
      transform: translateY(-2px) scale(1.05);
    }

    .register-panel p {
      font-size: 14px;
      margin-top: 15px;
      color: rgba(255, 255, 255, 0.9);
      text-align: center;
    }

    .register-panel p a {
      color: #f1c40f;
      font-weight: 700;
      text-decoration: none;
      transition: all 0.3s;
    }

    .register-panel p a:hover {
      color: #f39c12;
      text-decoration: underline;
    }

    #password-info {
      font-size: 12px;
      color: #fff;
      margin-top: -10px;
      margin-bottom: 10px;
    }

    #password-info span {
      margin-right: 8px;
    }
  </style>
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
      <p>¿Ya tienes cuenta? <a href="../../index.php">Inicia sesión aquí</a></p>
    </div>
  </div>

  <script>
    const registerForm = document.getElementById('registerForm');
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');

    const checklist = {
      charLength: document.getElementById('charLength'),
      uppercase: document.getElementById('uppercase'),
      lowercase: document.getElementById('lowercase'),
      number: document.getElementById('number'),
      special: document.getElementById('special')
    };

    // Mostrar/ocultar contraseña
    togglePassword.addEventListener('click', () => {
      const type = passwordInput.type === 'password' ? 'text' : 'password';
      passwordInput.type = type;
      togglePassword.classList.toggle('fa-eye-slash');
    });

    passwordInput.addEventListener('input', () => {
      const val = passwordInput.value;
      checklist.charLength.style.color = val.length >= 6 ? '#1abc9c' : '#e74c3c';
      checklist.uppercase.style.color = /[A-Z]/.test(val) ? '#1abc9c' : '#e74c3c';
      checklist.lowercase.style.color = /[a-z]/.test(val) ? '#1abc9c' : '#e74c3c';
      checklist.number.style.color = /\d/.test(val) ? '#1abc9c' : '#e74c3c';
      checklist.special.style.color = /[\W_]/.test(val) ? '#1abc9c' : '#e74c3c';
    });

    registerForm.addEventListener('submit', async e => {
      e.preventDefault();
      const val = passwordInput.value;
      const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/;
      if (!regex.test(val)) {
        Swal.fire({
          icon: 'warning',
          title: 'Contraseña inválida',
          html: 'Debe cumplir todos los requisitos de la línea debajo del campo.'
        });
        return;
      }

      const formData = new FormData(registerForm);

      try {
        const res = await fetch('../../../LoginAPI/register.php', {
  method: 'POST',
  body: formData
});



        const data = await res.json();

        if (data.success) {
          Swal.fire({
            icon: 'success',
            title: '¡Registro exitoso!',
            text: 'Ahora puedes iniciar sesión',
            timer: 1500,
            showConfirmButton: false
          }).then(() => window.location.href = "../../index.php");
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: data.message || 'Error al registrarse'
          });
        }
      } catch (err) {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'No se pudo conectar con el servidor'
        });
      }
    });
  </script>
</body>

</html>
