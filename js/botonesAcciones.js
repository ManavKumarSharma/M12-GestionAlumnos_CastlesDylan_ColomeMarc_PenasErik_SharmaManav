// JS para las acciones de los botones

// Editar
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
});

// Eliminar
document.addEventListener('DOMContentLoaded', () => {
    const tabla = document.querySelector('#tbl-content'); // Contenedor de la tabla
    if (tabla) {
        tabla.addEventListener('click', (event) => {
            // Verifica si el elemento clicado tiene la clase 'editarBoton'
            const target = event.target.closest('.celdaEliminar');
            if (target) {
                const urlActual = window.location.href; // url para mantener cualquier filtro (variables GET)
                const id = target.dataset.id;
                window.location.href = "../php/delete.php?idAlumno=" + id + "&urlDevuelta=" + urlActual;
                alert(urlActual);
            }
        });
    }
});
