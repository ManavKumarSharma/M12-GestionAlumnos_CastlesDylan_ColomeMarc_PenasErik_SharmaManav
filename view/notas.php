<?php
session_start();

// Importamos los archivos necesarios
require_once '../php/functions.php';
require_once '../php/query.php';
require '../php/connection/connection.php';

if (!isset($_GET["idAlumno"])) {
    header("Location: ./recepcion.php");
    exit();
}

$alu = $_GET["idAlumno"];
$data = getDataFromUser($mysqli, $alu);
$rowUser = mysqli_fetch_assoc($data);
$thisYear = intval(date("Y"));
$lastYear = $thisYear - 1;
$nextYear = $thisYear + 1;

$courses = getCoursesFromBBDD($mysqli);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="../js/validarNotas.js"></script>
    <title>Modificar Notas</title>
</head>

<body class="bg-light">
<header id="header">
    <img id="logo-iz" src="../img/logoClase.png" alt="">
    <a href="./recepcion.php" id="logo-cent">
        <img id="logo-cent" src="../img/logo_fje.svg" alt="">
    </a>
    <div id="btns-der">
        <?php
        $rutaFotoPerfil = '../fotosPerfil/' . $_SESSION['session_user']['id'] . '.png';
        ?>
        <div id="img-userContainer">
            <img src="<?php echo file_exists($rutaFotoPerfil) ? $rutaFotoPerfil : '../img/profilePic.png' ?>" alt="" id="img-user">
        </div>
        <p id="usrName"><?php echo $_SESSION['session_user']['name'] . ' ' .  $_SESSION['session_user']['surname'] ?></p>
        <a id="btn-cerrarSesion" href="../php/cerrarSesionProcess.php"><img src="../img/off.png" alt="" id="img-cerrarSesion"></a>
    </div>
</header>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Modificar Notas de <?php echo $rowUser["nombre_alumno"] . " " . $rowUser["apellido_alumno"]; ?></h3>

                    <form action="../php/notasProcess.php" method="post" id="formulario">
                        <input type="hidden" name="matricula" value="<?php echo $rowUser["matricula_alumno"]; ?>">

                        <?php
                        // Consulta para obtener las asignaturas y los cursos
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

                        // Convertir los resultados en un array
                        $asignaturas = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        if (count($asignaturas) > 0) {
                            $curso = $asignaturas[0];  // Suponiendo que hay un curso disponible
                            echo "<h5 class='text-center mb-4'>" . $curso["nombre_curso"] . " (" . $curso["fecha_asignatura_alumno"] . ")</h5>";
                        }
                        ?>

                        <input type="hidden" value="<?php echo htmlentities($curso['id_curso'])?>" name="id_curso">

                        <div class="row">
                            <?php
                            $formatoCursoEmpieza = $thisYear . "-" . $nextYear;
                            $cursoExiste = false;
                            foreach ($asignaturas as $fila) {
                                if ($fila["fecha_asignatura_alumno"] == $formatoCursoEmpieza) {
                                    echo '
                                    <div class="col-md-6 mb-3">
                                        <label for="asignatura_' . $fila["id_asignatura"] . '" class="form-label">' . $fila["nombre_asignatura"] . '</label>
                                        <input type="number" name="notas[' . $fila["id_asignatura"] . ']" value="' . $fila["nota_asignatura_alumno"] . '" class="form-control" id="asignatura_' . $fila["id_asignatura"] . '" min="0" max="100" required>
                                        <p id="asignatura_' . $fila["id_asignatura"] . 'Error" style="color: red;"></p>
                                    </div>';
                                    $cursoExiste = true;
                                }                         
                            }

                            if (!$cursoExiste) {
                                $formatoCursoAcaba = $lastYear . "-" . $thisYear;
                                foreach ($asignaturas as $fila) {
                                    if ($fila["fecha_asignatura_alumno"] == $formatoCursoAcaba) {
                                        echo '
                                        <div class="col-md-6 mb-3">
                                            <label for="asignatura_' . $fila["id_asignatura"] . '" class="form-label">' . $fila["nombre_asignatura"] . '</label>
                                            <input type="number" name="notas[' . $fila["id_asignatura"] . ']" value="' . $fila["nota_asignatura_alumno"] . '" class="form-control" id="asignatura_' . $fila["id_asignatura"] . '" min="0" max="100" required>
                                            <p id="asignatura_' . $fila["id_asignatura"] . 'Error" style="color: red;"></p>
                                        </div>';
                                    }                         
                                }
                            }
                            ?>


                            <?php if (!$cursoExiste): ?>
                                <div class='col-12 text-center'>
                                    <p>Este alumno no pertenece a ningún curso.</p>
                                    <label for="curso_al" class="form-label">Agrégale un curso:</label>
                                    <div class="col-md-6 mb-3 d-flex justify-content-center w-100">
                                        <select name="curso_al" id="curso_al" class="form-select">
                                                <option value="">Selecciona el curso...</option>
                                            <?php while ($row = mysqli_fetch_assoc($courses)):?>
                                                <option value="<?php echo htmlspecialchars($row['id_curso']) ?>"><?php echo htmlspecialchars($row['nombre_curso']) ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <?php
                                        if (isset($_GET['error']) && $_GET['error'] == 'NoSelectedOption') {
                                            echo '<span style="color: red;">Debés seleccionar una opción válida</span><br><br>';
                                        }
                                    ?>
                                    <input type="submit" value="Agregar" class="btn btn-primary" name="btn_addCourseStudent">
                                    <br><br>
                                    <a href="./recepcion.php">Volver a la tabla</a>
                                </div>
                            <?php else: ?>
                                <div class="text-center mt-4">
                                    <button type="submit" id="botonSubmit" name="envioEdit" class="btn btn-primary w-100">Modificar</button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>