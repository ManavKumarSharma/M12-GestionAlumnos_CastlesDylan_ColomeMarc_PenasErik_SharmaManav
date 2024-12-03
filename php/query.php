<?php
function getUsersFromBBDD($mysqli, $limit_number, $offset, $filters, $column_to_filter, $order_column) {
    $limit = $limit_number ? "LIMIT $limit_number OFFSET $offset" : '';

    // Construcción de la cláusula WHERE dinámica
    $whereClauses = [];
    $params = [];
    $paramTypes = '';

    if (!empty($filters['filter_matricula'])) {
        $whereClauses[] = "a.matricula_alumno = ?";
        $params[] = $filters['filter_matricula'];
        $paramTypes .= 'i';
    }

    if (!empty($filters['filter_nombre'])) {
        $whereClauses[] = "a.nombre_alumno LIKE ?";
        $params[] = '%' . $filters['filter_nombre'] . '%';
        $paramTypes .= 's';
    }

    if (!empty($filters['filter_apellido'])) {
        $whereClauses[] = "a.apellido_alumno LIKE ?";
        $params[] = '%' . $filters['filter_apellido'] . '%';
        $paramTypes .= 's';
    }

    if (!empty($filters['filter_dni'])) {
        $whereClauses[] = "a.dni_alumno LIKE ?";
        $params[] = '%' . $filters['filter_dni'] . '%';
        $paramTypes .= 's';
    }

    if (!empty($filters['filter_telefono'])) {
        $whereClauses[] = "a.telf_alumno LIKE ?";
        $params[] = '%' . $filters['filter_telefono']  . '%';
        $paramTypes .= 's';
    }

    if (!empty($filters['filter_email_cole'])) {
        $whereClauses[] = "a.email_cole_alumno LIKE ?";
        $params[] = '%' . $filters['filter_email_cole'] . '%';
        $paramTypes .= 's';
    }

    if (!empty($filters['filter_email_personal'])) {
        $whereClauses[] = "a.email_pri_alumno LIKE ?";
        $params[] = '%' . $filters['filter_email_personal'] . '%';
        $paramTypes .= 's';
    }

    if (!empty($filters['filter_sexo'])) {
        $whereClauses[] = "a.sexo_user LIKE ?";
        $params[] = '%' . $filters['filter_sexo'] . '%';
        $paramTypes .= 's';
    }

    // Unimos las cláusulas WHERE
    $whereSql = $whereClauses ? 'WHERE ' . implode(' AND ', $whereClauses) : '';

    // Validar el ordenamiento
    $validColumns = [
        'matricula_alumno', 'nombre_alumno', 'apellido_alumno', 
        'dni_alumno', 'fecha_nac_alumno', 'direccion_alumno', 
        'telf_alumno', 'email_cole_alumno', 'email_pri_alumno', 
        'sexo_user'
    ];

    if ($column_to_filter && in_array($column_to_filter, $validColumns)) {
        $order_column = strtoupper($order_column) === 'DESC' ? 'DESC' : 'ASC';
        $orderSql = "ORDER BY $column_to_filter $order_column";
    } else {
        $orderSql = '';
    }

    // Creamos la consulta dinámica
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
                    $whereSql
                    $orderSql
                    $limit";

    // Inicializamos el stmt
    $stmt = mysqli_stmt_init($mysqli);

    // Preparamos la consulta
    if (mysqli_stmt_prepare($stmt, $dinamicSql)) {
        if (!empty($params)) {
            // Asociamos los parámetros dinámicamente
            mysqli_stmt_bind_param($stmt, $paramTypes, ...$params);
        }

        // Ejecutamos el stmt
        mysqli_stmt_execute($stmt);

        // Obtenemos los resultados
        $result = mysqli_stmt_get_result($stmt);

        // Cerramos el stmt
        mysqli_stmt_close($stmt);

        return $result;
    } else {
        // Si hay un error, manejarlo
        die("Error en la preparación de la consulta: " . mysqli_error($mysqli));
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

        // Ejecutamos la consulta
        mysqli_stmt_execute($stmt);

        // Obtenemos los resultados
        $result = mysqli_stmt_get_result($stmt);

        // Cerramos el stmt
        mysqli_stmt_close($stmt);

        return $result;
    }
}

function getTotalUsersCount($mysqli, $filters) {
    // Construcción de la cláusula WHERE dinámica para contar registros filtrados
    $whereClauses = [];
    $params = [];
    $paramTypes = '';

    if (!empty($filters['filter_matricula'])) {
        $whereClauses[] = "a.matricula_alumno = ?";
        $params[] = $filters['filter_matricula'];
        $paramTypes .= 'i';
    }

    if (!empty($filters['filter_nombre'])) {
        $whereClauses[] = "a.nombre_alumno LIKE ?";
        $params[] = '%' . $filters['filter_nombre'] . '%';
        $paramTypes .= 's';
    }

    if (!empty($filters['filter_apellido'])) {
        $whereClauses[] = "a.apellido_alumno LIKE ?";
        $params[] = '%' . $filters['filter_apellido'] . '%';
        $paramTypes .= 's';
    }

    if (!empty($filters['filter_dni'])) {
        $whereClauses[] = "a.dni_alumno = ?";
        $params[] = $filters['filter_dni'];
        $paramTypes .= 's';
    }

    if (!empty($filters['filter_telefono'])) {
        $whereClauses[] = "a.telf_alumno = ?";
        $params[] = $filters['filter_telefono'];
        $paramTypes .= 's';
    }

    if (!empty($filters['filter_email_cole'])) {
        $whereClauses[] = "a.email_cole_alumno LIKE ?";
        $params[] = '%' . $filters['filter_email_cole'] . '%';
        $paramTypes .= 's';
    }

    if (!empty($filters['filter_email_personal'])) {
        $whereClauses[] = "a.email_pri_alumno LIKE ?";
        $params[] = '%' . $filters['filter_email_personal'] . '%';
        $paramTypes .= 's';
    }

    if (!empty($filters['filter_sexo'])) {
        $whereClauses[] = "a.sexo_user LIKE ?";
        $params[] = '%' . $filters['filter_sexo'] . '%';
        $paramTypes .= 's';
    }

    // Unimos las cláusulas WHERE
    $whereSql = $whereClauses ? 'WHERE ' . implode(' AND ', $whereClauses) : '';

    // Consulta para contar los registros filtrados
    $dinamicSql = "SELECT COUNT(*) AS total FROM tbl_alumnos a $whereSql";

    // Inicializamos el stmt
    $stmt = mysqli_stmt_init($mysqli);

    // Preparamos la consulta
    if (mysqli_stmt_prepare($stmt, $dinamicSql)) {
        if (!empty($params)) {
            // Asociamos los parámetros dinámicamente
            mysqli_stmt_bind_param($stmt, $paramTypes, ...$params);
        }

        // Ejecutamos la consulta
        mysqli_stmt_execute($stmt);

        // Obtenemos el resultado
        $result = mysqli_stmt_get_result($stmt);

        // Fetch the result as an associative array
        $row = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);

        // Devolver el número total de registros
        return $row['total'];
    } else {
        // Si hay un error en la preparación de la consulta
        die("Error en la preparación de la consulta: " . mysqli_error($mysqli));
    }
}


// Función que obtiene las notas medias de los alumnos por asignatura y las ordena de mayor a menor
function getBestMarksFromUsersBBDD($mysqli) {
    // Consulta SQL que obtiene las notas medias por asignatura de los alumnos y las ordena por la nota media en orden descendente
    $dinamicSql = "
        WITH 
        AvgNotesBySubject AS (
            SELECT 
                s.id_asignatura,
                s.nombre_asignatura,
                c.nombre_curso,
                ROUND(AVG(asa.nota_asignatura_alumno), 2) AS nota_media
            FROM 
                tbl_asignaturas s
            JOIN 
                tbl_asignatura_alumno asa ON s.id_asignatura = asa.id_asignatura
            JOIN 
                tbl_cursos_asignaturas ca ON s.id_asignatura = ca.id_asignatura
            JOIN 
                tbl_cursos c ON ca.id_curso = c.id_curso
            GROUP BY 
                s.id_asignatura, c.id_curso
        ),
        HighestGradePerSubject AS (
            SELECT 
                asa.id_asignatura,
                asa.matricula_alumno,
                MAX(asa.nota_asignatura_alumno) AS mejor_nota
            FROM 
                tbl_asignatura_alumno asa
            GROUP BY 
                asa.id_asignatura, asa.matricula_alumno
        ),
        BestStudents AS (
            SELECT 
                h.id_asignatura,
                h.matricula_alumno,
                h.mejor_nota,
                RANK() OVER (PARTITION BY h.id_asignatura ORDER BY h.mejor_nota DESC) AS rank_alumno
            FROM 
                HighestGradePerSubject h
        )
        SELECT 
        a.nombre_alumno,
        a.apellido_alumno,
        a.matricula_alumno,
        s.nombre_asignatura,
        c.nombre_curso,  -- Mostrar el nombre del curso
        sa.nota_asignatura_alumno
        FROM 
            tbl_asignatura_alumno sa
        JOIN 
            tbl_alumnos a ON sa.matricula_alumno = a.matricula_alumno
        JOIN 
            tbl_asignaturas s ON sa.id_asignatura = s.id_asignatura
        JOIN 
            tbl_cursos_asignaturas ca ON s.id_asignatura = ca.id_asignatura
        JOIN
            tbl_cursos c ON ca.id_curso = c.id_curso  -- Unimos la tabla de cursos para obtener el nombre del curso
        WHERE 
            sa.nota_asignatura_alumno = (
                SELECT MAX(nota_asignatura_alumno)
                FROM tbl_asignatura_alumno
                WHERE id_asignatura = sa.id_asignatura
            )
        ORDER BY 
            sa.nota_asignatura_alumno DESC, s.nombre_asignatura;
    ";

    // Preparamos la sentencia SQL
    $stmt = mysqli_stmt_init($mysqli);

    if (mysqli_stmt_prepare($stmt, $dinamicSql)) {
        // Ejecutamos la consulta
        mysqli_stmt_execute($stmt);

        // Obtenemos los resultados en forma de un conjunto de datos
        $result = mysqli_stmt_get_result($stmt);

        // Cerramos la declaración preparada
        mysqli_stmt_close($stmt);

        // Retornamos el resultado para ser procesado en el HTML
        return $result;
    } else {
        // Si ocurre un error, devolvemos null y se puede manejar el error en el flujo principal
        return null;
    }
}

function getCoursesFromBBDD($mysqli) {
    $sql = "SELECT * FROM tbl_cursos";

    $stmt = mysqli_stmt_init($mysqli);

    if(mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return $result;
    } else {
        return null;
    }
}

function getDuplicatedUserFromBBDD($mysqli, $dni, $emailColegio){
    $dni = htmlspecialchars(mysqli_real_escape_string($mysqli, $dni));
    $emailColegio = htmlspecialchars(mysqli_real_escape_string($mysqli, $emailColegio));

    $sql = "SELECT * FROM tbl_alumnos WHERE dni_alumno = ? OR email_cole_alumno LIKE ?";

    $stmt = mysqli_stmt_init($mysqli);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 'ss', $dni, $emailColegio);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_num_rows($result) === 0 ? true : false;
    }
}
?>