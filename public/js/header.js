const openMenu = document.querySelector('.user-session-info');
const menu = document.querySelector('.dropdown');

openMenu.addEventListener('click', (event) => {
    event.stopPropagation(); 
    if (menu.style.display === 'flex') {
        menu.style.display = 'none';
    } else {
        menu.style.display = 'flex';
    }
});

document.addEventListener('click', (event) => {
    const targetElement = event.target;
    if (!targetElement.closest('.user-session-info')) {
        menu.style.display = 'none';
    }
});
