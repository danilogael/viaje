const loginBtn = document.getElementById('loginBtn');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const loginForm = document.getElementById('loginForm');
const togglePassword = document.getElementById('togglePassword');

let attempts = 0;
const maxAttempts = 3;
let lockTimeout;

// Toggle mostrar/ocultar contraseña
togglePassword.addEventListener('click', () => {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    togglePassword.classList.toggle('fa-eye-slash');
});

// Deshabilitar botón si campos vacíos
function checkLoginFields() {
  loginBtn.disabled = emailInput.value.trim() === '' || passwordInput.value.trim() === '';
}
emailInput.addEventListener('input', checkLoginFields);
passwordInput.addEventListener('input', checkLoginFields);
loginBtn.disabled = true;

// Manejo de login con bloqueo
loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    if(loginBtn.disabled) return;

    const formData = new FormData(loginForm);

    try {
        const res = await fetch('../LoginAPI/login.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();

        if(data.success){
            Swal.fire({
                icon: 'success',
                title: '¡Bienvenido!',
                text: `Hola ${data.user.first_name}`,
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.href = "components/ViewData/ViewData.php";
            });
        } else {
            attempts++;
            Swal.fire({
                icon: 'error',
                title: 'Login incorrecto',
                text: `Intento ${attempts} de ${maxAttempts}`
            });

            if(attempts >= maxAttempts){
                loginBtn.disabled = true;
                Swal.fire({
                    icon: 'warning',
                    title: 'Demasiados intentos',
                    text: 'Intenta de nuevo en 1 minuto'
                });
                lockTimeout = setTimeout(() => {
                    attempts = 0;
                    loginBtn.disabled = false;
                }, 60000);
            }
        }

    } catch(err){
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo conectar con el servidor'
        });
    }
});
