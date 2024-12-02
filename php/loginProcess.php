<?php
session_start();

if (!isset($_SESSION["data"])) {
    header ("Location: ../view/index.php");
}

require_once './functions.php';
include ("./connection/connection.php");

$valoresBBDD = [];

// Sanear los datos obtenidos de la sesión
foreach ($_SESSION["data"] as $campo => $valor) {
    $valoresBBDD[$campo] = mysqli_real_escape_string($mysqli, $valor);
}

$consultaEmail = "SELECT * from tbl_user WHERE email_cole_user = ?;";

// Comprobar si existe un usuario con el email
$stmt = mysqli_stmt_init($mysqli);
mysqli_stmt_prepare($stmt, $consultaEmail);
mysqli_stmt_bind_param($stmt, "s", $valoresBBDD['email']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Verificar si se encontró el usuario
if (!($result && mysqli_num_rows($result) > 0)) {
    $errors['errorBBDD'] = 'Email o contraseña incorrectos.';
    redirectWithErrors('../view/index.php', $errors);
}

// Obtener los datos del usuario
$row = mysqli_fetch_assoc($result);
$hashedPasswordFromDB = $row['pwd_user'];

// Verificar la contraseña usando password_verify
if (!password_verify($valoresBBDD['password'], $hashedPasswordFromDB)) {
    $errors['errorBBDD'] = 'Email o contraseña incorrectos.';
    redirectWithErrors('../view/index.php', $errors);
}


// Liberamos la sesión de datos
unset($_SESSION['data']);

// Inicializamos la sesión del usuario
$_SESSION['session_user'] = [
    'id' => $row['id_user'],
    'name' => $row['nombre_user'],
    'surname' => $row['apellidos_user']
];

// Si todo es correcto, redirigir al usuario a la página de recepción
header ("Location: ../view/recepcion.php");
exit();
?>