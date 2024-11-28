<?php
function getUsersFromBBDD($mysqli) {
    // Creamos la consulta dinámica
    $dinamicSql = "SELECT * from tbl_alumnos";
    
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