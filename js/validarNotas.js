// PARA CARGAR TODO EL DOM Y EL PHP
window.onload = function() {
    let inputs = Array.from(document.getElementsByClassName('form-control')); // Convertir HTMLCollection a array

    // Añadir un evento de submit al formulario
    document.getElementById('formulario').addEventListener('submit', function(event) {
        inputs.forEach(element => {
            if (!validarNumero(element)) {
                event.preventDefault();
            }
        });
    });

    // VALIDAR LOS INPUTS
    inputs.forEach(element => {
        element.addEventListener('keyup', function () {
            validarNumero(this);
        });
        element.addEventListener('blur', function () {
            validarNumero(this);
        });
    });
};

// ------------------------------------------------------------------------------------------------------------------

// VALIDACION NOTA

function validarNumero(input) {
    const textoEntrada = input.value.trim();
    const mensajeError = document.getElementById(input.id + 'Error');
    const patronNumeros = /^(\d{1,2}|100)$/; // Permite números del 0 al 100

    if (textoEntrada === "") {
        // Permitir que esté vacío
        mensajeError.textContent = "";
        return true;
    }

    if (!patronNumeros.test(textoEntrada)) {
        mensajeError.textContent = "Debe ser un número entre 0 y 100.";
        return false;
    }

    mensajeError.textContent = "";
    return true;
}
