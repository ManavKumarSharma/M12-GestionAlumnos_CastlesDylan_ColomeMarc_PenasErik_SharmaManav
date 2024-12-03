<?php
// Verificamos si está la sesión

session_start();

// Verificamos si existe la variable de SESSION
if (!isset($_SESSION['session_user'])) {
    header('Location: ../view/index.php');
    exit;
}

// Importamos los archivos necesarios
require_once '../php/functions.php';
require_once '../php/query.php';

// Importamos la conexión
require '../php/connection/connection.php';

// Recuperamos las variables por GET
$idUser = htmlspecialchars(mysqli_real_escape_string($mysqli, $_GET['idAlumno'])) ?? '';
$idCurso = htmlspecialchars(mysqli_real_escape_string($mysqli, $_GET['idCourse'])) ?? '';


try {
    // Quitamos el autocommit 
    mysqli_autocommit($mysqli, false);
    
    // Iniciamos la transacción
    mysqli_begin_transaction($mysqli);

    // Obtener las asignaturas asociadas al curso
    $queryAsignaturas = "SELECT id_asignatura FROM tbl_cursos_asignaturas WHERE id_curso = ?";
    $stmtAsignaturas = mysqli_prepare($mysqli, $queryAsignaturas);
    mysqli_stmt_bind_param($stmtAsignaturas, 'i', $idCurso);
    mysqli_stmt_execute($stmtAsignaturas);
    $resultAsignaturas = mysqli_stmt_get_result($stmtAsignaturas);

    // Asociar el alumno (usuario) con cada asignatura del curso
    $queryAsociar = "INSERT INTO tbl_asignatura_alumno (matricula_alumno, id_asignatura) VALUES (?, ?)";
    $stmtAsociar = mysqli_prepare($mysqli, $queryAsociar);

    while ($row = mysqli_fetch_assoc($resultAsignaturas)) {
        $idAsignatura = $row['id_asignatura'];
        mysqli_stmt_bind_param($stmtAsociar, 'ii', $idUser, $idAsignatura);  // Usar idUser aquí como matricula_alumno
        mysqli_stmt_execute($stmtAsociar);
    }

    // Confirmamos la transacción
    mysqli_commit($mysqli);

    // Cerramos los statements
    mysqli_stmt_close($stmtAsignaturas);
    mysqli_stmt_close($stmtAsociar);

    // Redirigir después de completar
    header("Location: ../view/notas.php?idAlumno=$idUser");
    exit();
} catch (Exception $e) {
    // En caso de error, revertimos la transacción
    mysqli_rollback($mysqli);
    echo "Error al asociar usuario al curso y asignaturas: " . $e->getMessage();
    die();
} finally {
    // Restauramos el autocommit
    mysqli_autocommit($mysqli, true);
}
?>