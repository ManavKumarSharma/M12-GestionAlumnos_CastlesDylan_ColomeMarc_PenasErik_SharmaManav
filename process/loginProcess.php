<?php
include ("./connection/connection.php");
session_start();

$_SESSION["data"];

echo $_SESSION["data"]["email"];
echo $_SESSION["data"]["password"];


// Consulta SQL
$sql = "SELECT email_cole_user FROM tbl_user";

// Ejecutar la consulta

$resultado = $mysqli->query($sql);

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
    // Recorrer los resultados y mostrarlos
    while($fila = $resultado->fetch_assoc()) {
        echo "ID: " . $fila["id"]. " - Nombre: " . $fila["nombre"]. " - Email: " . $fila["email"]. "<br>";
    }
} else {
    echo "No se encontraron resultados.";
}



// // Conexión a la base de datos
// $mysqli = new mysqli("localhost", "usuario", "contraseña", "basedatos");

// // Verificar si la conexión es exitosa
// if ($mysqli->connect_error) {
//     die("Error de conexión: " . $mysqli->connect_error);
// }

// // Preparar la sentencia SQL
// $stmt = $mysqli->prepare("INSERT INTO usuarios (nombre, email) VALUES (?, ?)");

// // Verificar si la preparación fue exitosa
// if ($stmt === false) {
//     die("Error en la preparación de la consulta: " . $mysqli->error);
// }

// // Enlazar parámetros (en este caso dos strings: nombre y email)
// $nombre = "Juan";
// $email = "juan@example.com";
// $stmt->bind_param("ss", $nombre, $email);

// // Ejecutar la sentencia
// $stmt->execute();

// // Verificar si la ejecución fue exitosa
// if ($stmt->error) {
//     die("Error en la ejecución de la consulta: " . $stmt->error);
// } else {
//     echo "Datos insertados correctamente.";
// }

// // Cerrar la sentencia y la conexión



?>