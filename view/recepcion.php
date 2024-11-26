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
    <header id="header">
        <img id="logo-iz" src="../img/logo_lanet.svg" alt="Logo Lanet">
        <img id="logo-cent" src="../img/logo_fje.svg" alt="Logo FJE">
        <div id="btns-der">
            <p>Manab Cum Sauarma</p>
        </div>
    </header>

    <!-- Contenedor principal de la página -->
    <main id="continer_main">
        <!-- Si no hay datos  -->
        <?php if(mysqli_num_rows($data) == 0): ?>
            <span>No hay datos</span>
        <?php else: ?>
            <!-- Formulario de selección de resultados por página -->
            <form action="" method="GET">
                <select name="results" id="results">
                    <option value="5" <?php if ($limit_number == 5) echo 'selected'; ?>>5</option>
                    <option value="15" <?php if ($limit_number == 15) echo 'selected'; ?>>15</option>
                    <option value="30" <?php if ($limit_number == 30) echo 'selected'; ?>>30</option>
                    <option value="50" <?php if ($limit_number == 50) echo 'selected'; ?>>50</option>
                    <option value="100" <?php if ($limit_number == 100) echo 'selected'; ?>>100</option>
                </select>
                <input type="hidden" name="resutlsbtn" value="<?php echo $page; ?>">
            </form>

            <?php if ($total_pages > 1): ?>
                <div class="pagination">
                    <!-- Enlaces de paginación -->
                    <?php if ($page > 1): ?>
                        <a href="?page=1&results=<?php echo $limit_number; ?>">Primera</a>
                        <a href="?page=<?php echo $page - 1; ?>&results=<?php echo $limit_number; ?>">Anterior</a>
                    <?php endif; ?>

                    <span>Página <?php echo $page; ?> de <?php echo $total_pages; ?></span>

                    <?php if ($page < $total_pages): ?>
                        <a href="?page=<?php echo $page + 1; ?>&results=<?php echo $limit_number; ?>">Siguiente</a>
                        <a href="?page=<?php echo $total_pages; ?>&results=<?php echo $limit_number; ?>">Última</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Tabla con los resultados -->
            <table>
                <thead>
                    <tr>
                        <th>Matrícula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Email del Colegio</th>
                        <th>Email Personal</th>
                        <th>Sexo</th>
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
                        echo "<td>" . htmlspecialchars($row['fecha_nac_alumno']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['direccion_alumno']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['telf_alumno']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email_cole_alumno']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email_pri_alumno']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['sexo_user']) . "</td>";                        
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</body>
</html>