
  // Selecciona los elementos
  const userIcon = document.querySelector('.user-icon');
  const dropdown = document.querySelector('.dropdown');

  // Abrir/cerrar el menú al hacer clic en el ícono
  userIcon.addEventListener('click', (e) => {
    e.stopPropagation(); // Evita que el clic se propague al document
    dropdown.classList.toggle('active');
  });

  // Cerrar el menú al hacer clic fuera de él
  document.addEventListener('click', (e) => {
    if (!dropdown.contains(e.target) && !userIcon.contains(e.target)) {
      dropdown.classList.remove('active');
    }
  });

  // Opcional: cerrar el menú al cambiar de tamaño (útil para móvil/desktop)
  window.addEventListener('resize', () => {
    dropdown.classList.remove('active');
  });
