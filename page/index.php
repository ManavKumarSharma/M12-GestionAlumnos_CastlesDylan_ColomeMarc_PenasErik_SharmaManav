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
</head>
<body>
    <form action="../validations/validations_php/validateLogIn.php" method="post">
        <label for="email">Correo:</label>
        <br>
        <input type="email" name="email">
        <br>
        <?php
        if (isset($errors['email'])) {echo $errors['email'] . '</br>'; } // EN CASO DE ERROR, LO MUESTRA
        ?>
        <br>
        <label for="password">Contraseña:</label>
        <br>
        <input type="password" name="password">
        <br>
        <?php
        if (isset($errors['password'])) {echo $errors['password'] . '</br>'; } // EN CASO DE ERROR, LO MUESTRA
        ?>
        <br>
        <button type="submit" name="login">Iniciar Sesión</button>
    </form>
</body>
</html>