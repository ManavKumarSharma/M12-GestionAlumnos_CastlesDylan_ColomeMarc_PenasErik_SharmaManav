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


// Inicializamos las varialbles
$conditions = '';
$param_types = '';
$params = [];

// Comprobamos si se ha pulsado el botón de los filtros
if($_SERVER['REQUEST_METHOD'] === 'GET' && filter_has_var(INPUT_GET, 'filter_btn')) {
    $filters = [];
    
    $fields = [
        'filter_matricula' => ['field' => 'a.matricula_alumno', 'type' => 'i'],
        'filter_nombre' => ['field' => 'a.nombre_alumno', 'type' => 's', 'like' => true],
        'filter_apellido' => ['field' => 'a.apellido_alumno', 'type' => 's', 'like' => true],
        'filter_nif' => ['field' => 'a.dni_alumno', 'type' => 's', 'like' => true],
        'filter_fecha' => ['field' => 'a.fecha_nac_alumno', 'type' => 's'],
        'filter_direccion' => ['field' => 'a.direccion_alumno', 'type' => 's', 'like' => true],
        'filter_telefono' => ['field' => 'a.telf_alumno', 'type' => 'i'],
        'filter_email_colegio' => ['field' => 'a.email_cole_alumno', 'type' => 's', 'like' => true],
        'filter_email_personal' => ['field' => 'a.email_pri_alumno', 'type' => 's', 'like' => true],
        'filter_sexo' => ['field' => 'a.sexo_user', 'type' => 's']
    ];
    
    foreach ($fields as $get_key => $db_field) {
        $input_value = htmlspecialchars($_GET[$get_key]) ?? '';
        if (!empty($input_value)) {
            $operator = $db_field['operator'] ?? '=';
            $like = $db_field['like'] ?? false;
            $filters[] = $db_field['field'] . " " . ($like ? "LIKE" : $operator) . " ?";
            $param_types .= $db_field['type'];
            $params[] = $like ? "%{$input_value}%" : $input_value;
        }
    }

    if (!empty($filters)) {
        $conditions .= " WHERE " . implode(' AND ', $filters);
    }
}

// Obtenemos los datos de los usuarios desde la base de datos
$data = getUsersFromBBDD($mysqli, $limit_number, $offset, $conditions, $params, $param_types);
$total_records = $data['total'];
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
            <?php if(mysqli_num_rows($data['data']) == 0): ?>
                <span>No hay datos</span>
            <?php else: ?>
                

                <!-- Contenedor que almacena todas las opciones de filtrado o indexación de la tabla -->
                <div id="container_filter_elements">
                    <button id="abrirModalBtn" class="results">Filtros</button>

                    <!-- La ventana Modal -->
                    <div id="miModal" class="modal">
                        <!-- Contenido de la modal -->
                        <div class="modal-contenido">
                            <span class="cerrar" id="cerrarModalBtn">&times;</span>
                            <form action="" method="GET">
                                <div id="modal_title">
                                    <h1>Filtros</h1>
                                </div>
                                <div class="modal_elements_form">
                                    <label for="filter_matricula">Matrícula</label><br>
                                    <input type="number" name="filter_matricula" id="filter_matricula">
                                </div>
                                <div class="modal_elements_form">
                                    <label for="filter_nombre">Nombre</label><br>
                                    <input type="text" name="filter_nombre" id="filter_nombre">
                                </div>
                                <div class="modal_elements_form">
                                    <label for="filter_apellido">Apellido</label><br>
                                    <input type="text" name="filter_apellido" id="filter_apellido">
                                </div>
                                <div class="modal_elements_form">
                                    <label for="filter_nif">NIF/NIE</label><br>
                                    <input type="text" name="filter_nif" id="filter_nif">
                                </div>
                                <div class="modal_elements_form">
                                    <label for="filter_fecha">Fecha de Nacimiento</label><br>
                                    <input type="number" name="filter_fecha" id="filter_fecha">
                                </div>
                                <div class="modal_elements_form">
                                    <label for="filter_direccion">Dirección</label><br>
                                    <input type="text" name="filter_direccion" id="filter_direccion">
                                </div>
                                <div class="modal_elements_form">
                                    <label for="filter_telefono">Teléfono</label><br>
                                    <input type="number" name="filter_telefono" id="filter_telefono">
                                </div>
                                <div class="modal_elements_form">
                                    <label for="filter_email_colegio">Email del Colegio</label><br>
                                    <input type="email" name="filter_email_colegio" id="filter_email_colegio">
                                </div>
                                <div class="modal_elements_form">
                                    <label for="filter_email_personal">Email Personal</label><br>
                                    <input type="email" name="filter_email_personal" id="filter_email_personal">
                                </div>
                                <div class="modal_elements_form">
                                    <label for="filter_sexo">Sexo</label><br>
                                    <select name="filter_sexo" id="filter_sexo">
                                        <option value="" selected>Selecciona una opción</option>
                                        <option value="H">H</option>
                                        <option value="M">M</option>
                                    </select>
                                </div>
                                <input type="submit" value="Filtrar" name="filter_btn">
                                <?php
                                    if(!empty($_GET['page'])) {
                                        echo '<input type="hidden" name="page" value="' . $page . '">';
                                    }

                                    if(!empty($_GET['results'])) {
                                        echo '<input type="hidden" name="results" value="' . $limit_number . '">';
                                    }
                                ?>
                            </form>
                        </div>
                    </div>

                    <!-- Formulario de selección de resultados por página -->
                    <form action="" method="GET">
                        <select name="results" class="results" id="resutls_form">
                            <option value="1" <?php if ($limit_number == 1) echo 'selected'; ?>>1</option>
                            <option value="5" <?php if ($limit_number == 5) echo 'selected'; ?>>5</option>
                            <option value="10" <?php if ($limit_number == 10) echo 'selected'; ?>>10</option>
                            <option value="15" <?php if ($limit_number == 15) echo 'selected'; ?>>15</option>
                        </select>
                        
                        <!-- Inputs hidden para mantener los filtros activos -->
                        <?php
                        if (!empty($fields)) {
                            // Añadimos un input hidden por cada filtro activo
                            foreach ($fields as $get_key => $db_field) {
                                if (isset($_GET[$get_key])) {
                                    $input_value = htmlspecialchars($_GET[$get_key]);
                                    echo '<input type="hidden" name="' . $get_key . '" value="' . $input_value . '">';
                                }
                            }
                        }
                        ?>
                        
                        <input type="hidden" name="resutlsbtn" value="<?php echo $page; ?>">
                    </form>
                </div>

                <!-- Tabla con los resultados -->
                <table id="tbl-content">
                    <thead>
                        <tr>
                            <th>Matrícula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>NIF/NIE</th>
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
                        while ($row = mysqli_fetch_assoc($data['data'])) {
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
                            echo "<td class='celdaEditar' class='editarBoton' data-id='" . $row['matricula_alumno'] . "'><img id='iconoEditar' src='../img/iconoEditar.png'></td>";  
                            echo "<td class='celdaEliminar' class='eliminarBoton' value='" . $row['matricula_alumno'] . "'><img id='iconoEliminar' src='../img/eliminarIcono.png'></td>";  
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
    <script src="../js/botonesAcciones.js"></script>
</body>
</html>