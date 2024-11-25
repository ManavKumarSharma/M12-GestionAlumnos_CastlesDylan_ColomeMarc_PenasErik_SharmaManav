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
?>