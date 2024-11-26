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

function getTotalUsersCount($mysqli) {
    // Consulta para contar el número total de registros
    $dinamicSql = "SELECT COUNT(*) AS total FROM tbl_alumnos";
    $result = mysqli_query($mysqli, $dinamicSql);
    $row = mysqli_fetch_assoc($result);
    return $row['total']; // Devuelve el número total de registros
}
?>