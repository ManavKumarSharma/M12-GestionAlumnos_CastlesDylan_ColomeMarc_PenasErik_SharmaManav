<?php
    require_once '../php/functions.php';
    require_once '../php/query.php';

    require '../php/connection/connection.php';

    if(!isset($_POST["edit"])){
        header("Location: ./recepcion.php");
        exit();
    }
    
    if (!empty($_POST["name_al"])) {
        
    }

    if (!empty($_POST["ap_al"])) {
        
    }

    if (!empty($_POST["nif_al"])) {
        
    }

    if (!empty($_POST["fecha_al"])) {
        
    }

    if (!empty($_POST["dir_al"])) {
        
    }

    if (!empty($_POST["tel_al"])) {
        
    }

    if (!empty($_POST["em-esc_al"])) {
        
    }

    if (!empty($_POST["em-per_al"])) {
        
    }
    
            // echo "<h4>Nombre</h4>
            // <input type='text' name='name_al' value='" . $row["nombre_alumno"] ."'><br><br>";

            // echo "<h4>Apellidos</h4>
            // <input type='text' name='ap_al' value='" . $row["apellido_alumno"] . "'><br><br>";

            // echo "<h4>NIF/NIE</h4>
            // <input type='text' name='nif_al' value='" . $row["dni_alumno"] . "'><br><br>";

            // echo "<h4>Nacimiento</h4>
            // <input type='date' name='fecha_al' id='' value='" . $row["fecha_nac_alumno"] . "'><br><br>";

            // echo "<h4>Dirección</h4>
            // <input type='text' name='dir_al' value='" . $row["direccion_alumno"] . "'><br><br>";

            // echo "<h4>Teléfono</h4>
            // <input type='text' name='tel_al' value='" . $row["telf_alumno"] . "'><br><br>";
            
            // echo "<h4>Email Escolar</h4>
            // <input type='text' name='em-esc_al' value='" . $row["email_cole_alumno"] . "'><br><br>";

            // echo "<h4>Email Personal</h4>
            // <input type='text' name='em-per_al' value='" . $row["email_pri_alumno"] . "'><br><br>";

            // echo "<input type='submit' value='Modificar' name='envioEdit'>";
    try {
        $sqlEdit = "UPDATE tbl_alumnos SET"
    } catch (\Throwable $th) {
        
    }
    
?>