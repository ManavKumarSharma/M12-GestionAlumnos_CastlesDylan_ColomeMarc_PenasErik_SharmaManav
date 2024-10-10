<?php
session_start();

if (!isset($_SESSION["data"])) {
    header ("Location: ../index.php");
}

foreach (glob("./manageErrors/*.php") as $archivo) {
    require_once $archivo;
}

include ("./connection/connection.php");

$valoresBBDD = [];

foreach ($_SESSION["data"] as $campo => $valor) {
    $valoresBBDD[$campo] = mysqli_real_escape_string($mysqli, $valor);
}

$consultaEmail = "SELECT * from tbl_user WHERE email_cole_user = ?;";
$consultaPsswd = "SELECT * from tbl_user WHERE email_cole_user = ? AND pwd_user = ?;";

// COMPROBAR QUE HAGA LA CONEXION A LA BBBDD !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!


// Comprobar si existe un usuario con el email
    // Inicializar la declaracion para poder usarla
    $stmt = mysqli_stmt_init($mysqli);

    // Preparar declaracion con la consulta
    mysqli_stmt_prepare($stmt, $consultaEmail);

    // Asociar los "?" de la declaracion con su variable
    mysqli_stmt_bind_param($stmt, "s", $valoresBBDD['email']);

    // Ejecutar declaracion preparada
    mysqli_stmt_execute($stmt);

    // Obtener el resultado como un objeto mysqli_result
    $result = mysqli_stmt_get_result($stmt);

    // Verificar si hay resultados
    if (!($result && mysqli_num_rows($result) > 0)) {
        $errors['emailBBDD'] = 'No existe ningún usuario con ese email.';
        redirectWithErrors('../index.php', $errors);
    }


// Comprobar si la contraseña es correcta
    // Inicializar la declaracion para poder usarla
    $stmt = mysqli_stmt_init($mysqli);

    // Preparar declaracion con la consulta
    mysqli_stmt_prepare($stmt, $consultaPsswd);

    // Asociar los "?" de la declaracion con su variable
    mysqli_stmt_bind_param($stmt, "ss", $valoresBBDD['email'], $valoresBBDD['password']);

    // Ejecutar declaracion preparada
    mysqli_stmt_execute($stmt);

    // Obtener el resultado como un objeto mysqli_result
    $result = mysqli_stmt_get_result($stmt);

    // Verificar si hay resultados
    if (!($result && mysqli_num_rows($result) > 0)) {
        $errors['passwordBBDD'] = 'La contraseña es incorrecta.';
        redirectWithErrors('../index.php', $errors);
    }
    
    header ("Location: ../paginas/recepcion.php");
?>