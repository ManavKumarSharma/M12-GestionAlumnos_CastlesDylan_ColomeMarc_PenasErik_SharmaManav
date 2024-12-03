// PARA CARGAR TODO EL DOM Y EL PHP
window.onload = function() {

    // Añadir un evento de submit al formulario
    document.getElementById('formulario').addEventListener('submit', function(event) {
        if (!validarFormulario()) {
            event.preventDefault();
        }
    });

    // VALIDACION NOMBRE
    document.getElementById('nombreAlumno').addEventListener('keyup', function () {
        validarNombre(this);
    });
    document.getElementById('nombreAlumno').addEventListener('blur', function () {
        validarNombre(this);
    });


    // VALIDACION APELLIDOS
    document.getElementById('apellidosAlumno').addEventListener('keyup', function () {
        validarApellidos(this);
    });
    document.getElementById('apellidosAlumno').addEventListener('blur', function () {
        validarApellidos(this);
    });


    // VALIDACIÓN DNI
    document.getElementById('nifNieAlumno').addEventListener('keyup', function () {
        validarDNI(this);
    });
    document.getElementById('nifNieAlumno').addEventListener('blur', function () {
        validarDNI(this);
    });


    // VALIDACION FECHA DE NACIMIENTO
    document.getElementById('nacimientoAlumno').addEventListener('blur', function() {
        validarFechaNacimiento(this);
    });


    // VALIDACION DIRECCION
    document.getElementById('direccionAlumno').addEventListener('keyup', function() {
        validarDireccion(this);
    });
    document.getElementById('direccionAlumno').addEventListener('blur', function() {
        validarDireccion(this);
    });


    // VALIDACION TELEFONO
    document.getElementById('telefonoAlumno').addEventListener('keyup', function() {
        validarTelefono(this);
    });
    document.getElementById('telefonoAlumno').addEventListener('blur', function() {
        validarTelefono(this);
    });

    // VALIDACION EMAIL ESCUELA
    document.getElementById('emailEscuelaAlumno').addEventListener('blur', function() {
        validarEmail(this);
    });

    // VALIDACION EMAIL PERSONAL
    document.getElementById('emailPersonalAlumno').addEventListener('blur', function() {
        validarEmail(this);
    });

    // VALIDACION SEXO (solo para crear)
    if (document.getElementById('sexo_al')) {
        document.getElementById('sexo_al').addEventListener('blur', function() {
            validarSexo(this);
        });
    }

    // Validación de Curso
    if (document.getElementById('curso_al')) {
        document.getElementById('curso_al').addEventListener('blur', function() {
            validarCurso(this);
        });
    }
};

// ------------------------------------------------------------------------------------------------------------------

// TODAS LAS VALIDACIONES AL HACER SUBMIT
function validarFormulario() {
    return validarNombre(document.getElementById('nombreAlumno')) &&
           validarApellidos(document.getElementById('apellidosAlumno')) &&
           validarDNI(document.getElementById('nifNieAlumno')) &&
           validarFechaNacimiento(document.getElementById('nacimientoAlumno')) &&
           validarDireccion(document.getElementById('direccionAlumno')) &&
           validarTelefono(document.getElementById('telefonoAlumno')) &&
           validarEmail(document.getElementById('emailEscuelaAlumno')) &&
           validarEmail(document.getElementById('emailPersonalAlumno')) &&
           validarSexo(document.getElementById('sexo_al')) && validarCurso(document.getElementById('curso_al'));
}

// ------------------------------------------------------------------------------------------------------------------

// VALIDACION NOMBRE
// - No puede estar vacío
// - Solo puede tener letras y espacios
// - Debe tener entre 3 y 25 caracteres

function validarNombre(input) {
    const textoEntrada = input.value.trim();
    const mensajeError = document.getElementById('nombreAlumnoError');
    const patronLetrasEspacios = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;

    if (textoEntrada === "") {
        mensajeError.textContent = "Este campo no puede estar vacío.";
        return false;
    }

    if (!patronLetrasEspacios.test(textoEntrada)) {
        mensajeError.textContent = "Solo puede contener letras y espacios.";
        return false;
    }

    if (textoEntrada.length < 3) {
        mensajeError.textContent = "Debe contener más de 3 letras.";
        return false;
    }

    if (textoEntrada.length > 25) {
        mensajeError.textContent = "No puede contener más de 25 letras.";
        return false;
    }

    mensajeError.textContent = "";
    return true;
}

// ------------------------------------------------------------------------------------------------------------------

// VALIDACIÓN APELLIDOS
// - Mínimo una palabra (puede tener primer y segundo apellido)
// - Máximo 40 letras y mínimo 3
// - No puede estar vacío
// - Solo letras y espacios

function validarApellidos(input) {
    const textoEntrada = input.value.trim();
    const mensajeError = document.getElementById('apellidosAlumnoError');

    if (textoEntrada === "") {
        mensajeError.textContent = "Este campo no puede estar vacío.";
        return false;
    }

    const patronLetrasEspacios = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
    if (!patronLetrasEspacios.test(textoEntrada)) {
        mensajeError.textContent = "Solo puede contener letras y espacios.";
        return false;
    }

    if (textoEntrada.length < 3) {
        mensajeError.textContent = "Debe contener al menos 3 caracteres.";
        return false;
    }

    if (textoEntrada.length > 40) {
        mensajeError.textContent = "No puede contener más de 40 caracteres.";
        return false;
    }

    mensajeError.textContent = "";
    return true;
}

// ------------------------------------------------------------------------------------------------------------------

// VALIDACIÓN DNI
// - No puede estar vacío
// - Debe tener 8 dígitos seguidos de una letra
// - La letra debe ser válida según el número de DNI

function validarDNI(input) {
    const textoEntrada = input.value.trim();
    const mensajeError = document.getElementById('nifNieAlumnoError');

    if (textoEntrada === "") {
        mensajeError.textContent = "Este campo no puede estar vacío.";
        return false;
    }

    const patronDNI = /^\d{8}[A-Za-z]$/;
    if (!patronDNI.test(textoEntrada)) {
        mensajeError.textContent = "El formato del DNI no es válido.";
        return false;
    }

    const letrasDNI = "TRWAGMYFPDXBNJZSQVHLCKE";
    const numeroDNI = parseInt(textoEntrada.substring(0, 8), 10);
    const letraDNI = textoEntrada.charAt(8).toUpperCase();

    const letraCorrecta = letrasDNI[numeroDNI % 23];

    if (letraDNI !== letraCorrecta) {
        mensajeError.textContent = "La letra del DNI no es correcta.";
        return false;
    }

    mensajeError.textContent = "";
    return true;
}

// ------------------------------------------------------------------------------------------------------------------

// VALIDACION FECHA DE NACIMIENTO
// - No puede estar vacío.
// - Fecha anterior al dia.

function validarFechaNacimiento(input) {
    const fechaEntrada = input.value;
    const mensajeError = document.getElementById('nacimientoAlumnoError');

    if (fechaEntrada === "") {
        mensajeError.textContent = "Este campo no puede estar vacío.";
        return false;
    }

    const fechaNacimiento = new Date(fechaEntrada);
    const fechaHoy = new Date();

    fechaHoy.setHours(0, 0, 0, 0); // Para no tener en cuenta las horas (lo pone a medianoche)

    if (fechaNacimiento >= fechaHoy) {
        mensajeError.textContent = "La fecha de nacimiento debe ser anterior a hoy.";
        return false;
    }

    mensajeError.textContent = "";
    return true;
}

// ------------------------------------------------------------------------------------------------------------------

// VALIDACION DIRECCION
// - No puede estar vacío.
// - No puede contener mas de 40 caracteres.

function validarDireccion(input) {
    const direccionEntrada = input.value;
    const mensajeError = document.getElementById('direccionAlumnoError');

    if (direccionEntrada.trim() === "") {
        mensajeError.textContent = "Este campo no puede estar vacío.";
        return false;
    }

    if (direccionEntrada.length > 40) {
        mensajeError.textContent = "La dirección no puede contener más de 40 caracteres.";
        return false;
    }

    mensajeError.textContent = "";
    return true;
}

// ------------------------------------------------------------------------------------------------------------------

// VALIDACION TELEFONO
// - No puede estar vacío.
// - Tiene que tener 9 digitos.
// - Solo puede tener numeros.

function validarTelefono(input) {
    const telefonoEntrada = input.value;
    const mensajeError = document.getElementById('telefonoAlumnoError');

    if (telefonoEntrada.trim() === "") {
        mensajeError.textContent = "Este campo no puede estar vacío.";
        return false;
    }

    const patronTelefono = /^\d+$/;
    if (!patronTelefono.test(telefonoEntrada)) {
        mensajeError.textContent = "Debe contener solo numeros.";
        return false;
    }

    if (telefonoEntrada.length !== 9) {
        mensajeError.textContent = "Debe tener 9 dígitos.";
        return false;
    }

    mensajeError.textContent = "";
    return true;
}

// ------------------------------------------------------------------------------------------------------------------

// VALIDACION EMAIL ESCUELA
// - No puede estar vacío.
// - Tipo email.
// - No mas de 40 caracteres

function validarEmail(input) {
    const emailEntrada = input.value;
    const idError = input.id + 'Error';
    const mensajeError = document.getElementById(idError);

    if (emailEntrada.trim() === "") {
        mensajeError.textContent = "Este campo no puede estar vacío.";
        return false;
    }

    if (emailEntrada.length > 40) {
        mensajeError.textContent = "No puede tener más de 40 caracteres.";
        return false;
    }

    const patronEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!patronEmail.test(emailEntrada)) {
        mensajeError.textContent = "El email no es válido.";
        return false;
    }

    mensajeError.textContent = "";
    return true;
}

// ------------------------------------------------------------------------------------------------------------------

// VALIDACION SEXO
// - Que sea H o M

function validarSexo(input) {
    const sexoEntrada = input.value;
    if (sexoEntrada.trim() !== "H" && sexoEntrada.trim() !== "M") {
        return false;
    }
    return true;
}

function validarCurso(input) {
    const cursoEntrada = input.value.trim();
    if (cursoEntrada === "") {
        return false; // El campo no puede estar vacío
    }
    return true; // El curso es válido si tiene algún valor
}
