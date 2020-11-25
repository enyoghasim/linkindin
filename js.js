
let nav = document.querySelector('nav ul');
let  burger = document.querySelector('.burger');
burger.addEventListener('click', () => {
    nav.classList.toggle('active');
});
