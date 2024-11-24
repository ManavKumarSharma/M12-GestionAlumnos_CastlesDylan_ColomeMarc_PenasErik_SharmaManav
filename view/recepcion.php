<?php

session_start();

if (!isset($_SESSION["data"])) {
    header ("Location: ./index.php");
}

include ("../php/connection/connection.php");

$valoresBBDD = [];

foreach ($_SESSION["data"] as $campo => $valor) {
    $valoresBBDD[$campo] = mysqli_real_escape_string($mysqli, $valor);
}

$consultaEmail = "SELECT tbl_user.*, tbl_roles.* from tbl_user INNER JOIN tbl_roles ON tbl_user.id_rol = tbl_roles.id_rol WHERE email_cole_user = ?;";

// Comprobar si existe un usuario con el email
    // Inicializar la declaracion para poder usarla
    $stmt = mysqli_stmt_init($mysqli);

    // Preparar declaracion con la consulta
    mysqli_stmt_prepare($stmt, $consultaEmail);

    // Asociar los "?" de la declaracion con su variable
    mysqli_stmt_bind_param($stmt, "s", $valoresBBDD['email']);

    // Ejecutar declaracion preparada
    mysqli_stmt_execute($stmt);

    // Obtener el resultado como un objeto mysqli_result
    $result = mysqli_stmt_get_result($stmt);

    // Verificar si hay resultados
    if (!($result && mysqli_num_rows($result) > 0)) {
        $errors['emailBBDD'] = 'No existe ningún usuario con ese email.';
        redirectWithErrors('../index.php', $errors);
    }

    $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse; /* Asegura que los bordes se colapsen en uno solo */
        }
        th, td {
            border: 1px solid black; /* Define el borde de las celdas */
            padding: 8px; /* Espaciado interno en las celdas */
            text-align: left; /* Alineación del texto a la izquierda */
        }
        th {
            background-color: #f2f2f2; /* Color de fondo para el encabezado */
        }
    </style>
</head>
<body>
    <div>
        <fieldset>
            <h2>Bienvenid@ <?php echo $row['nom_user']; ?>, estos son sus datos</h2>
            <table>
                <tbody>
                    <tr>
                        <td>Nombre completo</td>
                        <td><?php echo $row['nom_user'] . " " . $row['apellido_user']; ?></td>
                    </tr>
                    <tr>
                        <td>DNI</td>
                        <td><?php echo $row['dni_user'] ?></td>
                    </tr>
                    <tr>
                        <td>Fecha de nacimiento</td>
                        <td><?php echo $row['fecha_nac_user'] ?></td>
                    </tr>
                    <tr>
                        <td>Número de teléfono</td>
                        <td><?php echo $row['telf_user'] ?></td>
                    </tr>
                    <tr>
                        <td>Correo escuela</td>
                        <td><?php echo $row['email_cole_user'] ?></td>
                    </tr>
                    <tr>
                        <td>Permisos</td>
                        <td><?php echo $row['tipo_rol'] ?></td>
                    </tr>
                    <tr>
                        <td>Sexo</td>
                        <td><?php echo $row['sexo_user'] ?></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </div>
</body>
</html>