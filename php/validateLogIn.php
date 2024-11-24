<?php
// IMPORTAR LAS FUNCIONES NECESARIAS
require_once './functions.php';

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


// EN CASO DE ERROR REDIRIGIR A LA PÁGINA page/index.php Y MOSTRAR LOS ERRORES
if($errors) {
    redirectWithErrors('../view/index.php', $errors);
}

// INICIAMOS SESSION DESPUÉS DE VERIFICAR LOS CAMPOS
session_start();

// INICIALIZAMOS LA SESSION
$_SESSION["data"] = [
    'email' => $email,
    'password' => $password
];

header ("Location: ./loginProcess.php");
?>