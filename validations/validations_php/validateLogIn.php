<?php

// IMPORTAR AUTOMÁTICAMENTE LOS ARCHIVOS NECESARIOS
foreach (glob("./sanitize_data/*.php") as $archivo) {
    require_once $archivo;
}

foreach (glob("../../process/manageErrors/*.php") as $archivo) {
    require_once $archivo;
}

// LLAMA A LA FUNCIÓN QUE PASA DE ARGUMENTOS EL MÉTODO Y EL SUBMIT CORRESPONDIENTE
checkServerForms($_SERVER['REQUEST_METHOD'] !== 'POST', !filter_has_var(INPUT_POST, 'login'));

// INICIALIZA LA VARIABLE ERRORS
$errors = [];

// RECOGER Y VALIDAR LOS DATOS DEL FORMULARIO
$email = !empty($_POST['email']) ? htmlspecialchars(checkEmail($_POST['email'])) : $errors['email'] = 'Se debe completar el campo "email"';
$password = !empty($_POST['password']) ? htmlspecialchars($_POST['password']) : $errors['password'] = 'Se debe completar el campo "password"';

// VERIFICA SI LA LLAMADA A LA FUNCIÓN checkEmail DEVUELVE UN 'false'
if ($email == false) {
    $errors['email'] = 'El formato del campo "email" no es válido';
}


// EN CASO DE ERROR REDIRIGIR A LA PÁGINE page/index.php Y MOSTRAR LOS ERRORES
if($errors) {
    redirectWithErrors('../../index.php', $errors);
}

// ENCRIPTAMOS LA CONTRASEÑA RECIBIDA 
$password = hash('sha256', $password);

// INICIAMOS SESSION DESPUÉS DE VERIFICAR LOS CAMPOS
session_start();

// INICIALIZAMOS LA SESSION
$_SESSION["data"] = [
    'email' => $email,
    'password' => $password
];

header ("Location: ../../process/loginProcess.php");
echo 'has entrado (no está acabado aún mamaguevos)';
?>