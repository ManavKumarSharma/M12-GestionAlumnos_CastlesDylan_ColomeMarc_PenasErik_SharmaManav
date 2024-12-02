// Detecta el cambio en el select y envía el formulario
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('results_select').addEventListener('change', function() {
        document.getElementById('cambiarNumMostrar').submit();
    });
})
