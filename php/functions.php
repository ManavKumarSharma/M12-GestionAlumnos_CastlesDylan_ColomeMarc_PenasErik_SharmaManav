<?php
function checkEmail($email) {
    // Verifica si el email es un formato válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    
    return $email;
}

// VERIFICA SI EL FORMULARIO SE HA ENVIADO CORRECTAMENTE POR UN MÉTODO Y SUBMIT VÁLIDO
function checkServerForms($method, $submit) {
    if ($method || $submit) {
        echo "<script>
                alert('No se pudo procesar la solicitud');
                window.location.href = '../../index.php';
              </script>";
        exit();
    }
}

// FUNCIÓN QUE SE LLAMA PARA MANEJAR ERRORES, HACE REDIRECCIÓN POR GET MEDIANTE LA URL Y LA VARIABLE ERRORES
function redirectWithErrors($baseURL, $errors) {
    if (!empty($errors) && !empty($baseURL)) {
        $errorParams = http_build_query(['errors' => $errors]);
        
        header("Location: {$baseURL}?{$errorParams}");
        exit(); // Terminamos la ejecución
    }
}
?>