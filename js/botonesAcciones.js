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
