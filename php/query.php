<?php
function getUsersFromBBDD($mysqli, $limit_number, $offset) {
    $limit = $limit_number == false ? '' : "LIMIT $limit_number OFFSET $offset";

    // Creamos la consulta dinámica con LIMIT y OFFSET
    $dinamicSql = "SELECT
                        a.matricula_alumno,
                        a.nombre_alumno,
                        a.apellido_alumno,
                        a.dni_alumno,
                        a.fecha_nac_alumno,
                        a.direccion_alumno,
                        a.telf_alumno,
                        a.email_cole_alumno,
                        a.email_pri_alumno,
                        a.sexo_user
                    FROM 
                        tbl_alumnos a
                    $limit;";

    // Inicializamos el stmt
    $dinamicStmt = mysqli_stmt_init($mysqli);

     // Preparamos la consulta
     if (mysqli_stmt_prepare($dinamicStmt, $dinamicSql)) {

        // Ejecutamos el stmt
        mysqli_stmt_execute($dinamicStmt);

        // Obtenemos los resultados
        $result = mysqli_stmt_get_result($dinamicStmt);

        // Cerramos el stmt
        mysqli_stmt_close($dinamicStmt);

        return $result;
    }
}

function getDataFromUser($mysqli, $matriculaAlu) {

    // Creamos la consulta dinámica
    $dinamicSql = "SELECT * from tbl_alumnos WHERE matricula_alumno = ?";
    
    // Inicializamos el stmt
    $stmt = mysqli_stmt_init($mysqli);
    
     // Preparamos la consulta
     if (mysqli_stmt_prepare($stmt, $dinamicSql)) {
        mysqli_stmt_bind_param($stmt, "i", $matriculaAlu);
        mysqli_stmt_execute($stmt);

        // Ejecutamos el stmt
        mysqli_stmt_execute($stmt);

        // Obtenemos los resultados
        $result = mysqli_stmt_get_result($stmt);

        // Cerramos el stmt
        mysqli_stmt_close($stmt);

        return $result;
    }
}
?>