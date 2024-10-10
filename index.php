<?php
// EN CASO QUE HAYA ERRORES EN LA URL POR GET, INICIALIZA LA VARIABLE
if (isset($_GET['errors'])) {
    $errors = $_GET['errors'];
}
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./validations/validations_js/validateLogIn.js"></script>
    <script src="./process/scripts_js/cargarPagina.js"></script>
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <div id="loader">
        <h1>Cargando página...</h1>
    </div>
    <header>
        <div class="divDelHeader">
            <div class="divLogo">
                <img src="./imagenes/logo2.png" alt="Logo jesuites" class="logo2">
            </div>
            <nav class="nav" id="nav">
                <div class="divHeader">
                    <button class="cerrar-menu" id="cerrar"><i class="bi bi-x"></i></button>
                    <ul class="nav-list">
                        <li class="opciones"><a href="#">Inicio</a></li>
                        <li class="opciones"><a href="#">Quiénes somos</a></li>
                        <li class="opciones"><a href="#">Servicios</a></li>
                        <li class="opciones"><a href="#">Qué hacemos</a></li>
                        <li class="opciones"><a href="#">Contacto</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
        <div class="divContenedor" id="contenido">

            <div class="divPequeño">
                <img src="./imagenes/logo.webp" alt="Logo colegio" class="logo">
            </div>
            <div class="divGrande">
            <form action="./validations/validations_php/validateLogIn.php" method="post" onsubmit="validateLogInForm(event)">

            <label for="email">Correo:</label>
                <input type="email" name="email" id="email" value="<?php echo isset($_SESSION['data']['email']) ? $_SESSION['data']['email'] : "" ; ?>">
                <span class="error" id="errorEmail" hidden>Por favor, ingresa un email válido</span>
                <!-- ERROR FORMATO -->
                <?php
                if (isset($errors['email'])) { 
                    echo '<span class="error">' . htmlspecialchars($errors['email']) . '</span><br>'; // EN CASO DE ERROR, LO MUESTRA
                } 
                ?>
                <!-- ERROR BBDD -->
                <?php
                if (isset($errors['emailBBDD'])) { 
                    echo '<span class="error">' . htmlspecialchars($errors['emailBBDD']) . '</span><br>'; // EN CASO DE ERROR, LO MUESTRA
                } 
                ?>
                <br>
                <label for="password" id="cambiar">Contraseña:</label>
                <input type="password" name="password" id="password">
                <span class="error" id="errorPassword" hidden>Por favor, ingresa una contraseña</span>
                <!-- ERROR FORMATO -->
                <?php
                if (isset($errors['password'])){
                    echo '<span class="error">' . htmlspecialchars($errors['password']) . '</span><br>'; } // EN CASO DE ERROR, LO MUESTRA
                ?>
                <!-- ERROR BBDD -->
                <?php
                if (isset($errors['passwordBBDD'])) {
                    echo '<span class="error">' . htmlspecialchars($errors['passwordBBDD']) . '</span><br>'; // EN CASO DE ERROR, LO MUESTRA
                } 
                ?>
                <br>
                <a href="" id="olvidado">Has olvidado la contraseña?</a>
                <br>
                <button type="submit" name="login" id="enviar">Iniciar Sesión</button>
            </form>
        </div>
    </div>
</body>
</html>