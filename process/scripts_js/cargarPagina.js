window.onload = setTimeout(
    function() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("contenido").style.display = "block";
    }, 1000)

function toggleMenu() {
    const menu = document.getElementById("menu");
    menu.classList.toggle("show");
}