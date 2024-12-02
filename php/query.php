<?php
function getUsersFromBBDD($mysqli, $limit_number, $offset, $conditions, $params, $param_types) {
    // Definir el límite y offset para los resultados paginados
    $limit = $limit_number == false ? '' : "LIMIT $limit_number OFFSET $offset";

    // Consulta para obtener los registros con los filtros, LIMIT y OFFSET
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
                    $conditions $limit;";

    // Consulta para obtener el total de registros sin LIMIT y OFFSET
    $countSql = "SELECT COUNT(*) AS total FROM tbl_alumnos a $conditions;";

    // Inicializamos el stmt para obtener los registros
    $dinamicStmt = mysqli_stmt_init($mysqli);
    if (mysqli_stmt_prepare($dinamicStmt, $dinamicSql)) {
        if (!empty($params)) {
            mysqli_stmt_bind_param($dinamicStmt, $param_types, ...$params);
        }
        mysqli_stmt_execute($dinamicStmt);
        $result = mysqli_stmt_get_result($dinamicStmt);
    } else {
        die("Error preparing statement: " . mysqli_error($mysqli));
    }

    // Inicializamos el stmt para contar el total de registros
    $countStmt = mysqli_stmt_init($mysqli);
    $totalRecords = 0;
    if (mysqli_stmt_prepare($countStmt, $countSql)) {
        if (!empty($params)) {
            mysqli_stmt_bind_param($countStmt, $param_types, ...$params);
        }
        mysqli_stmt_execute($countStmt);
        $countResult = mysqli_stmt_get_result($countStmt);
        if ($countRow = mysqli_fetch_assoc($countResult)) {
            $totalRecords = $countRow['total'];
        }
    } else {
        die("Error preparing count statement: " . mysqli_error($mysqli));
    }

    return ['data' => $result, 'total' => $totalRecords];
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