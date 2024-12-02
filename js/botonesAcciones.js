document.addEventListener('DOMContentLoaded', () => {
    const tabla = document.querySelector('#tbl-content'); // Contenedor de la tabla
    if (tabla) {
        tabla.addEventListener('click', (event) => {
            // Verifica si el elemento clicado tiene la clase 'editarBoton'
            const target = event.target.closest('.celdaEditar');
            if (target) {
                const id = target.dataset.id;
                window.location.href = "../view/editar.php?idAlumno=" + id;
            }
        });
    }

    // Obtener los elementos
    var modal = document.getElementById("miModal");
    var btn = document.getElementById("abrirModalBtn");
    var span = document.getElementById("cerrarModalBtn");

    // Cuando el usuario hace clic en el botón, abre la modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // Cuando el usuario hace clic en la "X", cierra la modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Cuando el usuario hace clic fuera de la modal, también la cierra
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});