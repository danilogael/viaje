document.querySelectorAll('.lang-dropdown li').forEach(item => {
    item.addEventListener('click', () => {
        const lang = item.dataset.lang;
        fetch(`/viaje/viaje/Viaje-APP/componentes/setLang.php?lang=${lang}`)
            .then(() => location.reload());
    });
});

document.querySelectorAll('.currency-dropdown li').forEach(item => {
    item.addEventListener('click', () => {
        const currency = item.dataset.currency;
        fetch(`/viaje/viaje/Viaje-APP/componentes/setCurrency.php?currency=${currency}`)
            .then(() => location.reload());
    });
});
