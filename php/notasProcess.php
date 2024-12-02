<?php

session_start();

    // Verificamos si existe la variable de SESSION
    if (!isset($_SESSION['session_user'])) {
        header('Location: ./index.php');
        exit;
    }

    // Importamos los archivos necesarios
    require_once '../php/functions.php';
    require_once '../php/query.php';

    require '../php/connection/connection.php';

    // Provisional para hacer pruebas
    if(!isset($_POST["matricula"])){
        header("Location: ./recepcion.php");
        exit();
    }

    // Se Utiliza este en vez de POST-matricula
    // if(!isset($_GET["idAlumno"])){
    //     header("Location: ./recepcion.php");
    //     exit();
    // }

    if(!isset($_POST["notas"]) || !is_array($_POST['notas'])){
        header("Location: ./recepcion.php");
        exit();
    }    
    
    $matricula = $_POST['matricula'];
    $notas = $_POST['notas'];

    try {
        $sqlNotas = "UPDATE tbl_asignatura_alumno SET nota_asignatura_alumno = ? WHERE matricula_alumno = ? AND id_asignatura = ?";
        $stmt = mysqli_prepare($mysqli, $sqlNotas);

        // Recorrer el array de notas y actualizar cada una
        foreach ($notas as $idAsignatura => $nota) {
            $nota = mysqli_escape_string($mysqli, htmlspecialchars(trim($nota)));
            mysqli_stmt_bind_param($stmt, 'iii', $nota, $matricula, $idAsignatura);
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