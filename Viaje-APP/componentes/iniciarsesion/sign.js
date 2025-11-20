const loginForm = document.getElementById('loginForm');
const submitBtn = document.querySelector(".next-btn");

const MAX_ATTEMPTS = 3;
const BLOCK_TIME = 60 * 1000; // 1 min

// Verificar bloqueo
function checkBlocked() {
    const blockedUntil = localStorage.getItem('blockedUntil');
    if (blockedUntil) {
        const now = Date.now();
        if (now < blockedUntil) {
            const remaining = Math.ceil((blockedUntil - now) / 1000);
            submitBtn.disabled = true;

            Swal.fire({
                icon: 'warning',
                title: 'Cuenta bloqueada',
                text: `Intenta nuevamente en ${remaining} segundos.`,
                timer: 2500,
                showConfirmButton: false
            });

            setTimeout(() => submitBtn.disabled = false, blockedUntil - now);
            return true;
        } else {
            localStorage.removeItem('attempts');
            localStorage.removeItem('blockedUntil');
        }
    }
    return false;
}

checkBlocked();

// Manejar submit
loginForm.addEventListener('submit', async e => {
    e.preventDefault();
    if (checkBlocked()) return;

    const formData = new FormData(loginForm);

    try {
        const res = await fetch("/viaje/viaje/LoginAPI/login.php", {
            method: "POST",
            body: formData
        });

        const data = await res.json();

        if (data.success) {
            localStorage.removeItem('attempts');

            Swal.fire({
                icon: 'success',
                title: '¡Bienvenido!',
                text: `Hola ${data.user.nombre} ${data.user.apellido_paterno}`,
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.href = "/viaje/viaje/Viaje-APP/componentes/ViewData/ViewData.php";
            });

        } else {
            let attempts = parseInt(localStorage.getItem('attempts') || "0") + 1;
            localStorage.setItem('attempts', attempts);

            if (attempts >= MAX_ATTEMPTS) {
                const blockUntil = Date.now() + BLOCK_TIME;
                localStorage.setItem('blockedUntil', blockUntil);
                submitBtn.disabled = true;

                Swal.fire({
                    icon: 'error',
                    title: 'Cuenta bloqueada',
                    text: '3 intentos fallidos. Espera 1 minuto.'
                });

                setTimeout(() => {
                    submitBtn.disabled = false;
                    localStorage.removeItem('attempts');
                    localStorage.removeItem('blockedUntil');
                }, BLOCK_TIME);

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: `Credenciales incorrectas. Intento ${attempts} de ${MAX_ATTEMPTS}`
                });
            }
        }

    } catch (err) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo conectar con el servidor'
        });
    }
});
const togglePassword = document.querySelector(".toggle-password");
const passwordInput = document.getElementById("password");

togglePassword.addEventListener("click", () => {
    const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
    passwordInput.setAttribute("type", type);

    // Cambiar ícono
    togglePassword.classList.toggle("fa-eye");
    togglePassword.classList.toggle("fa-eye-slash");
});
