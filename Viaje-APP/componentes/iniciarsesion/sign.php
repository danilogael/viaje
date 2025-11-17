<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Profesional</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos/header.css">
    <link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos_footer/estilos_footer.css">
</head>
<body>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/header/header.php"); ?>

<div class="container">
    <div class="welcome-panel">
        <h1>Welcome Back!</h1>
        <p>Bienvenido de nuevo, inicia sesión para continuar con tu experiencia.</p>
    </div>

    <div class="login-panel">
        <h2>Iniciar Sesión</h2>
        <form id="loginForm">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="correo" placeholder="Correo" required>
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="contraseña" placeholder="Contraseña" required>
            </div>

            <button type="submit" id="submitBtn">Entrar</button>
        </form>

        <p>¿No tienes cuenta?
            <a href="/viaje/viaje/Viaje-APP/componentes/Register/Register.php">Regístrate aquí</a>
        </p>
    </div>
</div>

<script>
const loginForm = document.getElementById('loginForm');
const submitBtn = document.getElementById('submitBtn');

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
</script>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/footer/footer.php"); ?>

</body>
</html>
