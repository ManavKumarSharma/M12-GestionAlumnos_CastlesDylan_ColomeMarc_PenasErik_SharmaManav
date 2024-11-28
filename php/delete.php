<?php
    require_once '../php/functions.php';
    require_once '../php/query.php';

    require '../php/connection/connection.php';

    if(!isset($_GET["idAlumno"])){
        header("Location: ../view/recepcion.php");
        exit();
    }

    try {
        $delete = $_GET["idAlumno"];
        // En primer lugar, se desactiva la autoejecución de las consultas
        mysqli_autocommit($mysqli, false);


        // Se inicializa la transacción
        mysqli_begin_transaction($mysqli, MYSQLI_TRANS_START_READ_WRITE);
  
        $sqlDel1 = "DELETE FROM tbl_asignatura_alumno WHERE matricula_alumno = ?;";
        $stmt1 = mysqli_stmt_init($mysqli);
        mysqli_stmt_prepare($stmt1, $sqlDel1);
        mysqli_stmt_bind_param($stmt1, "i", $delete);
        mysqli_stmt_execute($stmt1); 
    
        
        $lastid = mysqli_insert_id($mysqli);

        $sqlDel2 = "DELETE FROM tbl_alumnos WHERE matricula_alumno = ?;";
        
        $stmt2 = mysqli_stmt_init($mysqli);
        mysqli_stmt_prepare($stmt2, $sqlDel2);
        mysqli_stmt_bind_param($stmt2, "i", $lastid);
        mysqli_stmt_execute($stmt2);
        
        // Se hace el commit y por lo tanto se confirman las dos consultas
        mysqli_commit($mysqli);

        // Se cierra la conexión
        mysqli_stmt_close($stmt1);
        mysqli_stmt_close($stmt2);

        header("Location: recepcion.php");
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "Error al crear usuario: " . $e->getMessage();
        die();
    }


?>