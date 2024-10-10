// Funciones de abrir y cerrar el menú
function abrirMenu() {
    var botonAbre = document.getElementsByClassName('cerrar-menu')[0];
    var botonCierra = document.getElementById('esconder');
    var navBar = document.getElementsByClassName('nav')[0];
    var navContainer = document.getElementsByClassName('divHeader')[0];

    if (botonAbre && navBar && navContainer && botonCierra) {
        botonAbre.style.visibility = 'hidden';
        navBar.style.visibility = 'visible';
        botonCierra.style.visibility = 'visible';
        navContainer.style.visibility = 'visible';
    }
}

function cerrarMenu() {
    var botonAbre = document.getElementsByClassName('cerrar-menu')[0];
    var botonCierra = document.getElementById('esconder');
    var navBar = document.getElementsByClassName('nav')[0];
    var navContainer = document.getElementsByClassName('divHeader')[0];

    if (botonAbre && navBar && navContainer && botonCierra) {
        botonAbre.style.visibility = 'visible';
        navBar.style.visibility = 'hidden';
        botonCierra.style.visibility = 'hidden';
        navContainer.style.visibility = 'hidden';
    }
}

// Restablece la visibilidad del menú según el tamaño de la ventana
function ajustarMenuSegunPantalla() {
    var navBar = document.getElementsByClassName('nav')[0];
    var botonAbre = document.getElementsByClassName('cerrar-menu')[0];
    var botonCierra = document.getElementById('esconder');
    var navContainer = document.getElementsByClassName('divHeader')[0];

    if (window.innerWidth > 800) {
        // Modo pantalla completa - Mostrar barra de navegación y contenedor del header
        navBar.style.visibility = 'visible';
        navContainer.style.visibility = 'visible';
        botonAbre.style.visibility = 'hidden';
        botonCierra.style.visibility = 'hidden';
    } else {
        // Modo móvil - Ocultar barra de navegación y contenedor del header, mostrar botón de menú móvil
        navBar.style.visibility = 'hidden';
        navContainer.style.visibility = 'hidden';
        botonAbre.style.visibility = 'visible';
        botonCierra.style.visibility = 'hidden';
    }
}

// Llama a ajustarMenuSegunPantalla al cargar y redimensionar la ventana
window.addEventListener('resize', ajustarMenuSegunPantalla);
window.addEventListener('load', ajustarMenuSegunPantalla);
