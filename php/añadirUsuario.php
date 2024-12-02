<?php

session_start();

// Verificamos si existe la variable de SESSION
if (!isset($_SESSION['session_user'])) {
    header('Location: ../view/index.php');
    exit;
}

require_once '../php/connection/connection.php';

$nombre = htmlspecialchars(mysqli_real_escape_string($mysqli,trim($_POST['name_al'])));

$apellido = htmlspecialchars(mysqli_real_escape_string($mysqli,trim($_POST['ap_al'])));

$dni = htmlspecialchars(mysqli_real_escape_string($mysqli,trim($_POST['nif_al'])));
 
$fecha = htmlspecialchars(mysqli_real_escape_string($mysqli,trim($_POST['fecha_al'])));

$direccion = htmlspecialchars(mysqli_real_escape_string($mysqli,trim($_POST['dir_al'])));

$telefono = htmlspecialchars(mysqli_real_escape_string($mysqli,trim($_POST['tel_al'])));

$emailColegio = htmlspecialchars(mysqli_real_escape_string($mysqli,trim($_POST['em-esc_al'])));

$emailPersonal = htmlspecialchars(mysqli_real_escape_string($mysqli,trim($_POST['em-per_al'])));

$sexo = htmlspecialchars(mysqli_real_escape_string($mysqli,trim($_POST['sexo_al'])));

$query = "INSERT INTO tbl_alumnos (nombre_alumno, apellido_alumno, dni_alumno, fecha_nac_alumno, direccion_alumno, telf_alumno, email_cole_alumno, email_pri_alumno, sexo_user) VALUES ('$nombre', '$apellido', '$dni', '$fecha', '$direccion', '$telefono', '$emailColegio', '$emailPersonal','$sexo')";



try {


    // echo $sqlEdit;
    // exit();
    // Inicializamos el stmt
    $stmt = mysqli_stmt_init($mysqli);

    // Preparamos la consulta
    if (mysqli_stmt_prepare($stmt, $query)) {

        // Ejecutamos el stmt
        mysqli_stmt_execute($stmt);

        // Obtenemos los resultados
        $result = mysqli_stmt_get_result($stmt);

        // Cerramos el stmt
        mysqli_stmt_close($stmt);
    }
    header("Location: ../view/recepcion.php");
    exit();
} catch (Exception $e) {
    echo "Error al crear usuario: " . $e->getMessage();
    die();
}
