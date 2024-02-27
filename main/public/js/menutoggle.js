const navbarToggle = document.querySelector('.navbar-toggle');
const navbarMenu = document.querySelector('.navbar-menu');
const navbarClose = document.querySelector('.navbar-close');

navbarToggle.addEventListener('click',()=>{

    navbarToggle.classList.toggle('active');
    navbarMenu.classList.toggle('active');
});

navbarClose.addEventListener('click',()=>{

    navbarMenu.classList.remove('active')
});