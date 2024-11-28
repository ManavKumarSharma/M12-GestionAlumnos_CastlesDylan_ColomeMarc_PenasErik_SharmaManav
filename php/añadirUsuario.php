<?php

require_once 'php/connection/connection.php';

$nombre = htmlspecialchars(mysqli_real_query($_POST['name_al'], $mysql)) ?? '';

$apellido = htmlspecialchars(mysqli_real_query($_POST['ap_al'], $mysql))?? '';

$dni = htmlspecialchars(mysqli_real_query($_POST['nif_al'], $mysql))?? '';

$fecha = htmlspecialchars(mysqli_real_query($_POST['fecha_al'], $mysql))?? '';

$direccion = htmlspecialchars(mysqli_real_query($_POST['dir_al'], $mysql))?? '';

$telefono = htmlspecialchars(mysqli_real_query($_POST['tel_al'], $mysql))?? '';

$emailColegio = htmlspecialchars(mysqli_real_query($_POST['em-esc_al'], $mysql))?? '';

$emailPersonal = htmlspecialchars(mysqli_real_query($_POST['em-per_al'], $mysql))?? '';

$query = "INSERT INTO tbl_alumnos (nombre_alumno, apellido_alumno, dni_alumno, fecha_nac_alumno, direccion_alumno, telf_alumno, email_cole_alumno, email_pri_alumno) VALUES ('$nombre', '$apellido', '$dni', '$fecha', '$direccion', '$telefono', '$emailColegio', '$emailPersonal')";

$result = mysqli_query($mysql, $query);

if ($result) {
    header('Location: index.php');
} else {
    echo "Error: ". $query. "<br>". mysqli_error($mysql);
}

mysqli_close($mysql);

?>