const registerForm = document.getElementById('registerForm');
const passwordInput = document.getElementById('contraseña'); 
const togglePassword = document.getElementById('togglecontraseña'); 

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
    // Asegúrate de que la ruta sea correcta según tu estructura
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
