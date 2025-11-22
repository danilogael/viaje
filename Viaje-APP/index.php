// guests.js
document.addEventListener('DOMContentLoaded', () => {
  const guestsBtn = document.getElementById('guests-btn');
  const guestsMenu = document.querySelector('.guests-menu');
  const adultsCount = document.getElementById('adults-count');
  const childrenCount = document.getElementById('children-count');
  const roomsCount = document.getElementById('rooms-count');
  const childrenAges = document.getElementById('children-ages');

  // Toggle menu
  guestsBtn.addEventListener('click', () => {
    guestsMenu.classList.toggle('active');
  });

  // Update display
  function updateGuestsBtn() {
    let adults = parseInt(adultsCount.textContent);
    let children = parseInt(childrenCount.textContent);
    let rooms = parseInt(roomsCount.textContent);
    guestsBtn.textContent = `${adults} adulto${adults > 1 ? 's' : ''}, ${children} niño${children !== 1 ? 's' : ''}, ${rooms} habitación${rooms > 1 ? 'es' : ''}`;
  }

  // Handle plus/minus buttons
  document.querySelectorAll('.guest-controls button').forEach(btn => {
    btn.addEventListener('click', () => {
      const type = btn.getAttribute('data-type');
      let countElem;
      if(type === 'adults') countElem = adultsCount;
      if(type === 'children') countElem = childrenCount;
      if(type === 'rooms') countElem = roomsCount;

      let count = parseInt(countElem.textContent);
      if(btn.classList.contains('plus')) count++;
      else if(btn.classList.contains('minus')) count = Math.max(0, count - 1);

      // Ensure at least 1 adult and 1 room
      if(type === 'adults' && count < 1) count = 1;
      if(type === 'rooms' && count < 1) count = 1;

      countElem.textContent = count;

      // Update children ages inputs
      if(type === 'children') {
        childrenAges.innerHTML = '';
        for(let i=1; i<=count; i++){
          const div = document.createElement('div');
          div.classList.add('child-age-row');
          div.innerHTML = `
            <label>Edad niño ${i}:</label>
            <input type="number" min="0" max="17" value="0">
          `;
          childrenAges.appendChild(div);
        }
      }

      updateGuestsBtn();
    });
  });

  // Close menu when clicking outside
  document.addEventListener('click', (e) => {
    if(!guestsBtn.contains(e.target) && !guestsMenu.contains(e.target)){
      guestsMenu.classList.remove('active');
    }
  });

  // Inicializar
  updateGuestsBtn();
});
