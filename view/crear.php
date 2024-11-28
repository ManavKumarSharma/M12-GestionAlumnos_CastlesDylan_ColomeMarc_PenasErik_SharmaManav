<?php

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
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <form action="../php/añadirUsuario.php" method="post">
        <label for="nom_al">Nombre</label>
        <br><br>
        <input type='text' id='nombreAlumno' name='name_al'><br><br>

        <label for="ap_al">Apellidos</label>
        <br><br>
        <input type='text' id='apellidosAlumno' name='ap_al'><br><br>

        <label for="nif_al">NIF</label>
        <br><br>
        <input type='text' id='nifNieAlumno' name='nif_al'><br><br>

        <label for="fecha_al">Fecha nacimiento</label>
        <br><br>
        <input type='date' id='nacimientoAlumno' name='fecha_al'><br><br>

        <label for="dir_al">Dirección</label>
        <br><br>
        <input type='text' id='direccionAlumno' name='dir_al'><br><br>

        <label for="tel_al">Telefono</label>
        <br><br>
        <input type='text' id='telefonoAlumno' name='tel_al'><br><br>

        <label for="em-esc_al">Email Escuela</label>
        <br><br>
        <input type='text' id='emailEscuelaAlumno' name='em-esc_al'><br><br>

        <label for="em-per_al">Email Personal</label>
        <br><br>
        <input type='text' id='emailPersonalAlumno' name='em-per_al'><br><br>

        <input type='submit' id='botonSubmit' value='Crear' name='envioCrear'>
       
    </form>
</body>

</html>