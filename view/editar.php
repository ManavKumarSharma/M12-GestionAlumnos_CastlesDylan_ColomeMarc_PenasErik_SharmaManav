<?php

    // Importamos los archivos necesarios
    require_once '../php/functions.php';
    require_once '../php/query.php';

    require '../php/connection/connection.php';

    if(!isset($_GET["idAlumno"])){
        header("Location: ./recepcion.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/validateEdit.js"></script>
    <title>Document</title>
</head>
<body>
    <form action="../php/editarProcess.php" method="post">
        <?php
        $data = getDataFromUser($mysqli, $_GET["idAlumno"]);
        if(mysqli_num_rows($data) > 0){
            $row = mysqli_fetch_assoc($data);
            
            echo "<input type='hidden' name='matricula' value='" . $row["matricula_alumno"] . "'>";
            
            echo "<h4>Nombre</h4>
            <input type='text' id='nombreAlumno' name='name_al' value='" . $row["nombre_alumno"] ."'><br><br>";

            echo "<h4>Apellidos</h4>
            <input type='text' id='apellidosAlumno' name='ap_al' value='" . $row["apellido_alumno"] . "'><br><br>";

            echo "<h4>NIF/NIE</h4>
            <input type='text' id='nifNieAlumno' name='nif_al' value='" . $row["dni_alumno"] . "'><br><br>";

            echo "<h4>Nacimiento</h4>
            <input type='date' id='nacimientoAlumno' name='fecha_al' id='' value='" . $row["fecha_nac_alumno"] . "'><br><br>";

            echo "<h4>Dirección</h4>
            <input type='text' id='direccionAlumno' name='dir_al' value='" . $row["direccion_alumno"] . "'><br><br>";

            echo "<h4>Teléfono</h4>
            <input type='text' id='telefonoAlumno' name='tel_al' value='" . $row["telf_alumno"] . "'><br><br>";
            
            echo "<h4>Email Escolar</h4>
            <input type='text' id='emailEscuelaAlumno' name='em-esc_al' value='" . $row["email_cole_alumno"] . "'><br><br>";

            echo "<h4>Email Personal</h4>
            <input type='text' id='emailPersonalAlumno' name='em-per_al' value='" . $row["email_pri_alumno"] . "'><br><br>";

            echo "<input type='submit' id='botonSubmit' value='Modificar' name='envioEdit'>";
        }
        ?>
    </form>
    
</body>
</html>