<?php

$host = "localhost";
$user = "root";
$password = "1234";
$dbname = "bd_escuela";

try {
    $mysqli = new mysqli($host, $user, $password, $dbname);
} catch (Exception $e) {
    // Capturar cualquier excepción y mostrar el mensaje de error
    die("Conexión fallida: " . $mysqli->connect_error);
    echo "Error en la conexión: " . $e->getMessage();
}
// NO TOQUEIS EL ARCHIVO MOROSOS
?>