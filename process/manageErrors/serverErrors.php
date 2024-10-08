<?php
// VERIFICA SI EL FORMULARIO SE HA ENVIADO CORRECTAMENTE POR UN MÉTODO Y SUBMIT VÁLIDO
function checkServerForms($method, $submit) {
    if ($method || $submit) {
        echo "<script>
                alert('No se pudo procesar la solicitud');
                window.location.href = '../../page/index.php';
              </script>";
        exit();
    }
}
?>