<?php
// Importamos los archivos necesarios
require_once '../php/functions.php';
require_once '../php/query.php';
require '../php/connection/connection.php';

// Verificamos si el idAlumno está presente
if(!isset($_GET["idAlumno"])){
    header("Location: ./recepcion.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alumno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="../js/validateInputs.js"></script>
</head>

<body class="bg-light">
    <!-- Header con logo y usuario -->
    <header id="header">
        <img id="logo-iz" src="../img/logoClase.png" alt="">
        <a href="./recepcion.php" id="logo-cent">
            <img id="logo-cent" src="../img/logo_fje.svg" alt="">
        </a>
        <div id="btns-der">
            <?php
            session_start();
            $rutaFotoPerfil = '../fotosPerfil/' . $_SESSION['session_user']['id'] . '.png';
            ?>
            <div id="img-userContainer">
                <img src="<?php echo file_exists($rutaFotoPerfil) ? $rutaFotoPerfil : '../img/profilePic.png' ?>" alt="" id="img-user">
            </div>
            <p id="usrName"><?php echo $_SESSION['session_user']['name'] . ' ' .  $_SESSION['session_user']['surname'] ?></p>
            <a id="btn-cerrarSesion" href="../php/cerrarSesionProcess.php"><img src="../img/off.png" alt="" id="img-cerrarSesion"></a>
        </div>
    </header>

    <!-- Contenedor del formulario -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Editar Alumno</h3>
                        <form action="../php/editarProcess.php" method="post" id="formulario">
                            <?php
                            $idAlumno = htmlspecialchars($_GET["idAlumno"]);
                            $data = getDataFromUser($mysqli, $idAlumno);
                            if (mysqli_num_rows($data) > 0) {
                                $row = mysqli_fetch_assoc($data);
                                echo "<input type='hidden' name='matricula' value='" . $row["matricula_alumno"] . "'>";

                                // Formulario en dos columnas
                                echo "<div class='row'>";

                                // Columna izquierda
                                echo "<div class='col-md-6 mb-3'>
                                    <label for='nombreAlumno' class='form-label'>Nombre</label>
                                    <input type='text' id='nombreAlumno' name='name_al' class='form-control' value='" . $row["nombre_alumno"] ."'>
                                    <p id='nombreAlumnoError' class='text-danger'></p>
                                </div>";

                                echo "<div class='col-md-6 mb-3'>
                                    <label for='apellidosAlumno' class='form-label'>Apellidos</label>
                                    <input type='text' id='apellidosAlumno' name='ap_al' class='form-control' value='" . $row["apellido_alumno"] . "'>
                                    <p id='apellidosAlumnoError' class='text-danger'></p>
                                </div>";

                                echo "<div class='col-md-6 mb-3'>
                                    <label for='nifNieAlumno' class='form-label'>NIF/NIE</label>
                                    <input type='text' id='nifNieAlumno' name='nif_al' class='form-control' value='" . $row["dni_alumno"] . "'>
                                    <p id='nifNieAlumnoError' class='text-danger'></p>
                                </div>";

                                echo "<div class='col-md-6 mb-3'>
                                    <label for='nacimientoAlumno' class='form-label'>Fecha de Nacimiento</label>
                                    <input type='date' id='nacimientoAlumno' name='fecha_al' class='form-control' value='" . $row["fecha_nac_alumno"] . "'>
                                    <p id='nacimientoAlumnoError' class='text-danger'></p>
                                </div>";

                                echo "<div class='col-md-6 mb-3'>
                                    <label for='direccionAlumno' class='form-label'>Dirección</label>
                                    <input type='text' id='direccionAlumno' name='dir_al' class='form-control' value='" . $row["direccion_alumno"] . "'>
                                    <p id='direccionAlumnoError' class='text-danger'></p>
                                </div>";

                                echo "<div class='col-md-6 mb-3'>
                                    <label for='telefonoAlumno' class='form-label'>Teléfono</label>
                                    <input type='text' id='telefonoAlumno' name='tel_al' class='form-control' value='" . $row["telf_alumno"] . "'>
                                    <p id='telefonoAlumnoError' class='text-danger'></p>
                                </div>";

                                echo "<div class='col-md-6 mb-3'>
                                    <label for='emailEscuelaAlumno' class='form-label'>Email Escolar</label>
                                    <input type='email' id='emailEscuelaAlumno' name='em-esc_al' class='form-control' value='" . $row["email_cole_alumno"] . "'>
                                    <p id='emailEscuelaAlumnoError' class='text-danger'></p>
                                </div>";

                                echo "<div class='col-md-6 mb-3'>
                                    <label for='emailPersonalAlumno' class='form-label'>Email Personal</label>
                                    <input type='email' id='emailPersonalAlumno' name='em-per_al' class='form-control' value='" . $row["email_pri_alumno"] . "'>
                                    <p id='emailPersonalAlumnoError' class='text-danger'></p>
                                </div>";

                                // Cierre de la fila
                                echo "</div>";

                                // Botón de Enviar
                                echo "<div class='mb-3 text-center'>
                                    <button type='submit' class='btn btn-primary w-100' name='envioEdit'>Modificar</button>
                                </div>";
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
