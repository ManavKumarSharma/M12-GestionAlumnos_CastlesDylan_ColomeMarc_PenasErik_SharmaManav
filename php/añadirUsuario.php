<?php

session_start();

// Verificamos si existe la variable de SESSION
if (!isset($_SESSION['session_user'])) {
    header('Location: ../view/index.php');
    exit;
}

require_once '../php/connection/connection.php';
require_once '../php/query.php';

$nombre = htmlspecialchars(mysqli_real_escape_string($mysqli, trim($_POST['name_al'])));
$apellido = htmlspecialchars(mysqli_real_escape_string($mysqli, trim($_POST['ap_al'])));
$dni = htmlspecialchars(mysqli_real_escape_string($mysqli, trim($_POST['nif_al'])));
$fecha = htmlspecialchars(mysqli_real_escape_string($mysqli, trim($_POST['fecha_al'])));
$direccion = htmlspecialchars(mysqli_real_escape_string($mysqli, trim($_POST['dir_al'])));
$telefono = htmlspecialchars(mysqli_real_escape_string($mysqli, trim($_POST['tel_al'])));
$emailColegio = htmlspecialchars(mysqli_real_escape_string($mysqli, trim($_POST['em-esc_al'])));
$emailPersonal = htmlspecialchars(mysqli_real_escape_string($mysqli, trim($_POST['em-per_al'])));
$sexo = htmlspecialchars(mysqli_real_escape_string($mysqli, trim($_POST['sexo_al'])));
$curso = htmlspecialchars(mysqli_real_escape_string($mysqli, trim($_POST['curso_al'])));

$validateUser = getDuplicatedUserFromBBDD($mysqli, $dni, $emailColegio);

// En caso que el usuario ya exista que redirija con error
if ($validateUser == false) {
    header('Location: ../view/crear.php?error=userExist');
}

try {
    // Quitamos el autocommit 
    mysqli_autocommit($mysqli, false);
    
    // Iniciamos la transacción
    mysqli_begin_transaction($mysqli);

    // Inserta el alumno en la tabla tbl_alumnos
    $queryAlumno = "INSERT INTO tbl_alumnos (nombre_alumno, apellido_alumno, dni_alumno, fecha_nac_alumno, direccion_alumno, telf_alumno, email_cole_alumno, email_pri_alumno, sexo_user)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtAlumno = mysqli_prepare($mysqli, $queryAlumno);
    mysqli_stmt_bind_param($stmtAlumno, 'sssssssss', $nombre, $apellido, $dni, $fecha, $direccion, $telefono, $emailColegio, $emailPersonal, $sexo);
    mysqli_stmt_execute($stmtAlumno);

    // Obtener el ID del alumno recién insertado
    $idAlumno = mysqli_insert_id($mysqli);

    // Obtener las asignaturas asociadas al curso
    $queryAsignaturas = "SELECT id_asignatura FROM tbl_cursos_asignaturas WHERE id_curso = ?";
    $stmtAsignaturas = mysqli_prepare($mysqli, $queryAsignaturas);
    mysqli_stmt_bind_param($stmtAsignaturas, 'i', $curso);
    mysqli_stmt_execute($stmtAsignaturas);
    $resultAsignaturas = mysqli_stmt_get_result($stmtAsignaturas);

    // Asociar el alumno con las asignaturas del curso
    $queryAsociar = "INSERT INTO tbl_asignatura_alumno (matricula_alumno, id_asignatura) VALUES (?, ?)";
    $stmtAsociar = mysqli_prepare($mysqli, $queryAsociar);

    while ($row = mysqli_fetch_assoc($resultAsignaturas)) {
        $idAsignatura = $row['id_asignatura'];
        mysqli_stmt_bind_param($stmtAsociar, 'ii', $idAlumno, $idAsignatura);
        mysqli_stmt_execute($stmtAsociar);
    }

    // Confirmamos la transacción
    mysqli_commit($mysqli);

    // Cerramos los statements
    mysqli_stmt_close($stmtAlumno);
    mysqli_stmt_close($stmtAsignaturas);
    mysqli_stmt_close($stmtAsociar);

    // Redirigir después de completar
    header("Location: ../view/recepcion.php");
    exit();
} catch (Exception $e) {
    // En caso de error, revertimos la transacción
    mysqli_rollback($mysqli);
    echo "Error al crear usuario y asignarlo al curso con asignaturas: " . $e->getMessage();
    die();

}   finally {
    // Restauramos el autocommit
    mysqli_autocommit($mysqli, true);
}
?>