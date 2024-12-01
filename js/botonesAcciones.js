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

// Validar que usuario esta seleccionado

document.addEventListener('DOMContentLoaded', () => {
    // Obtener todos los botones de radio con el nombre 'alumno'
    let botonesBorrar = document.getElementsByName('alumno');

    // Función para verificar si alguno está seleccionado
    const verificarSeleccion = () => {
        let algunoSeleccionado = false;

        // Iterar sobre los radios y verificar si alguno está seleccionado
        botonesBorrar.forEach(boton => {
            if (boton.checked) {
                algunoSeleccionado = true;
                valorSeleccionado = boton.value;
            }
        });

        // Cambiar el color de fondo de la caja según la selección
        if (algunoSeleccionado) {
            document.getElementById('activar').style.pointerEvents = 'all';
            document.getElementById('activar').href = "../php/editarNotas.php?idAlumno=" + valorSeleccionado;
            if (document.getElementById('cajaEditarNotasDesactivado')) {
                document.getElementById('cajaEditarNotasDesactivado').id = 'cajaEditarNotasActivado'; 
            };
        }
    };

    // Añadir el evento 'click' a cada uno de los botones de radio
    botonesBorrar.forEach(boton => {
        boton.addEventListener('click', verificarSeleccion); // Actualizar al hacer clic
    });
});
