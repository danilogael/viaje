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
            showConfirmButton: false
        }).then(() => {
            window.location.href = '/viaje/viaje/Viaje-APP/componentes/iniciarsesion/sign.php';
        });
    </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Mi cuenta — Remolinos Tours</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="ViewData.css">
  <link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos/header.css">
  <link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos_footer/estilos_footer.css">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/header/header.php"); ?>

<button id="darkModeBtn" class="dark-toggle" title="Modo oscuro"><i class="fa-solid fa-moon"></i></button>

<div class="container">
  <aside class="sidebar">
    <ul>
      <li class="active" data-section="info"><i class="fa-solid fa-user"></i> Información personal</li>
      <li data-section="seguridad"><i class="fa-solid fa-lock"></i> Seguridad</li>
      <li data-section="favoritos"><i class="fa-solid fa-heart"></i> Favoritos</li>
      <li data-section="recientes"><i class="fa-solid fa-clock-rotate-left"></i> Vistos recientemente</li>
      <li data-section="reservas"><i class="fa-solid fa-suitcase"></i> Reservaciones</li>
      <li data-section="preferencias"><i class="fa-solid fa-magnifying-glass"></i> Preferencias</li>
      <li data-section="notificaciones"><i class="fa-solid fa-bell"></i> Notificaciones</li>
      <li data-section="ayuda"><i class="fa-solid fa-circle-question"></i> Ayuda</li>
    </ul>
  </aside>

  <main class="content">
    <!-- INFORMACIÓN PERSONAL -->
    <section id="info" class="card">
      <h2>Información personal</h2>
      <p class="subtitle">Revisa o modifica tu información</p>
      <div id="userData"><p>Cargando...</p></div>

      <div class="actions">
        <button class="btn-edit" onclick="editarCampo('nombre')">Editar nombre</button>
        <button class="btn-edit" onclick="editarCampo('apellido_paterno')">Editar apellido paterno</button>
        <button class="btn-edit" onclick="editarCampo('apellido_materno')">Editar apellido materno</button>
        <button class="btn-edit" onclick="editarCampo('correo')">Editar correo</button>
        <button class="btn-edit" onclick="editarCampo('telefono')">Editar teléfono</button>
      </div>
      <div style="margin-top:18px;">
        <button id="logoutBtn" class="btn-danger">Cerrar sesión</button>
      </div>
    </section>

    <!-- SEGURIDAD -->
    <section id="seguridad" class="card hidden">
      <h2>Seguridad de la cuenta</h2>
      <p class="subtitle">Opciones de acceso y seguridad.</p>
      <button class="btn-edit" onclick="cambiarPassword()">Cambiar contraseña</button>
    </section>

    <!-- FAVORITOS -->
    <section id="favoritos" class="card hidden">
      <h2>Favoritos</h2>
      <p class="subtitle">Destinos guardados.</p>
      <div id="favList">Aún no hay favoritos.</div>
    </section>

    <!-- RECIENTES -->
    <section id="recientes" class="card hidden">
      <h2>Vistos recientemente</h2>
      <p class="subtitle">Tu historial reciente.</p>
      <div id="recentList">Sin historial.</div>
    </section>

    <!-- RESERVAS -->
    <section id="reservas" class="card hidden">
      <h2>Reservaciones</h2>
      <p class="subtitle">Tus reservas aparecerán aquí.</p>
      <div id="resList">No hay reservas.</div>
    </section>

  </main>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/footer/footer.php"); ?>

<script>
const GET_USER_URL = '/viaje/viaje/LoginAPI/getUser.php';
const UPDATE_USER_URL = '/viaje/viaje/LoginAPI/updateUser.php';
const CHANGE_PASS_URL = '/viaje/viaje/LoginAPI/changePassword.php';
const LOGOUT_URL = '/viaje/viaje/LoginAPI/logOut.php';

/* MODO OSCURO */
document.getElementById('darkModeBtn').addEventListener('click',()=>{
  document.body.classList.toggle('dark');
  localStorage.setItem('darkMode', document.body.classList.contains('dark'));
});
if(localStorage.getItem('darkMode')==='true'){document.body.classList.add('dark');}

/* SIDEBAR */
document.querySelectorAll('.sidebar li').forEach(li=>{
  li.addEventListener('click',()=>{
    document.querySelectorAll('.sidebar li').forEach(x=>x.classList.remove('active'));
    li.classList.add('active');
    document.querySelectorAll('.content .card').forEach(c=>c.classList.add('hidden'));
    const target = document.getElementById(li.dataset.section);
    if(target) target.classList.remove('hidden');
  });
});

/* Cargar datos */
async function loadUser(){
  const res = await fetch(GET_USER_URL);
  const data = await res.json();
  if(!data.success) return;
  const u = data.user;
  document.getElementById("userData").innerHTML = `
    <p><strong>Nombre:</strong> ${escapeHtml(u.nombre)}</p>
    <p><strong>Apellido paterno:</strong> ${escapeHtml(u.apellido_paterno)}</p>
    <p><strong>Apellido materno:</strong> ${escapeHtml(u.apellido_materno)}</p>
    <p><strong>Correo:</strong> ${escapeHtml(u.correo)}</p>
    <p><strong>Teléfono:</strong> ${escapeHtml(u.telefono)}</p>
    <p><strong>Rol:</strong> ${escapeHtml(u.rol)}</p>
  `;
}
loadUser();
function escapeHtml(t){return t??''}

/* Editar datos */
async function editarCampo(campo){
  const label = {
    nombre:'Nombre',
    apellido_paterno:'Apellido paterno',
    apellido_materno:'Apellido materno',
    correo:'Correo',
    telefono:'Teléfono'
  };

  const {value:nuevo} = await Swal.fire({
    title:`Editar ${label[campo]}`,
    input:'text',
    showCancelButton:true,
    inputValidator:(v)=>{
      if(!v) return 'No puede estar vacío';
      if(campo==='correo' && !/^\S+@\S+\.\S+$/.test(v)) return 'Correo inválido';
    }
  });

  if(!nuevo) return;

  const fd = new FormData();
  fd.append('campo',campo);
  fd.append('valor',nuevo);

  const res = await fetch(UPDATE_USER_URL,{method:'POST',body:fd});
  const data = await res.json();
  Swal.fire(data.success?'Listo':'Error',data.message,data.success?'success':'error');
  if(data.success) loadUser();
}

/* Cambiar contraseña */
async function cambiarPassword(){
  const {value:form} = await Swal.fire({
    title:"Cambiar contraseña",
    html:`
      <input id="currentPass" type="password" class="swal2-input" placeholder="Contraseña actual">
      <input id="newPass" type="password" class="swal2-input" placeholder="Nueva contraseña">
    `,
    preConfirm:()=>{
      const c=document.getElementById("currentPass").value;
      const n=document.getElementById("newPass").value;
      if(!c||!n) return Swal.showValidationMessage("Completa todos los campos");
      if(n.length<6) return Swal.showValidationMessage("Mínimo 6 caracteres");
      return {current:c,newp:n};
    },
    showCancelButton:true
  });

  if(!form) return;

  const fd=new FormData();
  fd.append("current_password",form.current);
  fd.append("new_password",form.newp);

  const req=await fetch(CHANGE_PASS_URL,{method:"POST",body:fd});
  const res=await req.json();
  Swal.fire(res.success?"Hecho":"Error",res.message,res.success?"success":"error");
}

/* Logout */
document.getElementById("logoutBtn").addEventListener("click",async()=>{
  await fetch(LOGOUT_URL);
  window.location.href="/viaje/viaje/Viaje-APP/componentes/iniciarsesion/sign.php";
});
</script>

</body>
</html>
