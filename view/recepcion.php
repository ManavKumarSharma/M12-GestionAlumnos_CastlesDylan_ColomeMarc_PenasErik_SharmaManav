<?php
// Incluye las conexiones y funciones necesarias
session_start();

// Verificamos si existe la variable de SESSION
if (!isset($_SESSION['session_user'])) {  
    header('Location: ./index.php');
    exit;
}

require_once '../php/functions.php';
require_once '../php/query.php';
require '../php/connection/connection.php';

// Definir el número de resultados por página desde GET
$limit_number = isset($_GET['results']) ? (int)htmlspecialchars($_GET['results']) : 5;
$page = isset($_GET['page']) ? (int)htmlspecialchars($_GET['page']) : 1;
$offset = ($page - 1) * $limit_number;

// Obtenemos los datos de los usuarios desde la base de datos
$data = getUsersFromBBDD($mysqli, $limit_number, $offset);
$total_records = getTotalUsersCount($mysqli);
$total_pages = ceil($total_records / $limit_number);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Página principal</title>
    <script src="../js/recargarTabla.js"></script>
</head>
<body>
    <!-- Header de las paginas -->
    <header id="header">
        <img id="logo-iz" src="../img/logoClase.png" alt="">
        <img id="logo-cent" src="../img/logo_fje.svg" alt="">
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

    <!-- Contenedor principal de la página -->
    <main id="content">
        <nav id="menu">
            <h1 id="tituloPequeño" class="fuenteAzulClaro">OPCIONES</h1>
            <div class="opcionCaja" id="cajaCrearAlumno">
                <div id="parteIconoCaja">
                    <img src="../img/simboloCrearUsuario.png" class="simboloCaja">
                </div>
                <div id="parteNombreCaja">
                    <p class="fuenteBlanca" id="textoCajas">Crear usuario</p>
                </div>
            </div>
            <div class="opcionCaja" id="cajaNotasMedias">
                <div id="parteIconoCaja">
                    <img src="../img/simboloNotasMedias.png" class="simboloCaja">
                </div>
                <div id="parteNombreCaja">
                    <p class="fuenteBlanca" id="textoCajas">Notas medias</p>
                </div>
            </div>
        </nav>
        <div id="content-right" class="fuenteNegra">

            
            <!-- Si no hay datos  -->
            <?php if(mysqli_num_rows($data) == 0): ?>
                <span>No hay datos</span>
            <?php else: ?>
                <!-- Formulario de selección de resultados por página -->
                <form action="" method="GET" id="cambiarNumMostrar">
                    <select name="results" id="results">
                        <option value="1" <?php if ($limit_number == 1) echo 'selected'; ?>>1</option>
                        <option value="5" <?php if ($limit_number == 5) echo 'selected'; ?>>5</option>
                        <option value="10" <?php if ($limit_number == 10) echo 'selected'; ?>>10</option>
                        <option value="15" <?php if ($limit_number == 15) echo 'selected'; ?>>15</option>
                    </select>
                    <input type="hidden" name="resutlsbtn" value="<?php echo $page; ?>">
                </form>
                
                <!-- Tabla con los resultados -->
                <table id="tbl-content">
                    <thead>
                        <tr>
                            <th>Matrícula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>DNI</th>
                            <th class="ocultar">Fecha de Nacimiento</th>
                            <th class="ocultar">Dirección</th>
                            <th>Teléfono</th>
                            <th class="ocultar">Email del Colegio</th>
                            <th class="ocultar">Email Personal</th>
                            <th class="ocultar">Sexo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($data)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['matricula_alumno']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nombre_alumno']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['apellido_alumno']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['dni_alumno']) . "</td>";
                            echo "<td class='ocultar'>" . htmlspecialchars($row['fecha_nac_alumno']) . "</td>";
                            echo "<td class='ocultar'>" . htmlspecialchars($row['direccion_alumno']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['telf_alumno']) . "</td>";
                            echo "<td class='ocultar'>" . htmlspecialchars($row['email_cole_alumno']) . "</td>";
                            echo "<td class='ocultar'>" . htmlspecialchars($row['email_pri_alumno']) . "</td>";
                            echo "<td class='ocultar'>" . htmlspecialchars($row['sexo_user']) . "</td>";                        
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            <?php endif; ?>
            <?php if ($total_pages > 1): ?>
                    <div class="pagination">
                    <span>Página <?php echo $page; ?> de <?php echo $total_pages; ?></span>
                        <br><p></p>
                        <!-- Enlaces de paginación -->
                        <?php if ($page > 1): ?>
                            <a class="noEstilosLink" href="?page=1&results=<?php echo $limit_number; ?>">Primera</a>
                            <a class="noEstilosLink" href="?page=<?php echo $page - 1; ?>&results=<?php echo $limit_number; ?>">Anterior</a>
                        <?php endif; ?>



                        <?php if ($page < $total_pages): ?>
                            <a class="noEstilosLink" href="?page=<?php echo $page + 1; ?>&results=<?php echo $limit_number; ?>">Siguiente</a>
                            <a class="noEstilosLink" href="?page=<?php echo $total_pages; ?>&results=<?php echo $limit_number; ?>">Última</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
        </div>
    </main>
</body>
</html>