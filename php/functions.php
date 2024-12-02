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

function buildHTTPGet($baseURL, ...$args) {
    // Inicializamos un arreglo vacío para los parámetros
    $params = [];

    // Procesamos los argumentos en pares (clave, valor)
    for ($i = 0; $i < count($args); $i += 2) {
        // Asegurarnos de que hay un par clave-valor
        if (isset($args[$i + 1])) {
            $params[$args[$i]] = $args[$i + 1];
        }
    }

    // Comprobamos si hay parámetros que agregar
    if (!empty($params)) {
        // Convertir el arreglo de parámetros a una cadena de consulta
        $queryString = http_build_query($params);
        
        // Si la URL ya contiene parámetros, añadir los nuevos con '&', sino con '?'
        if (strpos($baseURL, '?') !== false) {
            $baseURL .= '&' . $queryString;
        } else {
            $baseURL .= '?' . $queryString;
        }
    }

    return $baseURL;
}
?>