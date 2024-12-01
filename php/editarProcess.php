<?php
    require_once '../php/functions.php';
    require_once '../php/query.php';

    require '../php/connection/connection.php';

    if(!isset($_POST["envioEdit"])){
        header("Location: ../view/recepcion.php");
        exit();
    }

    $campos = [];
    if (!empty($_POST["name_al"])) {
        $campos[] = "nombre_alumno = '" . mysqli_escape_string($mysqli, htmlspecialchars($_POST["name_al"])) ."'";
    }

    if (!empty($_POST["ap_al"])) {
        $campos[] = "apellido_alumno = '" . mysqli_escape_string($mysqli, htmlspecialchars($_POST["ap_al"])) ."'";
    }

    if (!empty($_POST["nif_al"])) {
        $campos[] = "dni_alumno = '" . mysqli_escape_string($mysqli, htmlspecialchars($_POST["nif_al"])) ."'";
    }

    if (!empty($_POST["fecha_al"])) {
        $campos[] = "fecha_nac_alumno = '" . mysqli_escape_string($mysqli, htmlspecialchars($_POST["fecha_al"])) ."'";
    }

    if (!empty($_POST["dir_al"])) {
        $campos[] = "direccion_alumno = '" . mysqli_escape_string($mysqli, htmlspecialchars($_POST["dir_al"])) ."'";
    }

    if (!empty($_POST["tel_al"])) {
        $campos[] = "telf_alumno = '" . mysqli_escape_string($mysqli, htmlspecialchars($_POST["tel_al"])) ."'";
    }

    if (!empty($_POST["em-esc_al"])) {
        $campos[] = "email_cole_alumno = '" . mysqli_escape_string($mysqli, htmlspecialchars($_POST["em-esc_al"])) ."'";
    }

    if (!empty($_POST["em-per_al"])) {
        $campos[] = "email_pri_alumno = '" . mysqli_escape_string($mysqli, htmlspecialchars($_POST["em-per_al"])) ."'";
    }
    
    try {
        $matricula = mysqli_escape_string($mysqli, htmlspecialchars($_POST["matricula"]));

        $sqlEdit = "UPDATE tbl_alumnos SET ";
        $sqlEdit .= implode(", ", $campos);
        $sqlEdit .= " WHERE matricula_alumno = ?";
        
        // echo $sqlEdit;
        // exit();
        // Inicializamos el stmt
        $stmt = mysqli_stmt_init($mysqli);
        
        // Preparamos la consulta
        if (mysqli_stmt_prepare($stmt, $sqlEdit)) {
            mysqli_stmt_bind_param($stmt, "i", $matricula);

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
        echo "Error al editar alumno: " . $e->getMessage();
        die();
    }
    
?>