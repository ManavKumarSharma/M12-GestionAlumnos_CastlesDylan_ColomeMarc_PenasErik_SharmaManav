<?php
session_start();
// Importamos los archivos necesarios
require_once '../php/functions.php';
require_once '../php/query.php';

require '../php/connection/connection.php';

$data = getAvgMarkUsersFromBBDD($mysqli);
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
    <style>

    </style>
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
                    <h3 class="card-title text-center mb-4">Notas medias de los alumnos</h3>

                    <?php if(mysqli_num_rows($data) == 0):?>
                        <span>No hay datos</span>
                    
                    <?php else: ?>
                        <!-- Inicio de tabla -->
                        <table>
                            <tr>
                                <th>Matrícula alumno</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Asignatura</th>
                                <th>Nota media</th>
                                <th>Curso</th>
                            </tr>
                        <?php while ($row = mysqli_fetch_assoc($data)): ?>
                            <tbody>
                                <tr class="rowTable"></tr>
                                <td><?php echo $row['matricula_alumno'] ?></td>
                                <td><?php echo $row['nombre_alumno'] ?></td>
                                <td><?php echo $row['apellido_alumno'] ?></td>
                                <td><?php echo $row['nombre_asignatura'] ?></td>
                                <td><?php echo $row['nota_media'] ?></td>
                                <td><?php echo $row['nombre_curso'] ?></td>
                            </tbody>                            
                        <?php endwhile; ?>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
