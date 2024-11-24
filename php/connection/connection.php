<?php

$host = "localhost";
$user = "root";
$password = "1234";
$dbname = "bd_escuela";

try {
    $mysqli = @new mysqli($host, $user, $password, $dbname);
} catch (Exception $e) {
    // Capturar cualquier excepción y mostrar el mensaje de error
    echo "Error en la conexión: " . $e->getMessage();
    echo "</br>";
    die("Conexión fallida.");
}

// NO TOQUEIS EL ARCHIVO MOROSOS
?>