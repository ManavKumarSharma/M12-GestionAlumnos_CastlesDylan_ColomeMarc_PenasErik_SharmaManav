<?php
session_start();

// Verificamos si existe la variable de SESSION
if (!isset($_SESSION['session_user'])) {  // Corregido 'sesison_user' por 'session_user'
    header('Location: ./index.php');
    exit; // Aseguramos que no se ejecute el resto del código después del redireccionamiento
}

// Importamos los archivos necesarios
require_once '../php/functions.php';
require_once '../php/query.php';

// Importamos la conexión con la BBDD
require '../php/connection/connection.php';

// Obtenemos los datos de los usuarios desde la base de datos
$data = getUsersFromBBDD($mysqli);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Página principal</title>
</head>
<body>
    <header id="header">
        <img id="logo-iz" src="../img/logo_lanet.svg" alt="Logo Lanet">
        <img id="logo-cent" src="../img/logo_fje.svg" alt="Logo FJE">
        <div id="btns-der">
            <p>Manab Cum Sauarma</p>
        </div>
    </header>

    <main id="continer_main">
        <?php if(mysqli_num_rows($data) == 0): ?>
            <p>No hay datos</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Matrícula</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>NIF/NIE</th>
                        <th>Nacimiento</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Email escolar</th>
                        <th>Email personal</th>
                        <th>Sexo</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($data)): ?>
                        <tr>
                            <td><?php echo $row['matricula_alumno']; ?></td>
                            <td><?php echo htmlspecialchars($row['nombre_alumno']); ?></td>
                            <td><?php echo htmlspecialchars($row['apellido_alumno']); ?></td>
                            <td><?php echo htmlspecialchars($row['dni_alumno']); ?></td>
                            <td><?php echo htmlspecialchars($row['fecha_nac_alumno']); ?></td>
                            <td><?php echo htmlspecialchars($row['direccion_alumno']); ?></td>
                            <td><?php echo htmlspecialchars($row['telf_alumno']); ?></td>
                            <td><?php echo htmlspecialchars($row['email_cole_alumno']); ?></td>
                            <td><?php echo htmlspecialchars($row['email_pri_alumno']); ?></td>
                            <td><?php echo htmlspecialchars($row['sexo_user']); ?></td>
                            <td>
                                <button>Editar</button>
                                <button>Eliminar</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</body>
</html>