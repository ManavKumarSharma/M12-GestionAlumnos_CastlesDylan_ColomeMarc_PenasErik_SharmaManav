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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


</head>

<body>
    <form action="./validations/validations_php/validateLogIn.php" method="post" onsubmit="validateLogInForm(event)">
        <label for="email">Correo:</label>
        <br>
        <input type="email" name="email" id="email">
        <br>
        <span class="error" id="errorEmail" hidden>Por favor, ingresa un email válido</span>
        <?php
        if (isset($errors['email'])) { 
            echo '<span class="error">' . htmlspecialchars($errors['email']) . '</span><br>'; // EN CASO DE ERROR, LO MUESTRA
        }
        ?>
        <br>
        <label for="password">Contraseña:</label>
        <br>
        <input type="password" name="password" id="password">
        <br>
        <span class="error" id="errorPassword" hidden>Por favor, ingresa una contraseña</span>
        <?php
        if (isset($errors['password'])){
            echo '<span class="error">' . htmlspecialchars($errors['password']) . '</span><br>'; } // EN CASO DE ERROR, LO MUESTRA
        ?>
        <br>
        <button type="submit" name="login">Iniciar Sesión</button>
    </form>
    <header>

        <div class="divDelHeader">
            <div class="divLogo">
                <img src="./imagenes/logo2.png" alt="Logo jesuites" class="logo2">
            </div>
            <div class="divHeader">
                <li>
                    <ul href="" class="opciones">Escuelas y ofertas educativas</ul>
                    <ul href="" class="opciones">Trabaja con nosotros</ul>
                    <ul href="" class="opciones">Proyecto educativo</ul>
                    <ul href="" class="opciones">La fundación</ul>
                </li>

            </div>
        </div>
    </header>
    <div id="loader">
        <h1>Cargando...</h1>
    </div>
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
                <br><br>
                <a href="" id="olvidado">Has olvidado la contraseña?</a>
                <br>
                <button type="submit" name="login" id="enviar">Iniciar Sesión</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>