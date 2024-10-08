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
</body>
</html>