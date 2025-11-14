<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Acceso denegado',
            text: 'Debes iniciar sesión primero',
            timer: 2000,
            showConfirmButton: false,
            confirmButtonColor: '#1abc9c'
        }).then(() => {
            window.location.href = 'viaje/viaje/Viaje-APP/componentes/iniciarsesion/sign.php';
        });
    </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Perfil de Usuario</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="ViewData.css">
<link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos/header.css">
   <link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos_footer/estilos_footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
   <?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/header/header.php"); ?>
<div class="container">

  <!-- ==== MENÚ LATERAL ==== -->
  <div class="sidebar">
    <ul>
      <li class="active"><i class="fa-solid fa-user"></i> Información personal</li>
      <li><i class="fa-solid fa-lock"></i> Seguridad de la cuenta</li>
      <li><i class="fa-solid fa-heart"></i> Favoritos</li>
      <li><i class="fa-solid fa-clock-rotate-left"></i> Vistos recientemente</li>
      <li><i class="fa-solid fa-suitcase"></i> Reservaciones</li>
      <li><i class="fa-solid fa-magnifying-glass"></i> Preferencias de búsqueda</li>
      <li><i class="fa-solid fa-bell"></i> Notificaciones</li>
      <li><i class="fa-solid fa-circle-question"></i> Ayuda y soporte</li>
    </ul>
  </div>

  <!-- ==== CONTENIDO DERECHO ==== -->
  <div class="card">
      <div class="card-header">Información personal</div>
      <div class="subtitle">Revisa o modifica tu información personal</div>

      <div id="userData"></div>

      <button id="logoutBtn" class="btn">Cerrar Sesión</button>
  </div>

</div>

    </div>
  </div>
</div>
<script> 
  async function loadUser() {
    try {
        const res = await fetch('/viaje/viaje/LoginAPI/getUser.php');
        const data = await res.json();

        if (data.success) {
            const user = data.user;
            document.getElementById('userData').innerHTML = `
                <p><strong>Nombre:</strong> ${user.first_name}</p>
                <p><strong>Segundo Nombre:</strong> ${user.middle_name || '-'}</p>
                <p><strong>Apellido:</strong> ${user.last_name}</p>
                <p><strong>Correo:</strong> ${user.email}</p>
            `;
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message || 'No se pudieron cargar los datos del usuario',
                confirmButtonColor: '#1abc9c'
            });
        }
    } catch (err) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo conectar con el servidor',
            confirmButtonColor: '#1abc9c'
        });
    }
}

loadUser();

document.getElementById('logoutBtn').addEventListener('click', async () => {
    try {
        const res = await fetch('/viaje/viaje/LoginAPI/logOut.php');
        const data = await res.json();

        if (data.success) {
                window.location.href = "/viaje/viaje/Viaje-APP/componentes/iniciarsesion/sign.php";
          
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message || 'No se pudo cerrar sesión',
                confirmButtonColor: '#1abc9c'
            });
        }
    } catch (err) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo conectar con el servidor',
            confirmButtonColor: '#1abc9c'
        });
    }
});
</script>
 <?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/footer/footer.php"); ?>
</body>
</html>
