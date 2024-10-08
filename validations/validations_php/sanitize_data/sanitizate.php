<?php
function checkEmail($email) {
    // Verifica si el email es un formato válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    
    return $email;
}
?>