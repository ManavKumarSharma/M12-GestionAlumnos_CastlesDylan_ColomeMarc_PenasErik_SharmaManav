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
$limit_number = isset($_GET['results']) ? (int)htmlspecialchars($_GET['results_select']) : 5;
$page = isset($_GET['page']) ? (int)htmlspecialchars($_GET['page']) : 1;
$total_pages = isset($_GET['total_pages']) ? (int)htmlspecialchars($_GET['total_pages']) : '';

// Verificamos las acciones de paginación
if (filter_has_var(INPUT_GET, 'primera')) {
    $page = 1;
} elseif (filter_has_var(INPUT_GET, 'anterior') && $page > 1) {
    $page--;
} elseif (filter_has_var(INPUT_GET, 'siguiente') && $page < $total_pages) {
    $page++;
} elseif (filter_has_var(INPUT_GET, 'ultima')) {
    $page = $total_pages;
}

// Recoger los filtros por GET
$filters = [
    'filter_matricula' => isset($_GET['filter_matricula']) ? $_GET['filter_matricula'] : '',
    'filter_nombre' => isset($_GET['filter_nombre']) ? $_GET['filter_nombre'] : '',
    'filter_apellido' => isset($_GET['filter_apellido']) ? $_GET['filter_apellido'] : '',
    'filter_dni' => isset($_GET['filter_dni']) ? $_GET['filter_dni'] : '',
    'filter_telefono' => isset($_GET['filter_telefono']) ? $_GET['filter_telefono'] : '',
    'filter_email_cole' => isset($_GET['filter_email_cole']) ? $_GET['filter_email_cole'] : '',
    'filter_email_personal' => isset($_GET['filter_email_personal']) ? $_GET['filter_email_personal'] : '',
    'filter_sexo' => isset($_GET['filter_sexo']) ? $_GET['filter_sexo'] : '',
];

$column_to_filter = isset($_GET['column_to_filter']) ? htmlspecialchars($_GET['column_to_filter']) : '';
$order_column = isset($_GET['order_column']) ? htmlspecialchars($_GET['order_column']) : '';

// Recoger el número total de registros para calcular el total de páginas
$total_records = getTotalUsersCount($mysqli, $filters);

// Calcular el número total de páginas, asegurándonos de que haya al menos una página
$total_pages = max(1, ceil($total_records / $limit_number));

// Si la página actual es mayor que el total de páginas, redirigir a la última página disponible
if ($page > $total_pages) {
    $page = $total_pages;
}

// Calcular el offset basado en la página actual
$offset = ($page - 1) * $limit_number;


// Obtener los datos de los usuarios desde la base de datos
$data = getUsersFromBBDD($mysqli, $limit_number, $offset, $filters, $column_to_filter, $order_column);

mysqli_close($mysqli);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Página principal</title>
    <script src="../js/recargarTabla.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/modalDisplay.js"></script>
</head>

<body id="bugSwal">
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
            <a id="btn-cerrarSesion" href="../php/cerrarSesionProcess.php"><img src="../img/off.png" alt="" id="img-cerrarSesion"></a>
        </div>
    </header>

    <!-- Contenedor principal de la página -->
    <main id="content">
        <nav id="menu">
            <h1 id="tituloPequeño" class="fuenteAzulClaro">OPCIONES</h1>
            <div class="opcionCaja" id="cajaCrearAlumno">
                <a class="quitarEstilosBtn" href="crear.php">
                    <div id="parteIconoCaja">
                        <img src="../img/simboloCrearUsuario.png" class="simboloCaja">
                    </div>
                    <div id="parteNombreCaja">
                        <p class="fuenteBlanca" id="textoCajas">Crear usuario</p>
                    </div>
                </a>
            </div>
            <div class="opcionCaja" id="cajaNotasMedias">
                <a class="quitarEstilosBtn" href="media.php">
                    <div id="parteIconoCaja">
                        <img src="../img/simboloNotasMedias.png" class="simboloCaja">
                    </div>
                    <div id="parteNombreCaja">
                        <p class="fuenteBlanca" id="textoCajas">Notas medias</p>
                    </div>
                </a>
            </div>
            <div class="opcionCaja" id="cajaEditarNotasDesactivado">
                <a class="quitarEstilosBtn" id="activar">
                    <div id="parteIconoCaja">
                        <img src="../img/iconoEditar.png" class="simboloCaja">
                    </div>
                    <div id="parteNombreCaja">
                        <p class="fuenteBlanca" id="textoCajas">Editar Notas</p>
                    </div>
                </a>
            </div>
        </nav>

        <div id="content-right" class="fuenteNegra">
            <!-- Si no hay datos  -->
            <?php if (mysqli_num_rows($data) == 0): ?>
                <span>No hay datos</span>

                <a href="./recepcion.php">Suprimir los filtros</a>

            <?php else: ?>
                <!-- Formulario de los diferentes filtros de la página -->
                <form action="" method="GET" id="cambiarNumMostrar">
                    <div id="container_index_pages">
                        <!-- Botones de navegación (Primera, Anterior, Siguiente, Última) -->
                        <div id="pagination_buttons">
                            <?php if ($page > 1): ?>
                                <input class="results_select" type="submit" value="Primera" name="primera">
                                <input  class="results_select" type="submit" value="Anterior" name="anterior">
                            <?php endif; ?>

                        <!-- Mostrar la página actual y el total de páginas -->
                        <span><?php echo $page; ?> de <?php echo $total_pages; ?></span>

                            <?php if ($page < $total_pages): ?>
                                <input  class="results_select" type="submit" value="Siguiente" name="siguiente">
                                <input  class="results_select" type="submit" value="Última" name="ultima">
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Campos ocultos para mantener la página actual y otros parámetros -->
                    <input type="hidden" value="<?php echo $page; ?>" name="page">
                    <input type="hidden" value="<?php echo $limit_number; ?>" name="results">
                    <input type="hidden" value="<?php echo $total_pages; ?>" name="total_pages">

                    <!-- Selector de número de resultados por página -->
                    <div id="container_results_select" style="display: flex; justify-content: end; margin-right: 4.6vw;">
                        <!-- Botón para abrir la modal -->
                        <button id="openModalBtn" class="results_select" style="margin-right: 3px;">Filtros</button>
                        <!-- Ventana Modal -->
                        <div id="modal" class="modal">
                            <div class="modal-content">
                                <span id="closeModalBtn" class="close-btn">&times;</span>
                                <h2>Filtros</h2>
                                <form action="" method="GET">
                                    <label for="filter_matricula">Matrícula:</label>
                                    <input type="text" id="filter_matricula" name="filter_matricula" value="<?php echo htmlspecialchars($filters['filter_matricula']); ?>"><br><br>

                                    <label for="filter_nombre">Nombre:</label>
                                    <input type="text" id="filter_nombre" name="filter_nombre" value="<?php echo htmlspecialchars($filters['filter_nombre']); ?>"><br><br>

                                    <label for="filter_apellido">Apellido:</label>
                                    <input type="text" id="filter_apellido" name="filter_apellido" value="<?php echo htmlspecialchars($filters['filter_apellido']); ?>"><br><br>

                                    <label for="filter_dni">DNI:</label>
                                    <input type="text" id="filter_dni" name="filter_dni" value="<?php echo htmlspecialchars($filters['filter_dni']); ?>"><br><br>

                                    <label for="filter_telefono">Teléfono:</label>
                                    <input type="text" id="filter_telefono" name="filter_telefono" value="<?php echo htmlspecialchars($filters['filter_telefono']); ?>"><br><br>

                                    <label for="filter_email_cole">Email Colegio:</label>
                                    <input type="text" id="filter_email_cole" name="filter_email_cole" value="<?php echo htmlspecialchars($filters['filter_email_cole']); ?>"><br><br>

                                    <label for="filter_email_personal">Email Personal:</label>
                                    <input type="text" id="filter_email_personal" name="filter_email_personal" value="<?php echo htmlspecialchars($filters['filter_email_personal']); ?>"><br><br>

                                    <label for="filter_sexo">Sexo:</label>
                                    <select name="filter_sexo" id="filter_sexo">
                                        <option value="" <?php echo ($filters['filter_sexo'] == '') ? 'selected' : ''; ?>></option>
                                        <option value="H" <?php echo ($filters['filter_sexo'] == 'M') ? 'selected' : ''; ?>>H</option>
                                        <option value="M" <?php echo ($filters['filter_sexo'] == 'S') ? 'selected' : ''; ?>>M</option>
                                    </select>

                                    <!-- Columna a ordenar -->
                                    <label for="column_to_filter">Columna a Ordenar</label>
                                    <select name="column_to_filter" id="column_to_filter">
                                        <option value="" <?php echo ($column_to_filter == '') ? 'selected' : ''; ?>>Selecciona una columna...</option>
                                        <option value="matricula_alumno" <?php echo ($column_to_filter == 'matricula_alumno') ? 'selected' : ''; ?>>Matrícula</option>
                                        <option value="nombre_alumno" <?php echo ($column_to_filter == 'nombre_alumno') ? 'selected' : ''; ?>>Nombre</option>
                                        <option value="apellido_alumno" <?php echo ($column_to_filter == 'apellido_alumno') ? 'selected' : ''; ?>>Apellidos</option>
                                        <option value="dni_alumno" <?php echo ($column_to_filter == 'dni_alumno') ? 'selected' : ''; ?>>DNI</option>
                                        <option value="fecha_nac_alumno" <?php echo ($column_to_filter == 'fecha_nac_alumno') ? 'selected' : ''; ?>>Fecha de Nacimiento</option>
                                        <option value="direccion_alumno" <?php echo ($column_to_filter == 'direccion_alumno') ? 'selected' : ''; ?>>Dirección</option>
                                        <option value="telf_alumno" <?php echo ($column_to_filter == 'telf_alumno') ? 'selected' : ''; ?>>Teléfono</option>
                                        <option value="email_cole_alumno" <?php echo ($column_to_filter == 'email_cole_alumno') ? 'selected' : ''; ?>>Email del Colegio</option>
                                        <option value="email_pri_alumno" <?php echo ($column_to_filter == 'email_pri_alumno') ? 'selected' : ''; ?>>Email Personal</option>
                                        <option value="sexo_user" <?php echo ($column_to_filter == 'sexo_user') ? 'selected' : ''; ?>>Sexo</option>
                                    </select>
                                    
                                    <!-- Ordenar por (desactivado hasta que se seleccione una columna) -->
                                    <label for="order_column">Ordenar por...</label>
                                    <select name="order_column" id="order_column" <?php echo ($column_to_filter == '') ? 'disabled' : ''; ?>>
                                        <option value="" <?php echo ($order_column == '') ? 'selected' : ''; ?>>Selecciona el orden</option>
                                        <option value="DESC" <?php echo ($order_column == 'DESC') ? 'selected' : ''; ?>>DESC</option>
                                        <option value="ASC" <?php echo ($order_column == 'ASC') ? 'selected' : ''; ?>>ASC</option>
                                    </select>

                                    <input type="submit" value="Filtrar"><br><br>
                                    <a href="./recepcion.php">Reestablecer filtros</a>
                                </form>
                            </div>
                        </div>
                        <select name="results_select" class="results_select" onchange="this.form.submit()">
                            <option value="1" <?php if ($limit_number == 1) echo 'selected'; ?>>1</option>
                            <option value="5" <?php if ($limit_number == 5) echo 'selected'; ?>>5</option>
                            <option value="10" <?php if ($limit_number == 10) echo 'selected'; ?>>10</option>
                            <option value="15" <?php if ($limit_number == 15) echo 'selected'; ?>>15</option>
                        </select>
                    </div>
                </form>

                
                <!-- Tabla con los resultados -->
                <table id="tbl-content">
                    <thead>
                        <tr>
                            <th class='ocultar'></th>
                            <th>Matrícula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>DNI</th>
                            <th class='ocultar'>Fecha de Nacimiento</th>
                            <th class='ocultar'>Dirección</th>
                            <th>Teléfono</th>
                            <th class='ocultar'>Email del Colegio</th>
                            <th class='ocultar'>Email Personal</th>
                            <th class='ocultar'>Sexo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($data)) {
                            echo "<tr class='rowTable'>";
                            echo "<td class='ocultar'><input type='radio' name='alumno' value=" . htmlspecialchars($row['matricula_alumno']) . "></td>";
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
                            echo "<td class='celdaEditar' data-id='" . $row['matricula_alumno'] . "'><img id='iconoEditar' src='../img/iconoEditar.png'></td>";
                            echo "<td class='celdaEliminar' data-id='" . $row['matricula_alumno'] . "'><img id='iconoEliminar' src='../img/eliminarIcono.png'></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </main>
    <?php
    // Script de Sweet Alert que aparece si viene de delete.php
                    if (isset($_GET['success'])) {
                        $mensaje = htmlspecialchars($_GET['success'], ENT_QUOTES, 'UTF-8');
                        echo "<script>                                
                                    Swal.fire({
                                        title: '¡Éxito!',
                                        text: '$mensaje',
                                        icon: 'success',
                                        confirmButtonText: 'Aceptar'
                                    });
                            </script>";
                    }
                // Script de Sweet Alert que aparece si viene de delete.php
                    if (isset($_GET['exito'])) {
                        switch ($_GET['exito']) {
                            case 'notas_actualizadas':
                                    echo "<script>
                                    document.addEventListener('DOMContentLoaded', () => {
                                        Swal.fire({
                                            title: '¡Éxito!',
                                            text: 'Se han actualizado las notas con Éxito',
                                            icon: 'success',
                                            confirmButtonText: 'Aceptar'
                                        });
                                    });
                                    </script>";
                                break;
                            
                            default:
                                # code...
                                break;
                        }
                    }
                ?>
        </div>
    </main>
    <script src="../js/botonesAcciones.js"></script>
    <script>
        // Script para que el SweetAlert solo salga la 1ra vez que carga
        window.onload = function () {
            if (window.location.search.includes('success') || window.location.search.includes('exito')) {
                const newURL = window.location.origin + window.location.pathname;
                window.history.replaceState({}, document.title, newURL);
            }
        };
</script>
</body>
</html>