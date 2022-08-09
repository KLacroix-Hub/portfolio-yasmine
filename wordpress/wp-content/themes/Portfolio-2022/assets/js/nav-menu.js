const burgerOpen = document.getElementById('burger-open');
const burgerClose = document.getElementById('burger-close');
const navMenu = document.getElementById('nav-menu');

burgerOpen.onclick = () => {
    navMenu.style.transition = '0.4s ease-in';
    navMenu.style.opacity = "100%";
    navMenu.style.zIndex = "10";
    navMenu.style.width = "100%";
    burgerClose.style.display = 'block';
};

burgerClose.onclick = () => {
    navMenu.style.transition = '0.4s ease-in';
    navMenu.style.opacity = '0';
    navMenu.style.zIndex = '0';
    navMenu.style.width = "0";

    burgerClose.style.display = 'none';
};