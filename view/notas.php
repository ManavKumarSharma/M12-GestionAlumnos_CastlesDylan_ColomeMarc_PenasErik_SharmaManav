<?php

    // Importamos los archivos necesarios
    require_once '../php/functions.php';
    require_once '../php/query.php';

    require '../php/connection/connection.php';

    if(!isset($_GET["idAlumno"])){
        header("Location: ./recepcion.php");
        exit();
    }
    
    $alu = $_GET["idAlumno"];
    $data = getDataFromUser($mysqli, $alu);
    $rowUser = mysqli_fetch_assoc($data);
    $thisYear = intval(date("Y"));
    $lastYear = $thisYear - 1;
    $nextYear = $thisYear + 1;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/validateEdit.js"></script>
    <title>Document</title>
</head>
<body>
    <form action="../php/notasProcess.php" method="post">
    <input type='hidden' name='matricula' value="<?php echo $rowUser["matricula_alumno"];  ?>">
        <h3><?php echo $rowUser["nombre_alumno"] . " " . $rowUser["apellido_alumno"]; ?></h3>
            <?php
            $sqlAsignaturas = "SELECT * FROM tbl_asignaturas 
                               INNER JOIN tbl_cursos_asignaturas ON tbl_cursos_asignaturas.id_asignatura = tbl_asignaturas.id_asignatura
                               INNER JOIN tbl_asignatura_alumno ON tbl_asignatura_alumno.id_asignatura = tbl_asignaturas.id_asignatura
                               INNER JOIN tbl_cursos ON tbl_cursos.id_curso = tbl_cursos_asignaturas.id_curso
                               WHERE tbl_asignatura_alumno.matricula_alumno = ?";
            $stmt = mysqli_stmt_init($mysqli);
        
            // Preparamos la consulta
            if (mysqli_stmt_prepare($stmt, $sqlAsignaturas)) {
                mysqli_stmt_bind_param($stmt, "i", $alu);

                // Ejecutamos el stmt
                mysqli_stmt_execute($stmt);

                // Obtenemos los resultados
                $result = mysqli_stmt_get_result($stmt);

                // Cerramos el stmt
                mysqli_stmt_close($stmt);
            }   
            $curso = mysqli_fetch_assoc($result);
            echo "<h5>" . $curso["nombre_curso"] . " (" . $curso["fecha_asignatura_alumno"] . ")</h5>";
            ?>
            <table id="tbl-content">
                    <thead>
                        <tr>
                        <?php
                            $formatoCursoEmpieza = $thisYear . "-" . $nextYear;
                            $cursoExiste = false;
                            foreach ($result as $fila) {
                                if ($fila["fecha_asignatura_alumno"] == $formatoCursoEmpieza) {
                                    echo '<th>' . $fila["nombre_asignatura"] . '</th>';
                                    $cursoExiste = true;
                                }                         
                            }
                            if (!$cursoExiste) {
                                $formatoCursoAcaba = $lastYear . "-" . $thisYear;
                                $cursoExiste = false;
                                foreach ($result as $fila) {
                                    if ($fila["fecha_asignatura_alumno"] == $formatoCursoEmpieza) {
                                        echo '<th>' . $fila["nombre_asignatura"] . '</th>';
                                        $cursoExiste = false;
                                    }                         
                                }
                            }

                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $formatoCursoEmpieza = $thisYear . "-" . $nextYear;
                            $cursoExiste = false;
                            foreach ($result as $fila) {
                                if ($fila["fecha_asignatura_alumno"] == $formatoCursoEmpieza) {
                                    echo '<td><input type="number" name="notas[' . $fila["id_asignatura"] . ']" value="' . $fila["nota_asignatura_alumno"] . '" class="form-control"></td>';                                    $cursoExiste = true;
                                }                         
                            }
                            if (!$cursoExiste) {
                                $formatoCursoAcaba = $lastYear . "-" . $thisYear;
                                $cursoExiste = false;
                                foreach ($result as $fila) {
                                    if ($fila["fecha_asignatura_alumno"] == $formatoCursoEmpieza) {
                                        echo '<td><input type="number" name="notas[' . $fila["id_asignatura"] . ']" value="' . $fila["nota_asignatura_alumno"] . '" class="form-control"></td>';                                    $cursoExiste = true;
                                        $cursoExiste = false;
                                    }                         
                                }
                            }

                            if (!$cursoExiste) {
                                echo "Este alumno no pertenece a ninugn curso.";
                            }

                            ?>
                        </tr>
                    </tbody>
                </table>
            <input type='submit' id='botonSubmit' value='Modificar' name='envioEdit'>
    </form>
    
</body>
</html>