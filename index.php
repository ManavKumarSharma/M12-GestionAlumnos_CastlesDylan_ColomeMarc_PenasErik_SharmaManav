<?php
// EN CASO QUE HAYA ERRORES EN LA URL POR GET, INICIALIZA LA VARIABLE
if (isset($_GET['errors'])) {
    $errors = $_GET['errors'];
}
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
    <script src="https://kit.fontawesome.com/fbf78ca96b.js" crossorigin="anonymous"></script>

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
            <div class="btn-cerrar">
                <button class="cerrar-menu" id="cerrar"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#0054e6" d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z"/></svg></button>
            </div>
            <nav class="nav" id="nav">
                <div class="divHeader">
                    <ul class="nav-list">
                    <li class="opciones" id="esconder"><button>X</button></li>
                        <li class="opciones"><a href="#" class="quitarEstilo">Inicio</a></li>
                        <li class="opciones"><a href="#" class="quitarEstilo">Quiénes somos</a></li>
                        <li class="opciones"><a href="#" class="quitarEstilo">Servicios</a></li>
                        <li class="opciones"><a href="#" class="quitarEstilo">Qué hacemos</a></li>
                        <li class="opciones"><a href="#" class="quitarEstilo">Contacto</a></li>
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
                <input type="email" name="email" id="email">
                <span class="error" id="errorEmail" hidden>Por favor, ingresa un email válido</span>
                <?php
                if (isset($errors['email'])) { 
                    echo '<span class="error">' . htmlspecialchars($errors['email']) . '</span><br>'; // EN CASO DE ERROR, LO MUESTRA
                } 
                ?>
                <br>
                <label for="password" id="cambiar">Contraseña:</label>
                <input type="password" name="password" id="password">
                <span class="error" id="errorPassword" hidden>Por favor, ingresa una contraseña</span>
                <?php
                if (isset($errors['password'])){
                    echo '<span class="error">' . htmlspecialchars($errors['password']) . '</span><br>'; } // EN CASO DE ERROR, LO MUESTRA
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