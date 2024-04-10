const openMenu = document.querySelector('.user-session-info');
const menu = document.querySelector('.dropdown');
const contactBtn = document.querySelector('.contact-btn');
const cancelContactBtn = document.querySelector('.cancel-button');
const contactForm = document.querySelector('.container');
const background = document.querySelector('main');
const feedbackBtn = document.querySelector('.feedback-btn');

if(openMenu && menu) {
    openMenu.addEventListener('click', (event) => {
        event.stopPropagation(); 
        menu.style.display = menu.style.display == 'flex' ? 'none' : 'flex';
    });
}

document.addEventListener('click', (event) => {
    const targetElement = event.target;
    if (!targetElement.closest('.user-session-info') && menu.style.display === 'flex') {
        menu.style.display = 'none';
    } 

});

document.addEventListener('click', (event) => {
    const targetElement = event.target;
    console.log(!targetElement.closest('.contact-container'));
    if (!targetElement.closest('.contact-container') && targetElement !== contactBtn && contactForm.style.display === 'block') {
        contactForm.style.display = 'none';
        background.classList.remove('blur');
        
    }
});



if(contactBtn && contactForm) {
    contactBtn.addEventListener('click', function(event) {
        const contactFormDisplay = window.getComputedStyle(contactForm).getPropertyValue('display');
        event.preventDefault();
        contactForm.style.display = (contactFormDisplay === 'none') ? 'block' : 'none';
        background.classList.toggle('blur');
    });
}

if(cancelContactBtn && contactForm) {
    cancelContactBtn.addEventListener('click', function(event) {
        event.preventDefault();
        contactForm.style.display = 'none';
        background.classList.remove('blur');
    });
}

