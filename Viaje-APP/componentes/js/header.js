document.addEventListener("DOMContentLoaded", () => {
  const button = document.getElementById("menu-toggle");
  const menu = document.getElementById("nav-links");

  if (button && menu) {
    button.addEventListener("click", () => {
      menu.classList.toggle("activo");
    });
  }
});
