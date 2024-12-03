<?php

session_start();

    // Verificamos si existe la variable de SESSION
    if (!isset($_SESSION['session_user'])) {
        header('Location: ../view/index.php');
        exit;
    }

    // Importamos los archivos necesarios
    require_once '../php/functions.php';
    require_once '../php/query.php';

    require '../php/connection/connection.php';

    $matricula = $_POST['matricula'];

    if (filter_has_var(INPUT_POST, 'btn_addCourseStudent')) {
        $course = htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['curso_al'])) ?? '';

        if ($course == '') {
            header("Location: ../view/notas.php?idAlumno=$matricula&error=NoSelectedOption");
        }

        header("Location: ./addCourseUser.php?idAlumno=$matricula&idCourse=$course");

        exit();
    }

    // Se Utiliza este en vez de POST-matricula
    // if(!isset($_GET["idAlumno"])){
    //     header("Location: ./recepcion.php");
    //     exit();
    // }

    if(!isset($_POST["notas"]) || !is_array($_POST['notas']) || !isset($_POST['matricula']) || !isset($_POST['id_curso'])){
        header("Location: ../view/recepcion.php");
        exit();
    }    
    

    $notas = $_POST['notas'];
    $course = $_POST['id_curso'];

    try {
        $sqlNotas = "UPDATE tbl_asignatura_alumno
                    SET nota_asignatura_alumno = ? 
                    WHERE matricula_alumno = ? 
                    AND id_asignatura = ?
                    AND id_asignatura IN (
                        SELECT id_asignatura
                        FROM tbl_cursos_asignaturas
                        WHERE id_curso = ?
                        AND id_asignatura = ?
                    )";



        $stmt = mysqli_prepare($mysqli, $sqlNotas);

        // Recorrer el array de notas y actualizar cada una
        foreach ($notas as $idAsignatura => $nota) {
            $nota = mysqli_escape_string($mysqli, htmlspecialchars(trim($nota)));
            mysqli_stmt_bind_param($stmt, 'iiiii', $nota, $matricula, $idAsignatura, $course, $idAsignatura);
            mysqli_stmt_execute($stmt);
        }
        mysqli_commit($mysqli);

        header("Location: ../view/recepcion.php?exito=notas_actualizadas");
        exit();
    } catch (Exception $e) {

        echo "Error al editar notas de alumno: " . $e->getMessage();
        die();
    }



?>