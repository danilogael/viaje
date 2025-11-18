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
      <p>Regístrate para acceder a todas las funciones y disfrutar de nuestra plataforma.</p>
    </div>

    <div class="register-panel">
      <h2>Crear Cuenta</h2>
      <form id="registerForm">
        <div class="input-group">
          <i class="fas fa-user"></i>
          <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
        </div>
        <div class="input-group">
          <i class="fas fa-user"></i>
          <input type="text" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido Paterno" required>
        </div>
        <div class="input-group">
          <i class="fas fa-user"></i>
          <input type="text" id="apellido_materno" name="apellido_materno" placeholder="Apellido Materno" required>
        </div>
        <div class="input-group">
          <i class="fas fa-envelope"></i>
          <input type="email" id="correo" name="correo" placeholder="Correo" required minlength="10">
        </div>
        <div class="input-group">
          <i class="fas fa-phone"></i>
          <input type="text" id="telefono" name="telefono" placeholder="Teléfono" required>
        </div>

        <!-- Contraseña -->
        <div class="input-group">
          <i class="fas fa-lock"></i>
          <input type="password" class="password" name="contraseña" placeholder="Contraseña" required minlength="6">
          <i class="fas fa-eye toggle-password"></i>
        </div>

        <!-- Confirmar contraseña -->
        <div class="input-group">
          <i class="fas fa-lock"></i>
          <input type="password" class="password" name="confirmar_contraseña" placeholder="Confirmar Contraseña" required minlength="6">
          <i class="fas fa-eye toggle-password"></i>
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
      <p>¿Ya tienes cuenta? <a href="/viaje/viaje/Viaje-APP/componentes/iniciarsesion/sign.php">Inicia sesión aquí</a></p>
    </div>
  </div>

  <script>
    const registerForm = document.getElementById('registerForm');
    const passwordInput = document.querySelector('input[name="contraseña"]');
    
    // Checklist visual
    const checklist = {
      charLength: document.getElementById('charLength'),
      uppercase: document.getElementById('uppercase'),
      lowercase: document.getElementById('lowercase'),
      number: document.getElementById('number'),
      special: document.getElementById('special')
    };

    // Mostrar/ocultar contraseñas
    document.querySelectorAll('.toggle-password').forEach(eye => {
      eye.addEventListener('click', () => {
        const input = eye.previousElementSibling;
        if(input.type === 'password'){
          input.type = 'text';
          eye.classList.add('fa-eye-slash');
        } else {
          input.type = 'password';
          eye.classList.remove('fa-eye-slash');
        }
      });
    });

    // Validación visual de contraseña
    passwordInput.addEventListener('input', () => {
      const val = passwordInput.value;
      checklist.charLength.style.color = val.length >= 6 ? '#1abc9c' : '#e74c3c';
      checklist.uppercase.style.color = /[A-Z]/.test(val) ? '#1abc9c' : '#e74c3c';
      checklist.lowercase.style.color = /[a-z]/.test(val) ? '#1abc9c' : '#e74c3c';
      checklist.number.style.color = /\d/.test(val) ? '#1abc9c' : '#e74c3c';
      checklist.special.style.color = /[\W_]/.test(val) ? '#1abc9c' : '#e74c3c';
    });

    // Enviar formulario
    registerForm.addEventListener('submit', async e => {
      e.preventDefault();
      const val = passwordInput.value;
      const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/;

      if(!regex.test(val)){
        Swal.fire({
          icon: 'warning',
          title: 'Contraseña inválida',
          html: 'Debe cumplir todos los requisitos de la línea debajo del campo.'
        });
        return;
      }

      const formData = new FormData(registerForm);

      try {
        const res = await fetch('/viaje/viaje/LoginAPI/register.php', {
          method: 'POST',
          body: formData
        });
        const data = await res.json();

        if(data.success){
          Swal.fire({
            icon: 'success',
            title: '¡Registro exitoso!',
            text: 'Ahora puedes iniciar sesión',
            timer: 1500,
            showConfirmButton: false
          }).then(() => window.location.href = "/viaje/viaje/Viaje-APP/componentes/iniciarsesion/sign.php");
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: data.message || 'Error al registrarse'
          });
        }
      } catch(err){
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'No se pudo conectar con el servidor'
        });
      }
    });
  </script>

  <?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/footer/footer.php"); ?>
</body>
</html>
