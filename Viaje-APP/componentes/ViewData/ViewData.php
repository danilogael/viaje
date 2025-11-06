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
            window.location.href = '../../index.php';
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
  0% {background-position: 0% 50%;}
  50% {background-position: 100% 50%;}
  100% {background-position: 0% 50%;}
}

.container {
  width: 90%;
  max-width: 500px;
}

.card {
  background: rgba(255,255,255,0.05);
  border-radius: 15px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.5);
  overflow: hidden;
}

.card-header {
  background: rgba(255,255,255,0.1);
  color: #ecf0f1;
  text-align: center;
  padding: 15px;
  font-size: 20px;
  font-weight: 600;
}

.card-body {
  padding: 20px;
  color: #ecf0f1;
}

#userData p {
  margin: 8px 0;
  font-size: 15px;
}

.btn {
  display: block;
  width: 100%;
  padding: 12px;
  margin-top: 15px;
  background-color: rgba(26,188,156,0.8);
  color: #fff;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  font-size: 16px;
  font-weight: 600;
  transition: 0.3s;
}

.btn:hover {
  background-color: rgba(26,188,156,1);
}
</style>
</head>
<body>
<div class="container">
  <div class="card">
    <div class="card-header">Mi Perfil</div>
    <div class="card-body">
      <div id="userData">
       
      </div>
      <button id="logoutBtn" class="btn">Cerrar Sesión</button>
    </div>
  </div>
</div>

<script>
async function loadUser() {
    try {
        const res = await fetch('../../../LoginAPI/getUser.php');
        const data = await res.json();

        if (data.success) {
            const user = data.user;
            document.getElementById('userData').innerHTML = `
                <p><strong>Nombre:</strong> ${user.first_name}</p>
                <p><strong>Apellido Paterno:</strong> ${user.last_name}</p>
                <p><strong>Apellido Materno:</strong> ${user.middle_name || '-'}</p>
                <p><strong>Correo:</strong> ${user.email}</p>
                <p><strong>phone:</strong> ${user.phone}</p>
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
        const res = await fetch('../../../LoginAPI/logOut.php');
        const data = await res.json();

        if (data.success) {
                window.location.href = '../../index.php';
            
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
</body>
</html>