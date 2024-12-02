document.addEventListener('DOMContentLoaded', function() {
    // Obtener los elementos de la modal y el botón de abrir
    var modal = document.getElementById("modal");
    var openModalBtn = document.getElementById("openModalBtn");
    var closeModalBtn = document.getElementById("closeModalBtn");

    // Abrir la modal cuando el usuario hace clic en el botón
    openModalBtn.onclick = function(event) {
        event.preventDefault();  // Previene el comportamiento por defecto, si es un link o botón
        modal.style.display = "block";
    }

    // Cerrar la modal cuando el usuario hace clic en el botón de cerrar (x)
    closeModalBtn.onclick = function() {
        modal.style.display = "none";
    }

    // Cerrar la modal si el usuario hace clic fuera de la ventana modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});

document.addEventListener("DOMContentLoaded", function() {
    // Obtén el select de la columna y el select de orden
    const columnSelect = document.getElementById('column_to_filter');
    const orderSelect = document.getElementById('order_column');

    // Añadir un evento al cambio de selección de la columna
    columnSelect.addEventListener('change', function() {
        // Habilitar el select de orden solo si se selecciona una columna
        if (columnSelect.value !== "") {
            orderSelect.disabled = false; // habilitar el orden
        } else {
            orderSelect.disabled = true; // deshabilitar el orden
        }
    });

    // Asegurarse de que al abrir el modal, el select de orden esté deshabilitado inicialmente
    if (columnSelect.value === "") {
        orderSelect.disabled = true;
    }
});
