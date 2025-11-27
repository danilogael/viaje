<?php
session_start();
require_once __DIR__ . "/../../../LoginAPI/db.php";

$query = $conexion->query("SELECT * FROM reseñas ORDER BY fecha DESC");
$reseñas = $query->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reseñas</title>

<link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos/header.css">
<link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos/estilos_footer.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>

<style>
/* ================= VARIABLES ================= */
:root {
    --blue: #21bbf3; /* Color de las estrellas y acentos */
    --dark-blue: #1aa0d8;
    --light-bg: #f5f7fa; /* Fondo suave de la sección */
    --text-color: #333;
    --shadow: 0 .5rem 1.5rem rgba(0,0,0,.08); /* Sombra suave */
    --white: #fff;
    --grey-text: #6c757d;
}

/* ================= BASE STYLES ================= */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: var(--light-bg);
    line-height: 1.6;
    color: var(--text-color);
    margin: 0;
    padding: 0;
}

/* ================= SECCIÓN PRINCIPAL DE RESEÑAS ================= */
.reviews-section {
    padding: 3rem 5%; 
    max-width: 1200px;
    margin: 0 auto;
}

.reviews-section h1 {
    text-align: center;
    color: var(--dark-blue);
    font-size: 2.5rem;
    margin-bottom: 1.5rem;
    padding-top: 1rem;
    font-weight: 700;
}

.reviews-section h2 {
    font-size: 1.8rem;
    margin-top: 3rem;
    margin-bottom: 2rem;
    color: var(--text-color);
    border-bottom: 2px solid var(--blue);
    display: inline-block;
    padding-bottom: .5rem;
}

/* Línea de separación */
.reviews-section hr {
    border: none;
    border-top: 1px solid rgba(0,0,0,.1);
    margin: 3rem 0;
}

/* Estilos de la respuesta del servidor */
#respuesta {
    text-align: center;
    font-size: 1.1rem;
    color: green;
    margin-top: -1rem;
    margin-bottom: 1rem;
    font-weight: 500;
}

/* ================= FORMULARIO ================= */
form#ratingForm {
    max-width: 700px;
    margin: 3rem auto;
    background: var(--white);
    padding: 3rem;
    border-radius: 1.5rem;
    box-shadow: 0 1rem 3rem rgba(0,0,0,.1);
    border: none;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    transition: all 0.3s ease;
}

form#ratingForm input[type="text"],
form#ratingForm input[type="number"],
form#ratingForm textarea,
form#ratingForm input[type="file"] {
    padding: 16px 14px;
    border-radius: .7rem;
    border: 1px solid #ddd;
    font-size: 1rem;
    background: #fff;
}

.rating {
    gap: .6rem; 
    font-size: 2.5rem; 
}

.rating .star.selected {
    color: #ffc107; 
}

form#ratingForm button {
    padding: 16px;
    background: linear-gradient(45deg, var(--blue), var(--dark-blue));
    color: white;
    border-radius: .8rem;
    box-shadow: 0 5px 15px rgba(33,187,243,0.3);
}

/* ================= CONTENEDOR DE RESEÑAS (SCROLL HORIZONTAL) ================= */

.box-container {
    display: flex; /* Habilita el scroll horizontal */
    overflow-x: auto; 
    scroll-snap-type: x mandatory;
    padding: 1.5rem 0; 
    gap: 2rem; /* Espacio entre tarjetas */
    -webkit-overflow-scrolling: touch;
    margin: 0 auto; 
}

/* Estilos para la barra de scroll (opcional) */
.box-container::-webkit-scrollbar {
    height: 8px;
}
.box-container::-webkit-scrollbar-thumb {
    background: var(--blue);
    border-radius: 10px;
}

/* ================= TARJETA INDIVIDUAL (.box) ================= */

.box {
    min-width: 300px; 
    width: 320px; 
    flex: 0 0 auto; /* Esencial para el scroll horizontal */
    background: var(--white);
    padding: 2.5rem;
    border-radius: 1rem;
    box-shadow: 0 5px 15px rgba(0,0,0,.08);
    border: 1px solid #eee; 
    position: relative;
    transition: box-shadow 0.3s ease;
    scroll-snap-align: start;
    
    display: flex;
    flex-direction: column;
}

.box:hover {
    box-shadow: 0 8px 20px rgba(0,0,0,.1);
}

/* Estrellas de la reseña */
.box .stars {
    color: var(--blue); 
    margin-bottom: 1.5rem;
    font-size: 1.4rem; 
}

/* Texto de la reseña */
.box p {
    font-size: 1rem;
    line-height: 1.6;
    color: var(--text-color);
    margin-bottom: 2rem;
    flex-grow: 1; 
}

/* Imagen de la reseña (foto subida) */
.box img:not(.user img) {
    display: none; 
}

/* Contenedor que agrupa usuario y comillas */
.user-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto; 
}

/* Contenedor del usuario */
.box .user {
    display: flex;
    align-items: center;
    margin: 0;
    padding: 0;
    border-top: none;
}

/* Ícono de Usuario (REEMPLAZA LA IMAGEN) */
.box .user .user-icon {
    font-size: 3.5rem; /* Tamaño del ícono */
    color: var(--grey-text); 
    margin-right: 1rem;
    
    /* Simulación del espacio circular de la imagen */
    height: 3.5rem;
    width: 3.5rem;
    line-height: 3.5rem; 
    text-align: center;
    border-radius: 50%; 
    background: #eee; 
}

.box .user .user-info h3 {
    font-size: 1.1rem;
    font-weight: 700;
    margin: 0;
    line-height: 1.2;
}

.box .user .user-info span {
    font-size: 0.9rem; 
    color: var(--grey-text);
    display: block;
    margin-top: 0.2rem;
}

/* Icono de comillas grandes (decorativo) */
.box .fa-quote-right {
    position: static; 
    font-size: 3.5rem;
    color: rgba(0,0,0,0.08); 
}

/* Fecha de la reseña */
.box small {
    display: none; 
}

/* Mensaje si no hay reseñas */
.no-reseñas {
    width: 100%;
    text-align: center;
    padding: 3rem;
    font-size: 1.2rem;
    color: #666;
    background: #fff;
    border-radius: 1rem;
    box-shadow: var(--shadow);
}

/* ================= RESPONSIVE ================= */
@media (max-width: 768px) {
    .reviews-section {
        padding: 2rem 3%;
    }
    .box {
        min-width: 280px;
        padding: 2rem;
    }
}
</style>


</head>

<body>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/header/header.php"); ?>

<div class="reviews-section">
  <h1>Reseñas de Clientes</h1>

    <form id="ratingForm" enctype="multipart/form-data">
    <h3>Comparte tu experiencia</h3>

    <input type="text" name="nombre" placeholder="Tu nombre" required>
    <input type="text" name="destino" placeholder="Destino visitado" required>
    <input type="number" name="dias" placeholder="Días de viaje" required>

    <p>Calificación:</p>
    <div class="rating">
      <i class="fas fa-star star" data-value="1"></i>
      <i class="fas fa-star star" data-value="2"></i>
      <i class="fas fa-star star" data-value="3"></i>
      <i class="fas fa-star star" data-value="4"></i>
      <i class="fas fa-star star" data-value="5"></i>
    </div>

    <input type="hidden" name="rating" id="ratingValue">

    <textarea name="mensaje" placeholder="Cuéntanos tu experiencia..." required></textarea>

    <label>Subir foto (opcional)</label>
    <input type="file" name="foto" accept="image/*">

    <button type="submit">Enviar reseña</button>
  </form>

  <p id="respuesta"></p>
  <hr>

  <h2>Reseñas recientes</h2>
  <div class="box-container">
    <?php if(count($reseñas) == 0): ?>
      <div class="no-reseñas"> Aún no hay reseñas — ¡sé la primera persona en opinar!</div>
    <?php else: ?>
      <?php foreach($reseñas as $r): ?>
        <div class="box">
          <div class="stars">
            
                        <?php
                        // --- LÓGICA CORREGIDA PARA MEDIAS ESTRELLAS ---
                        $calificacion_entera = floor($r["calificacion"]);
                        // Se considera media estrella si la parte decimal es 0.5 o más
                        $tiene_media = ($r["calificacion"] - $calificacion_entera) >= 0.5;
                        ?>

                        <?php for($i=1; $i<=5; $i++): ?>
                            <?php 
                            $clase_estrella = "fa-regular fa-star"; // Estrella vacía por defecto
                            
                            if ($i <= $calificacion_entera) {
                                $clase_estrella = "fa-star"; // Estrella completa
                            } elseif ($i == $calificacion_entera + 1 && $tiene_media) {
                                $clase_estrella = "fa-star-half-alt"; // Media estrella
                            }
                            ?>
                            <i class="fas <?= $clase_estrella ?>"></i>
                        <?php endfor; ?>
                    </div>

          <p><?= htmlspecialchars($r["mensaje"]) ?></p>

          <?php if($r["foto"]){ ?>
                        <img src="/viaje/viaje/LoginAPI/<?= htmlspecialchars($r["foto"]) ?>">
          <?php } ?>

                    <div class="user-wrapper">
            <div class="user">
                            <i class="fas fa-user-circle user-icon"></i> 
              <div class="user-info">
                <h3><?= htmlspecialchars($r["nombre"]) ?></h3>
                <span>Días: <?= htmlspecialchars($r["dias"]) ?> | Destino: <?= htmlspecialchars($r["destino"]) ?></span>
              </div>
            </div>
            <span class="fas fa-quote-right"></span>
          </div>
                    <small style="display: none;"><?= htmlspecialchars($r["fecha"]) ?></small>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/footer/footer.php"); ?>

<script>
// El script de JavaScript se mantiene igual para el formulario
const stars = document.querySelectorAll('.star');
const ratingValue = document.getElementById('ratingValue');
let rating = 0;

stars.forEach(star => {

 star.addEventListener('mouseover', () => {
  resetHover();
  highlight(star.dataset.value);
 });

 star.addEventListener('mouseout', () => {
  resetHover();
 });

 star.addEventListener('click', () => {
  rating = star.dataset.value;
  resetSelected();
  highlight(rating, true);
  ratingValue.value = rating;
 });
});

function highlight(limit, seleccionado=false){
 stars.forEach(star => {
  if(star.dataset.value <= limit)
   star.classList.add(seleccionado ? "selected" : "hovered");
 });
}

function resetHover(){
 stars.forEach(s => s.classList.remove("hovered"));
}

function resetSelected(){
 stars.forEach(s => s.classList.remove("selected"));
}

document.getElementById('ratingForm').addEventListener('submit', e => {
 e.preventDefault();

 fetch("/viaje/viaje/LoginAPI/guardar_rating.php", {
  method: "POST",
  body: new FormData(e.target)
 })
 .then(r => r.text())
 .then(res => {
  document.getElementById('respuesta').innerText = res;
  setTimeout(()=>location.reload(), 1000);
 });
});
</script>

</body>
</html>