// VALIDACIÓNES AL INTRODUCIR CAMPOS

// Para llamar a las funciones tanto cuando se levanta la tecla como cuando se sale del campo
const miInput = document.getElementById("nombreAlumno");
miInput.onkeyup = validar_nombreAlumno(miInput.value);
miInput.onblur = validar_nombreAlumno(miInput.value);

function validar_nombreAlumno(nombre) {
    alert(nombre);
    return;
    let errores = 0;

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    const spanEmail = document.getElementById('errorEmail');
    const spanPassword = document.getElementById('errorPassword');

    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Expresión que regulaiza el formato del mail usuario@dominio.com
    
    spanEmail.hidden = true;
    spanPassword.hidden = true;

    // SI NO CUMPLE CON LA EXPRESIÓN REGULAR, MUESTRA EL ERROR
    if (!regexEmail.test(email)) {
        spanEmail.hidden = false;
        errores += 1;
    }

    if (!password) {
        spanPassword.hidden = false;
        errores += 1;
    }

    // SI HAY ERROR EVITA EL ENVÍO DEL FORMULARIO
    if (errores > 0) {
        event.preventDefault();
        return false;
    }

    return true; // PERMITE EL ENVÍO DEL FORMULARIO
}