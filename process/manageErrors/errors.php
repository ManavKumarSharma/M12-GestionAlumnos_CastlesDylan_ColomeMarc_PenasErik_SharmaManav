<?php
// FUNCIÓN QUE SE LLAMA PARA MANEJAR ERRORES, HACE REDIRECCIÓN POR GET MEDIANTE LA URL Y LA VARIABLE ERRORES
function redirectWithErrors($baseURL, $errors) {
    if (!empty($errors) && !empty($baseURL)) {
        $errorParams = http_build_query(['errors' => $errors]);
        
        header("Location: {$baseURL}?{$errorParams}");
        exit(); // Terminamos la ejecución
    }
}