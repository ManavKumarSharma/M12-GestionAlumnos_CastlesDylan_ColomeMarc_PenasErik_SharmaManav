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

$baseURL = strtok($_SERVER['REQUEST_URI'], '?');
buildHTTPGet($baseURL, );


// Definir el número de resultados por página desde GET
$limit_number = isset($_GET['results']) ? (int)htmlspecialchars($_GET['results']) : 5;
$page = isset($_GET['page']) ? (int)htmlspecialchars($_GET['page']) : 1;
$offset = ($page - 1) * $limit_number;
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
        
    <?php endif; ?>



