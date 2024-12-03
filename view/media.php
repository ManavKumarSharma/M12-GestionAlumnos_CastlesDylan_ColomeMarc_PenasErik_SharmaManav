<?php
session_start();
// Importamos los archivos necesarios
require_once '../php/functions.php';
require_once '../php/query.php';
require '../php/connection/connection.php';

// Obtenemos los datos de la consulta
$data = getAvgMarkUsersFromBBDD($mysqli);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mejores notas medias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="../js/validateInputs.js"></script>
</head>

<body class="bg-light">
    <header id="header" class="d-flex align-items-center justify-content-between p-3 bg-white shadow-sm">
        <img id="logo-iz" src="../img/logoClase.png" alt="Logo Clase" style="height: 50px;">
        <a href="./recepcion.php">
            <img id="logo-cent" src="../img/logo_fje.svg" alt="Logo FJE" style="height: 50px;">
        </a>
        <div id="btns-der" class="d-flex align-items-center">
            <?php
            $rutaFotoPerfil = '../fotosPerfil/' . $_SESSION['session_user']['id'] . '.png';
            ?>
            <div id="img-userContainer" class="me-2">
                <img src="<?php echo file_exists($rutaFotoPerfil) ? $rutaFotoPerfil : '../img/profilePic.png'; ?>" alt="Foto Perfil" id="img-user" class="rounded-circle" style="height: 50px; width: 50px; object-fit: cover;">
            </div>
            <p id="usrName" class="me-3 mb-0">
                <?php echo $_SESSION['session_user']['name'] . ' ' . $_SESSION['session_user']['surname']; ?>
            </p>
            <a id="btn-cerrarSesion" href="../php/cerrarSesionProcess.php">
                <img src="../img/off.png" alt="Cerrar Sesión" id="img-cerrarSesion" style="height: 30px;">
            </a>
        </div>
    </header>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Notas Medias de los Alumnos</h3>
                        <?php if (mysqli_num_rows($data) == 0): ?>
                            <p class="text-center text-danger">No hay datos disponibles</p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Matrícula Alumno</th>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Asignatura</th>
                                            <th>Nota Media</th>
                                            <th>Curso</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($data)): ?>
                                            <tr>
                                                <td><?php echo $row['matricula_alumno']; ?></td>
                                                <td><?php echo $row['nombre_alumno']; ?></td>
                                                <td><?php echo $row['apellido_alumno']; ?></td>
                                                <td><?php echo $row['nombre_asignatura']; ?></td>
                                                <td><?php echo $row['nota_media']; ?></td>
                                                <td><?php echo $row['nombre_curso']; ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
