<?php
session_start();
// Importamos los archivos necesarios
require_once '../php/functions.php';
require_once '../php/query.php';

require '../php/connection/connection.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="../js/validateInputs.js"></script>
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
            <a id="btn-cerrarSesion"><img src="../img/off.png" alt="" id="img-cerrarSesion"></a>
        </div>
    </header>
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Crear usuarios</h3>
                    <form action="../php/añadirUsuario.php" method="post" id="formulario">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombreAlumno" class="form-label">Nombre</label>
                                <input type="text" id="nombreAlumno" name="name_al" class="form-control">
                                <p class="errorCrear" id="nombreAlumnoError"></p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="apellidosAlumno" class="form-label">Apellidos</label>
                                <input type="text" id="apellidosAlumno" name="ap_al" class="form-control">
                                <p class="errorCrear" id="apellidosAlumnoError"></p>

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nifNieAlumno" class="form-label">NIF</label>
                                <input type="text" id="nifNieAlumno" name="nif_al" class="form-control">
                                <p class="errorCrear" id="nifNieAlumnoError"></p>

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nacimientoAlumno" class="form-label">Fecha de nacimiento</label>
                                <input type="date" id="nacimientoAlumno" name="fecha_al" class="form-control">
                                <p class="errorCrear" id="nacimientoAlumnoError"></p>

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="direccionAlumno" class="form-label">Dirección</label>
                                <input type="text" id="direccionAlumno" name="dir_al" class="form-control">
                                <p class="errorCrear" id="direccionAlumnoError"></p>

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="telefonoAlumno" class="form-label">Teléfono</label>
                                <input type="text" id="telefonoAlumno" name="tel_al" class="form-control">
                                <p class="errorCrear" id="telefonoAlumnoError"></p>

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="emailEscuelaAlumno" class="form-label">Email Escuela</label>
                                <input type="email" id="emailEscuelaAlumno" name="em-esc_al" class="form-control">
                                <p class="errorCrear" id="emailEscuelaAlumnoError"></p>

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="emailPersonalAlumno" class="form-label">Email Personal</label>
                                <input type="email" id="emailPersonalAlumno" name="em-per_al" class="form-control">
                                <p class="errorCrear" id="emailPersonalAlumnoError"></p>

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="sexo_al" class="form-label">Sexo</label>
                                <select name="sexo_al" id="sexo_al" class="form-select">
                                    <option value="H">Hombre</option>
                                    <option value="M">Mujer</option>
                                </select>
                            </div>

                            <div class="col-md-12 text-center">
                                <button type="submit" id="botonSubmit" class="btn btn-primary w-100" name="envioCrear">Crear</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>


</html>