<?php
// ================= INICIO DE PHP =================
require __DIR__ . "/../../../LoginAPI/db.php"; // conexión
include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/header/header.php");

// Consulta paquetes sin descuento
$query = $conexion->query("SELECT * FROM paquetes WHERE descuento = 0 ORDER BY nombre");
$paquetes = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Descubre Paquetes</title>
<link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos/header.css">
<link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos/estilos_footer.css">
<link rel="stylesheet" href="/viaje/viaje/Viaje-APP/componentes/estilos/productos.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

:root {
--primary-color: #21bbf3;
--secondary-color: #1aa0d8;
--background-light: #f5f7fa;
--text-color: #2c3e50;
--grey-text: #6c757d;
--shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
--hover-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
--border-radius: 0.8rem;
--star-color: gold;
}

body {
font-family: 'Poppins', sans-serif;
background-color: var(--background-light);
color: var(--text-color);
margin: 0;
padding: 0;
line-height: 1.6;
}

/* =================== ENCABEZADO =================== */
.heading {
text-align: center;
padding: 2rem 0;
font-size: 3rem;
font-weight: 700;
color: var(--text-color);
margin-top: 4rem;
margin-bottom: 3rem;
}

.heading span {
color: var(--primary-color);
}

/* =================== LUPA (Diseño anterior, borde al lado derecho) =================== */
.filtro-lupa {
position: fixed;
top: 50%;
right: 0; /* Pegado al borde */
transform: translateY(-50%);
background: var(--primary-color);
color: #fff;
width: 56px;
height: 56px;
display: flex;
justify-content: center;
align-items: center;
/* Revertido al diseño anterior */
border-radius: 0.8rem 0 0 0.8rem; 
cursor: pointer;
box-shadow: var(--shadow);
z-index: 10000; 
transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s;
}

.filtro-lupa i {
    font-size: 1.5rem;
}

.filtro-lupa:hover {
background: var(--secondary-color);
transform: translateY(-50%) scale(1.05); 
box-shadow: var(--hover-shadow);
}

/* =================== PANEL DE FILTRO (Escondido completamente) =================== */
.filtro-panel {
position: fixed;
top: 50%;
/* CLAVE: Esconder el panel fuera de la vista (Ancho 300px + 2rem padding x2) */
right: -360px; 
transform: translateY(-50%);
background: #fff;
padding: 2.5rem 2rem;
/* Diseño que se pega al borde */
border-radius: 1rem 0 0 1rem;
box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
width: 300px;
display: flex;
flex-direction: column;
gap: 1.2rem;
z-index: 9999;
transition: right 0.4s ease-in-out;
}

.filtro-panel.active {
/* Muestra el panel, dejando visible el ancho de la lupa (56px) */
right: 56px; 
}

/* Botón de Cierre dentro del panel (Lo mantenemos por usabilidad) */
.close-btn {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: transparent;
    border: none;
    color: var(--grey-text);
    font-size: 1.5rem;
    cursor: pointer;
    transition: color 0.2s;
}
.close-btn:hover {
    color: var(--text-color);
}

.filtro-panel h3 {
font-size: 1.8rem;
color: var(--primary-color);
margin-top: 0;
margin-bottom: 1rem;
border-bottom: 2px solid #eee;
padding-bottom: 0.5rem;
}

.filtro-panel label {
font-weight: 600;
font-size: 0.9rem;
color: var(--text-color);
}

.filtro-panel input[type="text"],
.filtro-panel input[type="number"] {
padding: 0.9rem;
width: 100%;
border: 1px solid #ddd;
border-radius: 0.5rem;
font-size: 1rem;
background: #f9fafc;
transition: border-color 0.3s ease;
}

.filtro-panel input:focus {
border-color: var(--primary-color);
outline: none;
box-shadow: 0 0 6px rgba(33, 187, 243, 0.3);
}

.filtro-panel button {
padding: 1rem;
background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
color: white;
border: none;
border-radius: 0.5rem;
cursor: pointer;
font-size: 1.1rem;
font-weight: 600;
margin-top: 1rem;
transition: opacity 0.3s ease, transform 0.2s ease;
}

.filtro-panel button:hover {
opacity: 0.9;
transform: translateY(-2px);
}

/* =================== GRID DE PRODUCTOS =================== */
.box-container {
display: grid;
grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
gap: 3rem;
max-width: 1200px;
margin: 0 auto 5rem auto;
padding: 0 2%;
}

/* =================== TARJETA DE PAQUETE (Se mantiene el diseño mejorado) =================== */
.box {
background: #fff;
border-radius: var(--border-radius);
box-shadow: var(--shadow);
overflow: hidden;
transition: transform 0.3s ease, box-shadow 0.3s ease;
display: flex;
flex-direction: column;
}

.box:hover {
transform: translateY(-8px);
box-shadow: var(--hover-shadow);
}

.box .img {
    position: relative;
    height: 25rem;
    overflow: hidden;
}

.box .img img {
width: 100%;
height: 100%;
object-fit: cover;
transition: transform 0.5s ease;
}
.box:hover .img img {
    transform: scale(1.05);
}

.box .img .icons {
    position: absolute;
    bottom: -100%;
    left: 0;
    right: 0;
    padding: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: rgba(0, 0, 0, 0.5);
    transition: bottom 0.3s ease;
}
.box:hover .img .icons {
    bottom: 0;
}

.box .img .icons a {
    color: white;
    font-size: 1.5rem;
    transition: color 0.2s;
    flex-shrink: 0;
    padding: 0.5rem;
}
.box .img .icons a:hover {
    color: var(--primary-color);
}

.box .img .icons .cart-btn {
    flex-grow: 1;
    margin: 0 1rem;
    padding: 0.6rem 1rem;
    background: var(--primary-color);
    color: white;
    text-align: center;
    text-decoration: none;
    font-size: 1rem;
    border-radius: 0.5rem;
    transition: background 0.3s;
}
.box .img .icons .cart-btn:hover {
    background: var(--secondary-color);
}


.box .content {
padding: 1.5rem;
text-align: left;
flex-grow: 1;
display: flex;
flex-direction: column;
}

.box h3 {
font-size: 1.5rem;
color: var(--text-color);
margin-bottom: 0.5rem;
}

.box .ubicacion {
font-size: 0.9rem;
color: var(--grey-text);
margin-bottom: 0.5rem;
display: block;
}

.box .ubicacion i {
    color: var(--primary-color);
    margin-right: 0.3rem;
}

.box .duracion,
.box .categoria {
font-size: 0.9rem;
color: var(--grey-text);
margin-bottom: 0.3rem;
}

.box .rating {
font-size: 1.2rem;
color: var(--star-color);
margin: 0.8rem 0;
margin-top: auto;
}

.box .price {
font-size: 2rem;
color: var(--secondary-color);
font-weight: 700;
margin-top: 0.5rem;
}

/* =================== RESPONSIVE =================== */
@media (max-width: 768px) {
  /* La lupa se vuelve totalmente circular en móvil */
.filtro-lupa {
top: 90%;
right: 1rem;
transform: translateY(-50%);
border-radius: 50%; /* Circular en móvil */
}
  /* El panel se oculta fuera y se centra al activarse */
.filtro-panel {
right: -450px;
top: 50%;
left: auto;
transform: translateY(-50%);
width: 90%;
max-width: 400px;
padding: 1.5rem;
border-radius: 1rem; /* Borde completo en móvil */
}

.filtro-panel.active {
right: 50%;
left: auto;
transform: translate(50%, -50%);
}
    .box .img {
        height: 20rem;
    }
.box-container {
grid-template-columns: 1fr;
}
}
</style>
</head>
<body>

<div class="filtro-lupa" onclick="toggleFiltro()">
 <i class="fas fa-magnifying-glass"></i>
</div>

<div class="filtro-panel" id="filtroPanel">
    <button class="close-btn" onclick="toggleFiltro()"><i class="fas fa-times"></i></button>
<h3>Filtrar Paquetes</h3>
<label for="filtroCiudad">Ciudad / Estado</label>
<input type="text" id="filtroCiudad" placeholder="Ej: Cancún">
<label for="filtroPrecio">Precio máximo (MXN)</label>
<input type="number" id="filtroPrecio" placeholder="Ej: 15000">
<label for="filtroDias">Duración máxima (días)</label>
<input type="number" id="filtroDias" placeholder="Ej: 5">
<label for="filtroCategoria">Categoría / Hotel</label>
<input type="text" id="filtroCategoria" placeholder="Ej: All Inclusive">
<button onclick="aplicarFiltro()">Aplicar Filtros</button>
</div>

<section class="products" id="products">
<h1 class="heading">Descubre nuestros <span>Paquetes</span></h1>
<div class="box-container" id="boxContainer">
<?php foreach($paquetes as $p): ?>
<div class="box" 
 data-ciudad="<?= htmlspecialchars($p['ciudad']) ?>" 
 data-precio="<?= htmlspecialchars($p['precio']) ?>" 
 data-dias="<?= htmlspecialchars($p['duracion_dias']) ?>" 
 data-categoria="<?= htmlspecialchars($p['categoria']) ?>">
 <div class="img">
<img src="<?= htmlspecialchars($p['imagen']) ?>" alt="<?= htmlspecialchars($p['nombre']) ?>">
<div class="icons">
 <a href="#" class="fas fa-heart" title="Añadir a favoritos"></a>
 <a href="#" class="cart-btn" title="Ver detalles del paquete">Detalles</a>
 <a href="#" class="fas fa-share" title="Compartir"></a>
</div>
 </div>
 <div class="content">
 <h3><?= htmlspecialchars($p['nombre']) ?></h3>
 <span class="ubicacion"><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($p['ciudad']) ?></span>
 <p class="duracion"><?= htmlspecialchars($p['duracion_dias']) ?> días</p>
 <p class="categoria"><?= htmlspecialchars($p['categoria']) ?></p>
 <div class="rating"><?= str_repeat('★', $p['calificacion']) . str_repeat('☆', 5 - $p['calificacion']) ?></div>
 <div class="price">$<?= number_format($p['precio'], 0, '.', ',') ?> MXN</div>
 </div>
</div>
<?php endforeach; ?>
</div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/viaje/viaje/Viaje-APP/componentes/footer/footer.php"); ?>

<script>
function toggleFiltro() {
const panel = document.getElementById('filtroPanel');
panel.classList.toggle('active');
}

function aplicarFiltro() {
const ciudad = document.getElementById('filtroCiudad').value.toLowerCase().trim();
const precio = parseFloat(document.getElementById('filtroPrecio').value) || Infinity;
const dias = parseInt(document.getElementById('filtroDias').value) || Infinity;
const categoria = document.getElementById('filtroCategoria').value.toLowerCase().trim();

const boxes = document.querySelectorAll('.box-container .box');

boxes.forEach(box => {
const boxCiudad = box.dataset.ciudad.toLowerCase();
const boxPrecio = parseFloat(box.dataset.precio);
const boxDias = parseInt(box.dataset.dias);
const boxCategoria = box.dataset.categoria.toLowerCase();

const cumpleCiudad = boxCiudad.includes(ciudad);
    const cumplePrecio = boxPrecio <= precio;
    const cumpleDias = boxDias <= dias;
    const cumpleCategoria = boxCategoria.includes(categoria);

box.style.display = (cumpleCiudad && cumplePrecio && cumpleDias && cumpleCategoria) ? 'flex' : 'none';
});
}

// Filtro dinámico mientras se escribe
['filtroCiudad', 'filtroPrecio', 'filtroDias', 'filtroCategoria'].forEach(id => {
document.getElementById(id).addEventListener('input', aplicarFiltro);
});

// Asegura que los paquetes se muestren al cargar
document.addEventListener('DOMContentLoaded', aplicarFiltro);
</script>
</body>
</html>