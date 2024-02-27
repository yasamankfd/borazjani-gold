let navigation = document.querySelector('.navigation');
let toggle = document.querySelector('.toggle');
let main = document.querySelector('.main');
let titlemenu = document.querySelector('.titlemenu');

toggle.onclick = function (){
    navigation.classList.toggle('active')
    main.classList.toggle('active')
    titlemenu.classList.toggle('active')
}